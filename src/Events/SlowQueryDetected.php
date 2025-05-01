<?php

namespace Itxrahulsingh\LaravelMonitor\Events;

use Illuminate\Queue\SerializesModels;

class SlowQueryDetected
{
    use SerializesModels;

    public $query;
    public $executionTime;

    public function __construct($query, $executionTime)
    {
        $this->query = $query;
        $this->executionTime = $executionTime;
    }
}
