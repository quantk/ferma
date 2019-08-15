<?php
declare(strict_types=1);


require_once __DIR__ . '/vendor/autoload.php';

try {
    $journal = new \App\Infrastructure\Journal();
    $animalFactory = new \App\Animal\AnimalFactory($journal);
    $cows = $animalFactory->createAnimals(\App\Animal\Animal::COW_ANIMAL_TYPE, 10);
    $chickens = $animalFactory->createAnimals(\App\Animal\Animal::CHICKEN_ANIMAL_TYPE, 20);

    $milkMaid = new \App\Employee\Milkmaid($journal);
    $eggCollector = new \App\Employee\EggCollector($journal);

    $stable = new \App\Stable($journal, ...[$milkMaid, $eggCollector]);
    $stable->registerAnimals(...$cows);
    $stable->registerAnimals(...$chickens);

    $products = $stable->collectProducts();

    $report = new \App\Report\ProductReport($products);

    echo 'Report result:'.PHP_EOL;
    echo $report->make();

} catch (\Throwable $e) {
    echo (string)$e;
}
