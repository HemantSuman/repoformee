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
use App\models\MembershipPlanUser;
use Auth;
use DB;
use Session;

class SellerCheckMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        
		$getStateListTop = DB::table('state')->where('country_id', 14)->get()->toarray();
		Session::push('getStateListTop', $getStateListTop);
		
		if (Auth::guard('web')->check()) {
            $Userdata = Auth::guard('web')->user();

            $currentDate = date('Y-m-d');
            $memPlanUser = DB::table('membership_plan_users')->where('start_date', '<=', $currentDate)
                            ->where('end_date', '>=', $currentDate)
                            ->where(['status' => 1, 'user_id' => Auth::guard('web')->user()->id])->first();
            if ($Userdata->seller_type == 'business' && !$memPlanUser) {

                return Redirect::to('/membership_plans');
            }
        }
		
		
        return $next($request);
    }

}
