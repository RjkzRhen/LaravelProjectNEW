<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Отображение формы регистрации
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Обработка данных регистрации
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'age' => 'required|integer',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'age' => $request->age,
        ]);

        Auth::login($user);

        return redirect()->route('profile.show', ['id' => $user->id])
            ->with('success', 'Вы успешно зарегистрировались и вошли в систему.');
    }

    // Отображение формы входа
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Обработка данных входа
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('profile.show', ['id' => Auth::user()->id])
                ->with('success', 'Вы успешно вошли в систему.');
        }

        return back()->withErrors([
            'username' => 'Неверные учетные данные.',
        ]);
    }

    // Отображение профиля
    public function showProfile($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('home')->with('error', 'Пользователь не найден.');
        }
        return view('profile.show', compact('user'));
    }

    // Обновление профиля
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'age' => 'required|integer',
            'phone' => 'nullable|string|max:255', // Добавляем валидацию для телефона
        ]);

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('home')->with('error', 'Пользователь не найден.');
        }

        $user->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'age' => $request->age,
        ]);

        // Обновляем или создаем телефон
        if ($request->phone) {
            $phone = $user->phones()->first();
            if ($phone) {
                $phone->update(['value' => $request->phone]);
            } else {
                $user->phones()->create(['value' => $request->phone]);
            }
        }

        return redirect()->route('profile.show', ['id' => $user->id])
            ->with('success', 'Профиль успешно обновлен.');
    }

    // Выход из системы
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Вы успешно вышли из системы.');
    }
}
