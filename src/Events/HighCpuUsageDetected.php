<?php

namespace Itxrahulsingh\LaravelMonitor\Events;

use Illuminate\Queue\SerializesModels;

class HighCpuUsageDetected
{
    use SerializesModels;

    public $usage;

    public function __construct($usage)
    {
        $this->usage = $usage;
    }
}
