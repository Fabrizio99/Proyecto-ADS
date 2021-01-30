<?php

namespace App\Http\Middleware;

use App\helper\ValidateAuth;
use Closure;
use Exception;

class CheckToken
{
    public function handle($request, Closure $next)
    {
        try {
            // throw new \Exception('error');
            ValidateAuth::Check($request->token);
            return $next($request);
        } catch (Exception $e) {
            // return redirect('https://laravel.com/docs/7.x/middleware');
            return response($e->getMessage());

            // return 'https://laravel.com/docs/7.x/middleware';

        }
        
    }
}
