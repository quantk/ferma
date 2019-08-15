<?php
declare(strict_types=1);


namespace App\Infrastructure;


final class Journal
{
    /**
     * @param string $message
     */
    public function write(string $message): void
    {
        echo 'LOG: '.$message . PHP_EOL;
    }
}