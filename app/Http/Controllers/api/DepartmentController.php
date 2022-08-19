<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Models\department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
                //
                try {
                    $department = department::with('mail')->get();
        
                    return response([
                        'msg' => "sucess",
                        'status' => 200,
                        'data' => $department
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

    public function showDepartmentpost(Request $request)
    {
        //

        try {
            $id = $request->id;
            $show_department = department::findorfail($id);
            return response([
                'status'=>200,
                'msg'=>$show_department

            ]);

        } catch (\Exception $e) {
            return response([
                'status'=>404,
                'msg'=>$e

            ]);
        }

    }

    public function showDepartmentget($department_id)
    {
        //

        $show_department = department::findorfail($department_id);
        return response([
            'status'=>200,
            'msg'=>$show_department
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            department::create([
                'mall_id'=>$request->mall_id,
                'name'=>$request->name,
                'description'=>$request->description,
                'note'=>$request->note
            ]);

            return response([
                'status'=>200,
                'msg'=>'department added sucessfuly',
            ]);
        } catch (\Exception $e) {
            
            return response([
                'status'=>404,
                'msg'=>$e
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $department_id)
    {
        try {
            $department = department::with('mail')->findorfail($department_id);

            $department->update([
                'name' => $request->name,
                'description' => $request->description,
                'note' => $request->note,
                'mall_id'=>$request->mall_id
            ]);

            return response([
                'status' => 200,
                'msg' => 'The Manager Updated Done',

            ]);
        } catch (\Exception $e) {
            return response([
                'status' => 200,
                'msg' => $e,

            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $department_id= $request->id;

            department::findorfail($department_id)->delete();
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
