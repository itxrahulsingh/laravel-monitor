<?php

namespace Itxrahulsingh\LaravelMonitor\Models;

use Illuminate\Database\Eloquent\Model;

class MonitorValue extends Model
{
    protected $table = 'monitor_values';
    protected $fillable = ['timestamp', 'type', 'key', 'key_hash', 'value'];
}
