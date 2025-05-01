<?php

namespace Itxrahulsingh\LaravelMonitor\Models;

use Illuminate\Database\Eloquent\Model;

class MonitorAggregate extends Model
{
    protected $table = 'monitor_aggregates';
    protected $fillable = ['bucket', 'period', 'type', 'key', 'key_hash', 'aggregate', 'value', 'count'];
}
