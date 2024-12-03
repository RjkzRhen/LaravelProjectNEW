<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        // Фильтрация
        $filterField = $request->input('filterField', '');
        $filterValue = $request->input('filterValue', '');

        if ($filterField && $filterValue) {
            $query->where($filterField, 'like', '%' . $filterValue . '%');
        }

        // Сортировка
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $employees = $query->get();

        // Устанавливаем переменную сессии для указания текущего раздела
        $request->session()->put('current_section', 'employees');

        return view('employees.index', compact('employees', 'sortField', 'sortDirection', 'filterField', 'filterValue'));
    }

    public function create(Request $request)
    {
        $request->session()->forget('current_section');
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'position' => 'required|string|max:255',
            'telegramId' => 'nullable|string|max:255',
        ]);

        Employee::create($validatedData);

        $request->session()->forget('current_section');
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Request $request, Employee $employee)
    {
        $request->session()->forget('current_section');
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'position' => 'required|string|max:255',
            'telegramId' => 'nullable|string|max:255',
        ]);

        $employee->update($validatedData);

        $request->session()->forget('current_section');
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Request $request, Employee $employee)
    {
        $employee->delete();

        $request->session()->forget('current_section');
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
