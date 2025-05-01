<?php

namespace Itxrahulsingh\LaravelMonitor\Recorders;

use Itxrahulsingh\LaravelMonitor\Events\HighCpuUsageDetected;
use Itxrahulsingh\LaravelMonitor\Models\MonitorPerformanceMetric;

class SystemMetricsRecorder
{
    public function register()
    {
        // Scheduler will call record() periodically
    }

    public function record()
    {
        $cpu = $this->getCpuUsage();
        MonitorPerformanceMetric::create([
            'metric_name' => 'cpu_usage',
            'value' => $cpu,
            'context' => ['server' => gethostname()],
        ]);

        if ($cpu > config('laravel-monitor.notifications.thresholds.cpu_usage.value', 80)) {
            event(new HighCpuUsageDetected($cpu));
        }

        $memory = $this->getMemoryUsage();
        MonitorPerformanceMetric::create([
            'metric_name' => 'memory_usage',
            'value' => $memory['percent'],
            'context' => ['used' => $memory['used'], 'total' => $memory['total']],
        ]);

        $disk = $this->getDiskUsage();
        MonitorPerformanceMetric::create([
            'metric_name' => 'disk_usage',
            'value' => $disk['percent'],
            'context' => ['used' => $disk['used'], 'total' => $disk['total']],
        ]);
    }

    protected function getCpuUsage()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            try {
                $wmi = new \COM('WinMgmts://');
                $cpus = $wmi->ExecQuery('SELECT LoadPercentage FROM Win32_Processor');
                $total = 0;
                $count = 0;
                foreach ($cpus as $cpu) {
                    $total += $cpu->LoadPercentage;
                    $count++;
                }
                return $count ? $total / $count : 0;
            } catch (\Exception $e) {
                return 0;
            }
        }
        $load = sys_getloadavg();
        return $load ? $load[0] * 100 / (1 + $load[0]) : 0;
    }

    protected function getMemoryUsage()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            try {
                $wmi = new \COM('WinMgmts://');
                $mem = $wmi->ExecQuery('SELECT TotalVisibleMemorySize, FreePhysicalMemory FROM Win32_OperatingSystem');
                foreach ($mem as $info) {
                    $total = $info->TotalVisibleMemorySize;
                    $free = $info->FreePhysicalMemory;
                    return [
                        'used' => ($total - $free) / 1024,
                        'total' => $total / 1024,
                        'percent' => ($total - $free) / $total * 100,
                    ];
                }
            } catch (\Exception $e) {
                return ['used' => 0, 'total' => 1, 'percent' => 0];
            }
        }
        $free = shell_exec('free -m');
        preg_match_all('/\d+/', $free, $matches);
        $total = $matches[0][1] ?? 1;
        $used = $matches[0][2] ?? 0;
        return [
            'used' => $used,
            'total' => $total,
            'percent' => $used / $total * 100,
        ];
    }

    protected function getDiskUsage()
    {
        $path = base_path();
        $free = disk_free_space($path) / 1024 / 1024;
        $total = disk_total_space($path) / 1024 / 1024;
        return [
            'used' => $total - $free,
            'total' => $total,
            'percent' => ($total - $free) / $total * 100,
        ];
    }
}
