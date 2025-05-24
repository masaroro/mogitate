<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;

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
        $request->flashOnly(['keyword', 'sort']);

        return view('index', compact('products'));
    }

    public function create(){
        $seasons = Season::all();
        return view('register',compact('seasons'));
    }

    public function store(ProductRequest $request){
        $file_name = null;
        if ($request->hasFile('image')) {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images',$file_name);
        }

        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $file_name,
        ]);

        $product->seasons()->sync($request->input('seasons'));

        return redirect('/products');
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
