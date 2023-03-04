<?php

namespace App\Http\Controllers\Api;

use App\Models\product;
use App\Models\productImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductApiController extends Controller
{
    //getAllProduct
    function getAllProduct(){
        $productsData = product::orderBy('id','desc')->get();
        // Product Imageအများကြီးထဲကမှတစ်ခုစီဘဲပြမည်
        $productImages = productImage::groupBy('product_token')->get();
        return response()->json([
            'products' => $productsData,
            'images' => $productImages
        ]);
    }

    // getProductDetails
    function getProductDetails(Request $request){
        $productData = product::where('product_token',$request->Token)->first();
        // ပုံတွေအားလုံးထဲမှထိပ်ဆုံးကပုံတစ်ခုသာယူမည်
        $mainImage = productImage::where('product_token',$request->Token)->first();

        $allImages = productImage::where('product_token',$request->Token)->get();
        return response()->json([
            'productData' => $productData,
            'mainImage' => $mainImage,
            'allImages' => $allImages
        ]);
    }
}
