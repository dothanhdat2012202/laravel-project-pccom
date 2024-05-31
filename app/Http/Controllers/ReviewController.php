<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'text' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    // Lấy product_id từ request
    $product_id = $request->input('product_id');

    // Kiểm tra xem sản phẩm có tồn tại không trước khi lưu đánh giá
    if (!Product::where('id', $product_id)->exists()) {
        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại.']);
    }

    Review::create([
        'product_id' => $product_id,
        'user_id' => auth()->id(),
        'name' => $request->name,
        'text' => $request->text,
        'rating' => $request->rating
    ]);

    return response()->json(['success' => true, 'message' => 'Đánh giá đã được lưu.']);
}
}
