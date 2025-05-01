<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Monitor</title>
    @vite(['resources/css/app.css', 'packages  'packages/itxrahulsingh/laravel-monitor/resources/css/app.css'])
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 bg-white shadow">
            <div class="p-4">
                <h1 class="text-xl font-bold">Laravel Monitor</h1>
            </div>
            <nav class="mt-4">
                <a href="{{ route('monitor.dashboard') }}" class="block p-2 hover:bg-gray-100">Overview</a>
                <a href="#" class="block p-2 hover:bg-gray-100">Logs</a>
                <a href="#" class="block p-2 hover:bg-gray-100">Metrics</a>
                <a href="#" class="block p-2 hover:bg-gray-100">Alerts</a>
            </nav>
        </aside>
        <main class="flex-1 p-4 overflow-auto">
            @yield('content')
        </main>
    </div>
    @vite(['resources/js/app.js', 'packages/itxrahulsingh/laravel-monitor/resources/js/app.js'])
    @livewireScripts
</body>
</html>
