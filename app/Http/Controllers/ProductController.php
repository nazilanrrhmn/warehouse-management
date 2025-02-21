<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.product', ['title' => 'Product List', 'products' => $products]);
    }

    public function create()
    {
        return view('products.create', ['title' => 'Create Product', 'suppliers' => Supplier::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'supplier_id' => 'required|integer',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
        dd($request->all());
    }

    public function show(Product $product)
    {
        return view('product.show', ['title' => 'Product Details', 'product' => $product]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['title' => 'Edit Product', 'product' => $product, 'suppliers' => Supplier::all()]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'supplier_id' => 'required|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
