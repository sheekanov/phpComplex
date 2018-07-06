@extends('layouts.main');

@section('main-content')
    <div class="news-list__container">
        @foreach($news as $item)
            <div class="news-list__item">
                <div class="news-list__item__thumbnail"><img src="{{$item->thumbnail}}"></div>
                <div class="news-list__item__content">
                    <div class="news-list__item__content__news-title">{{$item->title}}</div>
                    <div class="news-list__item__content__news-date">{{$item->created_at->format('d.m.Y')}}</div>
                    <div class="news-list__item__content__news-content">
                        {!! $item->excerpt !!}
                    </div>
                </div>
                <div class="news-list__item__content__news-btn-wrap"><a href="{{route('news.article', ['news_id' => $item->id])}}" class="btn btn-brown">Подробнее</a></div>
            </div>
        @endforeach
    </div>
@endsection

@section('content-footer')
    @if($pages_qty > 1)
        <ul class="page-nav">
            @if($current_page > 1)
                <li class="page-nav__item"><a href="{{route('news')}}?p={{$current_page-1}}" class="page-nav__item__link"><i class="fa fa-angle-double-left"></i></a></li>
            @endif
            @for($i=1; $i<=$pages_qty; $i++)
                <li class="page-nav__item"><a href="{{route('news')}}?p={{$i}}" class="page-nav__item__link">{{$i}}</a></li>
            @endfor
            @if($current_page < $pages_qty)
                <li class="page-nav__item"><a href="{{route('news')}}?p={{$current_page+1}}" class="page-nav__item__link"><i class="fa fa-angle-double-right"></i></a></li>
            @endif
        </ul>
    @endif
@endsection