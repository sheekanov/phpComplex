@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('admin.categories.create')}}" class="btn btn-primary">Добавить</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Удаление</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Редактировать</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $categorie)
                <tr id="{{$categorie->id}}">
                    <td><a href="{{route('admin.categories.delete', ['categorie_id' => $categorie->id])}}">X</a></td>
                    <td>{{$categorie->name}}</td>
                    <td>{{$categorie->description}}</td>
                    <td><a href="{{route('admin.categories.edit' , ['categorie_id' => $categorie->id])}}">edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection