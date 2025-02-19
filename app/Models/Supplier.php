<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'address'];

    public function stockTransactions()
    {
        return $this->hasMany(StockTransactions::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
