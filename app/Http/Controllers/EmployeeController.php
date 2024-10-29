<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\employee;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input("search");
        $query = $request->input("query");
        $query = $query ? $query : $search;
    }

    public function index()
    {
        $employees = Employee::with(['educations', 'histories'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('employee.employeeList', compact('employees'));
    }

    public function edit($id)
    {
        $employee = Employee::where('id', $id)->first();
        return response()->json($employee);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $employee = Employee::with(['educations', 'histories'])->find($id);

            if (!$employee) {
                return redirect()->back()->with('error', 'Employee not found.');
            }

            $employee->delete();

            DB::commit();

            return redirect()->route('employee.employeeList')->with('success', 'Employee deleted successfully.');

        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete employee: ' . $e->getMessage());
        }
    }

    // public function store(Request $request){

    //     $request->validate([
    //         'name' => 'required|max:255',
    //         'email' => 'required|email|unique:employees,email',
    //         'dob' => 'required',
    //         'phone' => 'required|unique:employees,phone',
    //         'address' => 'required',
    //         'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);


    //     $requestData = $request->all();
    //     if ($request->hasFile('profile_image')) {
    //         $image = $request->file('profile_image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(storage_path('app/public/profile_images'), $imageName);
    //         $requestData['profile_image'] = 'profile_images/' . $imageName;
    //     }

    //     $employee = Employee::create($requestData);

    //     if ($request->ajax()) {
    //         return response()->json($employee);
    //     }

    //     return redirect()->route('employee.employeeList')
    //         ->with('success', 'Employee created successfully.');
    // }

    public function update(Request $request, $id)
    {
        $employee = employee::find($id);
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

            $path = storage_path('app/public/' . $employee->profile_image);
            if (file_exists($path)) {
                unlink($path);
            }

            $requestAll['profile_image'] = 'profile_images/' . $imageName;
        }

        $employee->update($requestAll);


        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'employee updated successfully!']);
        }
    }

    public function create()
    {
        return view('employee.createEmployee');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:employees,email',
            'dob' => 'required',
            'phone' => 'required|unique:employees,phone',
            'address' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'degree.*' => 'required',
            'institute.*' => 'required',
            'passing_year.*' => 'required',
            'results.*' => 'required',

        ]);

        try {
            DB::beginTransaction();
            $employee = new Employee();
            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->dob = $request->input('dob');
            $employee->address = $request->input('address');
            $employee->phone = $request->input('phone');

            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(storage_path('app/public/profile_images'), $imageName);
                $employee->profile_image = 'profile_images/' . $imageName;
            }

            $employee->save();
            $empId = $employee->id;

            $educations = [];
            foreach ($request->degree as $index => $degree) {
                $educations[] = [
                    'degree' => $degree,
                    'institute' => $request->institute[$index],
                    'passing_year' => $request->passing_year[$index],
                    'result' => $request->results[$index]
                ];
            }

            $employee->educations()->createMany($educations);

            // foreach ($request->degree as $index => $degree) {
            //     Education::create([
            //         'empId' => $empId,
            //         'degree' => $degree,
            //         'institute' => $request->institute[$index],
            //         'passing_year' => $request->passing_year[$index],
            //         'result' => $request->results[$index],
            //     ]);
            // }

            $histories = [];

            foreach ($request->employment_institute as $index => $institute) {
                $histories[] = [
                    'empId' => $empId,
                    'institute' => $institute,
                    'serving_year' => $request->serving_year[$index],
                    'position' => $request->position[$index],
                    'special_award' => $request->special_award[$index] ?? null,
                ];

            }

            $employee->histories()->createMany($histories);

            DB::commit();

            return redirect()->back()->with('success', 'Employee data saved successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to save employee data: ' . $e->getMessage());
        }
    }
    public function details($id)
    {
        $employee = Employee::with(['educations', 'histories'])
            ->where('id', $id)
            ->first();

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        return view('employee.employeeDetails', compact('employee'));
    }

}
