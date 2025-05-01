<?php

return [
    'enabled' => env('MONITOR_ENABLED', true),

    'storage' => [
        'driver' => env('MONITOR_STORAGE_DRIVER', 'database'),
        'database' => [
            'connection' => env('MONITOR_DB_CONNECTION', 'mysql'),
            'tables' => [
                'values' => 'monitor_values',
                'entries' => 'monitor_entries',
                'aggregates' => 'monitor_aggregates',
                'alerts' => 'monitor_alerts',
                'metrics' => 'monitor_performance_metrics',
            ],
        ],
    ],

    'recorders' => [
        'requests' => [
            'enabled' => true,
            'sample_rate' => env('MONITOR_REQUESTS_SAMPLE_RATE', 0.1),
        ],
        'slow_queries' => [
            'enabled' => true,
            'threshold_ms' => env('MONITOR_SLOW_QUERY_THRESHOLD', 1000),
        ],
        'exceptions' => [
            'enabled' => true,
            'sample_rate' => env('MONITOR_EXCEPTIONS_SAMPLE_RATE', 1.0),
        ],
        'jobs' => [
            'enabled' => true,
            'track_failures' => true,
        ],
        'system' => [
            'enabled' => true,
            'metrics' => ['cpu_usage', 'memory_usage', 'disk_usage'],
            'interval_seconds' => env('MONITOR_SYSTEM_INTERVAL', 60),
        ],
    ],

    'notifications' => [
        'enabled' => env('MONITOR_NOTIFICATIONS_ENABLED', true),
        'channels' => [
            'email' => [
                'enabled' => true,
                'to' => env('MONITOR_EMAIL_RECIPIENT', 'rahulsingh4041@gmail.com'),
            ],
            'slack' => [
                'enabled' => false,
                'webhook_url' => env('MONITOR_SLACK_WEBHOOK_URL'),
            ],
        ],
        'thresholds' => [
            'cpu_usage' => ['value' => 80, 'duration_minutes' => 5],
            'memory_usage' => ['value' => 90, 'duration_minutes' => 5],
            'slow_query_count' => ['value' => 10, 'duration_minutes' => 60],
        ],
    ],

    'dashboard' => [
        'route' => '/monitor',
        'middleware' => ['web', 'auth', 'can:view-monitor-dashboard'],
        'polling_interval_seconds' => env('MONITOR_POLLING_INTERVAL', 5),
        'theme' => 'light',
    ],

    'retention' => [
        'values_days' => env('MONITOR_RETENTION_VALUES', 7),
        'entries_days' => env('MONITOR_RETENTION_ENTRIES', 7),
        'aggregates_days' => env('MONITOR_RETENTION_AGGREGATES', 30),
    ],

    'cache' => [
        'enabled' => true,
        'driver' => env('MONITOR_CACHE_DRIVER', 'file'),
        'ttl_seconds' => env('MONITOR_CACHE_TTL', 300),
    ],
];
