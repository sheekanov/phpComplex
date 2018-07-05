<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        if (isset($request->all()['p'])) {
            $currentPage = $request->all()['p'];
        } else {
            $currentPage = 1;
        }

        $query = Product::orderBy('created_at', 'desc');
        $pagesQty = (int)ceil($query->count()/6);
        $prods = $query->forPage($currentPage, 6)->get();
        $data = ['page_title' => 'ГеймсМаркет','content_title' => 'Последние товары', 'products' => $prods, 'pages_qty' => $pagesQty, 'current_page' => $currentPage];

        return view('front.home', $data);
    }
}
