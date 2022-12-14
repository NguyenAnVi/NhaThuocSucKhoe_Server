<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'orderitems';
    protected $fillable=['id', 'order_id', 'product_id', 'product_name', 'price', 'qty'];
    public function Order(){
        return $this->belongsTo(Customer::class, 'order_id');
    }
    public function Product(){
        return $this->belongsTo(Customer::class, 'product_id');
    }
}
