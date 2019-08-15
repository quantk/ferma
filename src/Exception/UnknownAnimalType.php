<?php
declare(strict_types=1);

namespace App\Exception;


final class UnknownAnimalType extends \Exception
{
    protected $message = 'Unknown animal type';
}