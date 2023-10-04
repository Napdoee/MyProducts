<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\OrderItems;
use App\Models\OrderDetails;

class OrderController extends Controller
{
    public function index()
    {
        $listCart = Cart::where('user_id', Auth::user()->id)->get();
        $user = Auth::user();

        if($listCart->isEmpty()) {
            return abort(404);
        }

        return view('user.checkout', compact('listCart', 'user'));
    }

    public function getAll()
    {
        $orders = OrderDetails::all();

        return view('admin.order.index', compact('orders'));
    }

    public function edit(OrderDetails $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, OrderDetails $order)
    {
        $this->validate($request, [
            'status' => 'in:pending,progress,complete'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with([
            'message' => 'Succesfully change order status',
            'status' => 'info',
        ]);
    }

    public function show()
    {
        $fetchOrderDetails = OrderDetails::where('user_id', Auth::user()->id);
        $orders = $fetchOrderDetails->get();
        $fetchStatus = $fetchOrderDetails->groupBy('status')->get(['status'])->sortBy(function($model) {
            return array_search($model->status, ['pending', 'progress', 'complete']);
        });
        
        return view('user.order', compact('orders', 'fetchStatus'));
    }

    public function store(Request $request)
    {
        $cart = new Cart();
        $listCart = Cart::where('user_id', Auth::user()->id)->get();
        $subTotal = $cart->itemsPrice();
        $totalPrice = $cart->totalItemsPrice();

        $orderDetail = OrderDetails::create([
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->getFullName(),
            'address' => Auth::user()->address,
            'order_date' => now()->format('Y-m-d'),
            'total_price' => $totalPrice,
        ]);

        foreach($listCart as $row) {
            OrderItems::create([
                'order_id' => $orderDetail->id,
                'product_id' => $row->product_id,
                'quantity' => $row->quantity,
                'sub_price' => $row->total
            ]);

            Cart::destroy($row->id);
        }

        return view('user.finish', compact('orderDetail'));
    }
}
