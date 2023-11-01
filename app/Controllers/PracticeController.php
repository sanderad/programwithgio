<?php

declare(strict_types=1);

namespace App\Controllers;

class PracticeController
{
    public function index()
    {
        $array1 = ['a' => 1,2,3];
        $array2 = [4,5,6];

        $array3 = [...$array1, ...$array2];

        print_r($array3);
    }
}