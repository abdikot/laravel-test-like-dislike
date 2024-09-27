<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $user = Auth::user();
    
        $like = Like::where('product_id', $product->id)->where('user_id', $user->id)->first();
    
        if ($like) {
            $like->update(['is_like' => $request->is_like]);
        } else {
            Like::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'is_like' => $request->is_like,
            ]);
        }
    
        $likes = $product->likes()->where('is_like', true)->count();
        $dislikes = $product->likes()->where('is_like', false)->count();
    
        return response()->json([
            'likes' => $likes,
            'dislikes' => $dislikes
        ]);
    }
    

}
