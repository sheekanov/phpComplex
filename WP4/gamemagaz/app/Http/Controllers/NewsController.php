<?php

namespace App\Http\Controllers;

use App\News;
use App\Product;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {

        if (isset($request->all()['p'])) {
            $currentPage = $request->all()['p'];
        } else {
            $currentPage = 1;
        }

        $query = News::orderBy('created_at', 'desc');
        $pagesQty = (int)ceil($query->count()/2);
        $news = $query->forPage($currentPage, 2)->get();
        $data = ['page_title' => 'Новости','content_title' => 'Новости', 'news' => $news, 'pages_qty' => $pagesQty, 'current_page' => $currentPage];

        return view('front.news', $data);
    }

    public function article($news_id)
    {
        $news = News::find($news_id);

        $latestProds = Product::orderBy('created_at', 'desc')->take(3)->get();
        $data = [
            'page_title' => 'Новость',
            'content_title' => 'Новости',
            'news' => $news,
            'latest_products' => $latestProds
        ];

        return view('front.article', $data);
    }
}
