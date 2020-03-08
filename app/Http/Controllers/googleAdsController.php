<?php

namespace App\Http\Controllers;

use App\googleAds;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class googleAdsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = googleAds::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('advertise', function ($row){
                    if ($row->ads_type == "Banner") {
                        $advertise = '<img src="/fireuikit/images/google_ads.jfif">';
                    } else {
                        $advertise = $row->ads_google;
                    }
                    return $advertise;
                })
                ->addColumn('ads_status', function ($row){
                    if($row->status == "Active"){
                        $status_icon = '<img src="/fireuikit/images/right.png" width="16" height="16">';
                    }
                    else{
                        $status_icon = '<img src="/fireuikit/images/cross.png" width="16" height="16">';
                    }
                    return $status_icon;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                    $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['ads_status','advertise','action'])
                ->make(true);
        }

        $menus = DB::table('admin_menu')->get();
        return view('admin.googleAds' , ['menus'=>$menus]) ;//,compact('products'));
    } //


    public function store(Request $request)
    {
        googleAds::updateOrCreate(['id' => $request->ads_id],
            ['ads_name' => $request->ads_name, 'ads_type' => $request->ads_type, 'ads_google' => $request->ads_google, 'ads_banner' => $request->ads_banner, 'ads_banner_url' => $request->ads_banner_url, 'status' => $request->status]);

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
        $product = googleAds::find($id);
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
        googleAds::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
