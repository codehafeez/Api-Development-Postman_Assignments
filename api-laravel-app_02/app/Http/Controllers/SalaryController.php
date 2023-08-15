<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
class SalaryController extends Controller {

    public function addSalary(){
        $salary = new Salary;
        $salary->salary_amount = '583';
        $salary->employee_id = '1';
        $salary->save();
        
        echo "Add Salary Success";
    }
    
}
