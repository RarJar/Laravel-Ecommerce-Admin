<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //searchCategory
    function searchCategory(Request $request){
        $searchData = category::where('name','like','%' .$request->searchData. '%')->get();
        return response()->json([
            'searchValues' => $searchData
        ]);
    }
}
