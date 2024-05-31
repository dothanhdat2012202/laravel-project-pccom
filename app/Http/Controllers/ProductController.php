<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\ChildrenMenu;
use Illuminate\Support\Str;
use App\Models\Review;
use App\Models\Menu;
class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $productsMore = $this->productService->more($id);
        return view('products.content', [
            'title' => $product->name,
            'product' => $product,
            'products' => $productsMore,
        ]);
    }

    public function show($id, $slug)
{
    // Tìm sản phẩm theo ID
    $product = Product::findOrFail($id);
    $reviews = Review::where('product_id', $id)->get();

    // Tính toán lượt rating trung bình
    $averageRating = $reviews->avg('rating');

    // Kiểm tra xem slug có khớp không (để tránh các URL bị thay đổi)
    if (Str::slug($product->name, '-') !== $slug) {
        return redirect()->route('product.show', [
            'id' => $product->id,
            'slug' => Str::slug($product->name, '-')
        ]);
    }

    // Truy vấn cơ sở dữ liệu để lấy danh sách các sản phẩm liên quan
    $relatedProducts = Product::where('menu_id', $product->menu_id)
                            ->where('id', '!=', $id)
                            ->take(6)
                            ->get();

    // Trả về view hiển thị chi tiết sản phẩm
    return view('products.content', [
        'title' => $product->name,
        'product' => $product,
        'relatedProducts' => $relatedProducts, // Sửa tên biến thành 'relatedProducts'
        'reviews' => $reviews,
        'averageRating' => $averageRating,
    ]);
}


}
