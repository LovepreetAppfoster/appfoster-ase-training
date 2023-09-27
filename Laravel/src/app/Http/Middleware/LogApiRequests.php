<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        $logMessage = sprintf(
            "Request URL: %s\nRequest Data: %s\n\n",
            $request->fullUrl(),
            json_encode($request->all())
        );

        // Log the API request to a file
        File::append(storage_path('logs/api-requests.log'), $logMessage);
        return $next($request);
    }
}
