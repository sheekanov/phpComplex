<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrders extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->all()['p'])) {
            $currentPage = $request->all()['p'];
        } else {
            $currentPage = 1;
        }

        $query = Auth::user()->orders()->orderBy('created_at', 'desc')->where('status', '=', 1);
        $pagesQty = (int)ceil($query->count()/6);
        $orders = $query->forPage($currentPage, 6)->get();
        $data = ['page_title' => 'Мои заказы','content_title' => 'Мои заказы', 'orders' => $orders, 'pages_qty' => $pagesQty, 'current_page' => $currentPage];

        return view('front.myOrders', $data);
    }
}
