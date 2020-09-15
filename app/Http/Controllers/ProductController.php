<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('created_at')->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->except('_token'));
        return redirect(route('product.index'))->with('success', '添加机种成功！');
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->except('_token'));
        return redirect(route('product.index'))->with('success', '编辑机种成功！');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', '删除机种成功！');
    }
}
