<?php

namespace App\Http\Controllers;

use File;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //categoryListPage
    function categoryListPage(){
        $categories = category::orderBy('id','desc')->get();
        return view('category.categoryListPage',compact('categories'));
    }

    // addNewCategory
    function addNewCategory(Request $request){
        $this->addNewCategoryData($request);
        return back()->with(['success'=>'အမျိုးအစားအသစ်ထည့်ခြင်းအောင်မြင်ပါသည်']);
    }

    // updateCategoryPage
    function updateCategoryPage($token){
        $data = category::where('token',$token)->first();
        return view('category.categoryUpdatePage',compact('data'));
    }

    // updateCategory
    function updateCategory(Request $request){
        $this->updateCategoryData($request);
        return redirect()->route('category@categoryListPage')->with(['success'=>'ပြင်ဆင်ခြင်းအောင်မြင်ပါသည်']);
    }

    // deleteCategory
    function deleteCategory($token){
        //Image Delete in project folder
        $ImageName = category::select('image')->where('token',$token)->first()->toArray();
        $ImageName = $ImageName['image'];
        File::delete(public_path().'/categoryImage/'.$ImageName);

        // Delete data in database
        category::where('token',$token)->delete();
        return back()->with(['success'=>'အမျိုးအစားဖျက်ခြင်းအောင်မြင်ပါသည်']);
    }

    //addNewCategoryData
    private function addNewCategoryData($request){
        $request->validate([
            'categoryImage' => 'required|mimes:png,jpg,jpeg,svg,wepb',
            'categoryName' => 'required|unique:categories,name'
        ]);

        $imageName = uniqid() . $request->file('categoryImage')->getClientOriginalName();
        $request->file('categoryImage')->move(public_path() . '/categoryImage',$imageName);

        category::create([
            'image' => $imageName,
            'name' => $request->categoryName,
            'token' => uniqid() . time() . $request->_token . rand(00000000000,99999999999)
        ]);
    }

    // updateCategoryData
    private function updateCategoryData($request){
        $request->validate([
            'categoryImage' => 'mimes:png,jpg,jpeg,svg,wepb',
            'categoryName' => 'required|unique:categories,name,' . $request->categoryID
        ]);

        if ($request->hasFile('categoryImage')) {
            // Old Image Delete in project folder
            $oldImageName = category::select('image')->where('id',$request->categoryID)->first()->toArray();
            $oldImageName = $oldImageName['image'];
            File::delete(public_path().'/categoryImage/'.$oldImageName);

            $imageName = uniqid() . $request->file('categoryImage')->getClientOriginalName();
            $request->file('categoryImage')->move(public_path() . '/categoryImage',$imageName);

            category::where('token',$request->categoryToken)->update([
                'image' => $imageName,
                'name' => $request->categoryName
            ]);

        }else{
            category::where('token',$request->categoryToken)->update([
                'name' => $request->categoryName
            ]);
        }
    }
}
