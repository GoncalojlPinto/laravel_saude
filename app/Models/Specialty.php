<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class Specialty extends Model
{
    use HasFactory;

    public function setName(string $name): void
    {
        $validator = Validator::make(["name" => $name], ["name" => "required|min:4|max:20"]);

        if($validator->fails()){
            throw new InvalidArgumentException("O nome da especialidade tem de ter entre 4 e 20 caracteres");
        }

        $this->name = $name;
    }

    public function medicos(){
        return $this->hasMany(Medico::class);
    }
}
