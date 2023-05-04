<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInfo extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_full_name',
        'address_1'         ,
        'address_2'         ,
        'city'              ,
        'state'             ,
        'zip_code'          ,
        'country'           ,
        'phone_number'
    ];
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
