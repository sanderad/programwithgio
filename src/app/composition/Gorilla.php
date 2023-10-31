<?php

declare(strict_types=1);

namespace App\Composition;

use App\Composition\Abilities\BaseAbilities;

class Gorilla
{
    public function __construct(protected BaseAbilities $baseAbilities) {

    }

    public function stomp()
    {
        return $this->baseAbilities->stomp();
    }

    public function move()
    {
        return $this->baseAbilities->move();
    }
}