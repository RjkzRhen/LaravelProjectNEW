@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')
    <div class="container">
        <h1 class="display-4 text-primary mb-4">Create Employee</h1>
        <form action="{{ route('employees.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name:</label>
                <input type="text" id="lastName" name="lastName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name:</label>
                <input type="text" id="firstName" name="firstName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="middleName" class="form-label">Middle Name:</label>
                <input type="text" id="middleName" name="middleName" class="form-control">
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position:</label>
                <input type="text" id="position" name="position" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telegramId" class="form-label">Telegram ID:</label>
                <input type="text" id="telegramId" name="telegramId" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
