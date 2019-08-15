<?php
declare(strict_types=1);


namespace App\Report;


use App\Product\Egg;

final class EggsPresenter implements ProductPresenter
{

    /**
     * @param string $productName
     * @return bool
     */
    public function supports(string $productName): bool
    {
        return $productName === Egg::NAME;
    }

    /**
     * @param float $amount
     * @return string
     */
    public function present(float $amount): string
    {
        return "Total eggs: {$amount}";
    }
}