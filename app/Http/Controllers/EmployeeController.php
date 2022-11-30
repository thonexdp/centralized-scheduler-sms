<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Collection;
use App\Http\Controllers\GlobalVar;
use App\Models\Meetings;
use App\Models\Participants;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
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
        $department = Department::all();
        return view('employee', compact('department'));
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
        try {
      
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'department' => 'required',
            'agencyno' => 'unique:employee,agencyno,' . $request->id,
            'status' => 'required',
            'cellno' => 'required:unique'
        ],
            [
               'required'  => 'This field is required'
            ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }

        if(empty($request->id)){
            $find = Employee::all();
            foreach ($find as $value) {
                if(strtolower(trim($value->firstname)) == strtolower(trim($request->firstname)) and strtolower(trim($value->lastname)) == strtolower(trim($request->lastname)) and $value->campus == $request->campus ){
                    return response()->json([
                        'status' => 401,
                        'message' => 'Employee Name Already Exist'
                    ]);
                }
            }
            $save = new Employee();
            $save->firstname = $request->firstname;
            $save->middlename = $request->middlename;
            $save->lastname = $request->lastname;
            $save->agencyno = $request->agencyno;
            $save->department = $request->department;
            $save->cellno = $request->cellno;
            $save->email = $request->email;
            $save->status = $request->status;
            $save->itemname = $request->itemname;
            $save->campus = 'mc';
            $save->photo = $request->filepath;
            $save->save();
            $user = new Users();
            $user->empid = $save->id;
            $user->username = strtolower($save->lastname)."".$save->agencyno;
            $user->password = Hash::make('1234');
            $user->role = strtolower($request->itemname);
            $user->save();
        }else{
            $save = Employee::find($request->id);
            $save->firstname = $request->firstname;
            $save->middlename = $request->middlename;
            $save->lastname = $request->lastname;
            $save->agencyno = $request->agencyno;
            $save->department = $request->department;
            $save->cellno = $request->cellno;
            $save->email = $request->email;
            $save->status = $request->status;
            $save->itemname = $request->itemname;
            $save->campus = 'mc';
            if(!empty($request->filepath)){
                $save->photo = $request->filepath;
            }
            $save->update();
            $user = Users::where('empid',$request->id)->first();
            if($user){
                $user->username = strtolower($save->lastname)."".$save->agencyno;
                $user->role = strtolower($request->itemname);
                $user->update();
            }
            
        }
       
        return response()->json([
            'status' => 200,
            'message' => 'Save Successfully',
        ]);
             //code...
            } catch (\Throwable $th) {
               dd($th);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $dataResult = new Collection();
        $employee = Employee::orderBy('lastname')->get();
       if(sizeof($employee) == 0){
        return Datatables::of($dataResult)->make(true);
       }

        foreach ($employee as $key => $value) {
           // if($value->campus == $request->campus){
                $url= empty($value['photo'])?asset('assets/images/profile1.jpg'):asset('storage/'.$value['photo']);
                 
                $dataResult->push([
                    'id' => $key + 1,
                    'photo'  => ' <img src="'.$url.'" alt="photo" width="60">',
                    'name'  => ucwords($value['lastname']).",  ". ucwords($value['firstname'])." ".ucwords(empty($value['middlename'])?'':$value['middlename'][0]."."),
                    'agencyno'  => $value['agencyno'],
                    'department'  => $value['department'],
                    'cellno'  => $value['cellno'],
                    'email'  => $value['email'],
                    'status'  => $value['status'],
                    'itemname'  => $value['itemname'],
                    'action'  => ' <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-light btn-sm btn-edit-employee" data-id="'.$value['id'].'" > <i class="ri-ball-pen-line text-success mr-2 ml-2"></i> </button>
                            <button type="button" class="btn btn-outline-light btn-sm btn-delete-employee" data-id="'.$value['id'].'"><i class="ri-delete-bin-6-line text-danger mr-2 ml-2"></i></button>
                        </div>',
                ]);
         //   }
        }
       
        return Datatables::of($dataResult)
        ->editColumn('action', function ($row) { return $row['action'];})
        ->editColumn('photo', function ($row) { return $row['photo'];})
            ->rawColumns(['action','photo'])->make(true);
    }

    public function cropimage(Request $request){
         $data = $request->image;
         $image1 = explode(';', $data);
	     $image2 = explode(',', $image1[1]);

	    $data = base64_decode($image2[1]);
        $filepath = "images/".time().'.png';
        Storage::disk('public')->put($filepath, $data);
        return response()->json(['status' => 200, 'path' => $filepath]);

    }
    public function showinmeeting(Request $request)
    {
       //dd($request->all());
        $dataResult = new Collection();
        $status = $request->status;
        $department = $request->department;
        $campus = $request->campus;
        $meetingId = $request->meetingId;
        $meetingDate = $request->meetingDate;
        $meetingDuration = $request->meetingDuration;
        $meeting_start = $request->meeting_start;
        $meeting_end = $request->meeting_end;
        

       
        // if(empty($campus) and empty($status) and empty($department)){
        //     $employee = Employee::whereNotNull('campus')->orderBy('lastname')->get();
        // }

         $query = Employee::whereNotNull('campus');

        if (!empty($status)) {
              $query->where('itemname', $status);
        }
        if (!empty($department)) {
            $query->where('department', $department);
        }
        if (!empty($campus)) {
        $query->where('campus', $campus);
        }

        $employee = $query->orderBy('lastname')->get();


    
        $partipants_array_notEncluded = array();
        $partipants_array = array();
        $meeting_array = array();
        //$meeting = Meetings::where('date', $meetingDate)->where('duration',$meetingDuration)->where('id','!=',$meetingId)->get();
        $meeting = Meetings::where('date', $meetingDate)->where('id','!=',$meetingId)->get();

     // dd($meeting);
      //$test = 'false';
        foreach ($meeting as $value) {

            $start = Carbon::parse($meeting_start);
            $end = Carbon::parse($meeting_end);
    
    
           // $start = Carbon::parse('09:30:00');
           // $end = Carbon::parse('15:40:00');
    
            $cstart = Carbon::parse($value->timestart);
            $cend = Carbon::parse($value->timend);
           // $check = '';
    
            if ($start->between($cstart, $cend) or $end->between($cstart, $cend)  ) {
               // $test = 'true 1';
                array_push($meeting_array, $value->id); 
              }else{
                if ($cstart->between($start, $end) or $cend->between($start, $end)  ) {
                  //  $test = 'true 2';
                    array_push($meeting_array, $value->id); 
                }
                // else{
                //     $check = 'false';
                // }
              }

        }


     ///  dd($meeting_array);

        //  $partipants = Participants::whereIn('meetingId', $meeting_array)->get();
        // // dd($partipants);
        //   if(sizeof($partipants) == 0){

        //     $partipants = Participants::where('meetingId', $meetingId)->get();
        //     foreach ($partipants as $value) {
        //             array_push($partipants_array,$value->empid); 
        //     }

        //     // dd($partipants_array);



        //  }else{
        //     foreach ($partipants as $value) {
        //             array_push($partipants_array,$value->empid); 
        //     }
        //     $partipants = Participants::where('meetingId', $meetingId)->get();
        //     foreach ($partipants as $value) {
        //         array_push($partipants_array,$value->empid); 
        //     }
       //   }
        // where(function ($q) {
        //     $q->where('start_date', '<=', date('Y-m-d'));
        //     $q->where('end_date', '>=', date('Y-m-d'));
        //   })


        // $start = Carbon::parse($meeting_start);
        // $end = Carbon::parse($meeting_start);


        // $start = Carbon::parse('09:30:00');
        // $end = Carbon::parse('15:40:00');

        // $cstart = Carbon::parse('08:00:00');
        // $cend = Carbon::parse('09:00:00');
        // $check = '';

        // if ($start->between($cstart, $cend) or $end->between($cstart, $cend)  ) {
        //     $check = 'true 1';
        //   }else{
        //     if ($cstart->between($start, $end) or $cend->between($start, $end)  ) {
        //         $check = 'true 2';
        //     }else{
        //         $check = 'false';
        //     }
        //   }


        //  dd($check);

      // if($cstart->startOfDay()->lte($start) and $cend->startOfDay()->gte($start)){ }
      



            //   foreach ($partipants as $value) {
            //         array_push($partipants_array,$value->empid); 
            //   }
         //   dd($partipants_array);


         $partipants = Participants::whereIn('meetingId', $meeting_array)->get();
            if(sizeof($partipants) > 0){
                foreach ($partipants as $value) {
                    array_push($partipants_array,$value->empid); 
                }
            }
                $partipants = Participants::where('meetingId', $meetingId)->get();
                    foreach ($partipants as $value) {
                        array_push($partipants_array_notEncluded,$value->empid); 
                }
        

      //   dd($partipants_array);

        foreach ($employee as $key => $value) { 
            $isConflict = '';
            if(!in_array($value['id'],$partipants_array_notEncluded)){
                if(in_array($value['id'],$partipants_array)){
                    $isConflict = '<small class="text-danger"><i>Conflict Schedule</i> </small>';
                }
                $dataResult->push([
                    'name'  => ucwords($value['lastname']).",  ". ucwords($value['firstname'])." ".ucwords(empty($value['middlename'])?'':$value['middlename'][0]."."),
                    'department'  => empty($value['Department'])?'':$value['Department']['name'],
                    'status'  => $value['status'],
                    'conflict'  => $isConflict ,
                    'chk' => '<input type="checkbox" name="chkemployee[]" value="'.$value['id'].'">'
                ]);
            
            }
        }

        // foreach ($employee as $key => $value) { 
        //     if(!in_array($value['id'],$partipants_array)){
        //         $dataResult->push([
        //             'name'  => ucwords($value['lastname']).",  ". ucwords($value['firstname'])." ".ucwords(empty($value['middlename'])?'':$value['middlename'][0]."."),
        //             'department'  => empty($value['Department'])?'':$value['Department']['name'],
        //             'status'  => $value['status'],
        //             'campus'  => $this->global->cammpusDescription($value['campus']),
        //             'chk' => '<input type="checkbox" name="chkemployee[]" value="'.$value['id'].'">'
        //         ]);
        //     }
        // }
       
       
        return Datatables::of($dataResult)
        ->editColumn('chk', function ($row) {return $row['chk'];})
        ->editColumn('conflict', function ($row) {return $row['conflict'];})
        ->rawColumns(['chk','conflict'])->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $employee = Employee::find($request->id);
        if($employee){
            return response()->json([
                'status' => 200,
                'data' => $employee,
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => 'No record found',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $employee = Employee::find($request->id);
        if($employee){
            $employee->delete();
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
}
