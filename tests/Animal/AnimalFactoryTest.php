<?php


namespace Tests\Animal;


use App\Animal\Animal;
use App\Animal\AnimalFactory;
use App\Animal\Chicken;
use App\Animal\Cow;
use App\Exception\UnknownAnimalType;
use App\Infrastructure\Journal;
use PHPUnit\Framework\TestCase;

class AnimalFactoryTest extends TestCase
{
    /**
     * @throws \App\Exception\UnknownAnimalType
     */
    public function testCreateChickens()
    {
        $factory = new AnimalFactory(new Journal());
        $animals = $factory->createAnimals(Animal::CHICKEN_ANIMAL_TYPE, 3);
        static::assertSame(count($animals), 3);
        static::assertInstanceOf(Chicken::class, $animals[0]);
        static::assertInstanceOf(Chicken::class, $animals[1]);
        static::assertInstanceOf(Chicken::class, $animals[2]);
    }

    /**
     * @throws \App\Exception\UnknownAnimalType
     */
    public function testCreateCows()
    {
        $factory = new AnimalFactory(new Journal());
        $animals = $factory->createAnimals(Animal::COW_ANIMAL_TYPE, 3);
        static::assertSame(count($animals), 3);
        static::assertInstanceOf(Cow::class, $animals[0]);
        static::assertInstanceOf(Cow::class, $animals[1]);
        static::assertInstanceOf(Cow::class, $animals[2]);
    }

    /**
     * @throws UnknownAnimalType
     */
    public function testCreateUnknown()
    {
        $factory = new AnimalFactory(new Journal());
        $this->expectException(UnknownAnimalType::class);
        $animals = $factory->createAnimals('unknownType', 3);
    }
}