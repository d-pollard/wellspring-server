<?php
/**
 * Created by IntelliJ IDEA.
 * User: derek - dpollard@mail.bradley.edu
 * Date: 10/11/18
 * Time: 12:31 PM
 */

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->method() === 'OPTIONS')
            return response()->json(['success' => true])
            ->header('Access-Control-Allow-Headers', '*')
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        return $next($request)
            ->header('Access-Control-Allow-Headers', '*')
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
