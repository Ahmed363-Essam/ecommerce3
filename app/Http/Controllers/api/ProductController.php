<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $product = product::with('Vendors')->get();


            return response([
                'status'=>200,
                'msg'=>$product
            ]);
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
        //
        try {
            //code...

            $product_file = $request->file('photo');

            $product_file_name = $product_file->getClientOriginalName();


            $product_file->storeAs('product/' . $product_file_name, $product_file_name, 'product');
            product::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'manufacture_company'=>$request->manufacture_company,
                'photo'=>$product_file_name,
            ]);
            return response([
                'status' => 200,
                'msg' => "The products Added Sucessfuly",

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
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function showproductpost(Request $request)
    {
        //
        
        try {
            $id = $request->id;
            $show_product = product::findorfail($id);
            return response([
                'status'=>200,
                'msg'=>$show_product

            ]);

        } catch (\Exception $e) {
            return response([
                'status'=>404,
                'msg'=>$e

            ]);
        }

    }


    public function showproductget($product_id)
    {
        try {
        
            $show_product = product::findorfail($product_id);
            return response([
                'status'=>200,
                'msg'=>$show_product

            ]);

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
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($product_id,Request $request)
    {
        try {
            $product = product::find($product_id);


            $product->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'manufacture_company'=>$request->manufacture_company
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
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $product_id = product::findorfail($request->id);

            $product_id->delete();
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
