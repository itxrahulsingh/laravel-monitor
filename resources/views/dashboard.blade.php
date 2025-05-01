@extends('laravel-monitor::layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Laravel Monitor Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <livewire:monitor-card type="request" title="Requests/min" />
        <livewire:monitor-card type="exception" title="Errors" />
        <livewire:monitor-card type="slow_query" title="Slow Queries" />
        <livewire:monitor-card type="cpu_usage" title="CPU Usage (%)" />
        <livewire:monitor-card type="memory_usage" title="Memory Usage (%)" />
        <livewire:monitor-card type="disk_usage" title="Disk Usage (%)" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <livewire:real-time-logs-table />
        <livewire:performance-metrics-chart />
        <livewire:alert-notifications />
    </div>
</div>
@endsection
