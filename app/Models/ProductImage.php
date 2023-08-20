<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'is_main',
        'filename',
    ];

    public function findMainImageForProduct($productId) {

        return $this->where('product_id', $productId)->where('is_main', 1)->first();
    }
}
