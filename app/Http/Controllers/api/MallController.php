<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Mall;
use Illuminate\Http\Request;

class MallController extends Controller
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
            $Mall = Mall::with('manager')->get();

            return response([
                'msg' => "sucess",
                'status' => 200,
                'data' => $Mall
            ]);

        } catch (\Exception $e) {
            return response([
                'msg' => "failed",
                'status' => 404,
                'data' => $e
            ]);
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



            $Mall_file = $request->file('photo');

            $Mall_file_name = $Mall_file->getClientOriginalName();


            $Mall_file->storeAs('mail/' . $Mall_file_name, $Mall_file_name, 'mail');
            Mall::create([
                'manager_id' => $request->manager_id,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'space' => $request->space,
                'note' => $request->note,
                'photo' => $Mall_file_name,

            ]);
            

            return response([
                'msg'=> 'Manager Mail Added Sucessfully ',
                'status'=>200,
                
            ]);

        } catch (\Exception $e) {

            return response([
                'msg'=> $e,
                'status'=>404,
                
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function showpost(Request $request)
    {
        //

        try {
            $id = $request->id;
            $show_Mall = Mall::findorfail($id);
            return response([
                'status'=>200,
                'msg'=>$show_Mall

            ]);

        } catch (\Exception $e) {
            return response([
                'status'=>404,
                'msg'=>$e

            ]);
        }

    }

    public function showget($Mall_id)
    {
        //

        $show_Mall = Mall::findorfail($Mall_id);
        return response([
            'status'=>200,
            'msg'=>$show_Mall
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function edit(Mall $mall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mall $mall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try {
            $Mall_id = $request->id;

            Mall::findorfail($Mall_id)->delete();
            return response([
                'status'=>200,
                'msg'=> "deleted succesfully"
            ]);
        } catch (\Exception $e) {
            return response([
                'status'=>404,
                'msg'=>$e
            ]);
        }


   
    }
}
