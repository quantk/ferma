<?php
declare(strict_types=1);


namespace App\Animal;


use App\Exception\UnknownAnimalType;
use App\Infrastructure\Journal;

final class AnimalFactory
{
    /**
     * @var Journal
     */
    private $journal;

    /**
     * AnimalFactory constructor.
     * @param Journal $journal
     */
    public function __construct(Journal $journal)
    {
        $this->journal = $journal;
    }

    // @codeCoverageIgnoreStart

    /**
     * @return Cow
     */
    public function createCow(): Cow
    {
        $this->journal->write(Cow::class . ' was created');
        return new Cow();
    }
    // @codeCoverageIgnoreEnd

    /**
     * @param string $animalType
     * @param int $number
     * @return array
     * @throws UnknownAnimalType
     */
    public function createAnimals(string $animalType, int $number): array
    {
        if (!in_array($animalType, Animal::AVAILABLE_ANIMALS, true)) {
            throw new UnknownAnimalType();
        }

        $animals = [];
        while ($number > 0) {
            $animals[] = $this->createAnimalByType($animalType);
            $number--;
        }

        return $animals;
    }

    /**
     * @param string $animalType
     * @return Chicken|Cow
     * @psalm-suppress InvalidNullableReturnType
     */
    private function createAnimalByType(string $animalType)
    {
        switch ($animalType) {
            case Animal::COW_ANIMAL_TYPE:
                return $this->createCow();
            case Animal::CHICKEN_ANIMAL_TYPE:
                return $this->createChicken();
        }
        // @codeCoverageIgnoreStart
    }
    // @codeCoverageIgnoreEnd

    // @codeCoverageIgnoreStart
    /**
     * @return Chicken
     */
    public function createChicken(): Chicken
    {
        $this->journal->write(Chicken::class . ' was created');
        return new Chicken();
    }
    // @codeCoverageIgnoreEnd
}