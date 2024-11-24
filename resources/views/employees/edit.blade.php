@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
    <h1>Edit Employee</h1>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="{{ $employee->lastName }}" required>
        </div>
        <div>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="{{ $employee->firstName }}" required>
        </div>
        <div>
            <label for="middleName">Middle Name:</label>
            <input type="text" id="middleName" name="middleName" value="{{ $employee->middleName }}">
        </div>
        <div>
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" value="{{ $employee->position }}" required>
        </div>
        <div>
            <label for="telegramId">Telegram ID:</label>
            <input type="text" id="telegramId" name="telegramId" value="{{ $employee->telegramId }}">
        </div>
        <div>
            <button type="submit">Update</button>
        </div>
    </form>
@endsection
