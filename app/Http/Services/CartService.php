<?php

namespace App\Http\Services;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function create($request)
    {
        $quantity = (int)$request->input('quantity');
        $product_id = (int)$request->input('product_id');

        if($quantity <= 0 || $product_id <=0){
            Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác');
            return false;
        }


        $carts = Session::get('carts');

        if(is_null($carts)){
            // Nếu giỏ hàng chưa tồn tại, tạo mới giỏ hàng với sản phẩm này
            Session::put('carts',[
                $product_id => $quantity
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);

        if($exists){
            $carts[$product_id] = $carts[$product_id] + $quantity;
            Session::put('carts', $carts); // update lại giỏ hàng
            return true;
        }

        $carts[$product_id] = $quantity;
        Session::put('carts', $carts ); //update lại giỏ hàng
        return true;
    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if(is_null($carts)) return [];

        $productId = array_keys($carts);

        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            -> whereIn('id', $productId)
            ->get();

    }
    public function update($request)
    {
        Session::put('carts', $request->input('quantity')); //update lại giỏ hàng
        return true;
    }

    public function remove($id)
    {
        $carts = Session::get('carts');

        unset($carts[$id]);
        Session::put('carts', $carts);
        return true;
    }
    public function addCart($request)
    {
        try {
            DB::beginTransaction();
            $carts = Session::get('carts');
            if (is_null($carts)) {
                return false;
            }

            $customer = Customer::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'city' => $request->input('city'),
                'district' => $request->input('district'),
                'ward' => $request->input('ward'),
                'street' => $request->input('street'),
                'payment_method' => $request->input('payment_method'),
                'content' => $request->input('content')
            ]);

            $this->infoProductCart($carts, $customer->id);

            DB::commit();
            Session::flash('success', 'Đặt Hàng Thành Công');

            #SendMail Queue
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            Session::forget('carts');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt Hàng Lỗi, Vui Lòng Thử Lại Sau');
            return false;
        }

        return true;
    }
    protected function infoProductCart($carts, $customer_id)
    {
        $productId = array_keys($carts);

        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            -> whereIn('id', $productId)
            ->get();

        $data = [];
        foreach ($products as $product){
            $data[] = [
              'customer_id' => $customer_id,
              'product_id' => $product->id,
              'quantity' => $carts[$product->id],
              'price' => $product->price_sale != 0 ? $product->price_sale : $product->price

            ];
        }
        return Cart::insert($data);
    }
    public function get($customer){
        return $customer->carts()->with(['product'=> function ($query){
            $query->select('id','name','thumb');
        }])->get();
    }

}
