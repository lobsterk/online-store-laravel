<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json((new Product())->all());
    }

    /**
     * Return single product item
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getItem($id)
    {
        return response()->json((new Product())->find($id));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = (new Product());
        $product->fill($request->input('data'));
        $product->created_at = Carbon::now();
        $product->created_by = \Auth::id();
        $product->save();
        return response()->json($request->input('data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = (new Product())->findOrFail($id);
        $product->fill($request->input('data'));

        $product->updated_at = Carbon::now();
        $product->updated_by = \Auth::id();
        $product->save();
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return void
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        return response()->json($product->delete());
    }

    public function getProductStatus()
    {
        $items = [];
        foreach (Product::STATUS_MESSAGE as $k => $i) {
            $items[$k] = ['id' => $k, 'value' => $i];
        }
        return response()->json($items);
    }
}
