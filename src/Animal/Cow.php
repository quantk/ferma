<?php
declare(strict_types=1);


namespace App\Animal;


use App\Product\Milk;
use App\Product\ProductCollection;

class Cow implements Animal
{
    /**
     * @return ProductCollection
     * @throws \Exception
     */
    public function collect(): ProductCollection
    {
        $quantity = random_int(8, 12);

        return new ProductCollection(new Milk((float)$quantity));
    }
}