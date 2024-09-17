<?php

// app/Modules/AtmCard/Middleware/AtmCardAuth.php

namespace App\Modules\AtmCard\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AtmCardAuth
{
    public function handle(Request $request, Closure $next) 
    {
        \Log::info('AtmCardAuth Middleware Executed');
        
        $config_ip_address = '127.0.0.1';
        $current_ip_address = $request->ip();

        \Log::info('Current IP Address: ' . $current_ip_address);
        \Log::info('Configured IP Address: ' . $config_ip_address);

        if ($current_ip_address !== $config_ip_address) {
            \Log::info('IP address mismatch detected.');

            return response()->json([
                'ip_address' => $current_ip_address,
                'error' => 'Unauthorized. IP address mismatch.'
            ], 403);
        }

        \Log::info('IP address matched. Proceeding with request.');

        return $next($request);
    }
}
