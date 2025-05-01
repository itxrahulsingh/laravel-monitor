<?php

namespace Itxrahulsingh\LaravelMonitor\Tests\Feature;

use Itxrahulsingh\LaravelMonitor\Models\MonitorEntry;
use Tests\TestCase;

class MonitorEntryTest extends TestCase
{
    public function test_can_create_entry()
    {
        $entry = MonitorEntry::create([
            'timestamp' => now()->timestamp,
            'type' => 'test',
            'key' => 'test_key',
            'key_hash' => md5('test_key'),
            'value' => 100,
        ]);

        $this->assertDatabaseHas('monitor_entries', [
            'type' => 'test',
            'key' => 'test_key',
            'value' => 100,
        ]);
    }
}
