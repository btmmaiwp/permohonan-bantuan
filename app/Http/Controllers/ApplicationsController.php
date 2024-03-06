<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::with('scheme', 'user', 'createdBy')
            ->where('status', 'baru')
            ->get();

        return response()->json($applications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['required'],
            'scheme_id' => ['required'],
            'created_by' => ['required'],
            'amount' => ['required', 'decimal:2'],
        ]);

        $application = new Application();
        $application->fill($validatedData);
        $application->save();

        return response()->json($application);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $application = Application::find($id);
        $application->load(['user', 'scheme', 'createdBy']);

        return response()->json($application);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'user_id' => [],
            'scheme_id' => [],
            'created_by' => [],
            'amount' => ['decimal:2'],
            'status' => ['in:baru,proses,lulus,gagal']
        ]);

        $application = Application::find($id);
        $application->update($validatedData);

        return response()->json($application);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $application = Application::findOrFail($id);

        $application->delete();

        return response()->json('Data has been successfully deleted.');
    }
}
