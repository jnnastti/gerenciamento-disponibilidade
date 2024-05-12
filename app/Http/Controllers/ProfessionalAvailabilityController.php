<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalAvailability;
use Carbon\Carbon;
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

        $startTime = Carbon::createFromFormat('H:i', $request->input('start_time'));
        $endTime = Carbon::createFromFormat('H:i', $request->input('end_time'));

        $interval = $startTime->copy();

        while ($interval <= $endTime) {
            // Crie um novo registro de disponibilidade para cada intervalo de meia em meia hora
            ProfessionalAvailability::create([
                'hour' => $interval->format('H:i'),
                'professional_id' => $request->input('professional_id'),
                'day_of_week' => $request->input('day_of_week')
            ]);

            // Adicione 30 minutos ao intervalo
            $interval->addMinutes(30);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Availability created successfully.'
        ], 201);
    }

    // Atualizar uma disponibilidade existente
    public function update(Request $request)
    {
        // Validando se existe horarios para o dia da semana e o profissional
        $availabilities = ProfessionalAvailability::where('professional_id', $request->input('professional_id'))
            ->where('day_of_week', $request->input('day_of_week'))
            ->get();

        if ($availabilities->isEmpty()) {
            return response()->json(['error' => 'Availability not found.'], 404);
        }

        // Validando dados
        $validatedData = ProfessionalAvailability::validate($request->all());

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 422);
        }

        $startTime = Carbon::createFromFormat('H:i', $request->input('start_time'));
        $endTime = Carbon::createFromFormat('H:i', $request->input('end_time'));

        // Excluir os registros de disponibilidade antigos que não estão dentro do intervalo especificado
        ProfessionalAvailability::where('professional_id', $request->input('professional_id'))
            ->where('day_of_week', $request->input('day_of_week'))
            ->whereNotBetween('hour', [$startTime, $endTime])
            ->delete();

        // Adicione os novos registros de disponibilidade para os horários dentro do novo intervalo
        $interval = $startTime->copy();

        while ($interval <= $endTime) {
            // Verifique se o horário já existe
            $existingAvailability = ProfessionalAvailability::where('professional_id', $request->input('professional_id'))
                ->where('day_of_week', $request->input('day_of_week'))
                ->where('hour', $interval->format('H:i'))
                ->first();

            // Se não existir, crie um novo registro
            if (!$existingAvailability) {
                ProfessionalAvailability::create([
                    'professional_id' => $request->input('professional_id'),
                    'day_of_week' => $request->input('day_of_week'),
                    'hour' => $interval->format('H:i')
                ]);
            }

            // Adicione 30 minutos ao intervalo
            $interval->addMinutes(30);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Availability updated successfully.'
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

    // retornar horarios disponiveis filtradas
    public function getHours(Request $request)
    {
        $dayOfWeek = $request->input('day');
        $professionalId = $request->input('professional');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');

        $availabilities = ProfessionalAvailability::getHours($dayOfWeek, $professionalId, $startTime, $endTime);
        $formattedHours = [];

        foreach ($availabilities as $availability) {
            $dayOfWeek = $availability->day_of_week;
            $professionalId = $availability->professional_id;
            $hour = $availability->hour;

            if (!isset($formattedHours[$dayOfWeek][$professionalId])) {
                $formattedHours[$dayOfWeek][$professionalId] = [];
            }

            $formattedHours[$dayOfWeek][$professionalId][] = $hour;
        }

        return response()->json($formattedHours);
    }

    // reservar
    public function reserveSlot(Request $request)
    {
        $validatedData = ProfessionalAvailability::validateReserve($request->all());

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 422);
        }

        $slotId = $request->input('slot');

        // Encontrar o slot de horário pelo ID
        $slot = ProfessionalAvailability::find($slotId);

        ProfessionalAvailability::where('professional_id', $slot->professional_id)
            ->where('day_of_week', $slot->day_of_week)
            ->where('hour', '>=', $slot->hour)
            ->where('available', 1)
            ->where('hour', '<', date('H:i', strtotime("$slot->hour +1 hour")))
            ->update([
                'available' => false,
                'name' => $request->input('name')
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Availability reserved successfully.'
        ], 200);
    }

    // Cancelar reserva
    public function cancelSlot($id)
    {
        $availability = ProfessionalAvailability::findOrFail($id);

        ProfessionalAvailability::where('professional_id', $availability->professional_id)
            ->where('day_of_week', $availability->day_of_week)
            ->where('hour', '>=', $availability->hour)
            ->where('available', 0)
            ->where('name', $availability->name)
            ->where('hour', '<', date('H:i', strtotime("$availability->hour +1 hour")))
            ->update([
                'available' => true,
                'name' => null
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Slot canceled successfully.'
        ], 200);
    }
}
