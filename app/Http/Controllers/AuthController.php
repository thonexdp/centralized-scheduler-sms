<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        if(!empty(session('userid'))){
            return redirect('/dashboard');
        }
        return view('login');
    }
    public function login(Request $request){
        $username = strtolower($request->username);
        $password =  $request->password;

        $findEmployee = Users::where('username',$username)->first();
        if($findEmployee and Hash::check($password, $findEmployee->password)){
                session([
                    'name' => ucwords($findEmployee->employee['firstname'])." ". ucwords($findEmployee->employee['lastname']) ,
                    'userid' => $findEmployee->employee['id'],
                    'userole' => $findEmployee->role,
                    'photo' => $findEmployee->employee['photo']
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => '/dashboard'
                ]);
        }
         return response()->json([
                'status' => 400,
                'message' => 'No user Found'
            ]);
       // dd('eror',$findEmployee);
        // $found = false;
        // if($findEmployee){
        //     foreach ($findEmployee as $value) {
        //         $userName = strtolower($value->lastname)."".$value->agencyno;
        //        if($userName == $username and $password == '1234'){
        //         $found = true;
        //        }
        //     }
            // if($findEmployee){
            //     session([
            //         'name' => ucwords($value->firstname)." ". ucwords($value->lastname) ,
            //         'userid' => $value->id,
            //         'photo' => $value->photo
            //     ]);
            //     return response()->json([
            //         'status' => 200,
            //         'message' => '/employee'
            //     ]);
            // }
            // return response()->json([
            //     'status' => 400,
            //     'message' => 'No user Found'
            // ]);
        // }
        // return response()->json([
        //     'status' => 500,
        //     'message' => 'Server Error'
        // ]);
    }
    public function logout(Request $request){
        session()->flush();
       // \Session::forget('key');
        return redirect('/');
    }
}
