<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request,$query){
        $name = $request->query('name');
        $description = $request->query('description');

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($description) {
            $query->where('description', 'like', '%' . $description . '%');
        }

        return $query->get();
    }
}
