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
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('transactions.create', ['title' => 'Stock Transactions', 'products' => $products, 'suppliers' => $suppliers]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'type' => 'required|in:IN,OUT',
            'quantity' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek jika transaksi adalah "OUT" dan stok tidak mencukupi
        if ($request->type === 'OUT' && $request->quantity > $product->stock) {
            return redirect()->back()->withErrors(['quantity' => 'Stock is not sufficient!']);
        }

        try {
            // Simpan transaksi stok
            $transaction = StockTransactions::create([
                'product_id' => $request->product_id,
                'supplier_id' => $request->type === 'IN' ? $request->supplier_id : null,
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
