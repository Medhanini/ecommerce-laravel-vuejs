<?php

namespace App\Http\Controllers;

use App\ProductVariationType;
use Illuminate\Http\Request;

class ProductVariationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variations_types = ProductVariationType::all()->toArray();
        return array_reverse($variations_types);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductVariationType  $productVariationType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariationType $productVariationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductVariationType  $productVariationType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariationType $productVariationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductVariationType  $productVariationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariationType $productVariationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductVariationType  $productVariationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariationType $productVariationType)
    {
        //
    }
}
