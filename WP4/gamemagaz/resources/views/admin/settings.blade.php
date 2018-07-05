@extends('layouts.app')

@section('content')
    <div class="container">
        <div>Email для новых заказов</div>
        <form class="form-inline" action="{{route('admin.settings.send')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="{{$email}}">
            </div>
            <button type="submit" class="btn btn-default">Сохранить</button>
        </form>
    </div>
@endsection