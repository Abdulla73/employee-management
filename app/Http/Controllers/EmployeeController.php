<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\employee;
use App\Models\History;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        $employees = Employee::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', "%{$query}%");
        })->get();

        return view('employee.employeeList', compact('employees'));
    }

    public function downloadPDF($id)
    {
        $employee = Employee::with(['educations', 'histories'])
            ->where('id', $id)
            ->first();

        Log::info('Employee Data:', $employee->toArray());

        $pdf = Pdf::loadView('employee.employeePdf', compact('employee'));
        return $pdf->stream('employee_details.pdf');
        // return $pdf->download('employee_details.pdf');
    }

    public function checkEmail(Request $request)
    {
        $emailExists = Employee::where('email', $request->email)->exists();
        return response()->json(['exists' => $emailExists]);
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
        $employee = Employee::with(['educations', 'histories'])->findOrFail($id);
        return view('employee.empEdit', compact('employee'));
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

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete employee: ' . $e->getMessage());
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
            'results.*' => 'required',
            'start_date.*' => 'required|date',

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

            $histories = [];
            foreach ($request->employment_institute as $index => $institute) {
                $histories[] = [
                    'institute' => $institute,
                    'start_date' => $request->start_date[$index],
                    'end_date' => $request->end_date[$index] ?? null,
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


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'dob' => 'required',
            'phone' => 'required|unique:employees,phone,' . $id,
            'address' => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'degree.*' => 'required',
            'institute.*' => 'required',
            'start_date.*' => 'required|date',
            'results.*' => 'required',
        ]);

        // dd($request->all());
        //try {
        DB::beginTransaction();

        $employee = Employee::with(['educations', 'histories'])->find($id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

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
        // dd('aaaaa');

        $existingEducationIds = $employee->educations->pluck('id')->toArray();
        $submittedEducationIds = [];

        foreach ($request->degree as $index => $degree) {
            $educationData = [
                'degree' => $degree,
                'institute' => $request->institute[$index],
                'passing_year' => $request->passing_year[$index],
                'result' => $request->results[$index]
            ];

            if (isset($existingEducationIds[$index])) {
                $employee->educations()->where('id', $existingEducationIds[$index])->update($educationData);
                $submittedEducationIds[] = $existingEducationIds[$index];
            } else {
                $employee->educations()->create($educationData);
            }
        }

        $educationIdsToDelete = array_diff($existingEducationIds, $submittedEducationIds);
        if (!empty($educationIdsToDelete)) {
            $employee->educations()->whereIn('id', $educationIdsToDelete)->delete();
        }

        $existingHistoryIds = $employee->histories->pluck('id')->toArray();
        $submittedHistoryIds = $request->history_ids ?? [];

        foreach ($request->employment_institute as $index => $institute) {
            $historyData = [
                'institute' => $institute,
                'start_date' => $request->start_date[$index],
                'end_date' => $request->end_date[$index] ?? null,
                'position' => $request->position[$index],
                'special_award' => $request->special_award[$index] ?? null,
            ];

            if (isset($submittedHistoryIds[$index])) {
                $employee->histories()->where('id', $submittedHistoryIds[$index])->update($historyData);
            } else {
                $employee->histories()->create($historyData);
            }
        }

        $historyIdsToDelete = array_diff($existingHistoryIds, $submittedHistoryIds);
        if (!empty($historyIdsToDelete)) {
            $employee->histories()->whereIn('id', $historyIdsToDelete)->delete();
        }

        DB::commit();

        return redirect()->back()->with('success', 'Employee data updated successfully!');

        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->back()->with('error', 'Failed to update employee data: ' . $e->getMessage());
        // }
    }

    public function pdfview($id)
    {
        $employee = Employee::with(['educations', 'histories'])
            ->where('id', $id)
            ->first();


        return view('employee.employeePdf', compact('employee'));
    }
}
