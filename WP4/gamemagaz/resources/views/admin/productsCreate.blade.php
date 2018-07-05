@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('admin.products')}}" class="btn btn-primary">Назад</a>
        <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="text" name="name" placeholder="Название">
            <select name="categorie_id" id="">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <textarea name="description" id="">Описание</textarea>
            <input type="text" name="price" placeholder="Цена">
            <input type="file" name="pic">
            
            <input type="submit">
            <input type="reset">
        </form>
    </div>
@endsection