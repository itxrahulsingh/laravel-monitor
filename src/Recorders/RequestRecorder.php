<?php

namespace Itxrahulsingh\LaravelMonitor\Recorders;

use Illuminate\Support\Facades\Event;
use Itxrahulsingh\LaravelMonitor\Models\MonitorEntry;

class RequestRecorder
{
    public function register()
    {
        Event::listen('Illuminate\Routing\Events\RequestHandled', function ($event) {
            if (random_int(1, 100) / 100 > config('laravel-monitor.recorders.requests.sample_rate', 0.1)) {
                return;
            }

            $duration = (microtime(true) - LARAVEL_START) * 1000; // ms

            MonitorEntry::create([
                'timestamp' => now()->timestamp,
                'type' => 'request',
                'key' => $event->request->fullUrl(),
                'key_hash' => md5($event->request->fullUrl()),
                'value' => round($duration),
            ]);
        });
    }
}
