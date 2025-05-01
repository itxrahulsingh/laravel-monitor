<?php

namespace Itxrahulsingh\LaravelMonitor\Tests\Feature;

use Itxrahulsingh\LaravelMonitor\Models\MonitorAggregate;
use Tests\TestCase;

class MonitorAggregateTest extends TestCase
{
    public function test_can_create_aggregate()
    {
        $aggregate = MonitorAggregate::create([
            'bucket' => now()->startOfHour()->timestamp / 300,
            'period' => 60,
            'type' => 'test',
            'key' => 'test_key',
            'key_hash' => md5('test_key'),
            'aggregate' => 'count',
            'value' => 100,
            'count' => 100,
        ]);

        $this->assertDatabaseHas('monitor_aggregates', [
            'type' => 'test',
            'key' => 'test_key',
            'aggregate' => 'count',
            'value' => 100,
        ]);
    }
}
