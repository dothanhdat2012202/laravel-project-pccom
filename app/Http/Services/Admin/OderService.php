<?php

namespace App\Http\Services\Admin;

use App\Models\Customer;

class OderService
{
    public function getCustomer()
        {
            return Customer::orderBy('id')->paginate(15);
        }
    public function getProductForCart($customer)
    {
        return $customer->carts()->with(['product'=> function ($query){
            $query->select('id','name','thumb');
        }])->get();
    }
}
