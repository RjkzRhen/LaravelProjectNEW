<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $users = User::with('phones')->get();
        return view('phones.index', compact('users'));
    }

    public function create()
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $users = User::all();
        return view('phones.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'values' => 'required|array',
            'values.*' => 'required|string|max:255',
        ]);

        foreach ($validated['values'] as $value) {
            Phone::create([
                'user_id' => $validated['user_id'],
                'value' => $value,
            ]);
        }

        return redirect()->route('phones.index')->with('success', 'Номера успешно добавлены!');
    }

    public function edit($id)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $phone = Phone::findOrFail($id);
        $users = User::all();
        return view('phones.edit', compact('phone', 'users'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'value' => 'required|string|max:255',
        ]);

        $phone = Phone::findOrFail($id);
        $phone->update($validated);

        return redirect()->route('phones.index')->with('success', 'Номер успешно обновлен!');
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $phone = Phone::findOrFail($id);
        $phone->delete();

        return redirect()->route('phones.index')->with('success', 'Номер успешно удален!');
    }

    public function addToUser($id)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $user = User::findOrFail($id);
        $users = User::all();
        return view('phones.add_to_user', compact('user', 'users'));
    }

    public function storeToUser(Request $request, $id)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $validated = $request->validate([
            'values' => 'required|array',
            'values.*' => 'required|string|max:255',
        ]);

        foreach ($validated['values'] as $value) {
            Phone::create([
                'user_id' => $id,
                'value' => $value,
            ]);
        }

        return redirect()->route('phones.index')->with('success', 'Номера успешно добавлены!');
    }

    public function destroyUser($id)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('phones.index')->with('success', 'Пользователь успешно удален!');
    }
}
