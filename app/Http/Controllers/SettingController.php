<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Метод для отображения формы настроек
    public function showForm()
    {
        $setting = Setting::first();
        return view('settings.settings_form', compact('setting'));
    }

    // Метод для сохранения новых настроек
    public function store(Request $request)
    {
        // Валидация данных из запроса
        $request->validate([
            'tax_rate' => 'required|numeric|between:0,99.99', // Налоговая ставка должна быть числом от 0 до 99.99
        ]);

        // Создаем новую запись в таблице settings с данными из запроса
        Setting::create($request->all());

        // Перенаправляем на страницу настроек с сообщением об успешном сохранении
        return redirect()->route('settings.showForm')->with('success', 'Настройки успешно сохранены.');
    }

    // Метод для обновления настроек
    public function update(Request $request, Setting $setting)
    {
        // Валидация данных из запроса
        $request->validate([
            'tax_rate' => 'required|numeric|between:0,99.99', // Налоговая ставка должна быть числом от 0 до 99.99
        ]);

        // Обновляем запись в таблице settings с данными из запроса
        $setting->update($request->all());

        // Перенаправляем на страницу редактирования с сообщением об успешном обновлении
        return redirect()->route('settings.showForm')->with('success', 'Настройки успешно обновлены.');
    }
}
