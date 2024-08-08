<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\SearchController;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        $searchController = new SearchController();

        $result = $searchController->search($request, $query);

        $category = CategoryResource::collection($result);
        
        return response()->json($category);

    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json(CategoryResource::make($category));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json(CategoryResource::make($category));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Category $category)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return response()->json(CategoryResource::make($category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return response()->json(["result" => "ok"], 200);      
    }
}
