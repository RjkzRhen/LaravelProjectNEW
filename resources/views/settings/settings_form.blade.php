@extends('layouts.app')

@section('title', 'Настройки')

@section('content')
    <div class="settings-form-container">
        <form action="{{ $setting ? route('settings.update', $setting->id) : route('settings.store') }}" method="POST">
            @csrf
            @if($setting)
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="tax_rate">Налоговая ставка (%)</label>
                <input type="number" step="0.01" id="tax_rate" name="tax_rate" value="{{ $setting ? $setting->tax_rate : '' }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
