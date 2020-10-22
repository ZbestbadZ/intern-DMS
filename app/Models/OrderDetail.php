<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price'
    ];
    public function product()
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}