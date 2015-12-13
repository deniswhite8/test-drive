<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auto;
use App\Models\Dealer;
use App\Models\Order;
use App\Models\Salon;

/**
 * Admin dashboard controller
 *
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
    /**
     * Index action
     */
    public function index()
    {
        return view('admin.dashboard', [
            'orderCount' => Order::count(),
            'dealerCount' => Dealer::count(),
            'salonCount' => Salon::count(),
            'autoCount' => Auto::count()
        ]);
    }
}
