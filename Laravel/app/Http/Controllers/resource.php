<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class resource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $cruds = Crud::all();
       return response()->json($cruds);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'course'=> 'required',
            'email' => 'required|email|unique:users',
    ]);
       try{
   $cruds = new Crud;
   $cruds->name = $request->input('name');
    $cruds->course = $request->input('course');
    $cruds->email = $request->input('email');
   $cruds->save();

            $token = $cruds;
            return response()->json(['message' => 'User created successfully',
                'Status'=>'success',
                'statuscode'=>200,
                'authorization'=>[
                    'token' => $token,
                    'token_type' => 'Bearer',]]);
                }
                    catch (\Exception $e) {
                        // If an exception occurs (e.g., email is not unique), handle it and return an error response
                        return response()->json([
                            'message' => 'Email taken already',
                            'Status' => 'error',
                            'statuscode' => 500, // You can choose an appropriate status code
                        ]);
                    }
    
    }
    /**
     * Display the specified resource.
     */
    public function find(string $id)
    {

        $user = Crud::find($id);
        return response()->json($user);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function upgrade(Request $request, Crud $cruds, $id)
{
    // Validate the incoming data
    $request->validate([
        'name' => 'required',
        'email' => 'required|', // Use 'users' table for email uniqueness
        'course' => 'required',
    ]);

    // Find the Crud record by model binding using the route parameter
    // You don't need to manually find the record by ID when using model binding
    // Laravel will do this for you
    // Also, you were trying to find it by $id, but it's already injected as $cruds

    // Update the Crud record with the new values
    $cruds = Crud::find($id);
    $cruds->name = $request->input('name');
    $cruds->course = $request->input('course');
    $cruds->email = $request->input('email');
    $cruds->save();

    // Check if the record was successfully updated
    if ($cruds) {
        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully updated',
            'statuscode' => 200,
            'data' => $cruds,
        ]);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Data not found or no changes were made',
            'statuscode' => 400,
        ]);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destruct($id)
{
    $cruds= Crud::find($id);
    if(is_null($cruds))
    {
        return response()->json(['message' => 'User not found'], 404);
    }
    $cruds->delete();
    return response()->json(['message' => 'User deleted successfully',

], 200);
}


}
