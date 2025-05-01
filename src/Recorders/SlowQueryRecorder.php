<?php

namespace Itxrahulsingh\LaravelMonitor\Recorders;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Event;
use Itxrahulsingh\LaravelMonitor\Events\SlowQueryDetected;
use Itxrahulsingh\LaravelMonitor\Models\MonitorEntry;

class SlowQueryRecorder
{
    public function register()
    {
        Event::listen(QueryExecuted::class, function (QueryExecuted $event) {
            $threshold = config('laravel-monitor.recorders.slow_queries.threshold_ms', 1000);
            if ($event->time >= $threshold) {
                $query = $event->sql;

                MonitorEntry::create([
                    'timestamp' => now()->timestamp,
                    'type' => 'slow_query',
                    'key' => $query,
                    'key_hash' => md5($query),
                    'value' => round($event->time),
                ]);

                event(new SlowQueryDetected($query, $event->time));
            }
        });
    }
}
