<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\models\User;
use App\models\Wishlist;
use App\models\Classified;
use App\models\Message;
use App\models\Advertisement;
use App\models\Category;
use App\models\Query;
use App\Helpers\Helper;
use App\models\Cart;
use App\models\CartClassified;
use App\models\PromoCode;
use App\models\UserAddress;
use App\models\Order;
use App\models\OrderDetail;
use Session;
use Cookie;
use Illuminate\Support\Facades\Redis;
use Mail;
use Validator;
use Illuminate\Support\Facades\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\QueryException;
use Illuminate\Routing\Route;
use File;
use Srmklive\PayPal\Services\AdaptivePayments;

class CartController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {

        //$this->middleware('auth');
        $this->model = new Cart;
    }

    /**
     * html design page
     * faq
     *
     * @return void
     * @access public
     */
    public function cart_1() {

        return view('front.cart.cart_1');
    }

    public function checkout_1() {

        return view('front.cart.checkout_1');
    }

    public function checkout_2() {

        return view('front.cart.checkout_2');
    }

    public function checkout_3() {

        return view('front.cart.checkout_3');
    }

    public function checkout_4() {

        return view('front.cart.checkout_4');
    }


    public function picknpay_1() {
		
		$currentDate = date('Y-m-d');
		

        $userid = Auth::guard('web')->user()->id;

        $cartItems = $this->model->with(['cart_hm_cart_classified' => function($q1) {
                        $q1->with(['cart_bt_cart_classified' => function($q2) {
                                $q2->with(['classified_image']);
                            }
                        ]);
                    }])
                ->where(['user_id' => $userid])
                ->first();


        return view('front.cart.pickcheckout_1', compact('cartItems'));
    }

    public function picknpay_2(Request $request) {
		
		$userdata = Auth::guard('web')->user();
        $userid = Auth::guard('web')->user()->id;

        $cartItems = $this->model->with(['cart_hm_cart_classified' => function($q1) {
                        $q1->with(['cart_bt_cart_classified' => function($q2) {
                                $q2->with(['classified_image']);
                            }
                        ]);
                    }])
                ->where(['user_id' => $userid])
                ->first();
		if(isset($request->buyer_send_submit)){
			//****ADd cart itesm into Order tables ********	
			$productData = $cartItems->cart_hm_cart_classified[0];//->cart_bt_cart_classified;
   			$productData = $productData->toArray();
			
			$cartSubTotal = $productData['cart_bt_cart_classified']['price'] * $productData['qty'];
			
				$values = array('user_id'=>$userid, 'order_subtotal'=>$cartSubTotal, 'order_shipping'=>'0.00', 'order_discount'=>'0', 'order_grandtotal'=>$cartSubTotal, 'order_status'=>'pending', 'paypal_paykey'=>'', 'customer_fname'=>$userdata->fname, 'customer_lname'=>$userdata->lname,'customer_address1'=>$userdata->location,'customer_address2'=>'','customer_city'=>$userdata->city,'customer_state'=>$userdata->state,'customer_country'=>$userdata->country,'customer_postcode'=>$userdata->pincode);
			$LastinsertOrderId = DB::table('orders')->insertGetId($values);
			
			$cart = $this->model->where('user_id', '=', $userid)->first();

			if (isset($cart) && !empty($cart)) {
				$cart_id = $cart->id;
				//Get the user's cart items
				$cartItems = DB::table('cart_classified')->select('cart_classified.*', 'classifieds.*', DB::raw('(select paypal_email from users where id  =   classifieds.user_id  order by id asc limit 1) as paypal_email'))
						->leftJoin('classifieds', 'classifieds.id', '=', 'cart_classified.classified_id')
						->where('cart_classified.cart_id', '=', $cart_id)
						->first(); // it will return only one item
			}
			
			$value = $cartItems;
				$item_total_amt = ($value->price * $value->qty) ;
				$item_name_arr = DB::table('classifieds')->select('title', 'quantity')->where(['id'=>$value->classified_id])->first();
				$item_name = $item_name_arr->title;
				
				$values = array('order_id'=>$LastinsertOrderId,'classified_id'=>$value->classified_id,'item_name'=>$item_name,'item_qty'=>$value->qty,'item_price'=>$value->price,'seller_id'=>$value->user_id,'seller_paypal_email'=>$value->paypal_email,'item_ship_cost'=>0,'item_ship_name'=>'','item_total_amt'=> $item_total_amt, 'buyer_pick_date'=>$request->user_preferred_date, 'buyer_pick_time'=>$request->user_preferred_time, 'buyer_msg'=>$request->buyer_msg);
				
				$LastinsertOrderdetailId = DB::table('order_details')->insertGetId($values);
				
				//*****update item Qty*********
				$item_qty = $item_name_arr->quantity;
				$newQty = $item_qty - $value->qty ;
				$values1 = array('quantity'=>$newQty);
				DB::table('classifieds')->where('id', $value->classified_id)->update($values1);
				
				
				
				$seller_email_arr = DB::table('users')->select('email','name')->where(['id'=>$value->user_id])->first();
				$seller_email = $seller_email_arr->email;
				$seller_name = $seller_email_arr->name;
				$buyer_email = $userdata->email ;
				$email_to = array($seller_email, $buyer_email );
				
				$result = Mail::send('emails.buyer_to_seller_pickpay', array('values' => $values, 'seller_name' => $seller_name), function($message) use ($email_to) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to($email_to)->subject("Formee: Order Confirmation");
                    }, true);
				
				
				
				//*******Remove product from Cart***************
				DB::table('cart_classified')->where('cart_id', '=', $cart_id)->delete();
				//*********************************************
				
				Session::flash('alert-class', 'alert-success');
       			Session::flash('message', 'Your message successfully sent to Seller.');

				return redirect('user/orders');
			
		
		}
		
        return view('front.cart.pickcheckout_2', compact('cartItems'));
    }

    public function picknpay_3(Request $request) {
		
		
		$order_id = $request->id ;
		$userdata = Auth::guard('web')->user();
        $userid = Auth::guard('web')->user()->id;
		
		$ordermodel = new Order;
		$order = $ordermodel->with('orderDetail')->where(['id'=>$order_id])->first();
		
		$order = $order->toArray();
		
		$seller_id = $order['order_detail'][0]['seller_id'];
		
		if(isset($request->buyer_send_submit)){
			
				
				$seller_email_arr = DB::table('users')->select('email','name')->where(['id'=>$seller_id])->first();
				$seller_email = $seller_email_arr->email;
				$seller_name = $seller_email_arr->name;
				$buyer_email = $userdata->email ;
				
				$values = array('buyer_msg'=>$request->buyer_msg, 'order_id'=>$order_id);
				$email_to = array($seller_email, $buyer_email );
				
				$result = Mail::send('emails.buyer_to_seller_pickpay3', array('values' => $values, 'seller_name' => $seller_name), function($message) use ($email_to) {
                        $message->from('avinesh.mathur@planetwebsolution.com'); 
                        $message->to($email_to)->subject("Formee: Order Confirmation.");
                    }, true);
				
				
				
				Session::flash('alert-class', 'alert-success');
       			Session::flash('message', 'Your message successfully sent to Seller.');

		}
		
        return view('front.cart.pickcheckout_3', compact('order'));
    }

    public function picknpay_4(Request $request) {
		
		$order_id = $request->id ;
		$userdata = Auth::guard('web')->user();
        $userid = Auth::guard('web')->user()->id;
		
		$ordermodel = new Order;
		$order = $ordermodel->with('orderDetail')->where(['id'=>$order_id])->first();
		
		$order = $order->toArray();
		


        return view('front.cart.pickcheckout_4', compact('order'));
    }


    public function add_cart(Request $request) {

        $data = new Cart;

        $exceptFields = ['_token', 'updated_at', 'created_at'];
        $data = new Cart();
        foreach ($request as $key => $value) {
            if (!in_array($key, $exceptFields)) {
                $data->$key = $value;
            }
        }
        if ($request->user_id != 0) { //user logged in
            $data->user_id = $request->user_id;
            //Check user's cart exist
            $cart = $this->model->where('user_id', '=', $data->user_id)->first();
            if (isset($cart) && !empty($cart)) {
                $cart_id = $cart->id;
            } else {
                $cart = $this->model->create($data->toArray());
                $cart_id = $cart->id;
            }
            //Get the user's cart items
            $cartItems = DB::table('cart_classified')->where('cart_id', '=', $cart_id)->get();
            if (isset($cartItems) && count($cartItems) > 0) { //table not empty
                $cartItems = $cartItems->toArray();
                $itemadded = 0;
                foreach ($cartItems as $key => $value) {
                    if ($value->classified_id == $request->classified_id) { //if fount same item then update qty
                        $newqty = $value->qty + $request->qty;
                        DB::table('cart_classified')
                                ->where('id', $value->id)
                                ->update(['qty' => $newqty]);
                        $itemadded = 1;
                        break;
                    }
                }
                if ($itemadded == 0) {
                    $values = array('classified_id' => $request->classified_id, 'cart_id' => $cart_id, 'qty' => $request->qty, 'ship_name' =>$request->ship_name, 'ship_cost'=>$request->ship_cost);
                    DB::table('cart_classified')->insert($values);
                }
            } else { 
                $values = array('classified_id' => $request->classified_id, 'cart_id' => $cart_id, 'qty' => $request->qty, 'ship_name' =>$request->ship_name, 'ship_cost'=>$request->ship_cost);
                DB::table('cart_classified')->insert($values);
            }

            $NewcartItems = DB::table('cart_classified')->where('cart_id', '=', $cart_id)->get();
            Session::set('cartItems', count($NewcartItems));
        } else { //user NOT logged in
            if (isset($_COOKIE['cartCookie'])) {
                $encodeddata = $_COOKIE['cartCookie'];
                $dataArr = json_decode($encodeddata, true);
                $itemadded = 0;
                foreach ($dataArr as $key => $value) {
                    if ($value['classified_id'] == $request->classified_id) {
                        $dataArr[$key]['qty'] = $value['qty'] + $request->qty;
                        $itemadded = 1;
                        break;
                    }
                }
                if ($itemadded == 0) {
                    $dataArr[] = array('classified_id' => $request->classified_id, 'qty' => $request->qty, 'ship_name' =>$request->ship_name, 'ship_cost'=>$request->ship_cost);
                }

                Session::set('cartItems', count($dataArr));
                $dataencode = json_encode($dataArr);
                setcookie('cartCookie', $dataencode, time() + (86400 * 30), "/");
            } else {

                $data = array(array('classified_id' => $request->classified_id, 'qty' => $request->qty, 'ship_name' =>$request->ship_name, 'ship_cost'=>$request->ship_cost));

                Session::set('cartItems', count($data));

                setcookie('cartCookie', "", time() - 3600);
                $dataencode = json_encode($data);
                setcookie('cartCookie', $dataencode, time() + (86400 * 30), "/");
            }

        }

        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Product Successfully added into the Cart.');


        return Redirect::to('cart');
    }

    /*
      Add product into the cart from wishlist

     */

    public function add_to_cart_wishlist(Request $request) {

        $classified_id = $request->id;
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $userid = Auth::guard('web')->user()->id;
            //Check user's cart exist
            $cart = $this->model->where('user_id', '=', $userid)->first();
            if (isset($cart) && !empty($cart)) {
                $cart_id = $cart->id;
            } else {
                $cart = $this->model->create($data->toArray());
                $cart_id = $cart->id;
            }

            //Get the user's cart items
            $cartItems = DB::table('cart_classified')->where('cart_id', '=', $cart_id)->get();
            if (isset($cartItems) && count($cartItems) > 0) { //table not empty
                $cartItems = $cartItems->toArray();
                $itemadded = 0;
                foreach ($cartItems as $key => $value) {
                    if ($value->classified_id == $classified_id) { //if fount same item then update qty
                        $newqty = $value->qty + 1;
                        DB::table('cart_classified')
                                ->where('id', $value->id)
                                ->update(['qty' => $newqty]);
                        $itemadded = 1;
                        break;
                    }
                }
                if ($itemadded == 0) {
                    $values = array('classified_id' => $classified_id, 'cart_id' => $cart_id, 'qty' => 1);
                    DB::table('cart_classified')->insert($values);
                }
            } else { //cart empty
                $values = array('classified_id' => $classified_id, 'cart_id' => $cart_id, 'qty' => 1);
                DB::table('cart_classified')->insert($values);
            }
            //Remove from wishlist
            DB::table('wishlists')->where(['classified_id' => $classified_id, 'user_id' => $userid])->delete();

            Session::flash('alert-class', 'alert-success');
            Session::flash('message', 'Product Successfully added into the Cart.');
        }

        return Redirect::to('cart');
    }

    /*
      Get cart items list

     */

    public function cartlist(Request $request) {

        $cartItems = '';
        $cartCount = 0;
        $cartSubTotal = 0;
        $cartGrandTotal = 0;
        $wishlistItems = '';
        
        if (!(Auth::guard('web')->user())) {
            if (isset($_COOKIE['cartCookie'])) {
                $cartItems = json_decode($_COOKIE['cartCookie'], true);
                Session::set('cartItems', count($cartItems));
            }
        } else {

            $userid = Auth::guard('web')->user()->id;
            $cart = $this->model->where('user_id', '=', $userid)->first();
            if (isset($cart) && !empty($cart)) {
                $cart_id = $cart->id;
                //Get the user's cart items
                $cartItems = DB::table('cart_classified')->select('cart_classified.*', 'classifieds.*', DB::raw('(select name from classifiedimage where classified_id  =   cart_classified.classified_id  order by id asc limit 1) as photo'))
                        ->leftJoin('classifieds', 'classifieds.id', '=', 'cart_classified.classified_id')
                        ->where('cart_classified.cart_id', '=', $cart_id)
                        ->get();
                if (isset($cartItems) && count($cartItems) > 0) { //table not empty
                    $cartCount = count($cartItems);
                } else { //cart empty
                    //No item in Cart
                }

                $NewcartItems = DB::table('cart_classified')->where('cart_id', '=', $cart_id)->get();
                Session::set('cartItems', count($NewcartItems));
            } else {
                //No cart
            }
            
            $catids = $cartItems->pluck('category_id')->toArray();
            $similarClass = new Classified;
            $similarClass = $similarClass->getSimilarAds($catids,false);
            $similarClass = collect($similarClass)->take(3)->toArray();
            
            //********Get wishlist products**************

            $wishlistItems = DB::table('wishlists')->select('wishlists.*', 'classifieds.*', DB::raw('(select name from classifiedimage where classified_id  =   wishlists.classified_id  order by id asc limit 1) as photo'))
                    ->leftjoin('classifieds', 'wishlists.classified_id', '=', 'classifieds.id')
                    ->where(['wishlists.user_id' => $userid, 'wishlists.classified_type' => 'cart'])
                    ->get();
        }


        return view('front.cart.cart', compact('cartItems', 'wishlistItems', 'similarClass'));
    }

    /*
      Get cart items list for checkout step -1

     */

    public function cartlist_checkout(Request $request) {

        $currentDate = date('Y-m-d');

        $userid = Auth::guard('web')->user()->id;

        $cartItems = $this->model->with(['cart_hm_cart_classified' => function($q1) {
                        $q1->with(['cart_bt_cart_classified' => function($q2) {
                                $q2->with(['classified_image']);
                            }
                        ]);
                    }])
                ->where(['user_id' => $userid])
                ->first();

        $cart_id = $cartItems->id;

        $all_class_ids = $cartItems->cart_hm_cart_classified->groupBy('classified_id')->keys()->toArray();

        $promoCodes = new PromoCode;
        $promoCodes = $promoCodes->whereIn('classified_id', $all_class_ids)
                        ->where('start_date', '<=', $currentDate)
                        ->where('end_date', '>=', $currentDate)
                        ->get()->count();

        $NewcartItems = DB::table('cart_classified')->where('cart_id', '=', $cart_id)->get();
        Session::set('cartItems', count($NewcartItems));

        return view('front.cart.checkout1', compact('cartItems', 'promoCodes'));
    }

    /*
      Get cart items list for checkout step -1

     */

    public function cartlist_checkout2(Request $request) {

        $currentDate = date('Y-m-d');
        $doscounted_value = null;

        $userid = Auth::guard('web')->user()->id;

        $requestAll = Input::all();

        if (isset($requestAll['promo_code']) && $requestAll['promo_code'] != '') {

            $promocodes = new PromoCode;
            $promocodes = $promocodes
                            ->where('start_date', '<=', $currentDate)
                            ->where('end_date', '>=', $currentDate)
                            ->where(['promocode' => $requestAll['promo_code'], 'status' => 1])->first();
        }

        foreach ($requestAll['cart_classified'] as $key => $value) {

            $cartClassObj = new CartClassified;
            $save_data = [];
            $save_data['ship_name'] = $value['shipping_name'];
            $save_data['ship_cost'] = $value['shipping'];


            if (isset($promocodes) && $value['classified_id'] == $promocodes['classified_id']) {

                if ($promocodes['discount_type'] == 'Percentage') {

                    $doscounted_value = ($value['price'] * $promocodes['discount_value']) / 100;
                } else if ($promocodes['discount_type'] == 'Fix') {

                    $doscounted_value = $promocodes['discount_value'];
                }
                $save_data['discount_value'] = $doscounted_value;
                $save_data['promocode'] = $promocodes['promocode'];
                $save_data['discount_type'] = $promocodes['discount_type'];
            } else {
                $save_data['discount_value'] = null;
                $save_data['promocode'] = null;
                $save_data['discount_type'] = null;
            }

            $cartClassObj->where(['id' => $key])->update($save_data);
        }

        $users = DB::table('user_address')->where(['user_id' => $userid])->get()->groupBy('id')->toArray();
        return view('front.cart.checkout_2_template', compact('users'));
    }

    /*
      Get cart items list for checkout step -3

     */

    public function cartlist_checkout3(Request $request) {

        $cartItems = '';
        $cartCount = 0;
        $cartSubTotal = 0;
        $cartGrandTotal = 0;
        $wishlistItems = '';

		$address_id = $request->address_id ;

        $userid = Auth::guard('web')->user()->id;
        $cart = $this->model->where('user_id', '=', $userid)->first();
        if (isset($cart) && !empty($cart)) {
            $cart_id = $cart->id;
            //Get the user's cart items
            $cartItems = DB::table('cart_classified')->select('cart_classified.*', 'classifieds.*', DB::raw('(select paypal_email from users where id  =   classifieds.user_id  order by id asc limit 1) as paypal_email'))
                    ->leftJoin('classifieds', 'classifieds.id', '=', 'cart_classified.classified_id')
                    ->where('cart_classified.cart_id', '=', $cart_id)
                    ->get();
            if (isset($cartItems) && count($cartItems) > 0) { //table not empty
                $cartCount = count($cartItems);
            } else { //cart empty
                //No item in Cart
            }

        } else {
            //No cart
        }

        return view('front.cart.checkout3', compact('cartItems', 'address_id'));
    }

    /*
      Remove a product from cart
     */

    public function removefromcart(Request $request) {
        $classified_id = $request->id;
        $cart_id = $request->cartid;

        if ($cart_id == 0) { //user not logged in
            if (isset($_COOKIE['cartCookie'])) {
                $cartItems = json_decode($_COOKIE['cartCookie'], true);
                foreach ($cartItems as $key => $value) {
                    if ($value['classified_id'] == $classified_id) {
                        unset($cartItems[$key]);
                    }
                }
            }
            setcookie('cartCookie', "", time() - 3600);
            $dataencode = json_encode($cartItems);
            setcookie('cartCookie', $dataencode, time() + (86400 * 30), "/");
        } else { //user logged in
            $res = DB::table('cart_classified')->where(['classified_id' => $classified_id, 'cart_id' => $cart_id])->delete();
        }

        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Product Successfully removed from the Cart.');
        return Redirect::to('cart');
    }

    /**
      chk-cart-items to check the payment methods of the cart items.
     */
    public function chk_cart_items() {
        if (!empty(Auth::guard('web')->user()) && !empty(Auth::guard('web')->user()->id)) {
            $userid = Auth::guard('web')->user()->id;
            $cart = $this->model->where('user_id', '=', $userid)->first();
            $cart_id = $cart->id;
            $cartItems = DB::table('cart_classified')->select('cart_classified.*', 'classifieds.*')
                    ->leftJoin('classifieds', 'classifieds.id', '=', 'cart_classified.classified_id')
                    ->where('cart_classified.cart_id', '=', $cart_id)
                    ->get();
            $paypal_arr = array();
            $picnpay_arr = array();
            foreach ($cartItems as $key => $value) {
                if ($value->pay_pal == 1) {
                    $paypal_arr[] = array('classified_id' => $value->classified_id, 'title' => $value->title);
                }
                if ($value->pic_n_pay == 1) {
                    $picnpay_arr[] = array('classified_id' => $value->classified_id, 'title' => $value->title);
                }
            }

            if (count($paypal_arr) > 0 && count($picnpay_arr) > 0) {
                $returnstr = 'The cart items contains Both typs of payment methods(PayPal and Pick-n-Pay). Please select only one type of itesm to checkout and move the other items into your wishlist by click on "save for Later. <br><br>
				A). PayPal Products:<br>	';
                foreach ($paypal_arr as $key => $value) {
                    $returnstr .= ($key + 1) . '). ' . $value['title'] . '<br>';
                }
                $returnstr .= '<br> B). Pick-n-Pay Products:<br>	';
                foreach ($picnpay_arr as $key => $value) {
                    $returnstr .= ($key + 1) . '). ' . $value['title'] . '<br>';
                }

                return $returnstr;
            } else {
				if(count($paypal_arr) > 0){
                	return "paypal";
				}else{
					if(count($picnpay_arr) > 1){
						return "The Cart Items contains more than one Pick-n-Pay product. Please keep only one Pick-n-Pay product to checkout";
					}else{
					
						return "picknpay";
					}
				}
            }
        } else {
            return "login required";
        }
    }

    /* update_shipment_checkout */

    public function update_shipment_checkout(Request $request) {

        $userid = Auth::guard('web')->user()->id;
        $cart = $this->model->where('user_id', '=', $userid)->first();
        $cart_id = $cart->id;
        $values = array();

        DB::table('cart_classified')->where(['cart_id' => $cart_id, 'classified_id' => $request->classified_id])
                ->update(['ship_name' => $request->ship_name, 'ship_cost' => $request->ship_cost]);
        return true;
    }

    /*     * *** Process to paypal adeptive chain method */

    public function paypal_process(Request $request) {

        $receivers = array();
		$cartSubTotal=0;
		$cartShipCost=0;
		$cartGrandTotal=0;
		$cartDiscount = 0;

        $provider = new AdaptivePayments;     // To use adaptive payments.
		$address_id = $request->address_id;
        $userid = Auth::guard('web')->user()->id;
        $cart = $this->model->where('user_id', '=', $userid)->first();

        if (isset($cart) && !empty($cart)) {
            $cart_id = $cart->id;
            //Get the user's cart items
            $cartItems = DB::table('cart_classified')->select('cart_classified.*', 'classifieds.*', DB::raw('(select paypal_email from users where id  =   classifieds.user_id  order by id asc limit 1) as paypal_email'))
                    ->leftJoin('classifieds', 'classifieds.id', '=', 'cart_classified.classified_id')
                    ->where('cart_classified.cart_id', '=', $cart_id)
                    ->get();
        }

        foreach ($cartItems as $key => $value) {
            $amount = ($value->price * $value->qty) + $value->ship_cost;
            $receivers[] = array('email' => $value->paypal_email, 'amount' => $amount, 'primary' => false, 'memo'=>'hello');
			$cartSubTotal += ($value->price * $value->qty);
			$cartShipCost += $value->ship_cost ;
			$cartDiscount += $value->discount_value;
        }
		
		$cartGrandTotal = $cartSubTotal + $cartShipCost - $cartDiscount;

        $data = [
            'receivers' => $receivers,
            'payer' => 'EACHRECEIVER', 
// (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('user/cart-paypal-success'),
            'cancel_url' => url('user/cart-paypal-cancel'),
        ];


        $response = $provider->createPayRequest($data);

        Session::set('payKey', $response['payKey']);
		
		//********Save cart recored into Order Table ***************
		$address_data = DB::table('user_address')->where(['id'=>$address_id])->first();
		
		
		 
		$values = array('user_id'=>$userid, 'order_subtotal'=>$cartSubTotal, 'order_shipping'=>$cartShipCost, 'order_discount'=>$cartDiscount, 'order_grandtotal'=>$cartGrandTotal, 'order_status'=>'pending', 'paypal_paykey'=>$response['payKey'], 'customer_fname'=>$address_data->fname, 'customer_lname'=>$address_data->lname,'customer_address1'=>$address_data->address_1,'customer_address2'=>$address_data->address_2,'customer_city'=>$address_data->city,'customer_state'=>$address_data->state,'customer_country'=>$address_data->country,'customer_postcode'=>$address_data->postalcode);
		$LastinsertOrderId = DB::table('orders')->insertGetId($values);
		
		foreach ($cartItems as $key => $value) {
			$item_total_amt = ($value->price * $value->qty) + $value->ship_cost - $value->discount_value;
			$item_name_arr = DB::table('classifieds')->select('title', 'quantity')->where(['id'=>$value->classified_id])->first();
			$item_name = $item_name_arr->title;
			
			$values = array('order_id'=>$LastinsertOrderId,'classified_id'=>$value->classified_id,'item_name'=>$item_name,'item_qty'=>$value->qty,'item_price'=>$value->price,'seller_id'=>$value->user_id,'seller_paypal_email'=>$value->paypal_email,'item_ship_cost'=>$value->ship_cost,'item_ship_name'=>$value->ship_name,'item_total_amt'=> $item_total_amt);
			$LastinsertOrderdetailId = DB::table('order_details')->insertGetId($values);
			
			//*****update item Qty*********
			$item_qty = $item_name_arr->quantity;
			$newQty = $item_qty - $value->qty ;
			$values = array('quantity'=>$newQty);
			DB::table('classifieds')->where('id', $value->classified_id)->update($values);
			
		}
		
		
		
		//**********************************

        $redirect_url = $provider->getRedirectUrl('approved', $response['payKey']);

        return redirect::to($redirect_url);
    }

    /*
      cart PayPal cancel
     */

    public function cart_paypal_cancel() {

        return view('front.cart.cancel');
    }

    /*
      cart PayPal success
     */

    public function cart_paypal_success(Request $request) {

        $provider = new AdaptivePayments;     // To use adaptive payments.
        $paykey = Session::get('payKey');

        $response = $provider->getPaymentDetails($paykey);
		
		$json_response = json_encode($response);
		if($response['status']=="COMPLETED"){
			$values = array('transaction_status'=>"COMPLETED", 'order_status'=>"PAID", 'paypal_response'=> $json_response);
			DB::table('orders')->where('paypal_paykey', $paykey)->update($values);
			
			$ordertb = DB::table('orders')->where('paypal_paykey', $paykey)->first();
			$orderid = $ordertb->id;
			
			
			foreach($response['paymentInfoList']['paymentInfo'] as $key	=> $value){
				$seller_paypal = $value['receiver']['email'];
				$amount = $value['receiver']['amount'];
				
				if(isset($value['transactionId'])){
					$transactionId = $value['transactionId'];
					$transactionStatus = $value['transactionStatus'];
				}else{
					$transactionId = '';
					$transactionStatus = 'PENDING';
				}
				$senderTransactionId = $value['senderTransactionId'];
				$values = array('transaction_id'=>$transactionId, 'transaction_status'=>$transactionStatus, 'senderTransactionId'=>$senderTransactionId);
				DB::table('order_details')->where(['order_id'=> $orderid, 'seller_paypal_email'=>$seller_paypal, 'item_total_amt'=>$amount])->update($values);
			}
			
		//****Send order confirmation email to customer *********************
		$orderDetails = DB::table('order_details')
		->select('order_details.*', DB::raw('(select title from classifieds where id = order_details.classified_id  order by id asc limit 1) as product_name'), DB::raw('(select name from users where id = order_details.seller_id order by id asc limit 1) as seller_name'))
		->where(['order_id'=> $orderid])->get();
		$orderDetails = $orderDetails->toArray();
		$email = Auth::guard('web')->user()->email;
		$result = Mail::send('emails.order_customer', array('orderDetails' => $orderDetails, 'ordertb' => $ordertb), function($message) use ($email) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to($email)->subject("Formee: Order Confirmation");
                    }, true);
		//******************************************************
		
		//********Send email to EACH Seller*************
		foreach($orderDetails as $key => $value){
		$seller_id = $value->seller_id;
		$seller_email_arr = DB::table('users')->select('email')->where(['id'=>$seller_id])->first();
		$seller_email = $seller_email_arr->email;
		
		$result = Mail::send('emails.order_seller', array('orderDetails' => $value, 'ordertb' => $ordertb), function($message) use ($seller_email) {
                        $message->from('avinesh.mathur@planetwebsolution.com');
                        $message->to($seller_email)->subject("Formee: Order Confirmation");
                    }, true);
		
		}
		//**********Empty the Cart********************
			$userid = Auth::guard('web')->user()->id;
			$cart = $this->model->where('user_id', '=', $userid)->first();
			$cart_id = $cart->id;
			DB::table('cart_classified')->where('cart_id', '=', $cart_id)->delete();
		}

        return view('front.cart.success');
    }

    public function save_user_address(Request $request) {
        $data = Input::all();
        $userid = Auth::guard('web')->user()->id;

        $user_address = \DB::table('user_address')->where('user_id', $userid)->get()->toArray();

        if ($data['address_id'] == '' && isset($user_address) && !empty($user_address) && count($user_address) >= 2) {

            return response()->json(['status' => false, 'message' => 'You can not add more than two address!']);
        } else {

            $savedata = new UserAddress;

            unset($data['_token']);

            $data['user_id'] = $userid;

            if ($data['address_id'] == '') {
                $res = $savedata->create($data);
            } else {

                $id = $data['address_id'];
                unset($data['address_id']);
                $savedata->where(['id' => $id])->update($data);
                $res = $savedata;
                $res->id = $id;
            }
        }

        if (isset($res->id)) {
            return response()->json(['status' => true, 'results' => $res->id]);
        } else {
            return response()->json(['status' => false, 'message' => '']);
        }
    }
    
    public function delete_user_address(Request $request) {
        $data = Input::all();
        $userid = Auth::guard('web')->user()->id;

        $user_address = \DB::table('user_address')->where('id', $data['address_id'])->delete();

        return response()->json(['status' => true]);
    }

    

}
