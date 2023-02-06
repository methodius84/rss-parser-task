<?php

namespace App\Loggers;

use Monolog\Logger;

class DBLogger
{
    public function __invoke(array $config): Logger
    {
        return new Logger('Database', [
            new DatabaseHandler(),
        ]);
    }
}
