@extends('layouts.app')

@section('title', 'Форма профиля')

@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">
                            <h1>Форма профиля</h1>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.save') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Фамилия</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">Имя</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="middle_name" class="form-label">Отчество</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">Возраст</label>
                                    <input type="number" class="form-control" id="age" name="age" required>
                                </div>
                                <button type="button" id="saveProfile" class="btn btn-success">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

