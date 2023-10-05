<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductDumpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = 'automotive';

        $product = Http::timeout(3)->get("https://dummyjson.com/products/category/$category")->body();
        $product_json = json_decode($product);

        $makeCategory = Category::create(['category_name' => $category]);

        foreach($product_json->products as $item) {
            Product::create([
                'discount_id' => null,
                'category_id' => $makeCategory->id,
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
