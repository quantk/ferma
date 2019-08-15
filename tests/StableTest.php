<?php


namespace Tests;


use App\Animal\Animal;
use App\Animal\AnimalFactory;
use App\Animal\Chicken;
use App\Animal\Cow;
use App\Employee\Milkmaid;
use App\Infrastructure\Journal;
use App\Product\Egg;
use App\Product\Milk;
use App\Product\ProductCollection;
use App\Stable;
use PHPUnit\Framework\TestCase;

class StableTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testCollectProducts()
    {
        $journal = new Journal();
        $animalFactory = new AnimalFactory($journal);
        $testAnimal = $this->createMock(Animal::class);
        $testAnimal->method('collect')->willReturn(42);
        $cow1 = $this->createMock(Cow::class);
        $cow1->method('collect')->willReturn(new ProductCollection(new Milk(3)));
        $chicken1 = $this->createMock(Chicken::class);
        $chicken1->method('collect')->willReturn(new ProductCollection(new Egg(), new Egg()));
        $cows = [$cow1];
        $chickens = [$chicken1];

        $milkMaid = new Milkmaid($journal);
        $eggCollector = new \App\Employee\EggCollector($journal);

        $stable = new Stable($journal, ...[$milkMaid, $eggCollector]);
        $stable->registerAnimals(...$cows);
        $stable->registerAnimals(...$chickens);
        $stable->registerAnimals(...[$testAnimal]);

        $result = $stable->collectProducts();
        static::assertSame($result->getAmount(), 5.0);
        $eggs = array_filter($result->toArray(), static function($product) {
             return $product instanceof Egg;
        });
        static::assertSame(count($eggs), 2);

        /** @var Milk[] $milks */
        $milks = array_filter($result->toArray(), static function($product) {
            return $product instanceof Milk;
        });
        $milkAmount = 0;
        foreach ($milks as $milk) {
            $milkAmount += $milk->getAmount();
        }
        static::assertSame($milkAmount, 3.0);
    }
}