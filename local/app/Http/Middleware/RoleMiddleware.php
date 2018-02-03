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
use App\models\PermissionRole;
use Auth;

class RoleMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        $action = app('request')->route()->getAction();
        $controller = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controller);
        
        $Userdata = Auth::guard('admin')->user();
        $loginrole_id = $Userdata->role_id;
        $loginuser_id = $Userdata->id;

        $result = User::with(["permission_role" => function ($detail)use($controller, $action) {
                        $detail->with(["permission" => function($ff) use($controller, $action) {
                                $ff->where('controler_name', '=', $controller)->where('name', '=', $action);
                            }]);
                    }])->with('role_name')->where('id', '=', $loginuser_id)->first();
                $valid_permission = [];
                foreach ($result->permission_role as $k => $val) {
                    if (!empty($val->permission[0]) && isset($val->permission[0]['controler_name'])) {
                        $valid_permission[] = array(
                            'controller' => $val->permission[0]['controler_name'],
                            'action' => $val->permission[0]['name'],
                        );
                    }
                }
                if(!empty($valid_permission))
                {
                
                  return $next($request);  
                }
                else
                {
                    
                   abort(403);  
                }
            }

        }
        