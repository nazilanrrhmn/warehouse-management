<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['product', 'supplier'])->get();
        return view('purchases.purchase', ['title' => 'Purchases', 'purchases' => $purchases]);
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('purchases.create', ['title' => 'Purchases', 'products' => $products, 'suppliers' => $suppliers]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $purchase = Purchase::create($request->all());

        return redirect()->route('purchases.index');
    }

    public function destroy(Purchase $purchase)
    {
        // Update product stock after deleting purchase record
        $product = $purchase->product;
        $product->quantity -= $purchase->quantity;
        $product->save();

        $purchase->delete();

        return redirect()->route('purchases.index');
    }
}
