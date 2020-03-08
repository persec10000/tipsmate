<?php

namespace App\Http\Controllers;

use App\users1;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = users1::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar', function($row){
                    $avatar = '<img src="/fireuikit/images/users/'.$row->image.'" width="50" height="50" class="rounded-circle">';
                    return $avatar;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                    return $btn;
                })
                ->addColumn('ask', function($row){
                    if($row->enable_question){
                        $status_icon = '<img src="/fireuikit/images/right.png" data-id="'.$row->id.'"  width="16" height="16" class="img_ask">';
                    }
                    else{
                        $status_icon = '<img src="/fireuikit/images/cross.png" data-id="'.$row->id.'" width="16" height="16" class="img_ask1">';
                    }
                    return $status_icon;
                })
                ->addColumn('post', function($row){
                    if($row->enable_article){
                        $status_icon = '<img src="/fireuikit/images/right.png" data-id="'.$row->id.'" width="16" height="16" class="img_post">';
                    }
                    else{
                        $status_icon = '<img src="/fireuikit/images/cross.png" data-id="'.$row->id.'" width="16" height="16" class="img_post1">';
                    }
                    return $status_icon;
                })
                ->rawColumns(['avatar','ask', 'post','action'])
                ->make(true);
        }

        $menus = DB::table('admin_menu')->get();
        return view('admin.admin_user',['menus'=>$menus]) ;//,compact('products'));
    }

    public function store(Request $request)
    {
        if($request->ask !== null) {
            users1::updateOrCreate(['id' => $request->id],
                ['enable_question' => $request->ask]);
        }
        if($request->post !== null){
            users1::updateOrCreate(['id' => $request->id],
                ['enable_article' => $request->post]);
        }
        return response()->json(['success'=>$request->id, 'enable_question' => $request->ask]);
    }

    public function destroy($id)
    {
        users1::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }



}
