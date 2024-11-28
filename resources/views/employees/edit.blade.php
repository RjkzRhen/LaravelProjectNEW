@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
    <div class="container">
        <h1 class="display-4 text-primary mb-4">Edit Employee</h1>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name:</label>
                <input type="text" id="lastName" name="lastName" class="form-control" value="{{ $employee->lastName }}" required>
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name:</label>
                <input type="text" id="firstName" name="firstName" class="form-control" value="{{ $employee->firstName }}" required>
            </div>
            <div class="mb-3">
                <label for="middleName" class="form-label">Middle Name:</label>
                <input type="text" id="middleName" name="middleName" class="form-control" value="{{ $employee->middleName }}">
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position:</label>
                <input type="text" id="position" name="position" class="form-control" value="{{ $employee->position }}" required>
            </div>
            <div class="mb-3">
                <label for="telegramId" class="form-label">Telegram ID:</label>
                <input type="text" id="telegramId" name="telegramId" class="form-control" value="{{ $employee->telegramId }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
