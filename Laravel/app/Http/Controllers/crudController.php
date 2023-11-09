<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class crudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cruds = Crud::all();
       return view('project.home',['cruds'=>$cruds]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('project.create');
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'course' => 'required',
            'email' => 'required|email|unique:cruds,email', // Use 'cruds' table for email uniqueness
        ]);
    
        // Create a new Crud instance and set its properties
        $cruds = new Crud;
        $cruds->name = $request->input('name');
        $cruds->course = $request->input('course');
        $cruds->email = $request->input('email');
        
        // Save the record to the database
        $cruds->save();
    
        // Redirect back to the home page with a success message
        return redirect()->route('project.home')->with('success', 'Data successfully created');
    
        
                         

    
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      
        $cruds = Crud::find($id); // Assuming you are retrieving the specific record for editing
        return view('project.edit',compact('cruds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Crud  $cruds)
    {
        $request->validate([
            'name' => 'required', 
            'email' => 'required|email|unique:users', 
    ]);

  
   $cruds->name = $request->name;
   $cruds->course = $request->course;
   $cruds->email = $request->email;
   $cruds->save();
   return redirect()->route('project.home')
        ->with('success', 'Data successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Crud $cruds)
{
    // Check if it's an API request
   
    $cruds->delete();
    return redirect()->route('project.home')
      ->with('success', 'record deleted successfully');
}



    public function deleteSelected(Request $request)
    {
        $selectedIds = $request->input('selected');

        // Check if any items were selected
        if (!empty($selectedIds)) {
            // Use the selected IDs to delete the corresponding items
            Crud::whereIn('id', $selectedIds)->delete();

            if ($request->wantsJson()) {
                // If it's an API request, return a JSON response
                return response()->json(['message' => 'Selected items deleted successfully'], 200);
            }

            // If it's a web request, redirect back with a message
            return redirect()->route('project.home')->with('success', 'Selected items deleted successfully');
        }

        // No items were selected
        if ($request->wantsJson()) {
            return response()->json(['message' => 'No items were selected for deletion'], 400);
        }

        // If it's a web request, redirect back with a message
        return redirect()->back()->with('error', 'No items were selected for deletion');
    }


}
