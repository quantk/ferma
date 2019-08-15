<?php
declare(strict_types=1);


namespace App\Product;


final class ProductCollection
{
    /**
     * @var Product[]
     */
    private $products;

    public function __construct(Product ...$products)
    {
        $this->products = $products;
    }

    /**
     * @return array|Product[]
     * @psalm-return array<Product>
     */
    public function toArray(): array
    {
        return $this->products;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return (float)array_reduce($this->products,
            /**
             * @param int|float $carry
             * @return float|int
             */
            static function($carry, Product $product) {
            /** @var int|float $carry */
            $amount = $product instanceof ProductWithAmount ? $product->getAmount() : 1;
            return $carry + $amount;
        }, 0);
    }
}