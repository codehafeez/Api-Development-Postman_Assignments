<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Salary;
class EmployeeController extends Controller {

    public function addEmployee(){
        $employee = new Employee;
        $employee->employee_name = "Hafeez";
        $employee->employee_phone = "234234234";
        $employee->save();

        echo "Add Employee Success";
    }
    
    public function getData() {
        $employee = Employee::find(1);
        return response()->json($employee);
    }
    
    public function getDataHasOne() {
        $employee = Employee::find(1);
        return response()->json($employee);

        $salary = Employee::find(1)->hasOne_salaryData;
        return response()->json($salary);
    }

    public function getDataJoin() {
        $data = Employee::join('salaries', 'employees.id', '=', 'salaries.employee_id')->get();
        return response()->json($data);
    }

}
