@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('admin.categories')}}" class="btn btn-primary">Назад</a>
        <form action="{{route('admin.categories.update', ['categorie_id' => $categorie->id])}}" method="post">
            {{csrf_field()}}
            <input type="text" name="name" value="{{$categorie->name}}">
            <textarea name="description" id="">{{$categorie->description}}</textarea>
            <input type="submit">
            <input type="reset">
        </form>
    </div>
@endsection