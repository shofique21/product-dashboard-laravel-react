<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    function addProduct( Request $request){
        $product = new Product;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->file_path = $request->file('file')->store('products');
        $product->save();
        return $product;
    }

    function productList(){
        return Product::all();
    }

    function delete($id){
        $result = Product::where('id', $id)->delete();
        if($result){
            return ["result"=> "Prdouct has been deleted"];
        }
        else{
            return ["result"=> "Operation failed"];
        }
    }

  function getProduct($id){
        $result = Product::where('id', $id)->first();
        return $result;
  }
  function search($key){
      $result = Product::where('name','like',"%$key%")->get();
      return $result;
  }
}
