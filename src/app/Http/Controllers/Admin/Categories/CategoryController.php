<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            (new Category)
                ->where('parent_id', Category::PARENT_CATEGORY)
                ->with('subCategory')
                ->get()
        );
    }

    public function getCategories()
    {
        return response()->json(
            (new Category)
                ->where('status', Category::STATUS_ON)
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input()['data'];

        return response()->json(Category::create($data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->except([
            'data.sub_category',
            'data.created_at',
            'data.updated_at',
            'data.deleted_at',
            ])['data'];

        return response()->json($category->update($data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        return response()->json($category->delete());
    }
}
