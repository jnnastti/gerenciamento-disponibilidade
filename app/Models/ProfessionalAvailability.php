<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalAvailability extends Model
{
    use HasFactory;

    // especificar quais atributos podem ser atribuídos em massa
    protected $fillable = [
        'professional_id', 'day_of_week', 'start_time', 'end_time'
    ];

    public static $rules = [
        'professional_id' => 'required|exists:professionals,id',
        'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ];

    // permite consultar profissionais por dia da semana
    public function scopeBySpecialization($query, $day)
    {
        return $query->where('day_of_week', $day);
    }

    // validação de dados
    public static function validate($data)
    {
        return validator($data, static::$rules);
    }
}
