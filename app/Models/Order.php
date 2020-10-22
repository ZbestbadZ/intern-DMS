<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'cus_phone', 'cus_name', 'cus_address', 'status', 'total_price', 'order_date', 'shipped_date', 'note'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}