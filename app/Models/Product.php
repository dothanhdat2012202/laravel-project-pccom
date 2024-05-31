<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'menu_id',
        'description',
        'price',
        'price_sale',
        'content',
        'active',
        'thumb'
    ];

    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')
            ->withDefault(['name'=>'']);

    }
    public function imeis()
    {
        return $this->hasMany(Imei::class);
    }

    // Kiểm tra xem sản phẩm có thể xóa được hay không
    public function canDelete()
    {
        return $this->imeis()->count() === 0;
    }

}
