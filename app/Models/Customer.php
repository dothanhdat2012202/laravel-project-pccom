<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'district',
        'ward',
        'street',
        'payment_method',
        'content'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'customer_id','id');
    }
}
