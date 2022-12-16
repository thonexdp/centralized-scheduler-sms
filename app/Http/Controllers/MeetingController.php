<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\GlobalVar;
use App\Models\Participants;
use Carbon\Carbon;
use DataTables;


class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $global;
    public function __construct()
    {
        $this->global = new GlobalVar();
    }
    public function index()
    {
        return view('meeting');
    }

    public function participants_list_index()
    {
        $meeting = Meetings::all();
        return view('participants', compact('meeting'));
    }

    public function addmeeting(Request $request)
    {

        $id = empty($request->s) ? '' : base64_decode($request->s);
        $department = Department::all();
        $employee = Employee::whereNotNull('campus')->get();
        $meeting = Meetings::find($id);
        return view('add-meeting', compact('department', 'employee', 'meeting'));
    }

    public function save_session_participants(Request $request)
    {
        var_dump($request->arr);
        if (!empty($request->arr)) {
            if (empty(session('participants_id'))) {
                session(['participants_id' => $request->arr]);
            } else {
                $arr_list = session('participants_id');
                $req_arr = $request->arr;
                foreach ($req_arr as $value) {
                    array_push($arr_list, $value);
                }
                session(['participants_id' => $arr_list]);
            }

            dd(session('participants_id'));
        }
    }

    public function participants_list(Request $request)
    {
        try {
            $dataResult = new Collection();
            $meetingid = $request->meetingid;
            $participants = Participants::where('meetingId', $meetingid)->get();
            if(sizeof($participants) == 0){
                return Datatables::of($dataResult)->make(true);
            }
            foreach ($participants as $key => $value) {
                $dataResult->push([
                    'name'  => ucwords($value['Employee']['lastname']) . ",  " . ucwords($value['Employee']['firstname']) . " " . ucwords(empty($value['Employee']['middlename']) ? '' : $value['Employee']['middlename'][0] . "."),
                    'status'  => $value['Employee']['status'],
                    'department'  => $value['Employee']['Department']['name'],
                    'action'  => '<span class="badge bg-danger cancel-meeting-emp" data-empid="' . $value['empid'] . '" data-meetingid="' . $value['meetingId'] . '"><i class="ri-close-fill"></i></span>',
                ]);
            }
            return Datatables::of($dataResult)
                ->editColumn('action', function ($row) {
                    return $row['action'];
                })
                ->rawColumns(['action'])->make(true);
        } catch (\Throwable $th) {
            dd('err:', $th);
        }
    }

    public function participants_employeelist(Request $request)
    {
        try {
            $dataResult = new Collection();
            $meetingid = $request->meetingid;
            $participants = Participants::where('meetingId', $meetingid)->get();
            if (sizeof($participants) > 0) {
                foreach ($participants as $key => $value) {
                   $url= empty($value['Employee']['photo'])?asset('assets/images/profile1.jpg'):asset('storage/'.$value['Employee']['photo']);
                    $dataResult->push([
                        'photo'  => ' <img src="'.$url.'" alt="photo" width="50">',
                        'name'  => ucwords($value['Employee']['lastname']) . ",  " . ucwords($value['Employee']['firstname']) . " " . ucwords(empty($value['Employee']['middlename']) ? '' : $value['Employee']['middlename'][0] . "."),
                        'status'  => $value['Meeting']['description'],
                        'time'  => date('H:i a', strtotime($value['Meeting']['timestart'])) ." - ".date('H:i a', strtotime($value['Meeting']['timend'])),
                        'department'  => $value['Employee']['Department']['name'],
                    ]);
                }
            }
            return Datatables::of($dataResult)
                 ->editColumn('photo', function ($row) {return $row['photo'];})
                ->rawColumns(['photo'])
                ->make(true);
        } catch (\Throwable $th) {
            dd('err:', $th);
        }
    }




    public function cancel_participants(Request $request)
    {
        $empid = $request->empid;
        $meetingId = $request->meetingId;
        $ifExist = Participants::where('empid', $empid)->where('meetingId', $meetingId)->first();
        if ($ifExist) {
            $ifExist->delete();
            return response()->json(['status' => 200, 'message' => 'Remove Successfully']);
        }
        return response()->json(['status' => 400, 'message' => 'Error: Try Again']);
    }


    public function save_participants(Request $request)
    {
        $meeting_id = $request->meeting_id;
        if (!empty($request->arr)) {
            $emp_arr = $request->arr;
            foreach ($emp_arr as $val) {
                $ifExist = Participants::where('empid', $val)->where('meetingId', $meeting_id)->first();
                if (empty($ifExist)) {
                    $meeting = new Participants();
                    $meeting->empid = $val;
                    $meeting->meetingId = $meeting_id;
                    $meeting->save();
                }
            }
            return response()->json(['status' => 200, 'message' => 'Save Successfully']);
        }
        return response()->json(['status' => 400, 'message' => 'NO Employee ID']);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make(
            $request->all(),
            [
                'description' => 'required',
                'meetingdate' => 'required',
                'meetingtype' => 'required',
                'timestart' => 'required:unique',
            ],
            [
                'required' => 'This field is required!',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }

        $description = $request->description;
        $topic = $request->topic;
        $meetingtype = $request->meetingtype;
        $meetingdate = $request->meetingdate;
        $timestart = $request->timestart;
        $timend = $request->timend;
        $duration = $request->duration;
        $venue = $request->venue;
        $link = $request->link;
        //     $maincategory = $request->maincategory;
        //     $campus = empty($request->campus)?'':implode(',',$request->campus);
        //     $secondCat = $request->secondCat;
        //     $itemname = empty($request->campus)?'':implode(',',$request->itemname);
        //     $secondCat = $request->secondCat;
        //    // $alldepartment = $request->alldepartment;
        //     $departmentlist = empty($request->campus)?'':implode(',',$request->departmentlist);
        $addedby = 0;

        //dd( $campus,$itemname,$departmentlist);
        if (empty($request->id)) {
            $meeting = new Meetings();
            $meeting->description = $description;
            $meeting->topic = $topic;
            $meeting->date = $meetingdate;
            $meeting->timestart = $timestart;
            $meeting->timend = $timend;
            $meeting->type = $meetingtype;
            $meeting->duration = $duration;
            $meeting->venue = $venue;
            $meeting->link = $link;
            $meeting->addedby = $addedby;
            $meeting->save();
        } else {
            $meeting = Meetings::find($request->id);
            $meeting->description = $description;
            $meeting->topic = $topic;
            $meeting->date = $meetingdate;
            $meeting->timestart = $timestart;
            $meeting->type = $meetingtype;
            $meeting->duration = $duration;
            $meeting->venue = $venue;
            $meeting->link = $link;
            $meeting->addedby = $addedby;
            $meeting->update();
        }



        return response()->json(['status' => 200, 'message' => 'Save Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {


        $dataResult = new Collection();
        $meetings = Meetings::all();
        if(sizeof($meetings) == 0){
            return Datatables::of($dataResult)->make(true);
        }
        foreach ($meetings as $key => $value) {
            $dataResult->push([
                'id' => $key + 1,
                'description'  => $value['description'],
                'topic'  => $value['topic'],
                'date'  => $value['date'],
                'timestart'  => date('H:i a', strtotime($value['timestart'])) . "-" .  date('H:i a', strtotime($value['timend'])),
                'type'  => $value['type'],
                'venue'  => $value['type']=="Virtual"?$value['link']:$value['venue'],
                // 'addedby'  => $value['addedby'],
                'action'  => ' <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-light btn-sm btn-edit-meeting" data-id="' . $value['id'] . '" > <i class="ri-ball-pen-line text-success mr-2 ml-2"></i> </button>
                            <button type="button" class="btn btn-outline-light btn-sm btn-delete-meeting" data-id="' . $value['id'] . '"><i class="ri-delete-bin-6-line text-danger mr-2 ml-2"></i></button>
                            <a  class="btn btn-outline-light btn-sm" href="' . route('meeting.add', ['s' => base64_encode($value['id'])]) . '"><i class="ri-group-line me-3 text-sucess mr-2 ml-2"></i> Participants</a>
                        </div>',
            ]);
        }
        
        return Datatables::of($dataResult)->editColumn('action', function ($row) {
            return $row['action'];
        })->rawColumns(['action'])->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function my_meeting()
    {
        $dataArray = new Collection();
        $dataArr = array();
        $empid = session('userid');
        $participants = Participants::where('empid', $empid)->get();
       
        $dataArray->push([
            'title' => 'Today',
            'start' => date('Y-m-d'),
            'textColor' => 'lightgreen'
        ]);
        if (sizeof($participants) != 0) {
            foreach ($participants as $value) {
               if(Carbon::now()->startOfDay()->lte($value->Meeting['date'])){
                $dataArray->push([
                    'title' => $value->Meeting['description'],
                    'start' => $value->Meeting['date'],
                ]);
                $dataArray->push([
                    'title' => 'Meeting',
                    'start' => $value->Meeting['date'] . "T" . $value->Meeting['timestart'],  #'2022-11-01T08:01:00'
                ]);
                array_push($dataArr, $value->Meeting['description']);
              }
            }
        }
        return response()->json(['status' => 200, 'data' => $dataArray]);
        // return response()->json(['status' => 400, 'data' => 'No Data Found']);



        // dd(json_encode($participants));
    }

    public function notify_meeting()
    {
        $dataArray = new Collection();
        $dataArr = array();
        $empid = 13;//session('userid');
        
        $participants = Participants::where('empid', $empid)->get();
       
        return response()->json(['status' => 200, 'data' => $participants]);
        // return response()->json(['status' => 400, 'data' => 'No Data Found']);



        // dd(json_encode($participants));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function one(Request $request)
    {
        $id = $request->id;
        $meeting = Meetings::find($id);
        if ($meeting) {
            return response()->json(['status' => 200, 'data' => $meeting]);
        }
        return response()->json(['status' => 400, 'message' => 'No data found']);
    }

    public function send_sms(Request $request)
    {
        try {
            #nextmo register

            /*  key #1  */
            $key = getenv("NEXMO_KEY"); 
            $secret = getenv("NEXMO_SECRET");

               /*  key #2  */
               $key = getenv("NEXMO_KEY2"); 
               $secret = getenv("NEXMO_SECRET2");


            $basic  = new \Nexmo\Client\Credentials\Basic($key,$secret);
            $client = new \Nexmo\Client($basic);


            $meetingID = $request->meeting_id;
            $participants = Participants::where('meetingId',$meetingID)->get();

            if(sizeof($participants) == 0){
                return response()->json(['status' => 400, 'message' => 'Message Not Sent']);
            }
                $num = array();
                $isSend = false;
                        foreach ($participants as $value) {
                        if(!empty($value->Employee) ){
                                if(!empty($value->Employee['cellno'])){
                                    if(strlen($value->Employee['cellno']) == 10){
                                        $firstChar = substr($value->Employee['cellno'], 0, 1);
                                        if($firstChar == '9'){
                                            $receiverNumber = "63".$value->Employee['cellno'];
                                            if(!empty($value->Meeting)){
                                                $message = "There will have a meeting for ".$value->Meeting['description']." on ".$value->Meeting['date'];
                                            }
                                        // array_push($num,$value->Employee['cellno'] );
                                      //  dd( $receiverNumber);
                                       
                                        $message = $client->message()->send([
                                            'to' => $receiverNumber,
                                            'from' => "SLSU_CM_SMS",
                                            'text' => $message
                                        ]);
                                        $isSend = true;
                                        }
                                    }
                                }
                        }
                        }

                   // dd($isSend);
    
        if($isSend){
            return response()->json(['status' => 200, 'message' => 'Message Sent Success']);
        }
        return response()->json(['status' => 400, 'message' => 'Message Not Sent!Please try again!']);
              //code...
            } catch (\Throwable $th) {
                return response()->json(['status' => 500, 'message' => 'Error MSG Not Sent',$th]);
            }

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $meeting = Meetings::find($request->id);
        if ($meeting) {
            $meeting->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Deleted Successfully'
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => 'No record found',
        ]);
    }
    public function getvenue(Request $request)
    {
        $date = $request->date;
      //  $duration = $request->duration;
      $dataResult = new Collection();
        if (!empty($date)) {
            $meeting = Meetings::where('date', $date)->get();
            if ($meeting) {
                foreach($meeting as $data){
                    $dataResult->push([
                        'venue' => $data['venue'],
                        'timestart' => empty($data['timestart'])?'':Carbon::parse($data['timestart'])->format('H:i A'),
                        'timend' => empty($data['timend'])?'':Carbon::parse($data['timend'])->format('H:i A'),
                    ]);
                }
                return response()->json([
                    'status' => 200,
                    'data' => $dataResult
                ]);
            }
        }

        return response()->json([
            'status' => 400,
            'message' => 'No record found',
        ]);
    }
}
