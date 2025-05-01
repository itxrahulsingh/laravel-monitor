<div wire:poll.5s>
    <input wire:model.debounce.500ms="search" placeholder="Search logs..." class="mb-4 p-2 border rounded">
    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th wire:click="sortBy('timestamp')" class="p-2 cursor-pointer">Time</th>
                <th wire:click="sortBy('type')" class="p-2 cursor-pointer">Type</th>
                <th wire:click="sortBy('key')" class="p-2 cursor-pointer">Key</th>
                <th class="p-2">Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td class="p-2">{{ \Carbon\Carbon::createFromTimestamp($log->timestamp)->toDateTimeString() }}</td>
                    <td class="p-2">{{ $log->type }}</td>
                    <td class="p-2">{{ Str::limit($log->key, 50) }}</td>
                    <td class="p-2">{{ $log->value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $logs->links() }}
</div>
