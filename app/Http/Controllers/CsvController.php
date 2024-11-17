<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvController extends Controller
{
    protected $csvPath = 'users_data.csv';

    // Отображение данных из CSV
    public function index()
    {
        $file = storage_path("app/{$this->csvPath}");

        // Проверяем, существует ли файл
        if (!file_exists($file)) {
            return redirect()->back()->with('error', 'Файл CSV не найден.');
        }

        // Читаем содержимое файла
        $fileContent = file($file);
        if ($fileContent === false) {
            return redirect()->back()->with('error', 'Не удалось прочитать содержимое CSV-файла.');
        }

        // Парсим строки в массив
        $csvData = array_map(function ($row) {
            return array_map('trim', str_getcsv($row, ';'));
        }, $fileContent);

        // Проверяем, есть ли данные
        if (empty($csvData)) {
            $header = ['id', 'last_name', 'first_name', 'middle_name', 'age', 'username', 'password'];
            $csvData = [];
        } else {
            $header = array_shift($csvData); // Первая строка — заголовок
        }

        return view('csv.index', compact('csvData', 'header'));
    }

    // Форма для добавления новой записи
    public function create()
    {
        return view('csv.create');
    }

    // Сохранение новой записи в CSV
    public function store(Request $request)
    {
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:1|max:150',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $file = storage_path("app/{$this->csvPath}");

        // Проверяем существование файла
        if (!file_exists($file)) {
            // Создаем новый файл с заголовком, если файл отсутствует
            $header = ['id', 'last_name', 'first_name', 'middle_name', 'age', 'username', 'password'];
            $handle = fopen($file, 'w');
            fputcsv($handle, $header, ';');
            fclose($handle);
        }

        // Читаем файл и преобразуем строки
        $csvData = array_map(function ($row) {
            return str_getcsv($row, ';');
        }, file($file));

        // Убираем заголовок из данных
        $header = array_shift($csvData);

        // Генерация нового ID
        $newId = count($csvData) + 1;

        // Добавляем новую запись
        $newRow = [
            $newId,
            $request->last_name,
            $request->first_name,
            $request->middle_name ?? '',
            $request->age,
            $request->username,
            $request->password,
        ];
        $csvData[] = $newRow;

        // Перезаписываем CSV с новым содержимым
        $handle = fopen($file, 'w');
        fputcsv($handle, $header, ';'); // Сохраняем заголовок
        foreach ($csvData as $row) {
            fputcsv($handle, $row, ';');
        }
        fclose($handle);

        return redirect()->route('csv.index')->with('success', 'Запись добавлена!');
    }

    // Форма для редактирования записи
    public function edit($id)
    {
        $file = storage_path("app/{$this->csvPath}");

        // Проверяем, существует ли файл
        if (!file_exists($file)) {
            return redirect()->back()->with('error', 'Файл CSV не найден.');
        }

        // Читаем данные из файла
        $csvData = array_map(function ($row) {
            return array_map('trim', str_getcsv($row, ';'));
        }, file($file));

        // Извлекаем заголовок
        $header = array_shift($csvData);

        // Проверяем, существует ли запись с данным ID
        if (!isset($csvData[$id - 1])) {
            return redirect()->back()->with('error', 'Запись с таким ID не найдена.');
        }

        // Извлекаем запись
        $record = $csvData[$id - 1];

        return view('csv.edit', compact('record', 'id', 'header'));
    }

    // Обновление записи
    public function update(Request $request, $id)
    {
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:1|max:150',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $file = storage_path("app/{$this->csvPath}");

        // Проверяем существование файла
        if (!file_exists($file)) {
            return redirect()->back()->with('error', 'Файл CSV не найден.');
        }

        // Читаем файл и преобразуем строки
        $csvData = array_map(function ($row) {
            return str_getcsv($row, ';');
        }, file($file));

        // Извлекаем заголовок
        $header = array_shift($csvData);

        // Проверяем, существует ли запись с данным ID
        if (!isset($csvData[$id - 1])) {
            return redirect()->back()->with('error', 'Запись с таким ID не найдена.');
        }

        // Обновляем данные записи
        foreach ($header as $index => $column) {
            $csvData[$id - 1][$index] = $request->input($column, $csvData[$id - 1][$index]);
        }

        // Перезаписываем CSV с обновленными данными
        $handle = fopen($file, 'w');
        fputcsv($handle, $header, ';');
        foreach ($csvData as $row) {
            fputcsv($handle, $row, ';');
        }
        fclose($handle);

        return redirect()->route('csv.index')->with('success', 'Запись обновлена!');
    }
}
