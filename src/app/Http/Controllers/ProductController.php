<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function search(Request $request)
    {
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

    public function store(ProductRequest $request)
    {
        $file_name = null;
        if ($request->hasFile('image')) {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images', $file_name, 'public');
        }
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $file_name,
            'description' => $request->input('description'),
        ]);
        $product->seasons()->sync($request->input('seasons'));
        return redirect('/products');
    }

    public function show($productId,Request $request)
    {
        $product = Product::with('seasons')->find($productId);
        $seasons = Season::all();
        return view('detail',compact('product','seasons'));
    }

    public function update($productId,ProductRequest $request)
    {
        $product = Product::find($productId);
        $file_name = $product->image;
        if ($request->hasFile('image')) {
            if ($file_name && Storage::disk('public')->exists('images/' . $file_name)) {
                Storage::disk('public')->delete('images/' . $file_name);
            }
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images', $file_name, 'public');
        }
        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $file_name,
            'description' => $request->input('description'),
        ]);
        $product->seasons()->sync($request->input('seasons'));
        return redirect('/products');
    }

    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->image) {
            $imagePath = 'images/' . $product->image;
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        Product::find($request->id)->delete();
        return redirect('/products');
    }

    private function getSearchQuery($request, $query)
    {
        if(!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
            };
        return $query;
    }
}
