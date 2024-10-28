<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function search(Request $request){
        $search = $request->input("search");
        $query = $request->input("query");
        $query = $query ? $query : $search;
    }

    public function index()
    {
        $employees = employee::all();
        $employees = Employee::orderBy('created_at', 'desc')->get();

        return view('employee.employeeList', compact('employees'));
    }

    public function edit($empId) {
        $employee = Employee::where('empId', $empId)->first();
        return response()->json($employee);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:employees,email',
            'dob' => 'required',
            'phone' => 'required|unique:employees,phone',
            'address' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $requestData = $request->all();
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/public/profile_images'), $imageName);
            $requestData['profile_image'] = 'profile_images/' . $imageName;
        }

        $employee = Employee::create($requestData);

        if ($request->ajax()) {
            return response()->json($employee);
        }

        return redirect()->route('employee.employeeList')
            ->with('success', 'Employee created successfully.');
    }

    public function update(Request $request, $empId){
        $employee = employee::find($empId);
        if (!$employee) {
            return redirect()->route('employee-panel.employee.index')->with('error', 'employee not found.');
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'dob' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $requestAll = $request->all();
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $imageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(storage_path('app/public/profile_images'), $imageName);

            $path = storage_path('app/public/'.$employee->profile_image);
            if (file_exists($path)) {
                unlink($path);
            }

            $requestAll['profile_image']= 'profile_images/' . $imageName;
        }

        $employee->update($requestAll);


        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'employee updated successfully!']);
        }
    }

    public function create(){
        return view('employee.createEmployee');
    }
}
