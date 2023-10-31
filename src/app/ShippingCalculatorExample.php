<?php

declare(strict_types=1);

use App\Enums\Shipping\DimDivisor;
use App\Services\Shipping\BillableWeightCalculatorService;
use App\Services\Shipping\PackageDimensions;
use App\Services\Shipping\Weight;

require __DIR__ . '/../vendor/autoload.php';

$package = [
    'weight' => 3,
    'dimensions' => [
        'width' => 12,
        'height' => 9,
        'lenght' => 10,
    ],
];

$dimDivisor = 139;

$billableWeight = new BillableWeightCalculatorService();

$packageDimensions = new PackageDimensions(
    $package['dimensions']['width'],
    $package['dimensions']['height'],
    $package['dimensions']['lenght'],
);

$weight = new Weight($package['weight']);

$increasedWidth = $packageDimensions->increaseWidth(10);

$total = $billableWeight->calculate(
    $packageDimensions,
    $weight,
    DimDivisor::FEDEX
);

$increasedTotal = $billableWeight->calculate(
    $increasedWidth,
    $weight,
    DimDivisor::FEDEX
);

echo $total . ' lb' . PHP_EOL;
echo $increasedTotal . ' lb' . PHP_EOL;