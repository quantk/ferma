<?php
declare(strict_types=1);


namespace App\Report;


interface ProductPresenter
{
    /**
     * @param string $productName
     * @return bool
     */
    public function supports(string $productName): bool;

    /**
     * @param float $amount
     * @return string
     */
    public function present(float $amount): string;
}