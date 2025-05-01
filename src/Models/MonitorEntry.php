<?php

namespace Itxrahulsingh\LaravelMonitor\Models;

use Illuminate\Database\Eloquent\Model;

class MonitorEntry extends Model
{
    protected $table = 'monitor_entries';
    protected $fillable = ['timestamp', 'type', 'key', 'key_hash', 'value'];
}
