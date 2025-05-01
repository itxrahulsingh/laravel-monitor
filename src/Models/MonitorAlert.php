<?php

namespace Itxrahulsingh\LaravelMonitor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonitorAlert extends Model
{
    use SoftDeletes;

    protected $table = 'monitor_alerts';
    protected $fillable = ['alert_type', 'message', 'status', 'channel', 'recipient'];
}
