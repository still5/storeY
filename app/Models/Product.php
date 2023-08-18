<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\select;

/**
 * Post
 *
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description_short',
        'description_full',
        'specifications',
        'price',
        'discount_price',
        'is_active',
    ];

    public function getActiveProducts($perPage = 20) {

        return $this->where('is_active', 1)->simplePaginate($perPage);
    }

    public function getProductById($id) {

        return $this->where('id', $id)->get();
    }

}
