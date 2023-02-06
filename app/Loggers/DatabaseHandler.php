<?php

namespace app\Loggers;

use App\Models\LogMessage;
use Monolog\Handler\AbstractProcessingHandler;

class DatabaseHandler extends AbstractProcessingHandler
{
    /**
     * @inheritDoc
     */
    protected function write(array $record): void
    {
        // TODO: Implement write() method.
        LogMessage::create([
            'timestamp' => $record['datetime'],
            'method' => $record['context']['method'],
            'url' => $record['context']['url'],
            'response_code' => $record['context']['code'],
            'response_body' => $record['context']['body'],
            'request_time' => $record['context']['time'],
        ]);
    }
}
