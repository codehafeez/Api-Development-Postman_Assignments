<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ImageStoreRequest extends FormRequest {

    public function authorize(){
        return true;
    }

    public function rules() {
        return [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
