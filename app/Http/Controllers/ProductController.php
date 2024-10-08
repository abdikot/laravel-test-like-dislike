<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $products = Product::withCount(['likes as likes_count' => function ($query) {
                $query->where('is_like', true);
            }, 'likes as dislikes_count' => function ($query) {
                $query->where('is_like', false);
            }])->get();

            return DataTables::of($products)
            ->addColumn('actions', function($row){
                $editButton = '<a href="#" class="text-blue-500 hover:underline editProduct" data-id="'.$row->id.'">Edit</a>';
                $deleteButton = '<form action="'.route('products.destroy', $row->id).'" method="POST" class="inline deleteProductForm" data-id="'.$row->id.'">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                              </form>';
                return $editButton.' '.$deleteButton;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view(('admin.dashboard'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($request->all());

        
        return response()->json($product);
    }

    public function edit(Product $product)
    {
            return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());

            return response()->json($product);
    }

    public function destroy(Product $product, Request $request)
    {
        $product->delete();

            return response()->json(['success' => true]);
    }
}
