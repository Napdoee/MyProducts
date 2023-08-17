<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
	{	
		$products = Product::latest()->get();
	
    	 return view('products.index', compact('products'));
    }
	
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => ['required', 'min:3'],
			'price' => ['required', 'numeric'],
			'image' => ['required', 'image']
		]);
		
		$image = time().'.'.$request->image->extension();
		$request->image->storeAs('images', $image);
		
		$product = new Product();
		
		$product->name = $request->name;
		$product->price = $request->price;
		$product->image = $image;
		$product->save();
	
		return redirect()->route('product.index')->with([
			'message' => 'Product Created',
			'status' => 'success',
		]);
	}

	public function edit(Product $product)
	{	
		return view('products.edit', compact('product'));
	}

    public function update(Request $request, Product $product)
	{
		$this->validate($request, [
			'name' => ['required'],
			'price' => ['required', 'numeric'],
			'image' => ['image']
		]);
		
		$image = '';
		
		if($request->hasFile('image')) {
			if(!empty($product->image) && Storage::exists($product->image)) {
				Storage::delete('images/'.$product->image);
			}
			$image = time().'.'.$request->image->extension();
			$request->image->storeAs('images', $image);
		} else {
			$image = $product->image;
		}
		
		$product->name = $request->name;
		$product->price = $request->price;
		$product->image = $image;
		$product->save();
		
		return redirect()->route('product.index')->with([
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
		
		return redirect()->route('product.index')->with([
			'message' => 'Product Deleted',
			'status' => 'danger',
		]);;
	}
}
