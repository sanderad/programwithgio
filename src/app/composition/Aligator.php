<?php

declare(strict_types=1);

namespace App\Composition;

use App\Composition\Abilities\BaseAbilities;

class Aligator
{
    public function __construct(protected BaseAbilities $baseAbilities) {

    }

    public function swim()
    {
        return $this->baseAbilities->swim();
    }

    public function move()
    {
        return $this->baseAbilities->move();
    }
}