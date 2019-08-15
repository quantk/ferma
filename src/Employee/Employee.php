<?php
declare(strict_types=1);

namespace App\Employee;


use App\Animal\Animal;
use App\Product\ProductCollection;

interface Employee
{
    public function collect(string $uid, Animal $animal): ProductCollection;

    public function supportAnimal(Animal $animal): bool;
}