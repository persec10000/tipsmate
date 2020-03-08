<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class AdminVideoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('video')
                ->Join('q_a_s', 'q_a_s.id', '=', 'video.category_id')
                ->Join('users','users.id','=','video.user_id')
                ->select( 'video.id','video.title','q_a_s.category', 'users.name as user')
                ->orderBy('video.updated_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $menus = DB::table('admin_menu')->get();
        return view('admin.video',['menus' =>$menus ]) ;//,compact('products'));
    }//  //

    public function destroy($id)
    {
        DB::table('video')->where('id','=',$id)->delete();
        return response()->json(['success'=>'Product deleted successfully.'.$id]);
    }
}
