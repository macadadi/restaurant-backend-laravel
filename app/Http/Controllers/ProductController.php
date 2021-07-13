<?php

namespace App\Http\Controllers;

use App\Models\fs;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch all products
    
        $products = Product::all();
   
    
        return response($products);
    }

   public function store(Request $request){
       $this->validate($request,[
           'name'=>'required',
           'image'=>'image|nullable|max:9999'
       ]);

       $base_path = 'profile/images';
       //check if upcoming request has an image
       if(!$request->hasFile('image')){
           return response()->json(['message'=>'no file to upload']);
       }
       $dir_path = $request->file('image')->store( $base_path);

       $Product = new Product();
       $Product->name = $request->name;
       $Product->price = $request->price;
       $Product->description = $request->description;
       $Product->category = $request->category;
       $Product->image =   $dir_path;
       $Product ->save();

       return response()->json(['message'=>'succesfuly uploaded']);
   }
   public function searchByCategory($category){
       $resp = Product::where('category',$category)->get();
       if(!$resp){
           return response(['message'=>'No such category']);
       }
       return response()->json($resp);

   }
   public function deleteproduct($id){
       Product::destroy($id);

       $products =Product::all();

    //    return response($products);
    return response()->json(['message'=>'successfully deleted']);
   }
}
