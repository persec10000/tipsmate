<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class VideoCommentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('video_comment')
                ->Join('video', 'video.id', '=', 'video_comment.video_id')
                ->Join('users','users.id','=','video_comment.user_id')
                ->select( 'video_comment.id','video_comment.content as comment','video.title as video', 'users.name as user')
                ->orderBy('video_comment.updated_at', 'desc')
                ->get();

            foreach($data as $row){
                $row->comment = str_limit($row->comment,40);
            }
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
        return view('admin.video_comment' , ['menus'=> $menus]) ;//,compact('products'));
    }//  ////
    public function destroy($id)
    {
        DB::table('video_comment')->where('id','=',$id)->delete();
        return response()->json(['success'=>'Product deleted successfully.'.$id]);
    }
}
