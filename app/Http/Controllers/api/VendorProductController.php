<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\VendorProduct;
use Illuminate\Http\Request;

class VendorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            VendorProduct::create([
                'vendor_id' => $request->vendor_id,
                'product_id' => $request->product_id,
                'price' => $request->price,
                'note' => $request->note
            ]);
            return response([
                'status'=>200,
                'msg'=>"created succesfully"
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
     * @param  \App\Models\VendorProduct  $vendorProduct
     * @return \Illuminate\Http\Response
     */
    public function show(VendorProduct $vendorProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorProduct  $vendorProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorProduct $vendorProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorProduct  $vendorProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorProduct $vendorProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorProduct  $vendorProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorProduct $vendorProduct)
    {
        //
    }
}
