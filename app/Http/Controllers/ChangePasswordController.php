<?php

namespace App\Http\Controllers;

use App\adminuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangePasswordController extends Controller
{
    public function index(Request $request)
    {
        $menus = DB::table('admin_menu')->get();
        return view('admin.ChangePassword', ['alert' => '', 'menus'=> $menus]);
    }

    public function confirm(Request $request){
        $temp = adminuser::get();
        $alert ="";
        $menus = DB::table('admin_menu')->get();
        if($request->input('newpassword') !== $request->input('confirmpassword')){
            $alert = "The password confirmation does not match.";
            return view('admin.ChangePassword',['alert'=> $alert, 'menus'=>$menus]);
        }
        elseif ($temp[0]->password !== $request->input('oldpassword')){
            $alert = "The old password does not exact.";
            return view('admin.ChangePassword',['alert'=> $alert, 'menus'=>$menus]);
        }
        else{
            adminuser::updateOrCreate(['name' => 'admin'], [ 'password' => $request->input('newpassword')]);
            return view('admin.ChangePassword', ['alert'=>'Password is changed Successfully!'
                , 'menus'=>$menus]);
        }
    }

    //
}
