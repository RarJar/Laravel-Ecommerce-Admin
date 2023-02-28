<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //productListPage
    function productListPage(){
        return view('product.productListPage');
    }
}
