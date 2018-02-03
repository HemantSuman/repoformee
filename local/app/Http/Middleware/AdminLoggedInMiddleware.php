<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Redirect;
use Closure;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\models\user;
use Auth;

class AdminLoggedInMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if(Auth::guard('admin')->check()) {           
        return $next($request);
        }
        
        return Redirect::to('/admin/login');
    }


}
