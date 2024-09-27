<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function index()
        {
            $products = Product::all();
            return view('admin.dashboard', compact('products'));
        }
    
        public function create()
        {
            return view('admin.products.create');
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
            ]);
    
            Product::create($request->all());
    
            return redirect()->route('admin.dashboard');
        }
    
        public function show(Product $product)
        {
            return view('admin.products.show', compact('product'));
        }
    
        public function edit(Product $product)
        {
            return view('admin.products.edit', compact('product'));
        }
    
        public function update(Request $request, Product $product)
        {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
            ]);
    
            $product->update($request->all());
    
            return redirect()->route('products.index');
        }
    
        public function destroy(Product $product)
        {
            $product->delete();
            return redirect()->route('products.index');
        }
}
