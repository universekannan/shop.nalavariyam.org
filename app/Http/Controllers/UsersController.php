<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;

use App\Models\Core\Setting;
use App\Models\Admin\Admin;
use App\Models\Core\Order;
use App\Models\Core\Customers;
use App\Models\Core\Drivers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Input;
use Exception;
use App\Models\Core\Images;
use Validator;
use Hash;
use Auth;
use ZipArchive;
use File;
use Carbon\Carbon;



class UsersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /****** View  Roles Start ******/

    public function manageUsers(){
        $login_id = Auth::user()->id;
        $shop_name = Auth::user()->shop_name;
        if(Auth::user()->user_types_id == 1){
         $manageusers = DB::table('users')->select('users.*','user_types.*','users.id as userID')
         ->Join('user_types', 'user_types.id', '=', 'users.user_types_id')->where('user_types.id', '=',2)
         ->orderBy('users.id','Asc')->get();
     }else if(Auth::user()->user_types_id == 2){
        $manageusers = DB::table('users')->select('users.*','user_types.*','users.id as userID')
        ->Join('user_types', 'user_types.id', '=', 'users.user_types_id')->where('user_types.id', '=',3)->where('users.login_id', '=',$login_id)
        ->orderBy('users.id','Asc')->get();

    }


            //$sql = "select * from user_types where "    
    if(Auth::user()->user_types_id == 1){
        $userrole = DB::table('user_types')->where('status',1)->where('id','=',2)->get();

    }else if(Auth::user()->user_types_id == 2){
        $userrole = DB::table('user_types')->where('status',1)->where('id','=',3)->get();

    }    


    return view("users.index",compact('shop_name'))->with('manageusers',$manageusers)->with('userrole', $userrole);


}

/******   View Roles  end ******/

public function usersAttendance($id){
    $attendance = DB::table('attendances')->select('attendances.*','users.*','attendances.id as userID')
    ->Join('users', 'users.id', '=', 'attendances.user_id')
    ->orderBy('attendances.id','Asc')->get();
    return view("users.attendance")->with('attendance', $attendance);
}

/****** Add  Roles Action Start ******/

public function addUser(Request $request){
               /* $email = trim($request->get('email'));
                $emailcheck = DB::table('users')->select('email')->where('email','=',$email)->get();

               if(count($emailcheck) > 0){
            return redirect('/users')->with('error', 'Email already used by another user');
        }else{*/
            $login_id =  Auth::user()->id;
            $customers_id = DB::table('users')->insertGetId([

                'full_name'		 		    =>   $request->first_name.' '.$request->last_name,
                'first_name'		 		=>   $request->first_name,
                'last_name'			 		=>   $request->last_name,
                'mobile_number'	 			=>	 $request->mobile_number,
                'email'                     =>   $request->email,
                'shop_name'                 =>   $request->shop_name,
                'login_id'                  =>   $login_id,

                'password'		 			=>   Hash::make($request->password),
                'check_password'		 	=>   $request->password,
                'gender'                    =>   $request->gender,
                'address'                   =>   $request->address,
                'created_at'                =>   date('Y-m-d H:i:s'),
                'user_types_id'			    =>	 $request->user_types_id
            ]);

            $addUserRoles = DB::table('user_permission')->insert([
                'user_types_id'   =>   $request->user_types_id,
                'user_id'         =>   $customers_id,
            ]);
            return redirect('/users')->with('success', 'Users Created Successfully');
        }

        /****** Edit  Roles Start ******/

        public function editUser(Request $request){

            $edituser = DB::table('users')->where('id',$request->id)->update([
                'full_name'                 =>   $request->first_name.' '.$request->last_name,
                'first_name'                =>   $request->first_name,
                'last_name'                 =>   $request->last_name,
                'mobile_number'             =>   $request->mobile_number,
                'email'                     =>   $request->email,
                'shop_name'                 =>   $request->shop_name,
                'gender'                    =>   $request->gender,
                'address'                   =>   $request->address,
                'status'                    =>   $request->status,
                'created_at'                =>   date('Y-m-d H:i:s'),
                'user_types_id'             =>   $request->user_types_id
            ]);
                            //Print_r($edituser);die();

            return redirect('/users')->with('success', 'Users Updated Successfully'); 
        }
        /******   Edit Users End ******/

        public function checkemail(Request $request){
            $email = trim($request->get('email'));
            $id = trim($request->get('id'));
            if($id == 0){
                $sql = "SELECT * FROM users where email='$email'";
            }else{
                $sql = "SELECT * FROM users where email='$email' and id <> $id";
            }
            $emailcheck = DB::select(DB::raw($sql));
            if(count($emailcheck) > 0){
                return response()->json(array("exists" => true));
            }else{
                return response()->json(array("exists" => false));   
            }
        }

    }
