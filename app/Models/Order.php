<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class Order extends Model
{

    use HasFactory;

    protected $fillable = [
        'product_id',
        'price',
        'user_id',
        'user_name',
        'user_email',
        'user_phone',
        'customer_comment',
        'status',
    ];
    protected $casts = [
        'status' => OrderStatusEnum::class
    ];

    public function getOrderById($id) {

        return $this->where('id', $id)->get();
    }

    public function getOrders($status = 'all', $perPage = 20) {
        $thisTable = $this->getTable();
        $productsTable = (new Product)->getTable();

        $orders = $this->select(
            "$thisTable.*",
            "$productsTable.name as product_name")
            ->join($productsTable, $productsTable . '.id', '=', $thisTable . '.product_id');
        if (isset($status) && $status != 'all') {
            $orders->where('status', $status);
        }

        return $orders->simplePaginate($perPage);
    }
}
