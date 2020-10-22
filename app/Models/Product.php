<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name', 'price', 'quantity_in_stock', 'description'
    ];

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'product_id', 'id');
    }
}