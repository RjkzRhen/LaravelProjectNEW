<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'last_name' => '', // Значение по умолчанию
            'first_name' => '', // Значение по умолчанию
            'middle_name' => '', // Значение по умолчанию
            'age' => 0, // Значение по умолчанию
        ]);

        Auth::login($user);

        return redirect()->route('profile.form');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Получаем текущего пользователя
            $user = Auth::user();

            // Перенаправляем на страницу профиля пользователя
            return redirect()->route('profile.show', ['id' => $user->id])->with('success', 'Вы успешно вошли в систему.');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showProfileForm()
    {
        return view('profile.form');
    }

    public function showProfile($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Пользователь не найден.');
        }
        return view('profile.show', compact('user'));
    }

    public function saveProfile(Request $request)
    {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'age' => 'required|integer',
        ]);

        $user = Auth::user();
        $user->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'age' => $request->age,
        ]);

        return redirect()->route('profile.show', ['id' => $user->id])->with('success', 'Profile updated successfully.');
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'age' => 'required|integer',
        ]);

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Пользователь не найден.');
        }

        $user->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'age' => $request->age,
        ]);

        return redirect()->route('profile.show', ['id' => $user->id])->with('success', 'Профиль успешно обновлен.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
