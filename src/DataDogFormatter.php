<?php

namespace Myli\DatadogLogger;

use DateTime;
use Monolog\Formatter\JsonFormatter;
use DDTrace\GlobalTracer;

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
        $span = GlobalTracer::get()->getActiveSpan();
        if (null !== $span) {
            $record['message'] .= sprintf(
                ' [dd.trace_id=%d dd.span_id=%d]',
                $span->getTraceId(),
                $span->getSpanId()
            );
            $record['dd.trace_id'] = $span->getTraceId();
            $record['dd.span_id'] = $span->getSpanId();
        }

        if (isset($record['level_name'])) {
            $record['status'] = $record['level_name'];
        }



        return parent::format($record);
    }
}
