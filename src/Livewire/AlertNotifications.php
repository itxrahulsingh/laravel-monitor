<?php

namespace Itxrahulsingh\LaravelMonitor\Livewire;

use Itxrahulsingh\LaravelMonitor\Models\MonitorAlert;
use Livewire\Component;

class AlertNotifications extends Component
{
    public function markAsRead($alertId)
    {
        MonitorAlert::find($alertId)->update(['status' => 'read']);
    }

    public function render()
    {
        $alerts = MonitorAlert::where('status', 'unread')->latest()->take(5)->get();

        return view('laravel-monitor::livewire.alert-notifications', ['alerts' => $alerts]);
    }
}
