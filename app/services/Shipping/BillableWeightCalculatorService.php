<?php

declare(strict_types=1);

namespace App\Services\Shipping;

use App\Enums\Shipping\DimDivisor;
use Exception;
use InvalidArgumentException;

class BillableWeightCalculatorService
{
    public function calculate(
        PackageDimensions $dimensions,
        Weight $weight,
        DimDivisor $dimDivisor
    ): int {

        match (true) {
            $dimDivisor <= 0 => throw new Exception('Invalid dim divisor'),
            default => true
        };

        $dimWeight = (int) round($dimensions->width * $dimensions->height * $dimensions->lenght / $dimDivisor->value);

        return  max($dimWeight, $weight->value);
    }
}