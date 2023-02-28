<?php

namespace App\Http\Controllers\Api;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryApiController extends Controller
{
    //getAllCategory
    function getAllCategory(){
        $categoriesData = category::orderBy('id','desc')->get();
        return response()->json([
            'categories' => $categoriesData
        ]);
    }
}
