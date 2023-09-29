<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
	{	
		$products = Product::latest()->get();
		$categories = Category::latest()->get();
		$discounts = Discount::latest()->where('active', 1)->get();
	
    	return view('admin.products.index', compact('products', 'categories', 'discounts'));
    }
	
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => ['required', 'min:3'],
			'description' => ['required'],
			'category' => ['required'],
			'price' => ['required', 'numeric'],
			'stock' => ['required', 'numeric'],
			'img' => ['required', 'image']
		]);
		
		$img = time().'.'.$request->img->extension();
		$request->img->storeAs('images', $img);
	
		$request['category_id'] = $request->category;
		$request['discount_id'] = $request->discount;
		$request['image'] = $img;

		$product = Product::create($request->all());

		return redirect()->route('admin.product.index')->with([
			'message' => 'Product Created',
			'status' => 'success',
		]);
	}

	public function edit(Product $product)
	{	
		$categories = Category::latest()->get();
		$discounts = Discount::latest()->where('active', 1)->get();

		return view('admin.products.edit', compact('product', 'categories', 'discounts'));
	}

    public function update(Request $request, Product $product)
	{
		$this->validate($request, [
			'name' => ['required', 'min:3'],
			'description' => ['required'],
			'category' => ['required'],
			'price' => ['required', 'numeric'],
			'stock' => ['required', 'numeric'],
			'img' => ['image']
		]);
		
		$img = '';
		
		if($request->hasFile('img')) {
			if(!empty($product->image) && Storage::exists($product->image)) {
				Storage::delete('images/'.$product->image);
			}
			$img = time().'.'.$request->img->extension();
			$request->img->storeAs('images', $img);
		} else {
			$img = $product->image;
		}

		$request['category_id'] = $request->category;
		$request['discount_id'] = $request->discount;
		$request['image'] = $img;
		
		$product->update($request->all());

		// $product->name = $request->name;
		// $product->price = $request->price;
		// $product->image = $image;
		// $product->save();

		return redirect()->route('admin.product.index')->with([
			'message' => 'Product Updated',
			'status' => 'info',
		]);
    }
	
	public function destroy(Product $product)
	{
		if(!empty($product->image) && Storage::exists($product->image)) {
			Storage::delete('images/'.$product->image);
		}
	
		$product->delete();
		
		return redirect()->route('admin.product.index')->with([
			'message' => 'Product Deleted',
			'status' => 'danger',
		]);;
	}
}
