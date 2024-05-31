<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get(['id', 'name', 'thumb', 'price_sale']);

        // Tạo URL chi tiết sản phẩm
        $products->each(function($product) {
            $product->slug = Str::slug($product->name, '-');
            $product->detail_url = route('product.show', ['id' => $product->id, 'slug' => $product->slug]);
        });

        return response()->json($products);
    }
}
