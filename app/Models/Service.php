<?php

namespace App\Models;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Service extends Model
{
    use HasFactory;

    public function medicos(){
        return $this->hasMany(Medico::class);
    }

    public static function validateData(array $input): ValidationValidator
    {
        return Validator::make($input, [
            'name' => 'required|min:4|max:14',
        ]);
    }
}
