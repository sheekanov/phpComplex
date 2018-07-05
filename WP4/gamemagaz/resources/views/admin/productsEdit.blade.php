@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('admin.products')}}" class="btn btn-primary">Назад</a>
        <form action="{{route('admin.products.update', ['product_id' => $product->id])}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="text" name="name" value="{{$product->name}}">
            <select name="categorie_id" id="" value = ''>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" @if($category->id == $product->categorie_id) selected @endif>{{$category->name}}</option>
                @endforeach
            </select>
            <textarea name="description" id="">{{$product->description}}</textarea>
            <input type="text" name="price" value="{{$product->price}}">
            <input type="file" name="pic">
            <input type="submit">
        </form>
        <img src="{{$product->pic}}" alt="" style="max-height: 200px; max-width: 200px">
    </div>
@endsection