<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index()
    {
        $users = User::with('phones')->get();

        return view('phones.index', compact('users'));
    }

    public function create()
    {
        $users = User::all();

        return view('phones.create', compact('users'));
    }

    public function store(Request $request)
    {
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
        $phone = Phone::findOrFail($id);
        $users = User::all();

        return view('phones.edit', compact('phone', 'users'));
    }

    public function update(Request $request, $id)
    {
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
        $phone = Phone::findOrFail($id);
        $phone->delete();

        return redirect()->route('phones.index')->with('success', 'Номер успешно удален!');
    }

    public function addToUser($id)
    {
        $user = User::findOrFail($id);
        $users = User::all();

        return view('phones.add_to_user', compact('user', 'users'));
    }

    public function storeToUser(Request $request, $id)
    {
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
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('phones.index')->with('success', 'Пользователь успешно удален!');
    }
}
