# Laravel Monitor

A real-time monitoring package for Laravel applications, with server metrics (CPU, memory, disk usage) and a Livewire-powered dashboard.

## Installation

1. Install the package via Composer:
   ```bash
   composer require itxrahulsingh/laravel-monitor
   ```

2. Publish the configuration file:
   ```bash
   php artisan vendor:publish --tag=laravel-monitor-config
   ```

3. Publish the migrations:
   ```bash
   php artisan vendor:publish --tag=laravel-monitor-migrations
   ```

4. Run the migrations to create the necessary database tables:
   ```bash
   php artisan migrate
   ```

## Configuration

Edit `config/laravel-monitor.php` to customize monitoring settings, including:
- Recorders (e.g., requests, slow queries, exceptions, jobs, system metrics).
- Notification channels (e.g., email, Slack) and thresholds.
- Data retention periods.
- Dashboard settings (e.g., route, middleware, polling interval).

Example configuration:
```php
return [
    'enabled' => env('MONITOR_ENABLED', true),
    'recorders' => [
        'requests' => ['enabled' => true, 'sample_rate' => 0.1],
        'slow_queries' => ['enabled' => true, 'threshold_ms' => 1000],
        'system' => ['enabled' => true, 'metrics' => ['cpu_usage', 'memory_usage', 'disk_usage']],
    ],
    'notifications' => [
        'channels' => [
            'email' => ['enabled' => true, 'to' => 'rahulsingh4041@gmail.com'],
        ],
    ],
    'dashboard' => [
        'route' => '/monitor',
        'middleware' => ['web', 'auth', 'can:view-monitor-dashboard'],
    ],
];
```

## Usage

1. Access the dashboard at `/monitor` (ensure you're authenticated and authorized).
2. View real-time metrics, logs, charts, and alerts.
3. Schedule the data trimming command to manage database size:
   ```bash
   php artisan monitor:trim
   ```
   Add to `app/Console/Kernel.php` for daily execution:
   ```php
   $schedule->command('monitor:trim')->daily();
   ```

4. Schedule system metrics collection:
   ```php
   $schedule->call(function () {
       (new \Itxrahulsingh\LaravelMonitor\Recorders\SystemMetricsRecorder)->record();
   })->everyMinute();
   ```

## Features

- **Real-Time Monitoring**: Track HTTP requests, slow queries, exceptions, queue jobs, and server metrics (CPU, memory, disk).
- **Pulse-Like Data Storage**: Efficient database schema with values, entries, and aggregates.
- **Livewire Dashboard**: Displays cards, charts, logs, and alerts with real-time updates.
- **Notifications**: Configurable alerts via email, Slack, etc., for critical events.
- **Data Retention**: Automatic trimming of old data.
- **Extensibility**: Add custom recorders and dashboard widgets.

## Testing

Run the included tests to verify functionality:
```bash
php artisan test
```

## Contributing

Contributions are welcome! Please:
1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -m 'Add your feature'`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Open a pull request on [GitHub](https://github.com/itxrahulsingh/laravel-monitor).

## Issues

Report bugs or request features by opening an issue on [GitHub](https://github.com/itxrahulsingh/laravel-monitor).

## Security Vulnerabilities

Please review [our security policy](https://github.com/itxrahulsingh/laravel-monitor/security/policy) on how to report security vulnerabilities.

## License

MIT License

Copyright (c) 2025 Rahul Singh

See the [LICENSE](LICENSE) file for details.

## Contact

For support, contact Rahul Singh at [rahulsingh4041@gmail.com](mailto:rahulsingh4041@gmail.com).
