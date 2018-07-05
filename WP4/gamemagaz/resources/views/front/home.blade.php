@extends('layouts.main');

@section('main-content')
    <div class="products-columns">
        @foreach($products as $product)
            <div class="products-columns__item">
                <div class="products-columns__item__title-product"><a href="{{route('product', ['product_id' => $product->id])}}" class="products-columns__item__title-product__link">{{$product->name}}</a></div>
                <div class="products-columns__item__thumbnail"><a href="{{route('product', ['product_id' => $product->id])}}" class="products-columns__item__thumbnail__link"><img src="{{$product->pic}}" alt="Preview-image" class="products-columns__item__thumbnail__img"></a></div>
                <div class="products-columns__item__description"><span class="products-price">{{$product->price}} руб</span><a href="{{route('cart.add', ['product_id' => $product->id])}}" class="btn btn-blue">Купить</a></div>
            </div>
        @endforeach
    </div>
@endsection

@section('content-footer')
    @if($pages_qty > 1)
    <ul class="page-nav">
            @if($current_page > 1)
                <li class="page-nav__item"><a href="{{route('home')}}?p={{$current_page-1}}" class="page-nav__item__link"><i class="fa fa-angle-double-left"></i></a></li>
            @endif
            @for($i=1; $i<=$pages_qty; $i++)
                <li class="page-nav__item"><a href="{{route('home')}}?p={{$i}}" class="page-nav__item__link">{{$i}}</a></li>
            @endfor
            @if($current_page < $pages_qty)
                <li class="page-nav__item"><a href="{{route('home')}}?p={{$current_page+1}}" class="page-nav__item__link"><i class="fa fa-angle-double-right"></i></a></li>
            @endif
    </ul>
    @endif
@endsection