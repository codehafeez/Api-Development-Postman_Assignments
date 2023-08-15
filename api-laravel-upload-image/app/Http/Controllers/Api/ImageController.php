<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Image;
use App\Http\Requests\ImageStoreRequest;
class ImageController extends Controller {

    // public function imageStore(Request $request){
    //     $this->validate($request, [
    //         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    //     ]);

    //     $image_path = $request->file('image')->store('image', 'public');

    //     $data = Image::create([
    //         'image' => $image_path,
    //     ]);

    //     return response($data);
    // }

    public function imageStore(ImageStoreRequest $request){
        $validatedData = $request->validated();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        
        // $validatedData['image'] = $request->file('image')->store('public/images');
        // $data = Image::create($validatedData);

        $data = Image::create($input);
        return response($data);
    }    

}
