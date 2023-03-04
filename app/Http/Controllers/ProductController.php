<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Support\Str;
use App\Models\productImage;
use Illuminate\Http\Request;
use File;

class ProductController extends Controller
{
    //productListPage
    function productListPage(){
        $products = product::select('products.*','categories.name as categoryName')
                    ->leftJoin('categories','categories.id','products.category')
                    ->orderBy('products.id','desc')
                    ->get();
        return view('product.productListPage',compact('products'));
    }

    // addNewProduct
    function addNewProductPage(){
        $categories = category::orderBy('id','desc')->get();
        return view('product.createProductPage',compact('categories'));
    }

    // addNewProduct
    function addNewProduct(Request $request){
        $product_token = uniqid() . time() . $request->_token . rand(00000000000,99999999999);
        
        $request->validate([
            'productImages.*' => 'mimes:png,jpg,jpeg,webp',
            'productImages' => 'required',
            'productName' => 'required',
            'discountPrice' => 'required',
            'category' => 'required',
            'availability' => 'required',
            'description' => 'required'
        ]);

        product::create([
            'name' => $request->productName,
            'original_price' => $request->originalPrice,
            'discount_price' => $request->discountPrice,
            'category' => $request->category,
            'availability' => $request->availability,
            'description' => $request->description,
            'product_token' => $product_token
        ]);

        if ($request->hasFile('productImages')) {
            foreach ($request->file('productImages') as $image) {
                $imageName = uniqid() . $image->getClientOriginalName();
                $image->move(public_path() . '/productImage',$imageName);

                productImage::create([
                    'image' => $imageName,
                    'product_token' => $product_token
                ]);
            }
        }

        return redirect()->route('product@productListPage')->with(['success'=>'ကုန်ပစ္စည်းအသစ်ထည့်ခြင်းအောင်မြင်ပါသည်']);
    }

    // updateProductPage
    function updateProductPage($token){
        $products = product::where('product_token',$token)->first();
        $categories = category::orderBy('id','desc')->get();
        $images = productImage::where('product_token',$token)->get();
        return view('product.updateProductPage',compact('products','categories','images'));
    }

    // updateProduct
    function updateProduct(Request $request){
        // dd($request->all());        
        $request->validate([
            'productImages.*' => 'mimes:png,jpg,jpeg,webp',
            'productName' => 'required',
            'discountPrice' => 'required',
            'category' => 'required',
            'availability' => 'required',
            'description' => 'required'
        ]);

        product::where('id',$request->productID)->update([
            'name' => $request->productName,
            'original_price' => $request->originalPrice,
            'discount_price' => $request->discountPrice,
            'category' => $request->category,
            'availability' => $request->availability,
            'description' => $request->description
        ]);

        // Update လုပ်လိုက်သောပုံများပေါင်းထည့်မည်
        if ($request->hasFile('productUpdateImages')) {
            foreach ($request->file('productUpdateImages') as $image) {
                $imageName = uniqid() . $image->getClientOriginalName();
                $image->move(public_path() . '/productImage',$imageName);

                // 
                productImage::create([
                    'image' => $imageName,
                    'product_token' => $request->productToken
                ]);
            }
        }

        return redirect()->route('product@productListPage')->with(['success'=>'ကုန်ပစ္စည်းအချက်အလက်များပြင်ဆင်ခြင်းအောင်မြင်ပါသည်']);
    }

    // removeImage_in_updatePage
    function removeImage_in_updatePage($imageName){
        // Delete image in database
        productImage::where('image',$imageName)->delete();
        //Delete image in project folder
        File::delete(public_path().'/productImage/'.$imageName);
        return back();
    }

    // deleteProduct
    function deleteProduct($token){
        //Delete all images in project folder
        $images = productImage::select('image')->where('product_token',$token)->get()->toArray();
        foreach ($images as $image) {
            File::delete(public_path().'/productImage/'. $image['image']);
        }

        product::where('product_token',$token)->delete();
        productImage::where('product_token',$token)->delete();
        return back()->with(['success'=>'ကုန်ပစ္စည်းဖျက်ခြင်းအောင်မြင်ပါသည်']);
    }
}
