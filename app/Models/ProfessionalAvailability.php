<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalAvailability extends Model
{
    use HasFactory;

    // especificar quais atributos podem ser atribuídos em massa
    protected $fillable = [
        'professional_id', 'day_of_week', 'hour'
    ];

    public static $rules = [
        'professional_id' => 'required|exists:professionals,id',
        'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ];

    // validação de dados
    public static function validate($data)
    {
        return validator($data, static::$rules);
    }
}
