<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function addProduct(){
        $product = new Product;
        $product->name = request()->name;
        $product->price = request()->price;
        $product->description = request()->description;
        $product->file_path = request()->file('file')->store('products');
        $product->save();
        return $product;
    }

    public function list(){
        return Product::all();
    }

    public function delete($id){
        $result = Product::where('id', $id)->delete();
        if($result){
            return ["result" => "Product has been deleted"];
        }else{
            return ["result" => "Operation failed"];
        }
    }

    public function getProduct($id){
        return Product::find($id);
    }

    public function updateProduct(Request $req,$id){
        $product = Product::find($id);
        $product->name = $req->name;
        $product->price = $req->price;
        $product->description = $req->description;
        $product->file_path = $req->file('file')->store('products');
        $product->save();
        return $product;
    }

    public function search($key){
        return Product::where('name', 'Like', "%$key%")->get();
    }
}
