<?php
declare(strict_types=1);

namespace App\Employee;


use App\Animal\Animal;
use App\Animal\Cow;
use App\Infrastructure\Journal;
use App\Product\Product;
use App\Product\ProductCollection;

final class Milkmaid implements Employee
{
    /**
     * @var Journal
     */
    private $journal;

    /**
     * EggCollector constructor.
     * @param Journal $journal
     */
    public function __construct(Journal $journal)
    {
        $this->journal = $journal;
    }

    /**
     * @param string $uid
     * @param Animal $animal
     * @return ProductCollection
     */
    public function collect(string $uid, Animal $animal): ProductCollection
    {
        $product = $animal->collect();
        $this->journal->write("Milkmaid collected {$product->getAmount()} liters of milk from cow with uid: {$uid}");

        return $product;
    }

    public function supportAnimal(Animal $animal): bool
    {
        return $animal instanceof Cow;
    }
}