<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index()
    {
        $phones = Phone::with('user')->get();

        return view('phones.index', compact('phones'));
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
            'value' => 'required|string|max:255',
        ]);

        Phone::create($validated);

        return redirect()->route('phones.index')->with('success', 'Номер успешно добавлен!');
    }
    public function destroy($id)
    {
        $phone = Phone::findOrFail($id);
        $phone->delete();

        return redirect()->route('phones.index')->with('success', 'Номер успешно удален!');
    }
}
