<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */
Route::group(['middleware' => ['seller']], function () {
    Route::get('/', 'front\HomeController@index');
});

Route::get('/membership_plans', 'front\MembershipPlansController@add');
Route::post('/membership_plans/create', 'front\MembershipPlansController@create');
Route::post('/get_become_a_member_form', 'front\MembershipPlansController@get_become_a_member_form');
Route::get('/membership_plans/success', 'front\MembershipPlansController@success');
Route::post('/get_sensis_search', 'admin\ClassifiedController@get_sensis_search');
//Route::post('/get_become_a_member_form1', 'front\MembershipPlansController@get_become_a_member_form1');
//Route::get('/membership_plans1', 'front\MembershipPlansController@add1');
//Route::get('/', 'front\HomeController@index');
Route::get('/imgResize', 'front\HomeController@index');
Route::post('/get_p_timing', 'front\PrayerTimingsController@get_p_timing');
Route::post('/get_c_map', 'admin\ClassifiedController@get_c_map');
//user registration route
Route::get('/messages/allnotifications', 'front\MessagesController@getallnotification');
Route::post('chkchat', 'chatController@sendMessage');
Route::get('testchat', 'chatController@testchat');
Route::get('/search_classifieds/', 'admin\ClassifiedController@get_searchresult');
Route::post('/search_classifieds/', 'admin\ClassifiedController@get_searchresult');
Route::get('search_classifiedsdata/', 'admin\ClassifiedController@get_searchresultdata');
Route::get('classified-dynamicattribute', 'admin\ClassifiedController@dynamicattribusteslist');
Route::get('/classifiedsellerinform/{id}', 'admin\ClassifiedController@classifiedsellerinform');
Route::get('/classifiedsharing/{id}', 'admin\ClassifiedController@classifiedssharing');


Route::get('search_classifieds_filter/', 'admin\ClassifiedController@get_search_classifieds_filter');
Route::get('search_classifieds_filter_category/', 'admin\ClassifiedController@get_search_classifieds_filter');
Route::post('get_banner_on_cat_change/', 'admin\ClassifiedController@get_banner_on_cat_change');
Route::get('search_classifieds_filter_dynamic_attributes/', 'admin\ClassifiedController@get_search_classifieds_filter_dynamic_attributes');

Route::get('/pushchk', 'admin\ClassifiedController@pushchk');
Route::post('/most_viewed_classifieds', 'admin\ClassifiedController@get_classified_viewed');
Route::get('/get_all_classifieds', 'admin\ClassifiedController@get_all_classifieds');
Route::post('/get_all_classifieds', 'admin\ClassifiedController@get_all_classifieds');
Route::post('/most_recent_classifieds', 'admin\ClassifiedController@get_classified_recent');
Route::post('/user-register', 'front\UsersController@registration');
//user forgot password route
Route::post('/forgot-password', 'front\UsersController@forgotpassword');
//user reset password route
Route::get('/verify/{resetCode}', 'front\UsersController@confirmResetCode');
Route::post('/reset-password/', 'front\UsersController@reset_password');
Route::get('/reset-password/', 'front\UsersController@reset_password');
//activate user via activation link
Route::get('activate/{activationCode}', 'front\UsersController@activate');
Route::get('update-email/{emailVerificationCode}', 'front\UsersController@update_requested_email');
// deactive all expired advertisement
Route::get('/deactive-expired-ads', 'admin\AdvertisementsController@deactive_expired_ads');
//user subscribe route
Route::post('/subscribe', 'admin\SubscriberListsController@subscribe');
Route::get('/subscribe', 'admin\SubscriberListsController@subscribe');

Route::post('/attributes/allchildattributes', 'admin\AttributesController@admin_allchildattributes');
// deactive all expired advertisement
// prayer timing routes
Route::get('/prayer-timings', 'front\admin\QueriesController@index');
Route::post('/prayer-timings', 'front\admin\QueriesController@index');
Route::get('/test', 'front\HomeController@testtt');
Route::post('/prayer-timing/get-states', 'front\admin\QueriesController@get_states');
Route::post('/prayer-timing/get-cities', 'front\QueriesController@get_subregions');
Route::post('/prayer-timing/get-timing', 'front\admin\QueriesController@get_prayer_timing');
Route::get('/prayer-timing/get-timing', 'front\admin\QueriesController@get_prayer_timing_for_test');
Route::post('/prayer-timing/get-monthly-timing', 'front\admin\QueriesController@get_monthly_prayer_timing');

//classified listing, details routes

Route::post('/classified_list/{id}', 'admin\ClassifiedController@classified_list');
Route::get('/classified_list/{slug}/{id}', 'admin\ClassifiedController@classified_list');
Route::post('/classified_list/{slug}/{id}', 'admin\ClassifiedController@classified_list');
Route::post('/get_suburbs_for_filter', 'admin\ClassifiedController@get_suburbs_for_filter');

//Food Product listing
Route::post('/food_list/{id}', 'admin\ClassifiedController@food_list');
Route::get('/food_list/{slug}/{id}', 'admin\ClassifiedController@food_list');
Route::post('/food_list/{slug}/{id}', 'admin\ClassifiedController@food_list');
Route::get('/food-detail/{id}', 'admin\ClassifiedController@food_detail');
Route::get('/food-detail/{slug}/{id}', 'admin\ClassifiedController@food_detail');

//Shopping Cart
Route::post('/add_to_cart', 'front\CartController@add_cart');
Route::get('/cart', 'front\CartController@cartlist');
Route::get('/removeitem/{id}/{cartid}', 'front\CartController@removefromcart');
Route::get('/removeitem_wishlist/{id}', 'front\WishlistsController@removeitem_wishlist');
Route::get('/add_to_cart_wishlist/{id}', 'front\CartController@add_to_cart_wishlist');
Route::post('/chk-cart-items', 'front\CartController@chk_cart_items');
Route::post('/update-shipment-checkout', 'front\CartController@update_shipment_checkout');


//Route::post('/classified-list/{id}', 'admin\ClassifiedController@classified_listpage');
Route::get('/classified-list/{slug}/{id}', 'admin\ClassifiedController@classified_listpage');
Route::get('/classified-list', 'admin\ClassifiedController@classified_listpage');
Route::get('/classified-list_111/{slug}/{id}', 'admin\ClassifiedController@classified_listpage_111');
Route::post('/classifieds/increase_count', 'admin\ClassifiedController@increase_count');
Route::get('/classified-detail/{id}', 'admin\ClassifiedController@classified_detail');
Route::get('/classified-detail/{slug}/{id}', 'admin\ClassifiedController@classified_detail');
Route::get('/classifieds/{id}', 'admin\ClassifiedController@classified_item');
Route::get('/classifieds/{slug}/{id}', 'admin\ClassifiedController@classified_item');
Route::get('/classifieds_111/{slug}/{id}', 'admin\ClassifiedController@classified_item_111');

Route::post('/classifieds/send_enq_msg', 'front\ClassifiedController@send_enq_msg');

Route::get('/classifieds-job/job-login/{id}', 'admin\ClassifiedController@job_login');
Route::get('/classifieds-job/job-login/{slug}/{id}', 'admin\ClassifiedController@job_login');

Route::get('/classifieds-job/job-apply/{id}', 'admin\ClassifiedController@job_apply');
Route::get('/classifieds-job/job-apply/{slug}/{id}', 'admin\ClassifiedController@job_apply');

Route::post('/classifieds-job/job-apply-post', 'admin\ClassifiedController@job_apply_post');

Route::get('/get_suburbs', 'front\ClassifiedController@get_suburbs');

//Mosques Routes
Route::post('/get-suburb', 'admin\QueriesController@get_msq_subregions');
Route::post('/get-cities', 'admin\QueriesController@get_subregions');
//Route::post('/get-near-mosque', 'front\HomeController@get_near_mosques');
Route::post('/get-near-msq', 'admin\ClassifiedController@get_near_msqs');

Route::get('/get-lat-long/', 'front\HomeController@lat_long_using_ip');

Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');


Route::get('auth/google', 'Auth\AuthController@redirectTogmailProvider');
Route::get('callback/google', 'Auth\AuthController@callbackgoogle');

// Display all SQL executed in Eloquent
\Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {

//var_dump($query->sql);
//    var_dump($query->bindings);
//    var_dump($query->time);
});

Route::POST('user/loginforjob', 'front\UsersController@postloginjob');
Route::POST('user/login', 'front\UsersController@postlogin');
Route::get('user/logout', 'front\UsersController@logout');
Route::get('/admin', 'admin\UsersController@admin_login');
Route::get('/admin/login', 'admin\UsersController@admin_login');
Route::get('/admin/forgotmail', 'admin\UsersController@admin_forgot');
Route::post('/load_header', 'front\UsersController@load_header');
Route::get('/load_css', 'front\UsersController@load_header');
Route::get('/load_header', 'front\UsersController@load_header');
Route::post('/load_js', 'front\UsersController@load_header');

Route::get('/admin/attributes/categories_json/{string}', 'admin\CategoriesController@admin_indexmulti_cat');
Route::get('/admin/attributes/categories_json', 'admin\CategoriesController@admin_indexmulti');
Route::get('/admin/attributes/categories_json_is_sellable', 'admin\CategoriesController@admin_categories_json_is_sellable');
Route::get('/admin/attributes/add/categories_json', 'admin\CategoriesController@admin_indexmulti');
Route::get('/admin/attributes/edit/categories_json/{string}', 'admin\CategoriesController@admin_indexmulti');
Route::get('/admin/attributes/edit/categories_json_is_sellable/{string}', 'admin\CategoriesController@admin_categories_json_is_sellable');
Route::get('/admin/attributes/edit/categories_json', 'admin\CategoriesController@admin_indexmulti');
//Route::get('/admin/attributes/categories_json_cat', 'admin\CategoriesController@admin_indexmulti_cat');
//Route::get('/admin/categoriesmulti','admin\CategoriesController@admin_indexmulti1');

Route::post('/admin/logincheck', 'admin\UsersController@admin_logincheck');
Route::post('/admin/forgotcheck', 'admin\UsersController@admin_forgotcheck');
Route::get('/admin/test', 'admin\UsersController@admin_test');

Route::get('/admin/logout', 'admin\UsersController@admin_logout');

Route::get('/admin/verify/{id}', 'admin\UsersController@admin_verify');
Route::post('/admin/verify', 'admin\UsersController@admin_verifycheck');

Route::get('/unsubscribe/{token}', 'admin\SubscriberListsController@unsubscribe');

//edit wishlist route
Route::post('/edit-wishlist', 'front\WishlistsController@add_to_wishlist');

//edit wishlist cart route
Route::post('/edit-wishlist-cart', 'front\WishlistsController@add_to_wishlist_cart');



//news feed page at front
Route::get('/news-feeds/', 'admin\FeedsController@index');
Route::post('/news-feeds/', 'admin\FeedsController@index');

//report spam classified
Route::post('/report/', 'admin\ReportsController@report');

//saved search mail routes
Route::get('/saved-search-daily-freq/', 'front\SavedSearchesController@mail_at_daily_frequency');
Route::get('/saved-search-weekly-freq/', 'front\SavedSearchesController@mail_at_weekly_frequency');
Route::get('/saved-search-immediately-freq/', 'front\SavedSearchesController@mail_at_immediately_frequency');

//Route::post('admin/categories/admin_delete','CategoriesController@admin_delete');
//Route::get('/admin/users', 'admin\UsersController@admin_index');
Route::get('/newsletters/cron', 'admin\NewslettersController@send_newsletter_using_cron');

//deactive classified when its end date expires
Route::get('/deactivate-classifieds', 'admin\ClassifiedController@deactive_classifieds_cron');

//route for update site visitor count
Route::post('/upd-vstr-cnt', 'front\UsersController@upd_vstr_cntr');

//for test
Route::get('/ipaddress', 'front\UsersController@ipaddr');

//static pages route
Route::get('/pages/{name}', 'admin\CmsController@commonaction');
Route::get('/mobilepages/{name}', 'admin\CmsController@commonactionmobile');
Route::post('/pages/{name}', 'admin\CmsController@commonaction');
Route::get('/about-us', 'front\HomeController@about_us');
Route::post('/contact-us', 'front\HomeController@contact_us');
Route::get('/contact-us', 'front\HomeController@contact_us');
//Route::get('/faq', 'front\HomeController@faq');
Route::get('/faq', 'admin\FaqController@getallfaqdatafront');



Route::post('/get_monthly_p_timing', 'front\admin\QueriesController@get_monthly_p_timing');

Route::post('/food_products/food_product_list', 'admin\FoodProductsController@food_product_list');
Route::post('/food_products/food_scan_bar', 'admin\FoodProductsController@food_product_detail');

Route::get('/user/cart_1', 'front\CartController@cart_1');
Route::get('/user/checkout_1', 'front\CartController@checkout_1');
Route::get('/user/checkout_22', 'front\CartController@checkout_2');
Route::get('/user/checkout_3', 'front\CartController@checkout_3');
Route::get('/user/checkout_4', 'front\CartController@checkout_4');
//Route::get('/information_list/{query}', 'admin\ClassifiedController@information_list');




Auth::routes();

Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {

    /*     * ********* QueriesController Routes ********** */
    Route::post('/attributes/attr_list', 'admin\AttributesController@admin_attr_list');
    Route::get('/add_user', ['middleware' => ['role'], 'uses' => 'admin\UsersController@admin_adduser']);
    Route::get('/register_user', 'admin\UsersController@admin_registeruserlist');
    Route::post('/register_user', 'admin\UsersController@admin_registeruserlist');

    Route::get('/business_users', 'admin\UsersController@admin_business_users');
    Route::get('/users/business_plans/{id}', 'admin\UsersController@admin_business_plans');

    Route::get('/notification', 'admin\NotificationController@admin_notification');
    Route::post('/notification', 'admin\NotificationController@admin_notification');


    Route::get('/admin_user', 'admin\UsersController@admin_userlist');
    //Route::get('/usernotification', 'UsersController@usernotification');
    Route::get('/usernotification', 'admin\NotificationController@usernotification');
    Route::get('/userlistnotification', 'admin\NotificationController@userlistnotification');
    Route::post('/admin_user', 'admin\UsersController@admin_userlist');
    Route::post('/admin_changeemail', 'admin\UsersController@admin_changeemail');
    Route::post('/admin_changpassword', 'admin\UsersController@admin_changpassword');

    Route::post('/users/create_user', 'admin\UsersController@admin_createuser');
    Route::get('users/add_register_user', ['middleware' => ['role'], 'uses' => 'admin\UsersController@admin_add_register_user']);
    Route::post('/users/create_register_user', 'admin\UsersController@admin_create_register_user');
    Route::post('/users/admin_update_user_status', 'admin\UsersController@admin_update_user_status');
    Route::get('users/delete', ['middleware' => ['role'], 'uses' => 'admin\UsersController@admin_delete']);
    Route::get('users/delete_register', ['middleware' => ['role'], 'uses' => 'admin\UsersController@admin_delete_registeruser']);

    Route::get('/users/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\UsersController@admin_edit']);
    Route::post('/users/edit/{id}', 'admin\UsersController@admin_update');
    Route::get('/users/register_edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\UsersController@register_edit']);
    Route::post('/users/register_edit/{id}', 'admin\UsersController@adminregister_update');

    Route::get('/users/business_edit/{id}', 'admin\UsersController@business_edit');
    Route::post('/users/business_edit/{id}', 'admin\UsersController@adminbusiness_update');
    // Route::get('/queries', 'QueriesController@admin_index');
    Route::get('/queries', ['middleware' => ['role'], 'uses' => 'admin\QueriesController@admin_index']);
    Route::post('/queries', 'admin\QueriesController@admin_index');
    Route::get('/new-queries', 'admin\QueriesController@admin_index_new');
    Route::post('/new-queries', 'admin\QueriesController@admin_index_new');
    Route::get('/queries/admin_delete', 'admin\QueriesController@admin_delete');
    // Route::get('/queries/chat/{id}', 'admin\QueriesController@admin_chat');
    Route::get('/queries/chat/{id}', ['middleware' => ['role'], 'uses' => 'admin\QueriesController@admin_chat']);
    Route::post('/queries/query-respond', 'admin\QueriesController@admin_query_respond');
    /* __________ QueriesController Routes End __________ */

    Route::get('/dashboard', 'admin\UsersController@admin_dashboard');

    Route::post('/categories/check_community', 'admin\CategoriesController@check_is_community');
    Route::post('/categories/set-order', 'admin\CategoriesController@admin_set_order');
    Route::post('/categories/setOrderSave', 'admin\CategoriesController@admin_setOrderSave');

    Route::get('/categories/multi_check_options', 'admin\CategoriesController@admin_multi_check_options');
    Route::get('/categories/allcategories', 'admin\CategoriesController@admin_allcategories');
    Route::post('/classifieds/allclassified', 'admin\ClassifiedController@admin_allclassified');
    //Route::get('/categories/allcategoriesfront', 'admin\CategoriesController@admin_allcategoriesfront');


    Route::get('/resingredients', 'admin\ResingredientsController@admin_index');

    Route::post('/resingredients', 'admin\ResingredientsController@admin_index');


    Route::get('/categories-info', 'admin\CategoriesController@admin_index_info');

    Route::post('/categories-info', 'admin\CategoriesController@admin_index_info');

    Route::get('/categories-info/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\CategoriesController@admin_edit_info']);
    Route::post('/categories-info/update/{id}', 'admin\CategoriesController@admin_update_info');

    Route::get('/categories-info/add', ['middleware' => ['role'], 'uses' => 'admin\CategoriesController@admin_add_info']);
    Route::get('/categories-info/add/{id}', 'admin\CategoriesController@admin_add_info');

    Route::post('/categories-info/create', 'admin\CategoriesController@admin_create_info');

    Route::get('/categories-info/admin_delete', ['middleware' => ['role'], 'uses' => 'admin\CategoriesController@admin_delete_info']);
    Route::get('/categories-info/multi_check_options', 'admin\CategoriesController@admin_multi_check_options_info');



    Route::get('/food_products', 'admin\FoodProductsController@admin_index');

    Route::post('/food_products', 'admin\FoodProductsController@admin_index');

    Route::get('/food_products/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\FoodProductsController@admin_edit']);
    Route::post('/food_products/update/{id}', 'admin\FoodProductsController@admin_update');

    Route::get('/food_products/add', ['middleware' => ['role'], 'uses' => 'admin\FoodProductsController@admin_add']);
    Route::post('/food_products/create', 'admin\FoodProductsController@admin_create');

    Route::get('/food_products/admin_delete', ['middleware' => ['role'], 'uses' => 'admin\FoodProductsController@admin_delete']);
    Route::get('/food_products/multi_check_options', 'admin\FoodProductsController@admin_multi_check_options');


    Route::get('/restricted_ingredients', 'admin\RestrictedIngredientsController@admin_index');

    Route::post('/restricted_ingredients', 'admin\RestrictedIngredientsController@admin_index');

    Route::get('/restricted_ingredients/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\RestrictedIngredientsController@admin_edit']);
    Route::post('/restricted_ingredients/update/{id}', 'admin\RestrictedIngredientsController@admin_update');

    Route::get('/restricted_ingredients/add', ['middleware' => ['role'], 'uses' => 'admin\RestrictedIngredientsController@admin_add']);
    Route::post('/restricted_ingredients/create', 'admin\RestrictedIngredientsController@admin_create');

    Route::get('/restricted_ingredients/admin_delete', ['middleware' => ['role'], 'uses' => 'admin\RestrictedIngredientsController@admin_delete']);
    Route::get('/restricted_ingredients/multi_check_options', 'admin\RestrictedIngredientsController@admin_multi_check_options');

    Route::get('/categories', 'admin\CategoriesController@admin_index');

    Route::post('/categories', 'admin\CategoriesController@admin_index');

    // Route::get('/categories/add', 'admin\CategoriesController@admin_add');
    Route::get('/categories/add', ['middleware' => ['role'], 'uses' => 'admin\CategoriesController@admin_add']);
    Route::get('/categories/add/{id}', 'admin\CategoriesController@admin_add');
    // Route::get('/categories/admin_delete', 'admin\CategoriesController@admin_delete');
    Route::get('/categories/admin_delete', ['middleware' => ['role'], 'uses' => 'admin\CategoriesController@admin_delete']);
//Route::post('/admin/categories/add','admin\CategoriesController@admin_add');

    Route::post('/categories/create', 'admin\CategoriesController@admin_create');
//Route::post('/admin/categories/addsubcat/{id}','admin\CategoriesController@admin_add');
    // Route::get('/categories/edit/{id}', 'admin\CategoriesController@admin_edit');
    Route::get('/categories/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\CategoriesController@admin_edit']);
    Route::post('/categories/update/{id}', 'admin\CategoriesController@admin_update');

    Route::get('/categories/attributes/{id}', 'admin\CategoriesController@admin_get_attributes');

    //Route::get('/categories/{id}', 'admin\CategoriesController@admin_index');
    Route::get('/categories/{id}', ['middleware' => ['role'], 'uses' => 'admin\CategoriesController@admin_index']);
    Route::post('/categories/{id}', 'admin\CategoriesController@admin_index');
    Route::get('/categories/all_categories/{id}', 'admin\CategoriesController@admin_allcategories');


    Route::get('/categories_json', 'admin\CategoriesController@admin_indexmulti');

    Route::get('/categoriesmulti', 'admin\CategoriesController@admin_indexmulti1');



//    Route::get('/attributes/categories_json', 'admin\CategoriesController@admin_indexmulti');
//    Route::get('/attributes/add/categories_json', 'admin\CategoriesController@admin_indexmulti');
//    Route::get('/attributes/edit/categories_json/{string}', 'admin\CategoriesController@admin_indexmulti');


    Route::get('/settings', 'admin\SettingsController@admin_index');
    //Route::get('/settings', [ 'uses' => 'admin\SettingsController@admin_index']);
    Route::get('/settings/add', ['uses' => 'admin\SettingsController@admin_add']);
    Route::post('/settings/create', ['uses' => 'admin\SettingsController@admin_create']);
    Route::get('/settings/edit/{key}', ['uses' => 'admin\SettingsController@admin_edit']);
    Route::post('/settings/update/{key}', ['uses' => 'admin\SettingsController@admin_update']);
    Route::get('/settings/delete/{key}', ['uses' => 'admin\SettingsController@admin_delete']);
    Route::get('/settings/import', ['uses' => 'admin\SettingsController@admin_import']);

    Route::post('/subscriber-lists', 'admin\SubscriberListsController@admin_index');
    Route::get('/subscriber-lists', 'admin\SubscriberListsController@admin_index');
    Route::get('/subscriber_lists/admin_delete', 'admin\SubscriberListsController@admin_delete');
    Route::get('/subscriber_lists/multi_check_options', 'admin\SubscriberListsController@admin_multi_check_options');
    Route::post('/subscriber_lists/admin_update_status', 'admin\SubscriberListsController@admin_update_status');


    Route::get('/groups', ['middleware' => ['role'], 'uses' => 'admin\GroupsController@admin_index']);
    Route::post('/groups', 'admin\GroupsController@admin_index');
    Route::get('/groups/add', ['middleware' => ['role'], 'uses' => 'admin\GroupsController@admin_add']);
    Route::post('/groups/create', 'admin\GroupsController@admin_create');
    Route::get('/groups/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\GroupsController@admin_edit']);
    Route::post('/groups/update/{id}', 'admin\GroupsController@admin_update');
    Route::get('/groups/admin_delete', 'admin\GroupsController@admin_delete');
    Route::get('/groups/multi_check_options', 'admin\GroupsController@admin_multi_check_options');


    Route::get('/membership_plans', ['middleware' => ['role'], 'uses' => 'admin\MembershipPlansController@admin_index']);
    Route::post('/membership_plans', 'admin\MembershipPlansController@admin_index');
    Route::get('/membership_plans/add', ['middleware' => ['role'], 'uses' => 'admin\MembershipPlansController@admin_add']);
    Route::post('/membership_plans/create', 'admin\MembershipPlansController@admin_create');
    Route::get('/membership_plans/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\MembershipPlansController@admin_edit']);
    Route::post('/membership_plans/update/{id}', 'admin\MembershipPlansController@admin_update');
    Route::get('/membership_plans/admin_delete', 'admin\MembershipPlansController@admin_delete');
    Route::get('/membership_plans/multi_check_options', 'admin\MembershipPlansController@admin_multi_check_options');

    Route::get('/promo_codes', ['middleware' => ['role'], 'uses' => 'admin\PromoCodesController@admin_index']);
    Route::post('/promo_codes', 'admin\PromoCodesController@admin_index');
    Route::get('/promo_codes/add', ['middleware' => ['role'], 'uses' => 'admin\PromoCodesController@admin_add']);
    Route::post('/promo_codes/create', 'admin\PromoCodesController@admin_create');
    Route::get('/promo_codes/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\PromoCodesController@admin_edit']);
    Route::post('/promo_codes/update/{id}', 'admin\PromoCodesController@admin_update');
    Route::get('/promo_codes/admin_delete', 'admin\PromoCodesController@admin_delete');
    Route::get('/promo_codes/multi_check_options', 'admin\PromoCodesController@admin_multi_check_options');

    Route::get('/templates', ['middleware' => ['role'], 'uses' => 'admin\TemplatesController@admin_index']);
    Route::post('/templates', 'admin\TemplatesController@admin_index');
    Route::get('/templates/add', ['middleware' => ['role'], 'uses' => 'admin\TemplatesController@admin_add']);
    Route::post('/templates/create', 'admin\TemplatesController@admin_create');
    Route::get('/templates/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\TemplatesController@admin_edit']);
    Route::post('/templates/update/{id}', 'admin\TemplatesController@admin_update');

    Route::get('/orders', ['middleware' => ['role'], 'uses' => 'admin\OrdersController@admin_index']);
    Route::post('/orders', ['middleware' => ['role'], 'uses' => 'admin\OrdersController@admin_index']);

    Route::get('/orders/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\OrdersController@admin_edit']);



    Route::get('/packages', ['middleware' => ['role'], 'uses' => 'admin\PackagesController@admin_index']);
//    Route::post('/packages', 'admin\PackagesController@admin_index');
//    Route::get('/packages/add', ['middleware' => ['role'], 'uses' => 'admin\PackagesController@admin_add']);
//    Route::post('/packages/create', 'admin\PackagesController@admin_create');
    Route::get('/packages/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\PackagesController@admin_edit']);
    Route::post('/packages/update/{id}', 'admin\PackagesController@admin_update');
//    Route::get('/packages/admin_delete', 'admin\PackagesController@admin_delete');
    Route::get('/packages/multi_check_options', 'admin\PackagesController@admin_multi_check_options');

    // Route::get('/classifieds/edit/{id}', 'admin\ClassifiedController@admin_edit');
    Route::get('/classifieds/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\ClassifiedController@admin_edit']);
    Route::get('/classifieds/view/{id}/{viewpage?}', 'admin\ClassifiedController@admin_view');
    Route::get('/classifieds/allstates', 'admin\ClassifiedController@admin_allregins');
    //Route::get('/classifieds', 'admin\ClassifiedController@admin_index');
    Route::get('/classifieds', ['middleware' => ['role'], 'uses' => 'admin\ClassifiedController@admin_index']);
    Route::post('/classifieds', 'admin\ClassifiedController@admin_index');
    //Route::get('/classifieds/add', 'admin\ClassifiedController@admin_add');
    Route::get('/classifieds/add', ['middleware' => ['role'], 'uses' => 'admin\ClassifiedController@admin_add']);
    Route::post('/classifieds/create', 'admin\ClassifiedController@admin_create');
    Route::get('/classifieds/multi_check_options', 'admin\ClassifiedController@admin_multi_check_options');
//    Route::post('/classifieds/update/{id}', 'admin\ClassifiedController@admin_update');
    Route::post('/classifieds/update', 'admin\ClassifiedController@admin_update');
    //Route::get('/classifieds/admin_delete', 'admin\ClassifiedController@admin_delete');
    Route::get('/classifieds/admin_delete', ['middleware' => ['role'], 'uses' => 'admin\ClassifiedController@admin_delete']);
    Route::get('/approve/admin_delete', 'admin\ClassifiedController@admin_delete_approve');
    Route::get('/reject/admin_delete', 'admin\ClassifiedController@admin_delete_reject');
    //Route::get('/classifieds/approve', 'admin\ClassifiedController@admin_approve');
    Route::get('/classifieds/approve', ['middleware' => ['role'], 'uses' => 'admin\ClassifiedController@admin_approve']);
    Route::post('/classifieds/approve', 'admin\ClassifiedController@admin_approve');
    Route::post('/classifieds/approved_submit', 'admin\ClassifiedController@admin_approved_submit');
    Route::post('/classifieds/approved_submit_reject', 'admin\ClassifiedController@admin_approved_submitfromreject');
    Route::post('/classifieds/export', 'admin\ClassifiedController@admin_export_classified');
    Route::get('/classifieds/export', 'admin\ClassifiedController@admin_export_classified');
    Route::post('/classifieds/export-unapprove', 'admin\ClassifiedController@admin_export_unapprove_classified');
    Route::get('/classifieds/export-unapprove', 'admin\ClassifiedController@admin_export_unapprove_classified');
    Route::get('/classifieds/export-approve', 'admin\ClassifiedController@admin_export_approve_classified');
    Route::post('/classifieds/export-approve', 'admin\ClassifiedController@admin_export_approve_classified');
    Route::post('/classifieds/delete-attachment', 'admin\ClassifiedController@admin_delete_attachment');
    //Route::get('/classifieds/reject', 'admin\ClassifiedController@admin_reject');
    Route::get('/classifieds/reject', ['middleware' => ['role'], 'uses' => 'admin\ClassifiedController@admin_reject']);
    Route::post('/classifieds/reject', 'admin\ClassifiedController@admin_reject');
    Route::post('/classifieds/delete-image-gallery', 'admin\ClassifiedController@admin_delete_gallery');
    Route::get('/classifieds/deactivate/{id}', 'admin\ClassifiedController@deactivate_classified');
    Route::get('/classifieds/actv-classified', 'admin\ClassifiedController@activate_classified');
    Route::post('/classifieds/attr_list', 'admin\ClassifiedController@admin_attributes');
    Route::post('/classifieds/allparrentattributevalues', 'admin\ClassifiedController@admin_allparrentattributevalues');

    Route::get('/food_products/export_food', 'admin\FoodProductsController@admin_export_food');


    Route::post('/newsletters', 'admin\NewslettersController@admin_index');
    Route::get('/newsletters', 'admin\NewslettersController@admin_index');
    Route::post('/newsletters/create', 'admin\NewslettersController@admin_create');
    //Route::get('/newsletters/create', 'admin\NewslettersController@admin_create');
    Route::get('/newsletters/create', ['middleware' => ['role'], 'uses' => 'admin\NewslettersController@admin_create']);
    Route::post('/newsletters/edit/{id}', 'admin\NewslettersController@admin_edit');
    Route::get('/newsletters/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\NewslettersController@admin_edit']);
//    Route::get('/newsletters/edit/{id}', 'admin\NewslettersController@admin_edit');
    //Route::get('/newsletters/admin_delete', 'admin\NewslettersController@admin_delete');
    Route::get('/newsletters/admin_delete', ['middleware' => ['role'], 'uses' => 'admin\NewslettersController@admin_delete']);
    Route::post('/newsletters/load-template', 'admin\NewslettersController@load_newsletter_template');
    Route::post('/newsletters/delete-attachment', 'admin\NewslettersController@admin_delete_attachment');


    // Route::get('/attributes/admin_delete', 'admin\AttributesController@admin_delete');
    Route::get('/attributes/admin_delete', ['middleware' => ['role'], 'uses' => 'admin\AttributesController@admin_delete']);

    Route::get('/attributes/multi_check_options', 'admin\AttributesController@admin_multi_check_options');
    Route::get('/attributes/allattributes', 'admin\AttributesController@admin_allattributes');
    Route::post('/attributes/allchildattributes', 'admin\AttributesController@admin_allchildattributes');
    Route::post('/attributes/admin_update_attribute_status', 'admin\AttributesController@admin_update_attribute_status');
//    Route::post('/attributes/allparrentattributevalues', 'admin\AttributesController@admin_allparrentattributevalues');

    Route::post('/attributes/generate_csv', 'admin\AttributesController@admin_generate_csv');
    Route::post('/attributes/import_csv', 'admin\AttributesController@admin_import_csv');
    Route::post('/attributes/import_csv_food', 'admin\AttributesController@admin_import_csv_food');
    Route::get('/attributes/generate_csv_food', 'admin\AttributesController@admin_generate_csv_food');
//    Route::post('/attributes/import_csv', 'admin\AttributesController@admin_import_csv');

//    Route::match(array('PUT', 'POST'), "/attributes/attr_list", array(
//      'uses' => 'admin\AttributesController@admin_attr_list'
//));
    //  Route::get('/attributes/attr_list', 'admin\AttributesController@admin_attr_list');

    Route::get('/attributes', 'admin\AttributesController@admin_index');
    Route::post('/attributes', 'admin\AttributesController@admin_index');

    //Route::get('/attributes/add', 'admin\AttributesController@admin_add');
    Route::get('/attributes/add', ['middleware' => ['role'], 'uses' => 'admin\AttributesController@admin_add']);
    Route::get('/attributes/add/{id}', 'admin\AttributesController@admin_add');

    Route::post('/attributes/showvalue', 'admin\AttributesController@admin_showvalue');
    Route::post('/attributes/create', 'admin\AttributesController@admin_create');

    //Route::get('/attributes/edit/{id}', 'admin\AttributesController@admin_edit');
    Route::get('/attributes/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\AttributesController@admin_edit']);
    Route::post('/attributes/update/{id}', 'admin\AttributesController@admin_update');

    Route::get('/attributes/{id}', 'admin\AttributesController@admin_index');
    Route::post('/attributes/{id}', 'admin\AttributesController@admin_index');
    //Route::get('/attributes/{id}/{categories}', 'admin\AttributesController@admin_categorydetail');
    Route::get('/attributes/{id}/{categories}', ['middleware' => ['role'], 'uses' => 'admin\AttributesController@admin_categorydetail']);



    Route::get('/feeds', 'admin\FeedsController@admin_index');
    Route::post('/feeds', 'admin\FeedsController@admin_index');
    Route::post('/feeds/add', 'admin\FeedsController@admin_add');
    //Route::get('/feeds/add', 'admin\FeedsController@admin_add');
    Route::get('/feeds/add', ['middleware' => ['role'], 'uses' => 'admin\FeedsController@admin_add']);
    Route::post('/feeds/edit/{id}', 'admin\FeedsController@admin_edit');
    // Route::get('/feeds/edit/{id}', 'admin\FeedsController@admin_edit');
    Route::get('/feeds/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\FeedsController@admin_edit']);
    //Route::get('/feeds/admin_delete', 'admin\FeedsController@admin_delete');
    Route::get('/feeds/admin_delete', ['middleware' => ['role'], 'uses' => 'admin\FeedsController@admin_delete']);
    Route::post('/feeds/admin_update_feed_home_status', 'admin\FeedsController@admin_update_feed_home_status');
    Route::get('/feeds/multi_check_options', 'admin\FeedsController@admin_multi_check_options');

    //classified spam reports routes
    Route::get('/reports', 'admin\ReportsController@admin_index');
    Route::post('/reports', 'admin\ReportsController@admin_index');

    Route::post('/prayer-timings', 'admin\QueriesController@admin_index');
    Route::get('/prayer-timings', 'admin\QueriesController@admin_index');
    Route::post('/prayer_timings/admin_update_default_status', 'admin\QueriesController@admin_update_default_status');
    Route::post('/prayer_timings/admin_update_status', 'admin\QueriesController@admin_update_status');


    Route::get('/advertisements', ['middleware' => ['role'], 'uses' => 'admin\AdvertisementsController@admin_index']);
    Route::post('/advertisements', 'admin\AdvertisementsController@admin_index');
    Route::post('/advertisements/add', 'admin\AdvertisementsController@admin_add');
    Route::get('/advertisements/add', ['middleware' => ['role'], 'uses' => 'admin\AdvertisementsController@admin_add']);
    Route::post('/advertisements/edit/{id}', 'admin\AdvertisementsController@admin_edit');
    Route::get('/advertisements/edit/{id}', ['middleware' => ['role'], 'uses' => 'admin\AdvertisementsController@admin_edit']);
    Route::get('/advertisements/admin_delete', ['middleware' => ['role'], 'uses' => 'admin\AdvertisementsController@admin_delete']);
    Route::post('/advertisements/check-availability', 'admin\AdvertisementsController@check_ad_availability');
    Route::post('/advertisements/delete-attachment', 'admin\AdvertisementsController@admin_delete_attachment');
    Route::post('/advertisements/set-order', 'admin\AdvertisementsController@admin_set_order');
    Route::get('/advertisements/multi_check_options', 'admin\AdvertisementsController@admin_multi_check_options');
    Route::post('/advertisements/get-positions', 'admin\AdvertisementsController@get_active_ad_positions');

    Route::get('/corporates', ['uses' => 'admin\RoleController@corporates']);
    Route::post('/corporates', ['uses' => 'admin\RoleController@corporates']);
    Route::get('roles/add_corporate', 'admin\RoleController@add_corporate');
    Route::post('roles/create_corporate', 'admin\RoleController@create_corporate');
    Route::get('roles/edit_corporate/{id}', ['uses' => 'admin\RoleController@edit_corporate', 'middleware' => ['role']]);
    Route::post('roles/corporate_update/{id}', 'admin\RoleController@corporate_update');

    Route::post('roles/create', 'admin\RoleController@store');
    Route::get('/roles', ['uses' => 'admin\RoleController@index']);
    Route::post('/roles', ['uses' => 'admin\RoleController@index']);
    Route::get('roles/create', ['uses' => 'admin\RoleController@create', 'middleware' => ['role']]);
    Route::post('roles/{id}', 'admin\RoleController@update');
    Route::get('roles/{id}', ['uses' => 'admin\RoleController@show', 'middleware' => ['role']]);
    Route::get('roles/edit/{id}', ['uses' => 'admin\RoleController@edit', 'middleware' => ['role']]);

    Route::post('/cancel-pp-profile', 'admin\UsersController@cancel_pp_profile');

    Route::post('roles/delete/{id}', ['uses' => 'admin\RoleController@destroy', 'middleware' => ['role']]);
    //Route::get('/roles', [ 'middleware' => ['permission:role-list|role-create|role-edit|role-delete'], 'uses' => 'admin\RoleController@index']);
    // Route::get('roles/create', ['uses' => 'admin\RoleController@create', 'middleware' => ['permission:role-create']]);
    // Route::post('roles/create', ['uses' => 'admin\RoleController@store', 'middleware' => ['permission:role-create']]);
    // Route::get('roles/{id}', ['uses' => 'admin\RoleController@show']);
    // Route::get('roles/edit/{id}', ['uses' => 'admin\RoleController@edit', 'middleware' => ['permission:role-edit']]);
    // Route::Post('roles/{id}', ['uses' => 'admin\RoleController@update', 'middleware' => ['permission:role-edit']]);
    //Route::post('roles/delete/{id}', ['uses' => 'admin\RoleController@destroy', 'middleware' => ['permission:role-delete']]);
    //Site Reports route
    Route::post('/site-reports', 'admin\SiteReportsController@admin_index');
    Route::post('/site-reports/post-categorygraph', 'admin\SiteReportsController@generatereportcategorypost');
    Route::post('/site-reports/view-categorygraph', 'admin\SiteReportsController@generatereportcategoryview');
    Route::post('/site-reports/generatereport', 'admin\SiteReportsController@getreportdata');
    Route::get('/site-reports', 'admin\SiteReportsController@admin_index');

    Route::get('/addcms', 'admin\CmsController@admin_addcms');
    Route::get('/cms', 'admin\CmsController@admin_list');
    //Route::post('/admin_cms', 'admin\UsersController@admin_cms');
    Route::post('/createcms', 'admin\CmsController@admin_create');
    Route::get('cms/edit/{id}', 'admin\CmsController@admin_edit');
    Route::post('/cms/edit/{id}', 'admin\CmsController@admin_update');
    Route::get('/cms/delete', 'admin\CmsController@admin_delete');
    Route::get('/faqcategorylist', 'admin\FaqcategoryController@faqcategorylist');
    Route::get('/addfaqcategory', 'admin\FaqcategoryController@addfaqcategory');
    Route::post('/createfaqcategory', 'admin\FaqcategoryController@createfaqcategory');
    Route::get('faq/edit/{id}', 'admin\FaqcategoryController@editfaqcategory');
    Route::post('/faq/edit/{id}', 'admin\FaqcategoryController@updatefaqcategory');
    Route::get('/faq/delete', 'admin\FaqcategoryController@admin_delete');
    Route::get('/faqlist', 'admin\FaqController@faqlist');
    Route::get('/addfaqlist', 'admin\FaqController@addfaqlist');
    Route::post('/createfaqlist', 'admin\FaqController@createfaqlist');
    Route::get('faqlist/edit/{id}', 'admin\FaqController@editfaqlist');
    Route::post('/faqlist/edit/{id}', 'admin\FaqController@updatefaqlist');
    Route::get('/faqlist/delete', 'admin\FaqController@admin_delete');
    Route::get('/reviews', 'admin\ReviewsController@admin_index');
    Route::post('/reviews', 'admin\ReviewsController@admin_index');
    Route::get('/reviews/view/{id}', 'admin\ReviewsController@admin_view');
    Route::post('/reviews/admin_update', 'admin\ReviewsController@admin_update');
    Route::get('/reviews/multi_check_options', 'admin\ReviewsController@admin_multi_check_options');
});


//Route::group(['prefix' => 'user'], function () {
Route::group(['middleware' => ['user', 'seller'], 'prefix' => 'user'], function () {

//    Route::get('/dashboard', 'front\HomeController@web_dashboard');
    Route::post('/classifieds/changestatus', 'front\ClassifiedController@frontchangestatus');
//    Route::post('/dashboard', 'front\HomeController@web_dashboard');
    Route::get('/post-classified_222', 'front\ClassifiedController@index_222');
    Route::get('/post-classified', 'front\ClassifiedController@index');
    Route::get('/categories/allcategoriesfront', 'front\CategoriesController@admin_allcategoriesfront');
    Route::get('/attributes/allattributes', 'front\AttributesController@admin_allattributes');
    Route::get('/classifieds/allstates', 'front\ClassifiedController@admin_allregins');
    Route::post('/classifieds/create', 'front\ClassifiedController@create');
    Route::post('/classifieds/update', 'front\ClassifiedController@update');
    Route::post('/classifieds/update_business_post', 'front\ClassifiedController@update_business_post');
    Route::post('/classifieds/delete_questions', 'front\ClassifiedController@delete_questions');
    Route::post('/classifieds/delete_others', 'front\ClassifiedController@delete_others');
    Route::get('/edit-post/{id}', 'front\ClassifiedController@edit');
    Route::get('/edit_business_post/{id}', 'front\ClassifiedController@edit_business_post');
    Route::post('/classifieds/send_msg_popup', 'front\ClassifiedController@send_msg_popup');
    Route::post('/classifieds/delete-image-gallery-front', 'front\ClassifiedController@admin_delete_gallery_front');
    Route::post('/classifieds/delete', 'front\ClassifiedController@delete');
    Route::post('/classifieds/deletenomsg', 'front\ClassifiedController@deletenomsg');

    Route::post('/classifieds/preview_detail_post', 'front\ClassifiedController@preview_detail_post');
    Route::post('/classifieds/final_submit_post', 'front\ClassifiedController@final_submit_post');
    Route::post('/classifieds/business_create', 'front\ClassifiedController@business_create');
    Route::post('/classifieds/private_post_create', 'front\ClassifiedController@private_post_create');
    Route::post('/classifieds/add_review', 'front\ClassifiedController@add_review');

    Route::post('/classifieds/final_submit_post_private', 'front\ClassifiedController@final_submit_post_private');
    Route::get('/classifieds/private_post_paypal_success', 'front\ClassifiedController@private_post_paypal_success');

    Route::post('/attributes/allchildattributes', 'front\AttributesController@admin_allchildattributes');
    Route::get('/classifieds', 'front\UsersController@user_classified');
    Route::post('/classifieds', 'front\UsersController@user_classified');
    Route::get('/profile', 'front\UsersController@user_profile');
    Route::post('/profile', 'front\UsersController@user_profile');
    Route::post('/update-profile', 'front\UsersController@user_profile');
    Route::post('/update_mobile', 'front\UsersController@update_mobile');
    Route::post('/update_uniquemobile', 'front\UsersController@update_uniquemobile');
    Route::post('/enterotp', 'front\UsersController@enterotp');
    Route::post('/checkotp', 'front\UsersController@checkotp');
    Route::post('/update-subscription', 'front\UsersController@user_update_subscription');
    Route::post('/messages/all_message_chat', 'front\MessagesController@all_message_chat');
    Route::post('/messages/delete_message_check', 'front\MessagesController@delete_message_check');
    Route::post('/messages/deletenomsg', 'front\MessagesController@deletenomsg');
    Route::post('/messages/send_message_chat', 'front\MessagesController@send_message_chat');
    Route::post('/messages/all_message', 'front\MessagesController@all_message');
    Route::post('/messages/count_for_tabs', 'front\MessagesController@count_for_tabs');
    Route::post('/messages/create', 'front\MessagesController@create');
    Route::get('/messages', 'front\MessagesController@index');
    Route::post('/messages', 'front\MessagesController@index');

    Route::post('/cancel-pp-profile', 'front\UsersController@cancel_pp_profile');
    Route::post('/update-pp-email', 'front\UsersController@update_pp_email');

    Route::get('/notification', 'front\UsersController@notification');

    Route::get('/checkout_1', 'front\CartController@cartlist_checkout');
    Route::post('/checkout_2', 'front\CartController@cartlist_checkout2');
    Route::post('/checkout_3', 'front\CartController@cartlist_checkout3');
//    Route::get('/cartlist_checkout3_111', 'front\CartController@cartlist_checkout3_111');
    Route::post('/paypal_process', 'front\CartController@paypal_process');
    Route::get('/cart-paypal-cancel', 'front\CartController@cart_paypal_cancel');
    Route::get('/cart-paypal-success', 'front\CartController@cart_paypal_success');
    //Route::post('/cart-paypal-success', 'front\CartController@cart_paypal_success');

    Route::get('/picknpay_1', 'front\CartController@picknpay_1');
    Route::get('/picknpay_2', 'front\CartController@picknpay_2');
    Route::post('/picknpay_2', 'front\CartController@picknpay_2');
    Route::get('/picknpay_3/{id}', 'front\CartController@picknpay_3');
    Route::post('/picknpay_3/{id}', 'front\CartController@picknpay_3');
    Route::get('/picknpay_4/{id}', 'front\CartController@picknpay_4');

    Route::get('/leads/view/{id}', 'front\MessagesController@leadsdetail');
    Route::post('/leads/view/{id}', 'front\MessagesController@leadsdetail');
    //Route::get('/leads/{id}', 'front\MessagesController@leadsindex');
    Route::get('/leads', 'front\MessagesController@leadsindex');
    Route::post('/leads', 'front\MessagesController@leadsindex');

    Route::get('/jobapplications', 'front\MessagesController@jobsindex');
	Route::get('/jobapplications/{id}', 'front\MessagesController@jobsindexfromAd');
    Route::get('/jobapplications/view/{id}', 'front\MessagesController@jobsdetail');
    Route::post('/jobapplications/view/{id}', 'front\MessagesController@jobsdetail');


    Route::get('/orders', 'front\UsersController@ordersindex');
    Route::get('/orders/view/{id}/{subId}', 'front\UsersController@ordersdetail');
    Route::post('/orders/view/{id}/{subId}', 'front\UsersController@ordersdetail');

    Route::get('/sales', 'front\UsersController@salesindex');
	Route::get('/sales/{id}', 'front\UsersController@salesindexfromAd');
    Route::get('/sales/view/{id}/{OrderId}', 'front\UsersController@salesdetail');
    Route::post('/sales/view/{id}/{OrderId}', 'front\UsersController@salesdetail');


    Route::get('/saved-searches', 'front\SavedSearchesController@index');
    Route::post('/saved-searches', 'front\SavedSearchesController@index');
    Route::get('/managed-ads', 'front\UsersController@user_classified');
    Route::post('/managed-ads', 'front\UsersController@user_classified');
    Route::get('/wishlist', 'front\WishlistsController@index');
    Route::post('/save-search', 'front\SavedSearchesController@save_search');
    Route::get('/delete-save-search/{id}', 'front\SavedSearchesController@delete_saved_search');
    Route::post('/classifieds/delete-attachment', 'front\ClassifiedController@front_delete_attachment');

    Route::get('/business-post-ad', 'front\ClassifiedController@business_post_ad1');
    Route::get('/business_post_ad', 'front\ClassifiedController@business_post_ad');
    Route::get('/automotive_detail', 'front\ClassifiedController@automotive_detail');
    Route::get('/real_estate_detail', 'front\ClassifiedController@real_estate_detail');
    Route::get('/home_garden_detail', 'front\ClassifiedController@home_garden_detail');
    Route::get('/baby_detail', 'front\ClassifiedController@baby_detail');
    Route::get('/complete_html', 'front\ClassifiedController@complete_html');
    Route::get('/job_listing', 'front\ClassifiedController@job_listing');
    Route::get('/real_estate_listing', 'front\ClassifiedController@real_estate_listing');
    Route::get('/job_detail', 'front\ClassifiedController@job_detail');
    Route::get('/job_detail1', 'front\ClassifiedController@job_detail1');
    Route::get('/job_detail2', 'front\ClassifiedController@job_detail2');
    Route::get('/dashboard', 'front\UsersController@dashboard');
    Route::get('/manageuser', 'front\UsersController@manageuser');
    Route::post('/promo_codes/apply_promo', 'admin\PromoCodesController@apply_promo');
    Route::post('/cart/save_user_address', 'front\CartController@save_user_address');
    Route::post('/cart/delete_user_address', 'front\CartController@delete_user_address');
});
