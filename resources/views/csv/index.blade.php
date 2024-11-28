@extends('layouts.app')

@section('title', 'CSV данные')

@section('content')
    <div class="container">
        <h1 class="display-4 text-primary mb-4">CSV данные</h1>
        <a href="{{ route('csv.create') }}" class="btn btn-success mb-3">Добавить запись</a>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
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
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить эту запись?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
