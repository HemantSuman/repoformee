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

class ApiMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {


        $login = 'formeemobile';
        $pass = md5('formeemobileapp1233#');
        if (empty($_SERVER['PHP_AUTH_PW']) || empty($_SERVER['PHP_AUTH_USER'])) {
            header('WWW-Authenticate: Basic realm="Test auth"');
            header('HTTP/1.0 401 Unauthorized');
            $result['status'] = 0;
            $result['msg'] = 'Auth failed';
            echo json_encode($result);
            die;
        }
        if (($_SERVER['PHP_AUTH_PW'] != $pass || $_SERVER['PHP_AUTH_USER'] != $login) || !$_SERVER['PHP_AUTH_USER']) {
            header('WWW-Authenticate: Basic realm="Test auth"');
            header('HTTP/1.0 401 Unauthorized');
            $result['status'] = 1;
            $result['msg'] = 'Auth failed';
            echo json_encode($result);
            die;
        } else {
            return $next($request);
        }
    }

}
