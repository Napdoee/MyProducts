<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_id', 'category_id', 'name', 'description',
        'price', 'stock', 'image', 'slug'
    ];

    public function getPrice()
    {
        return $this->getDiscountStatus() ? (100/100 - $this->discount->discount_percent/100) * $this->price : $this->price;
    }

    public function getDiscountStatus()
    {
        return $this->discount_id && $this->discount->active === 1;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
