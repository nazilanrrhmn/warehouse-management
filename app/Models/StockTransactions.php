<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class StockTransactions extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'type', 'quantity', 'user_id', 'transaction_date', 'supplier_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($transaction) {
            $product = $transaction->product;

            Log::info('Stock transaction created:', [
                'product_id' => $transaction->product_id,
                'type' => $transaction->type,
                'quantity' => $transaction->quantity,
                'supplier_id' => $transaction->supplier_id,
            ]);

            if ($product) {
                try {
                    $product->updateStock($transaction->quantity, $transaction->type);
                    Log::info('Stock updated successfully', ['new_stock' => $product->stock]);
                } catch (\Exception $e) {
                    Log::error('Stock update failed', ['error' => $e->getMessage()]);
                }
            }
        });
    }
}
