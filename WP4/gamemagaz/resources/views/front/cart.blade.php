@extends('layouts.main')

@section('modal-section')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Заполните форму, и наш менеджер свяжется с Вами</h5>
                    <button type="button" class="close modals__cart-refresh" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-row mb-3 cart__message" id="orderMessage">
                                Ошибка
                            </div>
                            <form id="orderForm" class="" method="POST" action="{{route('cart.send')}}">
                                {{csrf_field()}}
                                <div class="form-row mb-3">
                                    <label for="name">Ваше имя</label>
                                    <input id="name" name="name" type="text" class="form-control">
                                </div>
                                <div class="form-row">
                                    <label for="email">Ваш Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modals__cart-refresh" data-dismiss="modal">Закрыть</button>
                    <button type="button" id="orderFormSubmit" form="orderForm" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<?php $summ = 0?>

@section('main-content')
    <div class="cart-product-list">
        @foreach ($orders as $order)
            <?php $summ += $order->product()->withTrashed()->first()->price?>
            <div class="cart-product-list__item">
                <div class="cart-product__item__product-photo"><img src="{{$order->product()->withTrashed()->first()->pic}}" class="cart-product__item__product-photo__image"></div>
                <div class="cart-product__item__product-name">
                    <div class="cart-product__item__product-name__content"><a href="{{route('cart.delete', ['order_id' => $order->id])}}">{{$order->product()->withTrashed()->first()->name}} (удалить)</a></div>
                </div>
                <div class="cart-product__item__cart-date">
                    <div class="cart-product__item__cart-date__content">{{$order->created_at->format('d.m.Y')}}</div>
                </div>
                <div class="cart-product__item__product-price"><span class="product-price__value">{{$order->product()->withTrashed()->first()->price}} рублей</span></div>
            </div>
        @endforeach
        <div class="cart-product-list__result-item">
            <div class="cart-product-list__result-item__text">Итого</div>
            <div class="cart-product-list__result-item__value">{{$summ}} рублей</div>
        </div>
    </div>
@endsection

@section('content-footer')
    @if(!empty($orders->all()))
        <div class="btn-buy-wrap"><a href="{{route('cart.send')}}" class="btn-buy-wrap__btn-link" data-toggle="modal" data-target="#exampleModal">Оформить заказ</a></div>
    @endif
@endsection