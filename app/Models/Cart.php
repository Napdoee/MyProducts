<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart_items';
    protected $fillable = ['user_id', 'product_id', 'quantity', 'total'];

    public $tax = 25;

    public function getTax()
    {
        return $this->totalItems() * $this->tax;
    }

    public function itemsPrice()
    {
        return $this->where('user_id', Auth::user()->id)->sum('total');
    }

    public function totalItems()
    {
        return $this->where('user_id', Auth::user()->id)->count('total');
    }

    public function totalItemsPrice()
    {
        return $this->itemsPrice() + ($this->getTax());
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
