<?php
declare(strict_types=1);


namespace App\Animal;


use App\Product\Egg;
use App\Product\Product;
use App\Product\ProductCollection;

class Chicken implements Animal
{
    /**
     * @return ProductCollection
     * @throws \Exception
     */
    public function collect(): ProductCollection
    {
        $eggsCount = random_int(0,1);
        $eggs = [];
        // @codeCoverageIgnoreStart
        while ($eggsCount > 0) {
            $eggs[] = new Egg();
            $eggsCount--;
        }
        // @codeCoverageIgnoreStop
        return new ProductCollection(...$eggs);
    }
}