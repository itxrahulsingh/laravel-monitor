<?php

namespace Itxrahulsingh\LaravelMonitor\Console\Commands;

use Illuminate\Console\Command;
use Itxrahulsingh\LaravelMonitor\Models\MonitorAggregate;
use Itxrahulsingh\LaravelMonitor\Models\MonitorEntry;
use Itxrahulsingh\LaravelMonitor\Models\MonitorValue;

class TrimMonitorData extends Command
{
    protected $signature = 'monitor:trim';
    protected $description = 'Trim old monitoring data based on retention settings';

    public function handle()
    {
        $valuesDays = config('laravel-monitor.retention.values_days', 7);
        MonitorValue::where('timestamp', '<', now()->subDays($valuesDays)->timestamp)->delete();

        $entriesDays = config('laravel-monitor.retention.entries_days', 7);
        MonitorEntry::where('timestamp', '<', now()->subDays($entriesDays)->timestamp)->delete();

        $aggregatesDays = config('laravel-monitor.retention.aggregates_days', 30);
        MonitorAggregate::where('bucket', '<', now()->subDays($aggregatesDays)->timestamp / 300)->delete();

        $this->info('Monitoring data trimmed successfully.');
    }
}
