<?php

namespace App\Http\Middleware;

use App\Models\VisitorStatistic;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track GET requests on web pages (not API, assets, etc.)
        if ($request->isMethod('GET') && !$request->ajax() && !$request->is('api/*', 'storage/*', '_debugbar/*')) {
            try {
                VisitorStatistic::recordVisit($request->ip());
            } catch (\Exception $e) {
                // Silently fail - don't break the app if tracking fails
            }
        }

        return $next($request);
    }
}
