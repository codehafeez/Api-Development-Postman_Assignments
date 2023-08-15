<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\League;
class LeaguesController extends Controller
{
    public function index()
    {
        $leagues = League::all();
        return response()->json([
            'status' => true,
            'message' => 'Leagues',
            'data' => $leagues
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:leagues',
            'email' => 'required|email|unique:leagues,email',
            'password' => 'required|min:6'
        ]);

        $league = League::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'League created successfully.',
            'data' => $league
        ], 201);
    }

    public function show($id)
    {
        $league = League::find($id);
        if (!$league) {
            return response()->json([
                'status' => false,
                'message' => 'League not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'View League',
            'data' => $league
        ]);
    }

    public function update(Request $request, $id)
    {
        $league = League::find($id);
        if (!$league) {
            return response()->json([
                'status' => false,
                'message' => 'League not found.'
            ], 404);
        }

        $request->validate([
            'name' => 'required|unique:leagues,name,' . $id,
            'email' => 'required|email|unique:leagues,email,' . $id,
            'password' => 'required|min:6'
        ]);

        $league->name = $request->name;
        $league->email = $request->email;
        $league->password = bcrypt($request->password);
        $league->save();

        return response()->json([
            'status' => true,
            'message' => 'League updated successfully.',
            'data' => $league
        ], 200);
    }

    public function destroy($id)
    {
        $league = League::find($id);
        if (!$league) {
            return response()->json([
                'status' => false,
                'message' => 'League not found.'
            ], 404);
        }

        $league->delete();
        return response()->json([
            'status' => true,
            'message' => 'League deleted successfully.'
        ], 200);
    }
}
