@extends('layouts.app')

@section('title', 'CSV данные')

@section('content')
    <h1>CSV данные</h1>
    <a href="{{ route('csv.create') }}">Добавить запись</a>

    <table>
        <thead>
        <tr>
            @foreach($header as $column)
                <th>{{ $column }}</th>
            @endforeach
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($csvData as $index => $row)
            <tr>
                @foreach($row as $cell)
                    <td>{{ $cell }}</td>
                @endforeach
                <td>
                    <!-- Форма для удаления -->
                    <form action="{{ route('csv.destroy', $index + 1) }}" method="GET" style="display:inline;">
                        <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить эту запись?')">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
