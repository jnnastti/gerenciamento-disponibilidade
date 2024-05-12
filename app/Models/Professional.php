<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    // especificar quais atributos podem ser atribuídos em massa
    protected $fillable = [
        'name', 'specialization', 'description', 'phone_number', 'email'
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'specialization' => 'required|string|max:255',
        'description' => 'nullable|string',
        'phone_number' => 'nullable|string|max:20',
        'email' => 'required|email|unique:professionals,email',
    ];

    public static $rulesUpdate = [
        'name' => 'string|max:255',
        'specialization' => 'string|max:255',
        'description' => 'nullable|string',
        'phone_number' => 'nullable|string|max:20',
        'email' => 'email|unique:professionals,email',
    ];

    // permite consultar profissionais por especialização
    public function scopeBySpecialization($query, $specialization)
    {
        return $query->where('specialization', $specialization);
    }

    // validação de dados
    public static function validate($data)
    {
        return validator($data, static::$rules);
    }

    // validação de dados
    public static function validateUpdate($data)
    {
        return validator($data, static::$rulesUpdate);
    }

}
