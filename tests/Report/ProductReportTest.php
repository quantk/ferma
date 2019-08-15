<?php


namespace Tests\Report;


use App\Product\Egg;
use App\Product\Milk;
use App\Product\ProductCollection;
use App\Report\ProductReport;
use PHPUnit\Framework\TestCase;

class ProductReportTest extends TestCase
{
    public function testMake()
    {
        $productCollection = new ProductCollection(
            new Egg(),
            new Egg(),
            new Milk(42)
        );

        $report = new ProductReport($productCollection);
        $result = $report->make();
        static::assertSame($result, 'Total eggs: 2
Total milk: 42 liters
');
    }
}