<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;
use App\Product;

class CategoriesController extends Controller
{
    public function index($category_id, Request $request)
    {
        if (isset($request->all()['p'])) {
            $currentPage = $request->all()['p'];
        } else {
            $currentPage = 1;
        }

        $query = Product::where('categorie_id', '=', $category_id)->orderBy('created_at', 'desc');
        $category = Categorie::find($category_id);
        $pagesQty = (int)ceil($query->count()/6);
        $prods = $query->forPage($currentPage, 6)->get();
        $data = [
            'page_title' => 'Категории',
            'content_title' => 'Игры в разделе ' . $category->name,
            'products' => $prods,
            'pages_qty' => $pagesQty,
            'current_page' => $currentPage,
            'category' => $category_id
        ];

        return view('front.categories', $data);
    }
}
