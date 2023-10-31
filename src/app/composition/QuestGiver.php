<?php

declare(strict_types=1);

namespace App\Composition;

use App\Composition\Abilities\BaseAbilities;

class QuestGiver
{
    public function __construct(protected BaseAbilities $baseAbilities) {

    }

    public function giveQuest()
    {
        return $this->baseAbilities->giveQuest();
    }

    public function move()
    {
        return $this->baseAbilities->move();
    }
}