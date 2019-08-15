<?php
declare(strict_types=1);

namespace App\Employee;


use App\Animal\Animal;
use App\Product\ProductCollection;

final class CollectMediator
{
    /**
     * @param string $uid
     * @param Animal $animal
     * @param Employee[] $employers
     * @return ProductCollection
     */
    public function collect(string $uid, Animal $animal, Employee ...$employers): ?ProductCollection
    {
        foreach ($employers as $employer) {
            if ($employer->supportAnimal($animal)) {
                return $employer->collect($uid, $animal);
            }
        }

        return null;
    }
}