<?php

namespace Itxrahulsingh\LaravelMonitor\Livewire;

use Itxrahulsingh\LaravelMonitor\Models\MonitorEntry;
use Livewire\Component;
use Livewire\WithPagination;

class RealTimeLogsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'timestamp';
    public $sortDirection = 'desc';

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field && $this->sortDirection === 'desc' ? 'asc' : 'desc';
        $this->sortField = $field;
    }

    public function render()
    {
        $logs = MonitorEntry::query()
            ->when($this->search, fn($query) => $query->where('key', 'like', "%{$this->search}%")
                ->orWhere('type', 'like', "%{$this->search}%"))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('laravel-monitor::livewire.real-time-logs-table', ['logs' => $logs]);
    }
}
