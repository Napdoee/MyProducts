<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Http::timeout(3)->get('https://dummyjson.com/products/category/laptops')->body();
        $product_json = json_decode($product);

        $category = Category::create(['category_name' => 'laptops']);

        foreach($product_json->products as $item) {
            Product::create([
                'discount_id' => null,
                'category_id' => $category->id,
                'name' => $item->title,
                'slug' => Str::slug($item->title),
                'description' => $item->description,
                'price' => $item->price,
                'stock' => mt_rand(10, 40),
                'image' => null,
            ]);
        }
    }
}
