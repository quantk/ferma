<?php


namespace Tests\Animal;


use App\Animal\Chicken;
use PHPUnit\Framework\TestCase;

class ChickenTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testCollect()
    {
        $chicken = new Chicken();
        $products = $chicken->collect();
        $count = count($products->toArray());
        static::assertTrue($count >= 0 && $count <= 1);
    }
}