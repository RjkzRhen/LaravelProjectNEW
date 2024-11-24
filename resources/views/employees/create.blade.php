@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')
    <h1>Create Employee</h1>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>
        <label for="middleName">Middle Name:</label>
        <input type="text" id="middleName" name="middleName">
        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required>
        <label for="telegramId">Telegram ID:</label>
        <input type="text" id="telegramId" name="telegramId">
        <button type="submit">Create</button>
    </form>
@endsection
