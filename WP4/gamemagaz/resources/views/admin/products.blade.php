@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('admin.products.create')}}" class="btn btn-primary">Добавить</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Удаление</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Картинка</th>
                <th>Описание</th>
                <th>Редактировать</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr id="{{$product->id}}">
                    <td><a href="{{route('admin.products.delete', ['product_id' => $product->id])}}">X</a></td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->categorie->name}}</td>
                    <td>{{$product->price}}</td>
                    <td><a href="{{$product->pic}}">Посмотреть</a></td>
                    <td>{{$product->description}}</td>
                    <td><a href="{{route('admin.products.edit' , ['product_id' => $product->id])}}">edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection