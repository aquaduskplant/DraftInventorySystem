<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // If NOT admin → go directly to Inventory (products list)
        if ($user->role !== 'admin') {
            return redirect()->route('products.index');
        }

        // Admin dashboard stats
        $productCount  = Product::count();
        $categoryCount = Category::count();
        $totalQuantity = Product::sum('quantity');
        $lowStockCount = Product::where('quantity', '<', 5)->count();

        return view('dashboard', compact(
            'productCount',
            'categoryCount',
            'totalQuantity',
            'lowStockCount'
        ));
    }
}
