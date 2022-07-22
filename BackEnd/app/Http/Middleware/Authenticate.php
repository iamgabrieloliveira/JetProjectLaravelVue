<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    protected function redirectTo($request)
    {
        if($request->user()){
            return response()->json([], 200);
        }else{
            abort(401);
        }
    }
}
