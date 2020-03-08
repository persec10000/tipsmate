<?php

namespace App\Http\Controllers;

use App\PageContent;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;


class PageContentController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PageContent::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm ViewProduct">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $menus = DB::table('admin_menu')->get();
        return view('admin.pageContent', ['menus' => $menus]  ) ;//,compact('products'));
    } //


    public function store(Request $request)
    {
        PageContent::updateOrCreate(['id' => $request->page_id],
            ['meta_tags' => $request->meta_tags, 'page_title' => $request->page_title, 'keywords' => $request->keywords, 'page_content'=> $request->page_content, 'page_sc_name'=>$request->page_sc_name]);

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
        $product = PageContent::find($id);
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
        PageContent::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
