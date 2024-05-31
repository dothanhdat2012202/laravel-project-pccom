<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Imei;

class ImeiController extends Controller
{
    public function create()
    {
        $products = Product::all(); // Lấy tất cả sản phẩm

        return view('admin.imei.add', compact('products'), [
            'title' => 'Thêm thông tin bảo hành',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'imei' => 'required|unique:imeis,imei',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Imei::create([
            'product_id' => $request->product_id,
            'imei' => $request->imei,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('imeis.create')->with('success', 'Thông tin bảo hành đã được tạo thành công.');
    }
    public function index()
    {
        $imeis = Imei::with('product')->paginate(10);

        return view('admin.imei.list', compact('imeis'), [
            'title' => 'Danh sách bảo hành',
        ]);
    }
    public function search_imei()
    {
        return view('imei.index', [
            'title' => 'Tra cứu bảo hành sản phẩm'
        ]);
    }
    public function getImeiInfo(Request $request)
    {
        $imei = $request->input('imei');
        $imeiInfo = Imei::where('imei', $imei)->with('product')->first();

        return response()->json([
            'imei' => $imeiInfo->imei,
            'product_name' => $imeiInfo->product ? $imeiInfo->product->name : null,
            'start_date' => $imeiInfo->start_date,
            'end_date' => $imeiInfo->end_date,
        ]);
    }
}
