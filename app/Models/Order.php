<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['id', 'user_id', 'shipping_id', 'payment_id', 'total', 'status'];
    public function Customer(){
        return $this->belongsTo(Customer::class, 'user_id');
    }
    public function Shipping(){
        return $this->belongsTo(Customer::class, 'shipping_id');
    }
    public function Payment(){
        return $this->belongsTo(Customer::class, 'payment_id');
    }
}
