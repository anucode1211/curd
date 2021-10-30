<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $employees = Employee::latest()->paginate(5);
  
        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'employeeid' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'state' => 'required',
            'joiningdate' => 'required',
            'adharno' => 'required',
             ]);

         Employee::create($request->all());
     
        return redirect()->route('empoyees.index')
                        ->with('success',' New Employee Created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'employeeid' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'state' => 'required',
            'joiningdate' => 'required',
        ]);
    
        $employee->update($request->all());
    
        return redirect()->route('employees.index')
                        ->with('success','employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
    
        return redirect()->route('employees.index')
                        ->with('success','employee deleted successfully');

    }
}
