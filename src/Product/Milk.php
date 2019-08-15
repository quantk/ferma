<?php
declare(strict_types=1);


namespace App\Product;


final class Milk implements Product, ProductWithAmount
{
    public const NAME = 'milk';
    /**
     * @var float
     */
    private $liters;

    /**
     * Milk constructor.
     * @param float $liters
     */
    public function __construct(float $liters)
    {
        $this->liters = $liters;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->liters;
    }
}