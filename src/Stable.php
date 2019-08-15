<?php
declare(strict_types=1);


namespace App;


use App\Animal\Animal;
use App\Employee\CollectMediator;
use App\Employee\Employee;
use App\Infrastructure\Journal;
use App\Infrastructure\UID;
use App\Product\Product;
use App\Product\ProductCollection;

final class Stable
{
    /**
     * @var Animal[]
     * @psalm-var array<string, Animal>
     */
    private $animals;

    /**
     * @var Employee[]
     */
    private $employers;
    /**
     * @var Journal
     */
    private $journal;
    /**
     * @var CollectMediator
     */
    private $mediator;

    /**
     * Stable constructor.
     * @param Journal $journal
     * @param Employee[] $employers
     */
    public function __construct(Journal $journal, Employee ...$employers)
    {
        $this->employers = $employers;
        $this->journal   = $journal;
        $this->mediator  = new CollectMediator();
        $this->journal->write('Stable is initialized');
        $this->animals = [];
    }

    /**
     * @param Animal $animal
     * @throws \Exception
     */
    public function registerAnimal(Animal $animal): void
    {
        $animalClass        = get_class($animal);
        $id                 = UID::generate();
        $this->animals[$id] = $animal;
        $this->journal->write("Animal {$animalClass} registered with id: {$id}");
    }

    /**
     * @param Animal ...$animals
     * @throws \Exception
     */
    public function registerAnimals(Animal ...$animals): void
    {
        foreach ($animals as $animal) {
            $this->registerAnimal($animal);
        }
    }

    /**
     * @return ProductCollection
     */
    public function collectProducts(): ProductCollection
    {
        $allProducts = [];
        foreach ($this->animals as $uid => $animal) {
            $productCollection = $this->mediator->collect($uid, $animal, ...$this->employers);
            if ($productCollection) {
                /** @noinspection SlowArrayOperationsInLoopInspection */
                $allProducts = array_merge($allProducts, $productCollection->toArray());
            }
        }
        /** @var Product[] $allProducts */
        return new ProductCollection(...$allProducts);
    }
}