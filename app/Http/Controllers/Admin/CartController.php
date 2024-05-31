<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Services\Admin\OderService;

class CartController extends Controller
{
    protected $cart;
    public function __construct(OderService $cart)
    {
            $this->cart =$cart;
    }
    public function index()
    {
        return view('admin.carts.customer',[
            'title' => 'Danh Sách Đơn Đặt Hàng',
            'customers' => $this-> cart->getCustomer()
        ]);
    }
    public function show(Customer $customer)
    {
        return view('admin.carts.detail',[
            'title'=> 'Chi TIết Đơn Hàng: ' . $customer->name,
            'customer'=> $customer,
            'carts'=>$customer->carts()->get()
        ]);
    }
    public function oders()
    {

        // $orders = Customer::where('email', auth()->user()->email)->get();
        return view('admin.carts.oder',[
            'title' => 'Trạng Thái Đơn Hàng',
            'customers' => $this-> cart->getCustomer()
        ]);
    }
    public function edit($id)
    {
        $title = "Cập Nhật Trạng Thái";
        $customer = Customer::findOrFail($id);
        return view('admin.carts.update', compact('title','customer'));
    }
    public function updateStatus(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->order_status = $request->input('order_status');
        $customer->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }
}
