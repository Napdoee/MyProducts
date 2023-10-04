<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'sub_price'];

    public function details() 
    {
        return $this->belongsTo(OrderDetails::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
