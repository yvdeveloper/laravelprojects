<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use Illuminate\Support\Facades\Crypt;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where(["is_deleted"=>0])->get();
        return view('employees.index',["employees"=>$employees]);
    }

    public function new_employee()
    {
        return view('employees.create');
    }

    public function store(Request $request){
        $i = $request->validate([
            'first_name' => 'required|max:50',
            'first_name'=> 'required|max:50',
            'last_name'=>'required|max:50',
            'gender'=>'required',
            'birthdate' => 'required',
            'monthly_salary' => 'required|decimal:0,2'
        ]);

        $employee = new Employee;
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->gender = $request->input('gender');
        $employee->birthdate = $request->input('birthdate');
        $employee->monthly_salary = $request->input('monthly_salary');
        if($employee->save())
        {
            toastr()->success('New employee created!');
            return redirect(route('employee.index'));            
        }
        return redirect(route('employee.new_employee'));
    }

    public function view($id){
        $employee = Employee::find(Crypt::decrypt($id));
        if(empty($employee))
        {
            return redirect(route('employee.index'));
        }
        return view('employees.view', ['employee' => $employee]);
    }

    public function update(Employee $employee, Request $request){
        $request->validate([
            'first_name' => 'required|max:50',
            'first_name'=> 'required|max:50',
            'last_name'=>'required|max:50',
            'gender'=>'required',
            'birthdate' => 'required',
            'monthly_salary' => 'required|decimal:0,2'
        ]);

        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->gender = $request->input('gender');
        $employee->birthdate = $request->input('birthdate');
        $employee->monthly_salary = $request->input('monthly_salary');
        if($employee->update())
        {
            return redirect(route('employee.index'))->with('success', 'Employee Updated Succesffully');
        }
        return view('employees.view', ['employee' => $employee]);
        
        

    }

    public function destroy($id)
    {   
        $employee = Employee::find(Crypt::decrypt($id));
        if($employee) {
            $employee->is_deleted = 1;
            $employee->save();
        }
        return redirect(route('employee.index'))->with('success', 'Employee Remove Succesffully');
    }
}
