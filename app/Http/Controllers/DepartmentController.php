<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\GlobalVar;
use DataTables;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $global;
    public function __construct()
    {
        $this->global = new GlobalVar();
    }
    public function index(){
        return view('department');
    }
    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'data' => '',
                'message' => $validator->messages(),
            ]);
        }

        if(empty($request->id)){
            $find = Department::all();
            foreach ($find as $value) {
                if(strtolower(trim($value->name)) == strtolower(trim($request->name)) and $value->campus == $request->campus ){
                    return response()->json([
                        'status' => 401,
                        'message' => 'Department Already Exist for '.$this->global->cammpusDescription($request->campus),
                    ]);
                }
            }
            $save = new Department();
            $save->name = $request->name;
            $save->description = $request->description;
            $save->campus = $request->campus;
            $save->save();
        }else{
            $save = Department::find($request->id);
            $save->name = $request->name;
            $save->description = $request->description;
            $save->campus = $request->campus;
            $save->update();
        }
       
        return response()->json([
            'status' => 200,
            'message' => 'good',
        ]);

    }
    public function bycampus(Request $req){

        $dataResult = new Collection();
        $department = Department::orderBy('name')->get();
        foreach ($department as $key => $value) {
           // if($value->campus == $req->campus){
                $dataResult->push([
                    'id' => $key + 1,
                    'name'  => strtoupper($value['name']),
                    'description'  => $value['description'],
                    // 'campus'  => $this->global->cammpusDescription($value['campus']),
                    'action'  => ' <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-light btn-sm btn-edit-department" data-id="'.$value['id'].'" > <i class="ri-ball-pen-line text-success mr-2 ml-2"></i> </button>
                            <button type="button" class="btn btn-outline-light btn-sm btn-delete-department" data-id="'.$value['id'].'"><i class="ri-delete-bin-6-line text-danger mr-2 ml-2"></i></button>
                        </div>',
                ]);
           // }
        }
        return Datatables::of($dataResult)->editColumn('action', function ($row) {
            return $row['action'];
        })->rawColumns(['action'])->make(true);


        // $department = Department::where('campus', $req->campus)->get();
        // if(sizeof($department) == 0){
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'No data found!',
        //     ]);
        // }
        // return response()->json([
        //     'status' => 200,
        //     'data' => $department,
        // ]);
    }
    public function one(Request $req){

        $id = $req->id;
        $department = Department::find($id);
        if($department){
            return response()->json([
                'status' => 200,
                'data' => $department,
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => 'No record found',
        ]);
       
    }
    public function destroy(Request $request){
        $id = $request->id;
        $department = Department::find($id);
        if($department){
            $department->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Deleted Successfully!',
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => 'Server Error. Try again!',
        ]);
    }
}
