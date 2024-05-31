<?php

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Imei;
class ProductAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }
    protected  function isValidPrice($request)
    {
        if ($request->input('price') !=0 && $request->input('price_sale') !=0
            && $request->input('price_sale') >= $request->input('price')
        ){
            Session::flash('error','Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if($request->input('price_sales') !=0 && (int)$request->input('price') ==0){
            Session::flash('error','Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }
    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice === false) return false;

        try{
            $request->except('_token');
            Product::create($request->all()); // xuất ra các csdl

            Session::flash('success','Thêm sản phẩm thành công');
        } catch (\Exception $err)
        {
            Session::flash('error','Thêm sản phẩm lỗi');
            \Log::info($err->getMessage());
            return false;

        }
        return true;
    }
    public function get()
    {
        return Product::with('menu')
            ->orderBy('id')->paginate(15);
    }

    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice === false) return false;

        try{
            $product->fill($request->input());
            $product->save();

            Session::flash('success','Cập nhật thành công');
        } catch (\Exception $err)
        {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $productId = $request->input('id');

    // Kiểm tra xem sản phẩm có liên kết với bảng imeis hay không
    $imeiCount = Imei::where('product_id', $productId)->count();
    if ($imeiCount > 0) {
        return false; // Không thể xóa sản phẩm vì có liên kết với bảng imeis
    }

    // Nếu không có liên kết, thì mới thực hiện xóa sản phẩm
    $product = Product::find($productId);
    if ($product) {
        $product->delete();
        return true;
    }
    return false; // Không tìm thấy sản phẩm

    }
}
