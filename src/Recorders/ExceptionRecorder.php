<?php

namespace Itxrahulsingh\LaravelMonitor\Recorders;

use Illuminate\Support\Facades\Event;
use Itxrahulsingh\LaravelMonitor\Models\MonitorEntry;
use Throwable;

class ExceptionRecorder
{
    public function register()
    {
        Event::listen('Illuminate\Log\Events\MessageLogged', function ($event) {
            if ($event->level !== 'error' || !isset($event->context['exception'])) {
                return;
            }

            if (random_int(1, 100) / 100 > config('laravel-monitor.recorders.exceptions.sample_rate', 1.0)) {
                return;
            }

            $exception = $event->context['exception'];
            if ($exception instanceof Throwable) {
                MonitorEntry::create([
                    'timestamp' => now()->timestamp,
                    'type' => 'exception',
                    'key' => get_class($exception),
                    'key_hash' => md5(get_class($exception)),
                    'value' => 1,
                ]);
            }
        });
    }
}
