<?php

namespace App\Http\Controllers;

use App\Employee;
use Validator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(5);
        return view('employee.index',compact('employees'))->with('j', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());die;
        // $validator = $request->validate([
        //     'name' => 'required|',
        //     'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
        //     'basic' => 'required|numeric',
        //     'hra' => 'required|numeric',
        //     'allowance' => 'required|numeric',
        //     'pf' => 'required|numeric',
        // ]);
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'basic' => 'required|numeric',
            'hra' => 'required|numeric',
            'allowance' => 'required|numeric',
            'pf' => 'required|numeric',
        ]);


        if ($validator->fails()) {
            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'There are incorect values in the form!',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }
            $this->throwValidationException(
                $request, $validator
            );
        }
        Employee::create($request->all());

        return redirect()->route('employee.index')->with('success','Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        //
    }


    public function edit(Employee $employee)
    {
        return view('employee.edit',compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'basic' => 'required',
            'hra' => 'required',
            'allowance' => 'required',
            'pf' => 'required',
        ]);

        $employee->update($request->all());
        return redirect()->route('employee.index')->with('success','employee updated successfully.');
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success','employee deleted successfully.');
    }
}