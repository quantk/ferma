<?php
declare(strict_types=1);

namespace App\Employee;


use App\Animal\Animal;
use App\Animal\Chicken;
use App\Infrastructure\Journal;
use App\Product\ProductCollection;

final class EggCollector implements Employee
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
        $this->journal->write("EggCollector collected {$product->getAmount()} eggs from chicken with id {$uid}");

        return $product;
    }

    public function supportAnimal(Animal $animal): bool
    {
        return $animal instanceof Chicken;
    }
}