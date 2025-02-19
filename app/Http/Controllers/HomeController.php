<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'Dashboard',
            'totalProducts' => Product::count(),
            'totalStock' => Product::sum('stock'),
            'totalPurchases' => Purchase::count(),
            'totalSuppliers' => Supplier::count(),
            'totalCustomers' => Customer::count(),
        ]);
    }
}
