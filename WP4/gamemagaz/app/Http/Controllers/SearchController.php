<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->all()['p'])) {
            $currentPage = $request->all()['p'];
        } else {
            $currentPage = 1;
        }
        $searchString = $request->all()['search'];
        //dd($request->all());
        $query = Product::where('name', 'like', "%$searchString%");
        $pagesQty = (int)ceil($query->count()/6);
        $prods = $query->orderBy('created_at', 'desc')->forPage($currentPage, 6)->get();
        $data = ['page_title' => 'Поиск','content_title' => 'Результаты поиска','search_string' => $searchString, 'products' => $prods, 'pages_qty' => $pagesQty, 'current_page' => $currentPage];

        return view('front.search', $data);
    }
}
