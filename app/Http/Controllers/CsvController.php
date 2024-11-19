<?php

namespace App\Http\Controllers; // Определяем пространство имен для контроллера

use Illuminate\Http\Request; // Подключаем класс Request для обработки HTTP запросов

class CsvController extends Controller // Определяем класс контроллера CsvController, наследующийся от Controller
{
    protected $csvPath = 'users_data.csv'; // Определяем путь к CSV файлу

    // Отображение данных из CSV
    public function index() // Определяем метод index
    {
        $file = storage_path("app/{$this->csvPath}"); // Определяем путь к файлу

        // Проверяем, существует ли файл
        if (!file_exists($file)) { // Проверяем, существует ли файл
            return redirect()->back()->with('error', 'Файл CSV не найден.'); // Возвращаем на предыдущую страницу с сообщением об ошибке
        }

        // Читаем содержимое файла
        $fileContent = file($file); // Читаем содержимое файла в массив строк
        if ($fileContent === false) { // Проверяем, удалось ли прочитать файл
            return redirect()->back()->with('error', 'Не удалось прочитать содержимое CSV-файла.'); // Возвращаем на предыдущую страницу с сообщением об ошибке
        }

        // Парсим строки в массив
        $csvData = array_map(function ($row) { // Преобразуем каждую строку в массив
            return array_map('trim', str_getcsv($row, ';')); // Разделяем строку по разделителю ';' и удаляем пробелы
        }, $fileContent);

        // Проверяем, есть ли данные
        if (empty($csvData)) { // Если данных нет
            $header = ['id', 'last_name', 'first_name', 'middle_name', 'age', 'username', 'password']; // Определяем заголовок
            $csvData = []; // Инициализируем пустой массив данных
        } else {
            $header = array_shift($csvData); // Первая строка — заголовок
        }

        return view('csv.index', compact('csvData', 'header')); // Возвращаем представление csv.index и передаем в него данные и заголовок
    }

    // Форма для добавления новой записи
    public function create() // Определяем метод create
    {
        return view('csv.create'); // Возвращаем представление csv.create для создания новой записи
    }

    // Сохранение новой записи в CSV
    public function store(Request $request) // Определяем метод store, который принимает объект Request
    {
        $request->validate([ // Валидируем данные из запроса
            'last_name' => 'required|string|max:255', // Поле last_name обязательно, строка, максимум 255 символов
            'first_name' => 'required|string|max:255', // Поле first_name обязательно, строка, максимум 255 символов
            'middle_name' => 'nullable|string|max:255', // Поле middle_name необязательно, строка, максимум 255 символов
            'age' => 'required|integer|min:1|max:150', // Поле age обязательно, целое число, от 1 до 150
            'username' => 'required|string|max:255', // Поле username обязательно, строка, максимум 255 символов
            'password' => 'required|string|min:6', // Поле password обязательно, строка, минимум 6 символов
        ]);

        $file = storage_path("app/{$this->csvPath}"); // Определяем путь к файлу

        // Проверка на существование файла
        if (!file_exists($file)) { // Если файл не существует
            // Создаем файл с заголовком, если файл отсутствует
            $header = ['id', 'last_name', 'first_name', 'middle_name', 'age', 'username', 'password']; // Определяем заголовок
            $handle = fopen($file, 'w'); // Открываем файл для записи
            fputcsv($handle, $header, ';'); // Записываем заголовок в файл
            fclose($handle); // Закрываем файл
        }

        // Чтение текущего содержимого CSV файла
        $csvData = array_map(function ($row) { // Преобразуем каждую строку в массив
            return str_getcsv($row, ';'); // Разделяем строку по разделителю ';'
        }, file($file));

        // Извлечение заголовка
        $header = array_shift($csvData); // Первая строка — заголовок

        // Генерация нового ID
        $newId = count($csvData) + 1; // Определяем новый ID как количество строк + 1

        // Создание новой записи
        $newRow = [ // Создаем новую строку с данными
            $newId,
            $request->last_name,
            $request->first_name,
            $request->middle_name ?? '',
            $request->age,
            $request->username,
            $request->password,
        ];

        // Добавление записи в CSV
        $csvData[] = $newRow; // Добавляем новую строку в массив данных

        // Перезапись CSV файла с новыми данными
        $handle = fopen($file, 'w'); // Открываем файл для записи
        fputcsv($handle, $header, ';'); // Записываем заголовок в файл
        foreach ($csvData as $row) { // Перебираем строки данных
            fputcsv($handle, $row, ';'); // Записываем строку в файл
        }
        fclose($handle); // Закрываем файл

        return redirect()->route('csv.index')->with('success', 'Запись добавлена!'); // Перенаправляем на страницу списка записей с сообщением об успешном добавлении
    }

    // Форма для редактирования записи
    public function edit($id) // Определяем метод edit, который принимает ID записи
    {
        $file = storage_path("app/{$this->csvPath}"); // Определяем путь к файлу

        // Проверяем, существует ли файл
        if (!file_exists($file)) { // Проверяем, существует ли файл
            return redirect()->back()->with('error', 'Файл CSV не найден.'); // Возвращаем на предыдущую страницу с сообщением об ошибке
        }

        // Читаем данные из файла
        $csvData = array_map(function ($row) { // Преобразуем каждую строку в массив
            return array_map('trim', str_getcsv($row, ';')); // Разделяем строку по разделителю ';' и удаляем пробелы
        }, file($file));

        // Извлекаем заголовок
        $header = array_shift($csvData); // Первая строка — заголовок

        // Проверяем, существует ли запись с данным ID
        if (!isset($csvData[$id - 1])) { // Если запись с данным ID не найдена
            return redirect()->back()->with('error', 'Запись с таким ID не найдена.'); // Возвращаем на предыдущую страницу с сообщением об ошибке
        }

        // Извлекаем запись
        $record = $csvData[$id - 1]; // Извлекаем запись по ID

        return view('csv.edit', compact('record', 'id', 'header')); // Возвращаем представление csv.edit и передаем в него запись, ID и заголовок
    }

    // Обновление записи
    public function update(Request $request, $id) // Определяем метод update, который принимает объект Request и ID записи
    {
        $request->validate([ // Валидируем данные из запроса
            'last_name' => 'required|string|max:255', // Поле last_name обязательно, строка, максимум 255 символов
            'first_name' => 'required|string|max:255', // Поле first_name обязательно, строка, максимум 255 символов
            'middle_name' => 'nullable|string|max:255', // Поле middle_name необязательно, строка, максимум 255 символов
            'age' => 'required|integer|min:1|max:150', // Поле age обязательно, целое число, от 1 до 150
            'username' => 'required|string|max:255', // Поле username обязательно, строка, максимум 255 символов
            'password' => 'required|string|min:6', // Поле password обязательно, строка, минимум 6 символов
        ]);

        $file = storage_path("app/{$this->csvPath}"); // Определяем путь к файлу

        // Проверяем существование файла
        if (!file_exists($file)) { // Если файл не существует
            return redirect()->back()->with('error', 'Файл CSV не найден.'); // Возвращаем на предыдущую страницу с сообщением об ошибке
        }

        // Читаем файл и преобразуем строки
        $csvData = array_map(function ($row) { // Преобразуем каждую строку в массив
            return str_getcsv($row, ';'); // Разделяем строку по разделителю ';'
        }, file($file));

        // Извлекаем заголовок
        $header = array_shift($csvData); // Первая строка — заголовок

        // Проверяем, существует ли запись с данным ID
        if (!isset($csvData[$id - 1])) { // Если запись с данным ID не найдена
            return redirect()->back()->with('error', 'Запись с таким ID не найдена.'); // Возвращаем на предыдущую страницу с сообщением об ошибке
        }

        // Обновляем данные записи
        foreach ($header as $index => $column) { // Перебираем заголовок
            $csvData[$id - 1][$index] = $request->input($column, $csvData[$id - 1][$index]); // Обновляем данные записи
        }

        // Перезаписываем CSV с обновленными данными
        $handle = fopen($file, 'w'); // Открываем файл для записи
        fputcsv($handle, $header, ';'); // Записываем заголовок в файл
        foreach ($csvData as $row) { // Перебираем строки данных
            fputcsv($handle, $row, ';'); // Записываем строку в файл
        }
        fclose($handle); // Закрываем файл

        return redirect()->route('csv.index')->with('success', 'Запись обновлена!'); // Перенаправляем на страницу списка записей с сообщением об успешном обновлении
    }

    public function destroy($id) // Определяем метод destroy, который принимает ID записи
    {
        $file = storage_path("app/{$this->csvPath}"); // Определяем путь к файлу

        if (!file_exists($file)) { // Если файл не существует
            return redirect()->back()->with('error', 'CSV-файл не найден.'); // Возвращаем на предыдущую страницу с сообщением об ошибке
        }

        // Читаем данные из CSV
        $csvData = array_map(function ($row) { // Преобразуем каждую строку в массив
            return str_getcsv($row, ';'); // Разделяем строку по разделителю ';'
        }, file($file));

        $header = array_shift($csvData); // Первая строка — заголовок

        // Проверяем, существует ли запись с данным ID
        $found = false; // Флаг для проверки, найдена ли запись
        foreach ($csvData as $index => $row) { // Перебираем строки данных
            if ($row[0] == $id) { // Если ID записи совпадает с переданным ID
                unset($csvData[$index]); // Удаляем строку с найденным ID
                $found = true; // Устанавливаем флаг в true
                break; // Прерываем цикл
            }
        }

        if (!$found) { // Если запись не найдена
            return redirect()->back()->with('error', 'Запись не найдена.'); // Возвращаем на предыдущую страницу с сообщением об ошибке
        }

        // Перезаписываем CSV с обновленным содержимым
        $handle = fopen($file, 'w'); // Открываем файл для записи
        fputcsv($handle, $header, ';'); // Записываем заголовок в файл
        foreach ($csvData as $row) { // Перебираем строки данных
            fputcsv($handle, $row, ';'); // Записываем строку в файл
        }
        fclose($handle); // Закрываем файл

        return redirect()->route('csv.index')->with('success', 'Запись удалена!'); // Перенаправляем на страницу списка записей с сообщением об успешном удалении
    }
}
