<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;

class ProfessionalController extends Controller
{
    public function index()
    {
        $professionals = Professional::all();
        return response()->json($professionals);
    }

    public function store(Request $request)
    {
        $validatedData = Professional::validate($request->all());

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 422);
        }

        // Se a validação passar, crie o profissional
        $professional = Professional::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Professional created successfully.',
            'professional' => $professional
        ], 201);
    }

    public function show($id)
    {
        $professional = Professional::findOrFail($id);
        return response()->json($professional);
    }

    public function update(Request $request, $id)
    {
        $professional = Professional::find($id);

        if (!$professional) {
            return response()->json(['error' => 'Professional not found.'], 404);
        }

        $validatedData = Professional::validate($request->all());

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 422);
        }

        $professional->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Professional updated successfully.',
            'professional' => $professional
        ], 200);
    }

    public function destroy($id)
    {
        $professional = Professional::findOrFail($id);

        if ($professional->delete()) {
            return response()->json(null, 204);
        } else {
            return response()->json(['error' => 'Failed to delete professional.'], 500);
        }
    }
}
