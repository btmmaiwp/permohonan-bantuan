<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SchemesController extends Controller
{
    public function index()
    {
        $schemes = Scheme::select(['name', 'description'])->get();

        return response()->json($schemes);
    }

    public function show(Request $request, Scheme $scheme)
    {
        $scheme->load('applications');
        return response()->json($scheme);
    }

    public function store(Request $request)
    {
        // validate inputs
        $validatedData = $request->validate([
            'name' => ['required', 'min:5', 'unique:schemes'],
            'description' => ['nullable'],
        ]);

        // store data into database
        $scheme = Scheme::create($validatedData);

        // return response
        return $scheme;
    }

    public function update(Request $request, Scheme $scheme)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:5', Rule::unique('schemes')->ignore($scheme->id)],
            'description' => ['nullable'],
        ]);

        $scheme->fill($validatedData);
        $scheme->save();

        return $scheme;
    }

    public function destroy(Scheme $scheme)
    {
        $scheme->delete();

        return 'Scheme has been deleted';
    }
}
