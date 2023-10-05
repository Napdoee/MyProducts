<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->where('stock', '>', 0)->get();

        return view('home', compact('products'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function productDetail(Product $product) 
    {
        // dd($product);
        return view('product-detail', compact('product'));
    }

    public function products(Request $request) 
    {
        $categories = Category::latest()->get();
        $search = $request->q;
        $categoryName = $request->category;

        $products = Product::where('name', 'LIKE', '%'.$search.'%');
        if(isset($categoryName)) {
            $products = $products->whereHas('category', function($query) use($categoryName){
                $query->where('category_name', $categoryName);
            });
        }

        $products = $products->get();

        return view('products', compact('categories', 'products', 'search', 'categoryName'));
    }
}
