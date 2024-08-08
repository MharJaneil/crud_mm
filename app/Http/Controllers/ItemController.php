<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\SearchController;
use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Category;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $query = Item::query();

        $searchController = new SearchController();

        $result = $searchController->search($request, $query);

        $item = ItemResource::collection($result);

        return response()->json($item);

    }

    public function itemsWithCategory()
    {
        return Item::raw(function($collection)
        {
            return $collection->aggregate([
                [
                    '$addFields' => [
                        'category_id' => ['$toObjectId' => '$category_id']
                    ]
                ],
                [
                    '$lookup' => [
                        'from' => 'category',
                        'localField' => 'category_id',
                        'foreignField' => '_id',
                        'as' => 'category'
                    ]
                ],
                [
                    '$unwind' => [
                        'path' => '$category',
                        'preserveNullAndEmptyArrays' => true 
                    ]
                ],
                [
                    '$project' => [
                        '_id' => 0,
                        'name' => 1,
                        'description' => 1,
                        'price' => 1,
                        'quantity' => 1,
                        'category_id' => 1,
                        'category' => [
                            'id' => '$category._id',
                            'name' => '$category.name',
                            'description' => '$category.description'
                        ]
                    ]
                ]
            ]);
        });
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
    public function store(ItemRequest $request)
    {
        $item = Item::create($request->validated());

        return response()->json(ItemResource::make($item));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return response()->json(ItemResource::make($item));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Item $item)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, Item $item)
    {
        $item->update($request->validated());

        return response()->json(ItemResource::make($item));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        
        return response()->json(["result" => "ok"], 200);      
    }
}
