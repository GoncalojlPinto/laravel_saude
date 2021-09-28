<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class Medicine extends Model {

    private int $id;
    private string $brand;
    private string $drug;

    public function __construct(array $attributes){
        $this->id = isset($attributes["id"]) ? $attributes["id"] : null;
        $this->brand = $attributes["brand"];
        $this->drug = $attributes["drug"];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDrug(): string
    {
        return $this->drug;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }


}
