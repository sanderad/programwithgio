<?php

declare(strict_types=1);

namespace App\Services\Shipping;

use InvalidArgumentException;

class PackageDimensions
{
    public function __construct(public readonly int $width, public readonly int $height, public readonly int $lenght) 
    {
        match(true) {
            $this->width <= 0 || $this->width > 80 => throw new InvalidArgumentException('Invalid width'),
            $this->height <= 0 || $this->height >= 80 => throw new InvalidArgumentException('Invalid height'),
            $this->lenght <= 0 || $this->lenght >= 80 => throw new InvalidArgumentException('Invalid lenght'),
            default => true
        };
    }

    public function increaseWidth(int $width) 
    {
        return new self($this->width + $width, $this->height, $this->lenght);
    }

    public function equalTo(PackageDimensions $other) 
    {
        return $this->width === $other->width
            && $this->height === $other->height
            && $this->lenght === $other->lenght;
    }
}