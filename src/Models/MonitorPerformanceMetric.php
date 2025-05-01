<?php

namespace Itxrahulsingh\LaravelMonitor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonitorPerformanceMetric extends Model
{
    use SoftDeletes;

    protected $table = 'monitor_performance_metrics';
    protected $fillable = ['metric_name', 'value', 'context'];
    protected $casts = [
        'context' => 'array',
    ];
}
