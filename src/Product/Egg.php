<?php
declare(strict_types=1);


namespace App\Product;


final class Egg implements Product
{
    public const NAME = 'egg';

    public function getName(): string
    {
        return self::NAME;
    }
}