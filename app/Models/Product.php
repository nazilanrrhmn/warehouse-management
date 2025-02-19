<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock', 'description'];

    public function stockTransactions()
    {
        return $this->hasMany(StockTransactions::class);
    }

    public function updateStock($quantity, $type)
    {
        if ($type === 'IN') {
            $this->stock += $quantity;
        } elseif ($type === 'OUT') {
            if ($this->stock < $quantity) {
                return throw new \Exception("Insufficient stock.");
            }
            $this->stock -= $quantity;
        }
        $this->save();
    }
}
