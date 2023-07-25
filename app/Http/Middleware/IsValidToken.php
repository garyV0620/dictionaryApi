<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\BaseController;
use Closure;
use Illuminate\Http\Request;

class IsValidToken extends BaseController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    //This is a new middleware that you can use on the Route after regiter in the app/Http/Kernel.php (protected $routeMiddleware)
    public function handle(Request $request, Closure $next)
    {
        //check if token from the user input is the correct if not send a 401 response
        if($request->input('token') !== 'SECRETTOKEN'){
            //use the base controller
            // return $this->sendResponse([],'INVALID TOKEN!');
            return response()->json(['message'=>'INVALID TOKEN'],401);
        }
        return $next($request);
    }
}
