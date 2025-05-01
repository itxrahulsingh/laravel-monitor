<?php

namespace Itxrahulsingh\LaravelMonitor\Recorders;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Event;
use Itxrahulsingh\LaravelMonitor\Models\MonitorEntry;

class JobRecorder
{
    public function register()
    {
        Event::listen(JobFailed::class, function (JobFailed $event) {
            if (!config('laravel-monitor.recorders.jobs.track_failures', true)) {
                return;
            }

            MonitorEntry::create([
                'timestamp' => now()->timestamp,
                'type' => 'job_failure',
                'key' => $event->job->resolveName(),
                'key_hash' => md5($event->job->resolveName()),
                'value' => 1,
            ]);
        });
    }
}
