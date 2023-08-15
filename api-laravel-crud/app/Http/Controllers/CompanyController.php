<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
class CompanyController extends Controller
{

    function getDataAll(){
        $companies = Company::all();
        return [
            "status" => true,
            "message" => 'Read Data All',
            "data" => $companies
        ];
    }

    function getData($id){
        $companies = Company::find($id);
        return [
            "status" => true,
            "message" => 'Read Data by ID',
            "data" => $companies
        ];
    }

    function addData(Request $request){        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        Company::create($request->post());
        return [
            "status" => true,
            "message" => 'Add Data',
            "data" => $request->all()
        ];
    }

    function updateData(Request $request, $id)
    {
        $company = Company::find($id);
        
        if (!$company) {
            return [
                "status" => false,
                "message" => 'Data not found',
                "data" => null
            ];
        }
        
        $company->fill($request->all());
        $company->save();
        
        return [
            "status" => true,
            "message" => 'Update successful',
            "data" => $company
        ];
    }
    
    function deleteData($id){        
        $companies = Company::find($id);
        $companies->delete();
        return [
            "status" => true,
            "message" => 'Delete Data',
            "data" => $companies
        ];
    }
}
