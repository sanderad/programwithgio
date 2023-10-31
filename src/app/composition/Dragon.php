<?php

declare(strict_types=1);

namespace App\Composition;

use App\Composition\Abilities\BaseAbilities;
use App\Composition\Base\AbilitiesContract;

class Dragon
{
    public function __construct(protected BaseAbilities $baseAbilities){ 
    }

    public function throwFire()
    {
        return $this->baseAbilities->throwFire();
    }

    public function move()
    {
        return $this->baseAbilities->move();
    }
}