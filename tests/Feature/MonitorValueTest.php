<?php

namespace Itxrahulsingh\LaravelMonitor\Tests\Feature;

use Itxrahulsingh\LaravelMonitor\Models\MonitorValue;
use Tests\TestCase;

class MonitorValueTest extends TestCase
{
    public function test_can_create_value()
    {
        $value = MonitorValue::create([
            'timestamp' => now()->timestamp,
            'type' => 'test',
            'key' => 'test_key',
            'key_hash' => md5('test_key'),
            'value' => 'test_value',
        ]);

        $this->assertDatabaseHas('monitor_values', [
            'type' => 'test',
            'key' => 'test_key',
            'value' => 'test_value',
        ]);
    }
}
