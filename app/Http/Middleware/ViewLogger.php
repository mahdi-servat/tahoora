<?php

namespace App\Http\Middleware;

use App\Models\Country\Country;
use App\Models\ViewLog\ViewLog;
use App\Models\ViewLog\ViewPathLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class ViewLogger
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->ip() == '127.0.0.1') {
            return $next($request);
        }
        $data = Cache::remember('clinic.view_logs.ip.' . $request->ip(), now()->addDay(), function () use ($request) {
            $agent = new Agent();
            $deviceId = null;
            switch ($agent->deviceType()) {
                case 'desktop' :
                    $deviceId = 1;
                    break;
                case 'phone' :
                    $deviceId = 2;
                    break;
                case 'tablet' :
                    $deviceId = 3;
                    break;
                case 'robot' :
                    $deviceId = 4;
                    break;
                case 'other' :
                    $deviceId = 5;
                    break;
            }
            $browser = $agent->browser();
            $ip = $request->ip();
            $position = Location::get($request->ip());
            if (!$position) {
                $position = null;
                $country = null;
            } else {
                $country = Country::where('code', $position->countryCode)->first();
                $country = $country->id;
            }
            $today = Carbon::now()->format('Y-m-d');
            return ViewLog::firstOrCreate([
                'agent' => $request->header('User-Agent'),
                'browser' => $browser,
                'device_id' => $deviceId,
                'ip' => $request->ip(),
                'country_id' => $country,
                'date' => $today
            ]);
        });

        $url = $request->hasHeader('X-FromPath') ? $request->header('X-FromPath') : $request->fullUrl();

        $viewPathLog = ViewPathLog::create([
            'view_log_id' => $data->id,
            'path' => $url
        ]);

        return $next($request);
    }
}
