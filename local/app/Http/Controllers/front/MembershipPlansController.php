<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\MembershipPlan as CURRENT_MODEL;
use App\models\Role;
use App\models\MembershipPlanUser;
use Hash;
use DB;
use Mail;
use App\Event;
use File;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\QueryException;
use Session;
use Intervention\Image\Facades\Image as image1;
use Srmklive\PayPal\Services\ExpressCheckout;

class MembershipPlansController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route, Request $request) {

        $this->tableName = 'membership_plans';
        $this->viewName = 'membership_plans';
        $this->modelTitle = 'Membership Plan';
        $this->model = new CURRENT_MODEL;

        $currentAction = $route->getActionName();
        list($controller, $method) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $method);
    }

    /**
     * add
     * function for add form for MembershipPlans
     *
     * @return void
     * @access public
     */
    public function add($id = null) {

        $membership_plan = Role::with(['role_membership_plans' => function($q1){
            $q1->orderBy('display_order','asc');
        }])->where(['role_type' => 'front', 'seller_type' => 'business', 'status' => 1])->get();
        return view('front/' . $this->viewName . '/add', compact('membership_plan'));
    }

    /**
     * add
     * function for create a MembershipPlans
     *
     * @return void
     * @access public
     */
    public function create(Request $request) {


        if ($request->isMethod('post')) {

            $this->validate($request, [
                'fname' => 'required',
                'lname' => 'required',
                'business_name' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'statevalue' => 'required',
                'subregion_id' => 'required',
                'pincode' => 'required',
                    ], [
                'fname.required' => 'First Name is required.',
                'lname.required' => 'Last Name is required.',
                'business_name.required' => 'Company Name is required.',
                'lat.required' => 'Select full  address with state and city.',
                'lng.required' => 'Select full  address with state and city.',
                'statevalue.required' => 'Select full  address with state and city.',
                'subregion_id.required' => 'Select full  address with state and city.',
                'pincode.required' => 'Select full  address with state and city.',
            ]);
        }
        $membership = new MembershipPlanUser;
        $result = $membership->saveAll($request);
		
		
		//*****Redirect for PayPal recurring system*******
		$provider = new ExpressCheckout; 
		$lastInsertedId = $result->id;
		
		$data = [];
		$data['items'] = [
			[
				'name' => $result->plan_name,
				'price' => $result->plan_price,
				'qty' => 1
			]
		];
		
		$data['invoice_id'] = $result->id;
		$data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
		$data['return_url'] = url('/membership_plans/success');
		$data['cancel_url'] = url('/membership_plans');
		
		$total = 0;
		foreach($data['items'] as $item) {
			$total += $item['price']*$item['qty'];
		}
		
		$data['total'] = $total;
		
		$response = $provider->setExpressCheckout($data);

		// Use the following line when creating recurring payment profiles (subscriptions)
		$response = $provider->setExpressCheckout($data, true);
		
		 // This will redirect user to PayPal
		
		 return response()->json(['status' => true, 'url' => $response['paypal_link']]);
		
		
		
		
        if ($result) {
            Session::flash('type', 'success');
            Session::flash('message', 'Successfully submitted.');
            return response()->json(['status' => true, 'url' => '/']);
        } else {
            Session::flash('alert-class', 'alert-warning');
            Session::flash('message', 'Something wrong, please try again.');
            return response()->json(['status' => false, 'url' => '/']);
        }
    }

	public function success(Request $request){
		
		$provider = new ExpressCheckout; 
		
		$token = $request->token;
		$payerid = $request->PayerID;
		
		$response = $provider->getExpressCheckoutDetails($token);
		$invid = $response['INVNUM'];
		
		if($response['ACK'] == 'Success'){
			$values = array('paypal_token_id'=>$token, 'paypal_payer_id'=>$response['PAYERID']);
			DB::table('membership_plan_users')->where(['id'=>$invid])->update($values);
		
					// The $token is the value returned from SetExpressCheckout API call
			$startdate = gmdate("Y-m-d\TH:i:s\Z");
			$profile_desc = $response['DESC'];
			$data = [
				'PROFILESTARTDATE' => $startdate,
				'DESC' => $profile_desc,
				'BILLINGPERIOD' => 'Month', // Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
				'BILLINGFREQUENCY' => 1, // 
				'AMT' => $response['AMT'], // Billing amount for each billing cycle
				'CURRENCYCODE' => 'USD', // Currency code 
				//'TRIALBILLINGPERIOD' => 'Day',  // (Optional) Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
				//'TRIALBILLINGFREQUENCY' => 10, // (Optional) set 12 for monthly, 52 for yearly 
				//'TRIALTOTALBILLINGCYCLES' => 1, // (Optional) Change it accordingly
				//'TRIALAMT' => 0, // (Optional) Change it accordingly
			];
			$response = $provider->createRecurringPaymentsProfile($data, $token);
			if($response['ACK'] == 'Success'){
				
				$profileId = $response['PROFILEID'];
				$profileStatus = $response['PROFILESTATUS'];
				
				$value = array('paypal_profile_id'=>$profileId, 'paypal_profile_status'=>$profileStatus);
				DB::table('membership_plan_users')->where(['id'=>$invid])->update($value);
				
				Session::flash('type', 'success');
            	Session::flash('message', 'You membership profile has Successfully created.');
            	
				
				
				return redirect('/');
			}else{
				
				Session::flash('alert-class', 'alert-warning');
            	Session::flash('message', 'Something wrong, please try again.');
				return redirect('/');
				
			}
		
		}

		
	}

    public function get_become_a_member_form() {

        $data = Input::all();
        $planId = $data['planId'];

        $membership_plan = $this->model->getFirstValue($planId);
        $stateCode = DB::table('state')->where('country_id', 14)->pluck('id', 'code')->toarray();
        return view('front/' . $this->viewName . '/get_become_a_member_form', compact('membership_plan', 'stateCode'));
    }


}
