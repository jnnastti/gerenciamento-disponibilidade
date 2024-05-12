<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalAvailability extends Model
{
    use HasFactory;

    // especificar quais atributos podem ser atribuídos em massa
    protected $fillable = [
        'professional_id', 'day_of_week', 'hour', 'name'
    ];

    public static $rules = [
        'professional_id' => 'required|exists:professionals,id',
        'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ];

    public static $rulesReserve = [
        'slot' => 'required|exists:professional_availabilities,id',
        'name' => 'required|string|max:255'
    ];

    // validação de dados
    public static function validate($data)
    {
        return validator($data, static::$rules);
    }

    // validação de dados
    public static function validateReserve($data)
    {
        return validator($data, static::$rulesReserve);
    }

    // Selecionar horas disponiveis por profissional filtrado pelo dia da semana
    public static function getHours($dayOfWeek = null, $professionalId = null, $startTime = null, $endTime = null)
    {
        $query = self::query();

        if ($dayOfWeek !== null) {
            $query->where('day_of_week', $dayOfWeek);
        }

        if ($professionalId !== null) {
            $query->where('professional_id', $professionalId);
        }

        if ($startTime !== null && $endTime !== null) {
            $query->whereBetween('hour', [$startTime, $endTime]);
        }

        return $query->select('professional_id', 'hour', 'day_of_week')
            ->where('available', 1)
            ->orderBy('day_of_week')
            ->orderBy('professional_id')
            ->get();
    }

}
