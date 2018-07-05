@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('admin.categories')}}" class="btn btn-primary">Назад</a>
        <form action="{{route('admin.categories.store')}}" method="post">
            {{csrf_field()}}
            <input type="text" name="name" placeholder="Название">
            <textarea name="description" id="">Описание</textarea>
            <input type="submit">
            <input type="reset">
        </form>
    </div>
@endsection