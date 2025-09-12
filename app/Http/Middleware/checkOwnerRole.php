<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\returnCallback;

class checkOwnerRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   

        if(Auth::user()->role==='restaurant_owner'){
             return $next($request);
        }else{
            return response()->json(["message"=>"you are not an restaurant_owner"],403);
        }

       
    }
}
