<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;


class CommentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('comment')
                ->Join('answer', 'answer.id', '=', 'comment.answer_id')
                ->select( 'comment.id','comment.comment', 'answer.answer as answer', 'comment.name as user')
                ->orderBy('answer.register_date', 'desc')
                ->get();
            foreach($data as $row){
                $row->comment = str_limit($row->comment,40);
                $row->answer = str_limit($row->answer,40);
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
        return view('admin.comment',['menus'=>$menus]) ;//,compact('products'));
    }//
    public function destroy($id)
    {
        DB::table('comment')->where('id','=',$id)->delete();
        return response()->json(['success'=>'Product deleted successfully.'.$id]);
    }

}
