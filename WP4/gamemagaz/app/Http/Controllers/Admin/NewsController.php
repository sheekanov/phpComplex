<?php

namespace App\Http\Controllers\Admin;

use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news', ['news' => $news]);
    }

    public function create()
    {
        return view('admin.newsCreate');
    }

    public function store(Request $request)
    {
        $news = new News();
        $news->title = $request->all()['title'];
        $news->text = $request->all()['text'];
        $news->excerpt = $request->all()['excerpt'];
        $news->save();

        Storage::makeDirectory('uploads/news/news-id-' . $news->id);

        if ($request->hasFile('thumbnail')) {
            $request->file('thumbnail')->move(storage_path() . '/app/public/uploads/news/news-id-' . $news->id, 'thumbnail.jpg');
            $news->thumbnail = '/storage/uploads/news/news-id-' . $news->id . '/thumbnail.jpg';
            $news->save();
        }
        return redirect()->route('admin.news');
    }

    public function edit($news_id)
    {
        $news = News::find($news_id);
        return view('admin.newsEdit', ['news' => $news]);
    }

    public function update(Request $request, $news_id)
    {
        $a = $this->validate($request, [
            'title' => 'required',
            'text' => 'required'
        ]);

        $news = News::find($news_id);
        $news->title = $request->all()['title'];
        $news->text = $request->all()['text'];
        $news->excerpt = $request->all()['excerpt'];

        if ($request->hasFile('thumbnail')) {
            $request->file('thumbnail')->move(storage_path() . '/app/public/uploads/news/news-id-' . $news->id, 'thumbnail.jpg');
            $news->thumbnail = '/storage/uploads/news/news-id-' . $news->id . '/thumbnail.jpg';
        }
        $news->save();
        return redirect()->route('admin.news');
    }

    public function delete($news_id)
    {
        $news = News::find($news_id);
        $news->delete();

        return redirect()->route('admin.news');
    }
}
