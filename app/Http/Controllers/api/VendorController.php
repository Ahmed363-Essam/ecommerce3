<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;


use App\Models\vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        try {
            $vendor = vendor::with(['department'=>function($q){
                $q->select('id','name','description');
            }])->get();

            return $vendor;
        } catch (\Exception $e) {
            //throw $th;
        }
  
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //code...

            $vendor_file = $request->file('logo');

            $vendor_file_name = $vendor_file->getClientOriginalName();


            $vendor_file->storeAs('vendor/' . $vendor_file_name, $vendor_file_name, 'vendor');
            vendor::create([
                'department_id' => $request->department_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'description' => $request->description,
                'note' => $request->note,
                'logo' => $vendor_file_name
            ]);
            return response([
                'status' => 200,
                'msg' => "The Manger Added Sucessfuly",

            ]);
        } catch (\Exception $e) {
            return response([
                'status' => 404,
                'msg' => $e,

            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */






    public function showvendorpost(Request $request)
    {
        //

        try {
            $id = $request->id;
            $show_vendor = vendor::with(['department'=>function($q){
                $q->select('id','name');
            }])->findorfail($id);
            return response([
                'status'=>200,
                'msg'=>$show_vendor

            ]);

        } catch (\Exception $e) {
            return response([
                'status'=>404,
                'msg'=>$e

            ]);
        }

    }

    public function showvendorget($vendor_id)
    {
        //

        $show_vendor = vendor::with(['department'=>function($q){
            $q->select('id','name');
        }])->with('products')->findorfail($vendor_id);
        return response([
            'status'=>200,
            'msg'=>$show_vendor
        ]);
        try {
            //code...
        } catch (\Exception $e) {
            return response([
                'status'=>404,
                'msg'=>$e

            ]);
        }
    }




    public function show(vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update( $vendor_id,Request $request)
    {
        try {
            $vendor = vendor::find($vendor_id);

       
            $vendor->update([
                'department_id' => $request->department_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'description' => $request->description,
                'note' => $request->note
            ]);
            return response([
                'status'=>200,
                'msg'=>'updated done'

            ]);
        } catch (\Exception $e) {
            return response([
                'status'=>4004,
                'msg'=>$e

            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $vendor_id = vendor::findorfail($request->id);

            $vendor_id->delete();
            return response([
                'status' => 200,
                'msg' => "deleted succesfully",

            ]);
        } catch (\Exception $e) {

            return response([
                'status' => 404,
                'msg' => $e,

            ]);
        }
    }
}
