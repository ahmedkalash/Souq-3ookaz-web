<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id'     ,
        'total_price'       ,
        'shipping_info_id'  ,
        'status'=>'pending'
    ];
    public function ShippingInfo()
    {
        return $this->belongsTo(ShippingInfo::class);
    }
    public function orderItem()
    {
        return $this->hasMany(OrderItems::class);
    }
}

