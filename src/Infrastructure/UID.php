<?php
declare(strict_types=1);


namespace App\Infrastructure;


use Ramsey\Uuid\Uuid;

final class UID
{
    /**
     * @return string
     * @throws \Exception
     */
    public static function generate()
    {
        return Uuid::uuid4()->toString();
    }
}