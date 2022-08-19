<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
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
            $Manager = Manager::all();


            return response([
                'msg' => "sucess",
                'data' => $Manager
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
        //
        try {
            //code...

            $manager_file = $request->file('photo');

            $manager_file_name = $manager_file->getClientOriginalName();


            $manager_file->storeAs('manager/' . $manager_file_name, $manager_file_name, 'manager');
            Manager::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'photo' => $manager_file_name
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
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function showpost(Request $request)
    {
        //
        try {
            $id = $request->id;
            $show_manager = Manager::with('Mall')->findorfail($id);
            return response([
                'status' => 200,
                'msg' => $show_manager,

            ]);
        } catch (\Exception $e) {
            return response([
                'status' => 404,
                'msg' => $e,

            ]);
        }
    }

    public function showget($manager_id)
    {
        //
        try {
            $show_manager = Manager::with('Mall')->findorfail($manager_id);
            return response([
                'status' => 200,
                'msg' => $show_manager,

            ]);
        } catch (\Exception $e) {

            return response([
                'status' => 404,
                'msg' => $e,

            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $manager_id)
    {
        //
        try {
            $manager = Manager::findorfail($manager_id);

            $manager->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'address' => $request->address,
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
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try {
            $manager_id = Manager::findorfail($request->id);

            $manager_id->Mall()->delete();
            $manager_id->delete();
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
