<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
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
        if (!$request->email) {
            return response()->json([
                'message' => 'Error, required email to make new transaction'
            ]);
        }

        if (!$request->user) {
            return response()->json([
                'message' => 'Error, required user to make new transaction'
            ]);
        }

        if(!$request->input('order.0.id')) {
            return response()->json([
                'message' => 'Error, at least you add 1 product in your order'
            ]);
        }

       return $next($request);
    }
}
