<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use App\models\User;
use Cookie;
use App\models\Wishlist;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

//use AuthenticatesAndRegistersUsers;
    use AuthenticatesUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected $redirectPath = '/home';

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider() {

        return Socialite::driver('facebook')->redirect();
    }

    public function redirectTogmailProvider() {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback() {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }
        $authUser = $this->findOrCreateUser($user);
        if (Cookie::get('wishlistItems')) {
            $wishlistData = Cookie::get('wishlistItems');
            $wishlistObj = new Wishlist;
            $insertedWishlistData = array();
            foreach ($wishlistData as $wsKey => $clId) {
                $checkAlreadyExist = $wishlistObj->where('classified_id', '=', $clId)->first();
                if (count($checkAlreadyExist) == 0) {
                    $insertedWishlistData[] = array('user_id' => $authUser->id, 'classified_id' => $clId);
                }
            }
            if (!empty($insertedWishlistData)) {
                $wishlistObj->insert($insertedWishlistData);
            }
        }


        if ($authUser->status == '0') {
            return Redirect('/')->withMessage('Your account not activated.')->withType('danger')->withCookie(Cookie::forget('wishlistItems'));
        }
        Auth::login($authUser, true);

        return redirect('/');
    }

    public function callbackgoogle() {
        $user = Socialite::driver('google')->user();
        $authUser = $this->findOrCreateUsergmail($user);
        if (Cookie::get('wishlistItems')) {
            $wishlistData = Cookie::get('wishlistItems');
            $wishlistObj = new Wishlist;
            $insertedWishlistData = array();
            foreach ($wishlistData as $wsKey => $clId) {
                $checkAlreadyExist = $wishlistObj->where('classified_id', '=', $clId)->first();
                if (count($checkAlreadyExist) == 0) {
                    $insertedWishlistData[] = array('user_id' => $authUser->id, 'classified_id' => $clId);
                }
            }
            if (!empty($insertedWishlistData)) {
                $wishlistObj->insert($insertedWishlistData);
            }
        }


        if ($authUser->status == '0') {
            
            return Redirect('/')->withMessage('Your account not activated.')->withType('danger')->withCookie(Cookie::forget('wishlistItems'));
        }
        Auth::login($authUser, true);

        return redirect('/')->withCookie(Cookie::forget('wishlistItems'));
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($facebookUser) {
        $authUser = User::where('social_id', $facebookUser->id)->first();
        $authUserEmail = User::where('email', $facebookUser->email)->first();

        if ($authUser) {
            if (empty($facebookUser->avatar)) {
                $updatedarray = array(
                    'name' => $facebookUser->name,
                    'social_id' => $facebookUser->id,
                    'avatar' => $facebookUser->avatar,
                    'login_type' => 'facebook',
                );
            } else {
                $updatedarray = array(
                    'name' => $facebookUser->name,
                    'social_id' => $facebookUser->id,
                    'avatar' => $facebookUser->avatar,
                    'login_type' => 'facebook',
                    'image' => '',
                );
            }

            $updateStatus = User::where("email", $facebookUser->email)->update($updatedarray);
            return $authUser;
        }
        if ($authUserEmail) {
            $logintype = $authUserEmail->login_type;
            $authUserEmailid = $authUserEmail->email;
            if (!empty($logintype)) {
                if (empty($facebookUser->avatar)) {
                    $updatedarray = array(
                        'name' => $facebookUser->name,
                        'social_id' => $facebookUser->id,
                        'avatar' => $facebookUser->avatar,
                        'login_type' => 'facebook',
                    );
                } else {
                    $updatedarray = array(
                        'name' => $facebookUser->name,
                        'social_id' => $facebookUser->id,
                        'avatar' => $facebookUser->avatar,
                        'login_type' => 'facebook',
                        'image' => '',
                    );
                }

                $updateStatus = User::where("email", $authUserEmailid)->update($updatedarray);
            }
            return $authUserEmail;
        }

        return User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'social_id' => $facebookUser->id,
                    'avatar' => $facebookUser->avatar,
                    'login_type' => 'facebook',
                    'status' => '1',
        ]);
    }

    private function findOrCreateUsergmail($gmailUser) {
        $authUser = User::where('social_id', $gmailUser->id)->first();
        $authUserEmail = User::where('email', $gmailUser->email)->first();
        $gender = '';
        if (!empty($gmailUser->user['gender'])) {
            $gender = $gmailUser->user['gender'];
        }
        if ($authUser) {
            if (empty($gmailUser->avatar)) {
                $updatedarray = array(
                    'name' => $gmailUser->name,
                    'social_id' => $gmailUser->id,
                    'avatar' => $gmailUser->avatar,
                    'login_type' => 'gmail',
                    'device_id' => '',
                    'device_model' => '',
                    'device_type' => '',
                    'os_version' => '',
                    'network_provider' => '',
                    'app_version_no' => '',
                );
            } else {
                $updatedarray = array(
                    'name' => $gmailUser->name,
                    'social_id' => $gmailUser->id,
                    'avatar' => $gmailUser->avatar,
                    'login_type' => 'gmail',
                    'image' => '',
                    'device_id' => '',
                    'device_model' => '',
                    'device_type' => '',
                    'os_version' => '',
                    'network_provider' => '',
                    'app_version_no' => '',
                );
            }
            $updateStatus = User::where("email", $gmailUser->email)->update($updatedarray);
            return $authUser;
        }
        if (!empty($authUserEmail)) {
            $logintype = $authUserEmail->login_type;
            $authUserEmailid = $authUserEmail->email;
            if (!empty($logintype)) {
                if (empty($gmailUser->avatar)) {
                    $updatedarray = array(
                        'name' => $gmailUser->name,
                        'social_id' => $gmailUser->id,
                        'avatar' => $gmailUser->avatar,
                        'login_type' => 'gmail',
                        'device_id' => '',
                        'device_model' => '',
                        'device_type' => '',
                        'os_version' => '',
                        'network_provider' => '',
                        'app_version_no' => '',
                    );
                } else {
                    $updatedarray = array(
                        'name' => $gmailUser->name,
                        'social_id' => $gmailUser->id,
                        'avatar' => $gmailUser->avatar,
                        'login_type' => 'gmail',
                        'image' => '',
                        'device_id' => '',
                        'device_model' => '',
                        'device_type' => '',
                        'os_version' => '',
                        'network_provider' => '',
                        'app_version_no' => '',
                    );
                }
                $updateStatus = User::where("email", $authUserEmailid)->update($updatedarray);
            }
            return $authUserEmail;
        }


        return User::create([
                    'name' => $gmailUser->name,
                    'email' => $gmailUser->email,
                    'social_id' => $gmailUser->id,
                    'avatar' => $gmailUser->avatar,
                    'login_type' => 'gmail',
                    'status' => '1',
        ]);
    }

}
