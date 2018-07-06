@extends('layouts.main')

@section('main-content')
    <div class="product-container">
        <div class="product-container__image-wrap"><img src="{{$this_product->pic}}" class="image-wrap__image-product"></div>
        <div class="product-container__content-text">
            <div class="product-container__content-text__title">{{$this_product->name}}</div>
            <div class="product-container__content-text__price">
                <div class="product-container__content-text__price__value">
                    Цена:@if($this_product->trashed()) 0 @else <b>{{$this_product->price}}</b>@endif
                    руб
                </div>
                @if(!$this_product->trashed())<a href="{{route('cart.add', ['product_id' => $this_product->id])}}" class="btn btn-blue">Купить</a>@endif
            </div>
            <div class="product-container__content-text__description">
                @if($this_product->trashed())
                    <p>Данный товар более недоступен</p>
                @else
                    {!! $this_product->description !!}
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content-bottom')
    <div class="line"></div>
    <div class="content-head__container">
        <div class="content-head__title-wrap">
            <div class="content-head__title-wrap__title bcg-title">Посмотрите наши товары</div>
        </div>
    </div>
    <div class="content-main__container">
        <div class="products-columns">
            @foreach($latest_products as $product)
                <div class="products-columns__item">
                    <div class="products-columns__item__title-product"><a href="{{route('product', ['product_id' => $product->id])}}" class="products-columns__item__title-product__link">{{$product->name}}</a></div>
                    <div class="products-columns__item__thumbnail"><a href="{{route('product', ['product_id' => $product->id])}}" class="products-columns__item__thumbnail__link"><img src="{{$product->pic}}" alt="Preview-image" class="products-columns__item__thumbnail__img"></a></div>
                    <div class="products-columns__item__description"><span class="products-price">400 руб</span><a href="{{route('cart.add', ['product_id' => $product->id])}}" class="btn btn-blue">Купить</a></div>
                </div>
            @endforeach
        </div>
    </div>
@endsection