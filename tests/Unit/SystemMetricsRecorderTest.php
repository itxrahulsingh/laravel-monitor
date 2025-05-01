<?php

namespace Itxrahulsingh\LaravelMonitor\Tests\Unit;

use Itxrahulsingh\LaravelMonitor\Models\MonitorPerformanceMetric;
use Itxrahulsingh\LaravelMonitor\Recorders\SystemMetricsRecorder;
use Tests\TestCase;

class SystemMetricsRecorderTest extends TestCase
{
    public function test_can_record_metrics()
    {
        $recorder = new SystemMetricsRecorder;
        $recorder->record();

        $this->assertDatabaseHas('monitor_performance_metrics', [
            'metric_name' => 'cpu_usage',
        ]);
        $this->assertDatabaseHas('monitor_performance_metrics', [
            'metric_name' => 'memory_usage',
        ]);
        $this->assertDatabaseHas('monitor_performance_metrics', [
            'metric_name' => 'disk_usage',
        ]);
    }
}
