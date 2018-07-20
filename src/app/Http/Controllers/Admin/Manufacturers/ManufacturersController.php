<?php

namespace App\Http\Controllers\Admin\Manufacturers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ManufacturersController
 * @package App\Http\Controllers\Admin\Manufacturers
 */
class ManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Manufacturer::get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json((new Manufacturer)->create(['title' => $request->get('title')]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Manufacturer $manufacturer
     * @return void
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        $manufacturer->title = $request->get('title');

        return response()->json($manufacturer->save());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Manufacturer $manufacturer
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Manufacturer $manufacturer)
    {
        return response()->json($manufacturer->delete());
    }
}
