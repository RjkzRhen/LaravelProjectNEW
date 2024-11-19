<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->only(['first_name', 'middle_name', 'age', 'username']));

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
    public function index()
    {

        $users = User::all();

    
        return view('users.index', compact('users')); 
    }    public function create()
    {
    
        return view('users.create'); // Ensure you have this view
    }

    public function store(Request $request)
    {
    
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:1|max:150',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ]);

        try {
         
            User::create([
                'last_name' => $validated['last_name'],
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'age' => $validated['age'],
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']),
            ]);

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
    
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Пользователь не найден.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Пользователь успешно удален!');
    }
}
