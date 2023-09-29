<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:categories,category_name']
        ]);

        $request['category_name'] = $request->name;
        $category = Category::create($request->all());

        return redirect()->route('admin.category.index')->with([
            'message' => 'Category Created',
            'status' => 'success',
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $rule = ($request->name != '') ? ['required', 'unique:categories,category_name'] : ['required'];

        $this->validate($request, [
            'name' => $rule
        ]);

        $request['category_name'] = $request->name;
        $category->update($request->all());

        return redirect()->route('admin.category.index')->with([
            'message' => 'Category Updated',
            'status' => 'info',
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('admin.category.index')->with([
            'message' => 'Category Deleted',
            'status' => 'danger',
        ]);;
    }
}
