<?php

namespace App\Models; // Определяем пространство имен для модели

use Illuminate\Database\Eloquent\Factories\HasFactory; // Подключаем трейт HasFactory для использования фабрик
use Illuminate\Database\Eloquent\Model; // Подключаем базовый класс модели

class User extends Model // Определяем класс модели User, наследующийся от Model
{
    use HasFactory; // Используем трейт HasFactory

    // Добавляем разрешение для массового присваивания
    protected $fillable = [ // Определяем массив $fillable, который содержит поля, доступные для массового присваивания
        'last_name', // Поле last_name
        'first_name', // Поле first_name
        'middle_name', // Поле middle_name
        'age', // Поле age
        'username', // Поле username
        'password', // Поле password
    ];
}
