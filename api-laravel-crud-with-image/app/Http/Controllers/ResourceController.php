<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Resources retrieved successfully',
            'data' => $resources
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $resource = Resource::create($validatedData);
        $success = $resource ? true : false;
        return response()->json([
            'success' => $success,
            'data' => $resource
        ], $success ? 201 : 400);
    }


    public function show($id)
    {
        try 
        {
            $resource = Resource::findOrFail($id);
            return response()->json([
                'status' => true,
                'data' => $resource
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => null
            ], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $resource = Resource::find($id);
        if (!$resource) {
            return response()->json([
                'status' => false,
            ], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            // Delete the previous image if it exists
            if ($resource->image) {
                Storage::disk('public')->delete($resource->image);
            }

            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $resource->update($validatedData);
        return response()->json($resource);
    }

    public function destroy($id)
    {
        $resource = Resource::find($id);
        if (!$resource) {
            return response()->json([
                'status' => false,
            ], 404);
        }

        $resource->delete();
        return response()->json([
            'status' => true,
        ], 200);
    }
}
