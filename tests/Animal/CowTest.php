<?php


namespace Tests\Animal;


use App\Animal\Cow;
use PHPUnit\Framework\TestCase;

class CowTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testCollect()
    {
        $chicken  = new Cow();
        $products = $chicken->collect();
        $products    = $products->toArray();
        $amount   = reset($products)->getAmount();
        static::assertTrue($amount >= 8 && $amount <= 12);
    }
}