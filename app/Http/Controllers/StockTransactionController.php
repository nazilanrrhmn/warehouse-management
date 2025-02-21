<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransactions;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransactions::with('product')->get();
        return view('transactions.stock-transactions', ['title' => 'Stock Transactions', 'transactions' => $transactions]);
    }

    public function create()
    {
        $products = Product::select('id', 'name', 'supplier_id')->get();
        $suppliers = Supplier::all();
        return view('transactions.create', ['title' => 'Stock Transactions', 'products' => $products, 'suppliers' => $suppliers]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:IN,OUT',
            'quantity' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type === 'IN' && !$product->supplier_id) {
            return redirect()->back()->withErrors(['supplier_id' => 'Product must have a supplier for stock IN!']);
        }

        $supplierId = $request->type === 'IN' ? $product->supplier_id : null;

        if ($request->type === 'OUT' && $request->quantity > $product->stock) {
            return redirect()->back()->withErrors(['quantity' => 'Stock is not sufficient!']);
        }

        try {
            $transaction = StockTransactions::create([
                'product_id' => $request->product_id,
                'supplier_id' => $supplierId,
                'type' => strtoupper($request->type),
                'quantity' => $request->quantity,
                'user_id' => $request->user_id,
                'transaction_date' => now(),
            ]);

            Log::info('Stock transaction saved:', $transaction->toArray());

            return redirect()->route('stock-transactions.index')->with('success', 'Stock transaction added successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to save stock transaction:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to add stock transaction.');
        }
    }

    public function destroy($id)
    {
        $transaction = StockTransactions::findOrFail($id);
        $transaction->delete();

        return redirect()->route('stock-transactions.index');
    }
}
