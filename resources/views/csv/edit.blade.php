@extends('layouts.app')

@section('title', 'Редактировать запись в CSV')

@section('content')
    <h1>Редактировать запись в CSV</h1>
    <form action="{{ route('csv.update', $id) }}" method="POST">
        @csrf
        @foreach($header as $index => $column)
            <label for="{{ $column }}">{{ $column }}:</label>
            <input type="text" name="{{ $column }}" value="{{ $record[$index] }}" required><br>
        @endforeach
        <button type="submit">Обновить</button>
    </form>
@endsection
