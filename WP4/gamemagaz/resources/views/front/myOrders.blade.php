@extends('layouts.main');

@section('main-content')
    <div class="cart-product-list">
        @foreach($orders as $order)
            <div class="cart-product-list__item">
                <div class="cart-product__item__product-photo"><img src="{{$order->product()->withTrashed()->first()->pic}}" class="cart-product__item__product-photo__image"></div>
                <div class="cart-product__item__product-name">
                    <div class="cart-product__item__product-name__content"><a href="{{route('product', ['product_id' => $order->product_id])}}">{{$order->product()->withTrashed()->first()->name}}</a></div>
                </div>
                <div class="cart-product__item__cart-date">
                    <div class="cart-product__item__cart-date__content">{{$order->created_at->format('d.m.Y')}}</div>
                </div>
                <div class="cart-product__item__product-price"><span class="product-price__value">{{$order->product()->withTrashed()->first()->price}} рублей</span></div>
            </div>
        @endforeach
    </div>
@endsection

@section('content-footer')
    @if($pages_qty > 1)
        <ul class="page-nav">
            @if($current_page > 1)
                <li class="page-nav__item"><a href="{{route('myOrders')}}?p={{$current_page-1}}" class="page-nav__item__link"><i class="fa fa-angle-double-left"></i></a></li>
            @endif
            @for($i=1; $i<=$pages_qty; $i++)
                <li class="page-nav__item"><a href="{{route('myOrders')}}?p={{$i}}" class="page-nav__item__link">{{$i}}</a></li>
            @endfor
            @if($current_page < $pages_qty)
                <li class="page-nav__item"><a href="{{route('myOrders')}}?p={{$current_page+1}}" class="page-nav__item__link"><i class="fa fa-angle-double-right"></i></a></li>
            @endif
        </ul>
    @endif
@endsection