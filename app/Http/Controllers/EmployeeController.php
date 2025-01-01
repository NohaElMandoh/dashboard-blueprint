<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(5);
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'position' => 'required',
            'photo' => 'required',
            'password' => 'required|min:6',
        ]);

        $photoPath = $request->file('photo')->move(public_path('photos'), $request->file('photo')->getClientOriginalName());

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'photo' => 'photos/' . $request->file('photo')->getClientOriginalName(),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'position' => 'required',
            'photo' => 'required',
            'password' => 'nullable|min:6',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->move(public_path('photos'), $request->file('photo')->getClientOriginalName());
            $photoPath = 'photos/' . $request->file('photo')->getClientOriginalName();
        } else {
            $photoPath = $employee->photo;
        }

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'photo' => $photoPath,
            'password' => $request->password ? Hash::make($request->password) : $employee->password,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['success' => 'Employee deleted successfully.']);
    }
}