<?php

namespace App\Http\Controllers; // Определяем пространство имен для контроллера

use App\Models\User; // Подключаем модель User
use Illuminate\Http\Request; // Подключаем класс Request для обработки HTTP запросов

class UserController extends Controller // Определяем класс контроллера UserController, наследующийся от Controller
{
    public function update(Request $request, $id) // Определяем метод update, который принимает объект Request и ID пользователя
    {
        $user = User::findOrFail($id); // Ищем пользователя по ID, если не найден, выбрасываем исключение

<<<<<<< Updated upstream
        $user->update($request->only(['first_name', 'middle_name', 'age', 'username']));
=======
        // Validate and update the user
        $user->update($request->only(['first_name', 'middle_name', 'age', 'username'])); // Обновляем только указанные поля пользователя
>>>>>>> Stashed changes

        return redirect()->route('users.index')->with('success', 'User updated successfully'); // Перенаправляем на страницу списка пользователей с сообщением об успешном обновлении
    }

    public function index() // Определяем метод index
    {
<<<<<<< Updated upstream

        $users = User::all();

    
        return view('users.index', compact('users')); 
    }    public function create()
    {
    
        return view('users.create'); // Ensure you have this view
=======
        // Retrieve all users from the database
        $users = User::all(); // Получаем всех пользователей из базы данных

        // Return the view and pass the users data
        return view('users.index', compact('users')); // Возвращаем представление users.index и передаем в него данные о пользователях
>>>>>>> Stashed changes
    }

    public function create() // Определяем метод create
    {
        // Return the view to create a new user
        return view('users.create'); // Возвращаем представление users.create для создания нового пользователя
    }

    public function store(Request $request) // Определяем метод store, который принимает объект Request
    {
<<<<<<< Updated upstream
    
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
=======
        // Валидация данных
        $validated = $request->validate([ // Валидируем данные из запроса
            'last_name' => 'required|string|max:255', // Поле last_name обязательно, строка, максимум 255 символов
            'first_name' => 'required|string|max:255', // Поле first_name обязательно, строка, максимум 255 символов
            'middle_name' => 'nullable|string|max:255', // Поле middle_name необязательно, строка, максимум 255 символов
            'age' => 'required|integer|min:1|max:150', // Поле age обязательно, целое число, от 1 до 150
            'username' => 'required|string|max:255|unique:users,username', // Поле username обязательно, строка, максимум 255 символов, уникальное в таблице users
            'password' => 'required|string|min:6', // Поле password обязательно, строка, минимум 6 символов
        ]);

        try {
            // Создание нового пользователя
            User::create([ // Создаем нового пользователя с данными из валидированного массива
>>>>>>> Stashed changes
                'last_name' => $validated['last_name'],
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'age' => $validated['age'],
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']), // Хэшируем пароль
            ]);

<<<<<<< Updated upstream
            return redirect()->route('users.index')->with('success', 'Пользователь успешно добавлен!');
        } catch (\Illuminate\Database\QueryException $e) {
      
            if ($e->getCode() == 23000) {
                return redirect()->back()->withErrors(['username' => 'Имя пользователя уже существует.']);
            }
         
            return redirect()->back()->withErrors(['error' => 'Произошла ошибка при добавлении пользователя.']);
=======
            return redirect()->route('users.index')->with('success', 'Пользователь успешно добавлен!'); // Перенаправляем на страницу списка пользователей с сообщением об успешном добавлении
        } catch (\Illuminate\Database\QueryException $e) { // Обрабатываем исключение, если что-то пошло не так
            // Обработка ошибки, если имя пользователя уже существует
            if ($e->getCode() == 23000) { // Проверяем код ошибки
                return redirect()->back()->withErrors(['username' => 'Имя пользователя уже существует.']); // Возвращаем на предыдущую страницу с сообщением об ошибке
            }
            // Обработка других ошибок
            return redirect()->back()->withErrors(['error' => 'Произошла ошибка при добавлении пользователя.']); // Возвращаем на предыдущую страницу с сообщением об ошибке
>>>>>>> Stashed changes
        }
    }

    public function destroy($id) // Определяем метод destroy, который принимает ID пользователя
    {
<<<<<<< Updated upstream
    
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Пользователь не найден.');
        }

        $user->delete();
=======
        // Находим пользователя по ID
        $user = User::find($id); // Ищем пользователя по ID

        // Проверяем, существует ли пользователь
        if (!$user) { // Если пользователь не найден
            return redirect()->route('users.index')->with('error', 'Пользователь не найден.'); // Перенаправляем на страницу списка пользователей с сообщением об ошибке
        }

        // Удаляем пользователя
        $user->delete(); // Удаляем пользователя
>>>>>>> Stashed changes

        return redirect()->route('users.index')->with('success', 'Пользователь успешно удален!'); // Перенаправляем на страницу списка пользователей с сообщением об успешном удалении
    }
}
