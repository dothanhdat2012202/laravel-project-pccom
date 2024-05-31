<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imei extends Model
{
    use HasFactory;
    protected $fillable = [
        'imei',
        'product_id',
        'start_date',
        'end_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getWarrantyStatusAttribute()
    {
        $currentDate = now();
        if ($this->end_date >= $currentDate) {
            return 'Còn thời gian bảo hành';
        } else {
            return 'Hết hạn bảo hành';
        }
    }
}
