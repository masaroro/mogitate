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

    public function search(Request $request){
        if ($request->has('reset')) {
            return redirect('/products')->withInput();
        }

        $query = Product::query();
        $query = $this->getSearchQuery($request, $query);

        if ($request->has('sort')) {
            $sortOrder = $request->input('sort');
            if ($sortOrder === 'high') {
                $query->orderBy('price', 'desc');
            } elseif ($sortOrder === 'low') {
                $query->orderBy('price', 'asc');
            }
        }

        $products = $query->paginate(6);

        return view('index', compact('products'));
    }

    public function store(){
        return view('register');
    }

    public function show($productId,Request $request){
        if ($request->has('back')) {
            return redirect('/products')->withInput();
        }

        if ($request->has('register')) {
            return redirect('/products')->withInput();
        }

        if ($request->has('delete')) {
            return redirect('/products')->withInput();
        }

        $product = Product::with('seasons')->find($productId);
        $seasons = Season::all();
        return view('detail',compact('product','seasons'));
    }

    private function getSearchQuery($request, $query){
        if(!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
            };

        return $query;
    }
}
