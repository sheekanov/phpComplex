@extends('admin.base')

@section('main-content')
    <div class="row mb-3">
        <h2 class="col-lg-12">Новая категория</h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form method="POST"  action="{{route('admin.categories.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="inputTitle">Название</label>
                    <input type="text" name="name" placeholder="Название" class="form-control" id="inputTitle">
                </div>
                <div class="form-group">
                    <label for="inputDesc">Описание</label>
                    <textarea name="description" id="inputDesc" placeholder="Описание" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a href="{{route('admin.categories')}}" class="btn btn-primary ml-3">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection