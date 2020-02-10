<?php

namespace Myli\DatadogLogger;

use DateTime;
use Monolog\Formatter\JsonFormatter;

/**
 */
class DataDogFormatter extends JsonFormatter
{

    const LARAVEL_LOG_DATETIME_KEY = 'datetime';

    /**
     * simply copy level_name to status
     */
    public function format(array $record): string
    {

        if (isset($record['level_name'])) {
            $record['status'] = $record['level_name'];
        }

        return parent::format($record);
    }
}
