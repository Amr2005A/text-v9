<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select('id','name')->get();
        return response()->json($categories,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create(['name' => $data['name']]);
        return response()->json($category,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if (! $category) {
            return response()->json(['message'=> 'Category not found'],404);
        } else {
            return response()->json($category,200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $category = Category::find($id);
        if(! $category){
            return response()->json(['message'=> 'Category not founcd'],404);
        }
        $category->update(array_filter([
            'name'=> $data['name'] ?? $category->name,
        ]));
        return response()->json($category,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json(null,204);
    }
}
