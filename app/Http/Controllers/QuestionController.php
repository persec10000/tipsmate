<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Question;
use DataTables;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('q_a_s')
                ->Join('question', 'question.category_id', '=', 'q_a_s.id')
                ->Join('users', 'users.id', '=', 'question.user_id')
                ->select( 'question.id','question.title', 'q_a_s.category', 'users.name','question.following')
                ->orderBy('question.register_date', 'desc')
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
        return view('admin.question', ['menus'=>$menus]) ;//,compact('products'));
    }

    public function destroy($id)
    {
        DB::table('question')->where('id','=',$id)->delete();
        return response()->json(['success'=>'Product deleted successfully.'.$id]);
    }
}
