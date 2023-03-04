<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //searchCategory
    function searchCategory(Request $request){
        $searchData = category::where('name','like','%' .$request->searchData. '%')
                            ->orderBy('id','desc')
                            ->get();
        return response()->json([
            'searchValues' => $searchData
        ]);
    }

    //searchProduct
    function searchProduct(Request $request){
        $searchData = product::select('products.*','categories.name as categoryName')
                                ->where('products.name','like','%' .$request->searchData. '%')
                                ->leftJoin('categories','categories.id','products.category')
                                ->orderBy('products.id','desc')
                                ->get();
        return response()->json([
            'searchValues' => $searchData
        ]);
    }
}
