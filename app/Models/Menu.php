<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'content',
        'active'
    ];
    public  function products()
    {
        return $this->hasMany(Product::class, 'menu_id', 'id');
    }

    //quan hệ 1 nhiều với bảng ChildrenMenu

    public function childrenMenu()
    {
        return $this->hasMany(ChildrenMenu::class,'menus_id','id');
    }

}
