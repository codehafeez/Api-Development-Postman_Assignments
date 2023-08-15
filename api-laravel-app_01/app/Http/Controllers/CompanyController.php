<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
class CompanyController extends Controller
{

    function getData(){
        return [
            "status" => true,
            "data" => 'test message hello world'
        ];
    }

    function postData(Request $request){
        return [
            "status" => true,
            "data" => $request->all()
        ];

        // return response()->json($request->all());        
    }
}
