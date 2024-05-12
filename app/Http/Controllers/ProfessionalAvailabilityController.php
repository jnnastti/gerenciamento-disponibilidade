<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalAvailability;
use Illuminate\Http\Request;

class ProfessionalAvailabilityController extends Controller
{
    // Listar todas as disponibilidades
    public function index()
    {
        $availabilities = ProfessionalAvailability::all();
        return response()->json($availabilities);
    }

    // Exibir uma disponibilidade específica
    public function show($id)
    {
        $availability = ProfessionalAvailability::findOrFail($id);
        return response()->json($availability);
    }

    // Criar uma nova disponibilidade
    public function store(Request $request)
    {
        $validatedData = ProfessionalAvailability::validate($request->all());

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 422);
        }

        $availability = ProfessionalAvailability::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Availability created successfully.',
            'availability' => $availability
        ], 201);
    }

    // Atualizar uma disponibilidade existente
    public function update(Request $request, $id)
    {
        $availability = ProfessionalAvailability::find($id);

        if (!$availability) {
            return response()->json(['error' => 'Availability not found.'], 404);
        }
        $validatedData = ProfessionalAvailability::validateUpdate($request->all());

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 422);
        }

        $availability->update([
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time')
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Availability updated successfully.',
            'availability' => $availability
        ], 200);
    }

    // Excluir uma disponibilidade
    public function destroy($id)
    {
        $availability = ProfessionalAvailability::findOrFail($id);

        if ($availability->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Availability deleted successfully.',
                'availability' => $availability
            ], 200);
        } else {
            return response()->json(['error' => 'Failed to delete availability.'], 500);
        }
    }
}
