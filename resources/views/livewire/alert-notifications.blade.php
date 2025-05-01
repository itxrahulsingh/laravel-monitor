<div wire:poll.10s>
    @foreach ($alerts as $alert)
        <div class="alert alert-{{ $alert->status === 'unread' ? 'danger' : 'secondary' }} p-4 mb-2 rounded">
            {{ $alert->message }}
            @if ($alert->status === 'unread')
                <button wire:click="markAsRead({{ $alert->id }})" class="ml-2 p-1 bg-gray-200 rounded">Mark as Read</button>
            @endif
        </div>
    @endforeach
</div>
