<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:1|max:150',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
            'role' => 'required|string|max:255',
        ]);

        try {
            $user = User::create([
                'last_name' => $validated['last_name'],
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'age' => $validated['age'],
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']), // Хэшируем пароль
            ]);

            // Привязываем роль к пользователю
            $role = Role::where('name', $validated['role'])->first();
            if ($role) {
                $user->roles()->attach($role->id);
            }

            return redirect()->route('users.index')->with('success', 'Пользователь успешно добавлен!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->back()->withErrors(['username' => 'Имя пользователя уже существует.']);
            }
            return redirect()->back()->withErrors(['error' => 'Произошла ошибка при добавлении пользователя.']);
        }
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Пользователь не найден.');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Пользователь успешно удален!');
    }
}
