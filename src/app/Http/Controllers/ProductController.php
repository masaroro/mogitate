<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }

    public function store(){
        return view('register');
    }

    public function show(){
        $product= Product::find(1);
        return view('detail',compact('product'));
    }
}
