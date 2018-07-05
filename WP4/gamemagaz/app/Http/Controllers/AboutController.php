<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class AboutController extends Controller
{
    public function index()
    {
        $latestProds = Product::orderBy('created_at', 'desc')->take(3)->get();
        $data = [
            'page_title' => 'Игра',
            'content_title' => 'О магазине',
            'latest_products' => $latestProds
        ];

        return view('front.about', $data);
    }
}
