<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::latest()->get();

        return view('admin.discount.index', compact('discounts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'discount_percent' => ['required', 'numeric'],
            'description' => ['required'],
            'status' => ['required']
        ]);

        $request['active'] = $request->status;
        $discount = Discount::create($request->all());

        return redirect()->route('admin.discount.index')->with([
            'message' => 'Discount Created',
            'status' => 'success',
        ]);
    }

    public function edit(Discount $discount)
    {
        return view('admin.discount.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $this->validate($request, [
            'discount_percent' => ['required', 'numeric'],
            'description' => ['required'],
            'status' => ['required']
        ]);

        $request['active'] = $request->status;
        $discount->update($request->all());

        return redirect()->route('admin.discount.index')->with([
            'message' => 'Discount Updated',
            'status' => 'info',
        ]);
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('admin.discount.index')->with([
            'message' => 'Discount Deleted',
            'status' => 'danger',
        ]);
    }
}
