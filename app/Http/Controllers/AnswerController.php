<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class AnswerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('answer')
                ->Join('question', 'question.id', '=', 'answer.question_id')
                ->select('answer.id', 'answer.answer', 'question.title as question', 'answer.name as user', 'answer.following')
                ->orderBy('answer.register_date', 'desc')
                ->get();
            foreach($data as $row){
                    $row->answer = str_limit($row->answer,40);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $menus = DB::table('admin_menu')->get();
        return view('admin.answer',['menus'=>$menus]);//,compact('products'));
    }
    public function destroy($id)
    {
        DB::table('answer')->where('id', '=', $id)->delete();
        return response()->json(['success' => 'delete success' . $id]);
    }
}

