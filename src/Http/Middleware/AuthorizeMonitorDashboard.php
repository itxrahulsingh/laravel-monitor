<?php

namespace Itxrahulsingh\LaravelMonitor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthorizeMonitorDashboard
{
    public function handle(Request $request, Closure $next)
    {
        if (Gate::allows('view-monitor-dashboard')) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
