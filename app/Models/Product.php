<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
//use function Laravel\Prompts\select;

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

    public function getActiveProductsWithImageNames($perPage = 10) {
        $thisTable = $this->getTable();
        $productImagesTable = (new ProductImage)->getTable();

        $products = $this->select(
            "$thisTable.*",
            "$productImagesTable.filename as image_name")
            ->leftJoin($productImagesTable, function ($join){
                $join->on('product_images.product_id', '=', 'products.id')
                    ->where('product_images.is_main', '=', 1);
            })
            ->where("$thisTable.is_active", 1);

        return $products->simplePaginate($perPage);
    }

    public function getProductById($id) {

        return $this->where('id', $id)->get();
    }

    public function getProductByIdWithImageName($id) {
        $thisTable = $this->getTable();
        $productImagesTable = (new ProductImage)->getTable();

        $product = $this->select(
            "$thisTable.*",
            "$productImagesTable.filename as image_name")
            ->leftJoin($productImagesTable, function ($join){
                $join->on('product_images.product_id', '=', 'products.id')
                    ->where('product_images.is_main', '=', 1);
            })
            ->where("$thisTable.id", $id);

        return $product->get();
    }

}
