@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="profile-background">
        <div class="profile-content">
            <div class="profile-card">
                <h3 class="text-center">Профиль пользователя</h3>
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                             class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{ $user->username }}</h5>
                        <p class="text-muted mb-1">{{ $user->first_name }} {{ $user->last_name }}</p>
                        <p class="text-muted mb-4">{{ $user->age }} лет</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button type="button" id="editProfileButton" class="btn btn-primary">Редактировать</button>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card-body">
                            <!-- Шторка для редактирования -->
                            <div id="editProfileForm" class="collapse">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Фамилия</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control editable" id="last_name" value="{{ $user->last_name }}" required>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Имя</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control editable" id="first_name" value="{{ $user->first_name }}" required>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Отчество</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control editable" id="middle_name" value="{{ $user->middle_name }}">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Возраст</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control editable" id="age" value="{{ $user->age }}" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12 text-end">
                                        <button type="button" id="saveProfile" class="btn btn-success">Сохранить</button>
                                        <button type="button" id="cancelEdit" class="btn btn-secondary">Отмена</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Конец шторки -->

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">ФИО</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->first_name }} {{ $user->last_name }} {{ $user->middle_name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Логин</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->username }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Возраст</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->age }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script>
        // Показать форму редактирования
        document.getElementById('editProfileButton').addEventListener('click', function() {
            document.getElementById('editProfileForm').classList.toggle('show');
        });

        // Отмена редактирования
        document.getElementById('cancelEdit').addEventListener('click', function() {
            document.getElementById('editProfileForm').classList.remove('show');
        });

        // Сохранение изменений
        document.getElementById('saveProfile').addEventListener('click', function() {
            const lastName = document.getElementById('last_name').value;
            const firstName = document.getElementById('first_name').value;
            const middleName = document.getElementById('middle_name').value;
            const age = document.getElementById('age').value;

            fetch('{{ route('profile.update', ['id' => $user->id]) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    last_name: lastName,
                    first_name: firstName,
                    middle_name: middleName,
                    age: age
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Профиль успешно обновлен!');
                        document.getElementById('editProfileForm').classList.remove('show');
                    } else {
                        alert('Ошибка при обновлении профиля.');
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    alert('Произошла ошибка при обновлении профиля.');
                });
        });
    </script>
@endsection
