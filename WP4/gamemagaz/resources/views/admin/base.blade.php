@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 test-block">
                <nav>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'admin.settings') active @endif" href="{{route('admin.settings')}}">Настройки</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'admin.categories') active @endif" href="{{route('admin.categories')}}">Категории</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'admin.products') active @endif" href="{{route('admin.products')}}">Продукты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'admin.orders') active @endif" href="{{route('admin.orders')}}">Заказы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'admin.news') active @endif" href="{{route('admin.news')}}">Новости</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-9">
                @yield('main-content')
            </div>
        </div>
    </div>
@endsection