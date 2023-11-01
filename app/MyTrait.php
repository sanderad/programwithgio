<?php

namespace App;

trait MyTrait {

    private string $milkType = 'whole-milk';

    public function makeLatte(): string
    {
        return static::class .  'Making Latte with ' . $this->milkType . PHP_EOL;
    }

    public static function setMilkType(string $newMilkType)
    {
        self::$milkType = $newMilkType;
        return self::class;
    }
}