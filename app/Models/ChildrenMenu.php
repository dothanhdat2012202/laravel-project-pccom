<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenMenu extends Model
{
    use HasFactory;
    protected $table = 'children_category';
    protected $guarded = [];

    public function parents()
    {
        return $this->belongsToMany(Menu::class);
    }
}
