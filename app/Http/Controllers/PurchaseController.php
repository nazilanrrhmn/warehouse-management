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
        return view('purchases.purchase', [
            'title' => 'Purchases',
            'purchases' => $purchases
        ]);
    }

    public function create()
    {
        $products = Product::with('supplier:id,name')->get();
        $suppliers = Supplier::all();
        return view('purchases.create', [
            'title' => 'Create Purchase',
            'products' => $products,
            'suppliers' => $suppliers
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'status' => 'required|string'
        ]);

        $purchase = Purchase::create($request->all());

        return redirect()->route('purchases.index')->with('success', 'Purchase successfully added!');
    }

    public function destroy(Purchase $purchase)
    {
        $product = $purchase->product;

        // Kurangi stok produk setelah penghapusan pembelian
        $product->stock -= $purchase->quantity;
        $product->save();

        $purchase->delete();

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully!');
    }
}
