<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderPosition;
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

        $orders = Auth::user()->orders()->where('status', '=', 1)->orderBy('created_at')->get();

        $orderPositions = $orders->map(function ($item) {
            return $item->orderPositions()->get();
        })->collapse();


        $pagesQty = (int)ceil($orderPositions->count()/6);

        $orderPositionsPage = $orderPositions->forPage($currentPage, 6);

        $data = ['page_title' => 'Мои заказы','content_title' => 'Мои заказы', 'orderPositions' => $orderPositionsPage, 'pages_qty' => $pagesQty, 'current_page' => $currentPage];

        return view('front.myOrders', $data);
    }
}
