<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', '=', 1)->get();
        return view('admin.orders', ['orders' => $orders]);
    }

    public function view($order_id)
    {
        $order = Order::find($order_id);
        $summ = $order->orderPositions()->get()->map(function($item) {
            return $item->product()->withTrashed()->first()->price;
        })->sum();
        return view('admin.orderView', ['order' => $order]);
    }
}
