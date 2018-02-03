<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
     'facebook' => [
    'client_id' => '678621942346148',
    'client_secret' => '1bdcf2758bb32c2aebff75ab0c38bfdd',
    'redirect' => 'http://laravel.planetwebsolution.com/formeenew/auth/facebook/callback',     
  
 ],
    
    'google' => [
    'client_id' => '210911272806-n1htvm3lhuqjj8elrmmfaadlislf8a68.apps.googleusercontent.com',
    'client_secret' => 'XSO6p54tx1r7gfIKG00zU3Ng',
    'redirect' => 'http://laravel.planetwebsolution.com/formeenew/callback/google',
     
],

];

// 'client_id' => '1831120040505165',
//    'client_secret' => '389a8534dafb5b0137100d0b0d6a46d2',
//    'redirect' => 'http://laravel.planetwebsolution.com/formeenew/auth/facebook/callback',   