<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
use App\Models\Blog; // Thêm dòng này để sử dụng model Blog
use App\Models\Imei;

class MainController extends Controller
{
    protected $menu;
    protected $slider;
    protected $product;

    public function __construct(SliderService $slider, MenuService $menu, ProductService $product)
    {
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;
    }

    public function index()
    {
        $title = 'PCCom';
        $menus = Menu::all();
        // Tạo một mảng để lưu trữ sản phẩm theo tên của menu
        $menuProducts = [];
        $sliders = $this->slider->show();
        $products = $this->product->get();

        // Lặp qua danh sách menu
        foreach ($menus as $menu) {
            // Lấy danh sách sản phẩm thuộc menu đó
            $products = Product::where('menu_id', $menu->id)->get();

            // Lưu danh sách sản phẩm vào mảng $menuProducts với key là tên của menu
            $menuProducts[$menu->name] = $products;
        }

        // Tính toán và truyền phần trăm giảm cho mỗi sản phẩm
        foreach ($products as $product) {
            $originalPrice = $product->price;
            $discountedPrice = $product->price_sale;

            if ($originalPrice > 0) {
                $discountPercentage = round((($originalPrice - $discountedPrice) / $originalPrice) * 100);
            } else {
                $discountPercentage = 0;
            }

            $product->discountPercentage = $discountPercentage;
        }

        // Lấy các blog mới nhất và sắp xếp theo thời gian tạo giảm dần
        $latestBlogs = Blog::where('active', 1)->orderBy('created_at', 'desc')->take(2)->get();

        // Truyền dữ liệu blog đến view
        return view('main', compact('menus', 'sliders', 'products', 'menuProducts', 'title', 'latestBlogs'));
    }
}
