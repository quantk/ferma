<?php
declare(strict_types=1);


namespace App\Product;


interface ProductWithAmount
{
    /**
     * @return float
     */
    public function getAmount(): float;
}