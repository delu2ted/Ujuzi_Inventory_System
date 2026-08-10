<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{


    //
    public function index()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalStock = Product::sum('stock');
        $lowStockProducts = Product::where('stock', '<', 4)->count();

        return view('dashboard', compact('totalProducts', 'totalUsers', 'totalStock', 'lowStockProducts'));
    }
}
