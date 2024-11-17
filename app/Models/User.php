<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Добавляем разрешение для массового присваивания
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'age',
        'username',
        'password',
    ];
}

