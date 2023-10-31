<?php

declare(strict_types=1);

namespace App\VarianceExample;

class CatShelter implements AnimalShelter
{
    public function adopt(string $name): Cat
    {
        return new Cat($name);
    }
}