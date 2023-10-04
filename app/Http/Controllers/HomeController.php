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
        $categoryId = $request->category;

        $products = Product::where('name', 'LIKE', '%'.$search.'%');
        if(isset($categoryId)) {
            $products = $products->where('category_id', $categoryId);
        }

        $products = $products->get();

        return view('products', compact('categories', 'products', 'search', 'categoryId'));
    }

    // public function searchProduct(Request $request)
    // {
    //     $search = $request->q;
    //     $category = $request->category;

    //     $results = Product::where('name', 'LIKE', '%'.$search.'%');

    //     if($request->category != '') {
    //         $results->where('category_id', $category);
    //     }

    //     $results = $results->get();
    //     $values = [
    //         'query' => $search,
    //         'category' => $category
    //     ];

    //     return view('products', compact('results', 'values'));
    // }
}
