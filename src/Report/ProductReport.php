<?php
declare(strict_types=1);


namespace App\Report;


use App\Product\Product;
use App\Product\ProductCollection;
use App\Product\ProductWithAmount;

final class ProductReport
{
    /**
     * @var ProductCollection
     */
    private $productCollection;
    /**
     * @var array|ProductPresenter[]
     * @psalm-var array<array-key, ProductPresenter>
     */
    private $presenters;

    /**
     * ProductReport constructor.
     * @param ProductCollection $productCollection
     */
    public function __construct(ProductCollection $productCollection)
    {
        $this->productCollection = $productCollection;
        $this->presenters        = [
            new MilkPresenter(),
            new EggsPresenter()
        ];
    }

    /**
     * @param array|Product[] $products
     * @psalm-param array<string, Product> $products
     * @return string
     */
    private function present(array $products): string
    {
        $report = '';
        foreach ($products as $productClass => $product) {
            foreach ($this->presenters as $presenter) {
                if ($presenter->supports($productClass)) {
                    $report .= $presenter->present((float)$product) .PHP_EOL;
                }
            }
        }

        return $report;
    }

    /**
     * @return string
     */
    public function make(): string
    {
        $resultProducts = [];

        foreach ($this->productCollection->toArray() as $product) {
            if (!isset($resultProducts[$product->getName()])) {
                $resultProducts[$product->getName()] = 0;
            }

            $amount = $product instanceof ProductWithAmount ? $product->getAmount() : 1;

            $resultProducts[$product->getName()] += $amount;
        }
        /** @var array<string,Product> $resultProducts */
        return $this->present($resultProducts);
    }
}