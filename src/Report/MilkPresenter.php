<?php
declare(strict_types=1);


namespace App\Report;


use App\Product\Milk;

final class MilkPresenter implements ProductPresenter
{

    /**
     * @param string $productName
     * @return bool
     */
    public function supports(string $productName): bool
    {
        return $productName === Milk::NAME;
    }

    /**
     * @param float $amount
     * @return string
     */
    public function present(float $amount): string
    {
        return "Total milk: {$amount} liters";
    }
}