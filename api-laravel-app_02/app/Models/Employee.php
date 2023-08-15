<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Employee extends Model {

    use HasFactory;
    protected $fillable = ['employee_name','employee_phone'];

    public function hasOne_salaryData(){
        return $this->hasOne('App\Models\Salary', 'employee_id');
    }
    
}
