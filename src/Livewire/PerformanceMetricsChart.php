<?php

namespace Itxrahulsingh\LaravelMonitor\Livewire;

use Itxrahulsingh\LaravelMonitor\Models\MonitorPerformanceMetric;
use Livewire\Component;

class PerformanceMetricsChart extends Component
{
    public $metric = 'cpu_usage';

    public function render()
    {
        $metrics = MonitorPerformanceMetric::where('metric_name', $this->metric)
            ->where('created_at', '>=', now()->subMinutes(10))
            ->pluck('value', 'created_at');

        $chartData = [
            'labels' => $metrics->keys()->map(fn($date) => $date->toISOString()),
            'datasets' => [
                [
                    'label' => ucwords(str_replace('_', ' ', $this->metric)),
                    'data' => $metrics->values(),
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'fill' => false,
                ],
            ],
        ];

        return view('laravel-monitor::livewire.performance-metrics-chart', ['chartData' => $chartData]);
    }
}
