@extends('layouts.main');
<?php $summ = 0?>

@section('main-content')
    <div class="cart-product-list">
        @foreach ($orders as $order)
            <?php $summ += $order->product->price?>
            <div class="cart-product-list__item">
                <div class="cart-product__item__product-photo"><img src="{{$order->product->pic}}" class="cart-product__item__product-photo__image"></div>
                <div class="cart-product__item__product-name">
                    <div class="cart-product__item__product-name__content"><a href="{{route('cart.delete', ['product_id' => $order->product_id])}}">{{$order->product->name}} (удалить)</a></div>
                </div>
                <div class="cart-product__item__cart-date">
                    <div class="cart-product__item__cart-date__content">{{$order->created_at->format('d.m.Y')}}</div>
                </div>
                <div class="cart-product__item__product-price"><span class="product-price__value">{{$order->product->price}} рублей</span></div>
            </div>
        @endforeach
        <div class="cart-product-list__result-item">
            <div class="cart-product-list__result-item__text">Итого</div>
            <div class="cart-product-list__result-item__value">{{$summ}} рублей</div>
        </div>
    </div>
@endsection

@section('content-footer')
    <div class="btn-buy-wrap"><a href="{{route('cart.send')}}" class="btn-buy-wrap__btn-link">Оформить заказ</a></div>
@endsection