<?php
declare(strict_types=1);


namespace App\Animal;


use App\Product\Product;
use App\Product\ProductCollection;

interface Animal
{
    public const COW_ANIMAL_TYPE     = 'cow';
    public const CHICKEN_ANIMAL_TYPE = 'chicken';

    public const AVAILABLE_ANIMALS = [
        self::COW_ANIMAL_TYPE,
        self::CHICKEN_ANIMAL_TYPE
    ];

    public function collect(): ProductCollection;
}