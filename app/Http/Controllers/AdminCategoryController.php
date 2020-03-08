<?php

namespace App\Http\Controllers;

use App\Category;
use App\users1;
use App\adminuser;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Resource_;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
           if ($request->ajax()) {
            $data = Category::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $menus = DB::table('admin_menu')->get();
        return view('admin.dashboard', ['menus'=>$menus]) ;//,compact('products'));
    }


    public function login()
    {

         return view('admin.login',['alert'=>'']) ;//,compact('products'));
    }

    public function forgot_password(){
        $temp = adminuser::get();
        $admin_email = $temp[0]->email;
        return view('admin.forgot', ['alert'=>'']);
    }
    public function signin(Request $request)
    {

        $name = adminuser::get();
        if(($request->username == $name[0]->name) and ($request->password == $name[0]->password)){
            $request->session()->put("admin", $name);
           return $this->index($request) ;//,compact('products'));
        }
        else{
            return view('admin.login',['alert'=>'']);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::updateOrCreate(['id' => $request->category_id],
            ['category' => $request->category, 'priority' => $request->priority]);

        return response()->json(['success'=>'Product saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Category::find($id);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }

    public function send_password(Request $request)
    {

        $temp = adminuser::get();
        $email = $temp[0]->email;
        $password = $temp[0]->password;

        if($request->input('admin_mail') === $email) {
            $to_name = 'admin';
            $to_email = $email;
            $data = array('name' => 'administrator of Tipsmate','body' => $password);
            Mail::send('emails.mail', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('admin password send');
                $message->from('no-reply@tipsmate.com', 'To Administrator');
            });
            return view('admin.forgot',['alert'=>'We sent password to email successfully.']);
        }
        else{
            return view('admin.forgot',['alert'=>'We can not match email.']);
        }
    }

    public function reset_password(){
        return view('admin.reset', ['alert'=>" "]);
    }

    public function reset_confirm_password(Request $request){
        $temp = adminuser::get();
        $alert ="";
        if($request->input('new_password') !== $request->input('confirm_password')){
            $alert = "The password confirmation does not match.";
            return view('admin.reset',['alert'=> $alert]);
        }
        elseif ($temp[0]->password !== $request->input('old_password')){
            $alert = "The old password does not exact.";
            return view('admin.reset',['alert'=> $alert]);
        }
        else{

            adminuser::updateOrCreate(['name' => 'admin'], [ 'password' => $request->input('new_password')]);
            return view('admin.login', ['alert'=>'Reset Password Successfully!']);
        }
    }

}
