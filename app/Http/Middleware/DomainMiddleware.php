<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class DomainMiddleware
{
    public function handle($request, Closure $next)
    {
        $currentDomain = $request->getHost();

        // Perform domain-specific configurations
        // if ($currentDomain === 'example1.com') {
        //     Config::set('app.name', 'Site 1');
        //     // Add other domain-specific settings here
        // } elseif ($currentDomain === 'example2.com') {
        //     Config::set('app.name', 'Site 2');
        // } elseif ($currentDomain === 'example3.com') {
        //     Config::set('app.name', 'Site 3');
        // }
        return $next($request);
    }
}
