<?php

namespace Itxrahulsingh\LaravelMonitor\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonitorCard extends Component
{
    public $type;
    public $title;

    public function render()
    {
        $value = DB::table('monitor_aggregates')
            ->where('type', $this->type)
            ->where('period', 60)
            ->where('aggregate', 'count')
            ->value('value') ?? 0;

        $previous = DB::table('monitor_aggregates')
            ->where('type', $this->type)
            ->where('period', 60)
            ->where('bucket', '<', now()->subHour()->startOfHour()->timestamp / 300)
            ->value('value') ?? 0;

        $trend = $value > $previous ? '↑' : ($value < $previous ? '↓' : '→');

        return view('laravel-monitor::components.card', [
            'value' => $value,
            'trend' => $trend,
        ]);
    }
}
