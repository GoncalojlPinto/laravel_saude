<?php

namespace App\Models;

use App\Services\DownloadableEntity;
use Illuminate\Contracts\Validation\Validator as ContractValidator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Medico extends Model implements DownloadableEntity
{
    use HasFactory;


    public static function validateData(array $input): ContractValidator
    {

        $rules = [
            'name' => 'required|min:4',
            'address' => 'required|min:10',
            'phone' => 'required|min:9|max:14',
            'specialty_id' => 'min:1',
            'service_id' => 'min:1',
        ];

        return Validator::make($input, $rules);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getCsvFields(): array
    {
        return [
            $this->id,
            $this->name,
            $this->address,
            $this->phone,
            $this->service ? $this->service->name : "",
            $this->service ? $this->specialty->name : "",
            $this->photo
        ];
    }
}
