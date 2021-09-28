<?php

namespace App\Services;

use App\Models\Medicine;
use Illuminate\Support\Facades\Http;

// responsabilidade de "falar" com a API de medicamentos
class MedicineService {

        private const TOKEN = '1|Vwk9iF6GtUGNAVVP15cG0eTRYj8JRaVzbBXYCpAG';
        private const END_POINT = 'http://127.0.0.1:8001/api/medicine';

    public function all(): array {




        $response = Http::withToken(self::TOKEN)->acceptJson()->get(self::END_POINT);
        $medicines = [];

        if($response->successful()) {
        foreach($response->json() as $attributes){
            array_push($medicines, new Medicine($attributes));
        }
    };

        return $medicines;
    }


    public function find(int $id): ?Medicine {

        $response = Http::withToken(self::TOKEN)->acceptJson()->get(self::END_POINT.'/'.$id);
        return $response->successful() ? new Medicine($response->json()) : null;

    }

    public function save(Medicine $medicine) : void {

        $data = ['brand' => $medicine->brand, 'drug' => $medicine->drug];

        $response = Http::withToken(self::TOKEN)->acceptJson()->post(self::END_POINT, $data);

        if(!$response->failed()) {
            $response->throw()->json();
        }
    }


}

