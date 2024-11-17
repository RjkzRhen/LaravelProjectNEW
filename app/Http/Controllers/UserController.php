<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate and update the user
        $user->update($request->only(['first_name', 'middle_name', 'age', 'username']));

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
    public function index()
    {
        // Retrieve all users from the database
        $users = User::all();

        // Return the view and pass the users data
        return view('users.index', compact('users')); // Make sure the 'users.index' view exists
    }    public function create()
    {
        // Return the view to create a new user
        return view('users.create'); // Ensure you have this view
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:1|max:150',
            'username' => 'required|string|max:255|unique:user_table,username', // Обновляем имя таблицы
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'age' => $validated['age'],
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'Пользователь успешно добавлен!');
    }
}