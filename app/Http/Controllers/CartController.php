<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $listCart = Cart::where('user_id', Auth::user()->id)->get();
        // $listCart = Cart::latest()->get();

        // dd($listCart);
        return view('user.cart', compact('listCart'));
    }

    public function store(Request $request)
    {
        $fetchProduct = Product::find($request->product_id);
        $productInStock = $fetchProduct->stock;
        $totalProductPrice = $fetchProduct->getPrice() * $request->quantity;

        $userCart = Cart::where('user_id', Auth::user()->id)->get();
        $userCart = $userCart->map(function($data) { return $data->product_id; });
        
        if(in_array($request->product_id, $userCart->toArray())) {
            return redirect()->back()->with([
                'message' => 'Product is already in your cart!',
                'status' => 'orange',
            ]);
        }

        $this->validate($request, [
            'quantity' => ['required', 'numeric', 'min:1', "max:$productInStock"],
        ]);

        $request['user_id'] = Auth::user()->id;
        $request['total'] = $totalProductPrice;

        Cart::create($request->all());

        $newQuantity = $fetchProduct->stock - $request->quantity;
        $fetchProduct->update(['stock' => $newQuantity]);

        return redirect()->back()->with([
            'message' => 'Succesfully added item to cart!',
            'status' => 'success',
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        $fetchProduct = Product::find($request->product_id);
        $productInStock = ($cart->quantity + $fetchProduct->stock);
        $totalProductPrice = $fetchProduct->getPrice() * $request->quantity;

        $validator = Validator::make($request->only('quantity'), [
            'quantity' => ['required', 'numeric', 'min:1', "max:$productInStock"],
        ]);

        if($validator->fails()) {
            return redirect()->route('cart.index')->with([
                'productName' => $fetchProduct->name,
            ])->withErrors($validator);
        }

        $statsQuantity = $request->quantity <=> $cart->quantity;

        $newQuantity = null;;
        switch ($statsQuantity) {
            case -1:
                $newQuantity = $fetchProduct->stock + ($cart->quantity - $request->quantity);
                break;
            case 1:
                $newQuantity = $fetchProduct->stock - ($request->quantity - $cart->quantity);
                break;
            default:
                $newQuantity = $fetchProduct->stock;
                break;
        }

        // return response()->json([
        //     'currentQuantity' => $cart->quantity,
        //     'updateQuantity' => $request->quantity,
        //     'status' => $statsQuantity,
        //     'newQuantity' => $newQuantity
        // ]);

        $fetchProduct->update(['stock' => $newQuantity]);

        $cart->update([
            'quantity' => $request->quantity,
            'total' => $totalProductPrice
        ]);

        return redirect()->route('cart.index')->with([
            'message' => 'Succesfully update product quantity!',
            'status' => 'success',
        ]);
    }

    public function destroy(Cart $cart)
    {
        $fetchProduct = Product::find($cart->product_id);
        $updatedStock = $fetchProduct->stock + $cart->quantity;
        $fetchProduct->update(['stock' => $updatedStock]);

        $cart->delete();

        return redirect()->route('cart.index')->with([
            'message' => 'Remove product from cart!',
            'status' => 'danger',
        ]);;
    }
}
