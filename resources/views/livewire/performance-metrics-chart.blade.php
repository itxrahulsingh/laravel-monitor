<div wire:poll.5s>
    <select wire:model="metric" class="mb-4 p-2 border rounded">
        <option value="cpu_usage">CPU Usage</option>
        <option value="memory_usage">Memory Usage</option>
        <option value="disk_usage">Disk Usage</option>
    </select>
    <canvas id="metricsChart"></canvas>
</div>

@script
<script>
    const ctx = document.getElementById('metricsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: @json($chartData),
        options: {
            responsive: true,
            scales: {
                x: { type: 'time', time: { unit: 'second' } },
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endscript
