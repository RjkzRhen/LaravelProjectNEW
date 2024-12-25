<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $query = Employee::query();

        // Фильтрация
        $filterField = $request->input('filterField', '');
        $filterValue = $request->input('filterValue', '');

        if ($filterField && $filterValue) {
            $query->where($filterField, 'like', '%' . $filterValue . '%');
        }

        // Сортировка
        $sortField = $request->input('sortField', 'id');
        $sortDirection = $request->input('sortDirection', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $employees = $query->get();

        return view('employees.index', compact('employees', 'sortField', 'sortDirection', 'filterField', 'filterValue'));
    }

    public function create(Request $request)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $request->session()->forget('current_section');
        return view('employees.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

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
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $request->session()->forget('current_section');
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

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
        if (!Auth::user()->hasRole('Role_ADMIN')) {
            return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
        }

        $employee->delete();

        $request->session()->forget('current_section');
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
