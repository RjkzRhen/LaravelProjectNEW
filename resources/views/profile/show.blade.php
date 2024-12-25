@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="profile-background">
        <div class="profile-content">
            <div class="profile-card">
                <div class="card-body text-center">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                         class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3">{{ $user->username }}</h5>
                    <p class="text-muted mb-1">{{ $user->first_name }} {{ $user->last_name }}</p>
                    <p class="text-muted mb-4">{{ $user->age }} лет</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}">
                        @csrf
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="mb-0">Фамилия</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" />
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="mb-0">Имя</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" />
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="mb-0">Отчество</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="middle_name" class="form-control" value="{{ $user->middle_name }}" />
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="mb-0">Возраст</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" name="age" class="form-control" value="{{ $user->age }}" />
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="mb-0">Телефон</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control" value="{{ $user->phones->first()->value ?? '' }}" />
                                    </div>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <a href="{{ route('logout') }}" class="btn btn-danger">Выйти</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
