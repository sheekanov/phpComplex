@extends('admin.base')

@section('main-content')
    <div class="row mb-3">
        <h2 class="col-lg-12">Изменить категорию "{{$categorie->name}}"</h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <form method="POST" action="{{route('admin.categories.update', ['categorie_id' => $categorie->id])}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="inputTitle">Название</label>
                <input type="text" name="name" placeholder="Название" class="form-control" id="inputTitle" value="{{$categorie->name}}">
            </div>
            <div class="form-group">
                <label for="inputDesc">Описание</label>
                <textarea name="description" id="inputDesc" placeholder="Описание" class="form-control" rows="5">{{$categorie->description}}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{route('admin.categories')}}" class="btn btn-primary ml-3">Назад</a>
                <a href="{{route('admin.categories.delete', ['categorie_id' => $categorie->id])}}" class="btn btn-danger ml-3">Удалить</a>
            </div>
        </form>
        </div>
    </div>
@endsection