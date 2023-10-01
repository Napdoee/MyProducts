<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('home', compact('products'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function productDetail(Product $product) {
        // dd($product);
        return view('product-detail', compact('product'));
    }

    public function products() {
        $products = Product::latest()->get();
        $categories = Category::latest()->get();

        return view('products', compact('products', 'categories'));
    }
}
