<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');
// Route::get('/user', function (Request $request) {
//     //return $request->user();
//     dd('Api is call');
// });
//Route::get('/api','HomeController@api');
//Route::get('/api_auth', function (Request $request) {
//   return $request->user();
// })->middleware('auth:api');
// Route::get('/orders', function (Request $request) {
//     if ($request->user()->tokenCan('place-orders')) {
//         //
//     }
// });

Route::group(['middleware' => ['api2']], function ()
{
//Route::group(['middleware' => ['api']], function () {

Route::get('/check', 'HomeController@apicheck');
Route::get('/test', 'UsersController@api');
Route::POST('login', 'UsersController@apilogin');
Route::POST('forgotpassword', 'UsersController@apiforgotpassword');
Route::POST('changepassword', 'UsersController@changepasswordapi');
Route::POST('userdetail', 'UsersController@getuserdetail');
Route::POST('registration', 'UsersController@apiregistration');
Route::POST('most_viewed_classifieds', 'ClassifiedController@get_classified_viewedapi');
Route::POST('most_recent_classifieds', 'ClassifiedController@get_classified_recentapi');
Route::GET('most_recent_classifieds1', 'ClassifiedController@get_classified_recentapi1');
Route::POST('allcity', 'ClassifiedController@getallcityapi');
Route::POST('allcategories', 'ClassifiedController@getcategoriesforapi');
Route::POST('allsubcategories', 'ClassifiedController@getsubcategoriesforapi');
Route::POST('classified-list', 'ClassifiedController@classified_listpageapi');
Route::POST('classifiedinformation_list', 'ClassifiedController@classified_listinformationpageapi');
Route::POST('halalproduct_list', 'ClassifiedController@halalproduct_listapi');
Route::GET('halalproduct_categoryname', 'ClassifiedController@halalproduct_categoryname');
Route::POST('halalproduct_scan', 'ClassifiedController@halalproduct_scanapi');
Route::POST('classified_allinformation_list', 'ClassifiedController@classified_list_allinformationpageapi');
Route::POST('classified-detail', 'ClassifiedController@classified_detailpageapi');
Route::POST('classified_show', 'ClassifiedController@classified_detailpageapinew');
Route::POST('classifieduserinformation', 'ClassifiedController@classifieduserinformapi');
Route::POST('addwishlist', 'ClassifiedController@addwishlist');
Route::POST('addwishlistmultiple', 'ClassifiedController@addwishlistmultiple');
Route::POST('removewishlist', 'ClassifiedController@removewishlist');
Route::POST('allwishclassifiedlist', 'WishlistsController@allwishclassifiedlistapi');
Route::POST('showallattributes', 'AttributesController@showallattributeapi');
Route::POST('showallattributeschildren', 'AttributesController@showallchildattributesapi');
Route::POST('categoriestabledata', 'ClassifiedController@getcategoriestableforapi');
Route::POST('classifiedtabledata', 'ClassifiedController@getclassifiedtableforapi');
Route::POST('addclassified', 'ClassifiedController@classifiedcreateapi');
Route::POST('changemobileno', 'UsersController@changemobilenoapi');
Route::POST('changeemail', 'UsersController@changeemailapi');
Route::POST('changeprofile', 'UsersController@changeprofileapi');
Route::POST('changecontactaddress', 'UsersController@changecontactaddressapi');
Route::POST('defalultactiveprayertiming', 'PrayerTimingsController@defalultactiveprayertimingapi');
Route::GET('getprayertimingfillterdata', 'PrayerTimingsController@getprayertimingfillterdata');
Route::POST('savesearchlist', 'SavedSearchesController@savesearchlistapi');
Route::POST('delete_saved_searchapi', 'SavedSearchesController@delete_saved_searchapi');
Route::POST('send_msg_api', 'ClassifiedController@send_msg_api');
Route::POST('send_msg_apioffline', 'ClassifiedController@send_msg_apioffline');
Route::POST('send_msg_api_message', 'ClassifiedController@send_msg_api_message');
Route::POST('offermessageapi', 'MessagesController@createmessageofferapi');
Route::POST('offermessageapi_message', 'MessagesController@createmessageoffermessageapi');
Route::POST('chatmessageapi', 'MessagesController@chatmessageapi');
Route::POST('sendallsellerchat', 'MessagesController@sendallsellerchat');
Route::POST('sendallchatconversion', 'MessagesController@sendallchatconversion');
Route::POST('testpuchiphone', 'MessagesController@testpuchiphone');
Route::POST('reportclassified', 'ReportsController@reportclassifiedapi');
Route::POST('addmanagmenttab', 'UsersController@addmanagmenttabapi');
Route::POST('frontclassifiedchangestatus', 'ClassifiedController@frontchangestatusapi');
Route::POST('frontclassifieddelete', 'ClassifiedController@deleteclassifiedapi');
Route::POST('get_all_classifiedswithname', 'ClassifiedController@get_all_classifiedswithnameapi');
Route::POST('get_all_classifiedssearchbyname', 'ClassifiedController@get_all_classifiedssearchbynameapi');
Route::POST('get_all_classifiedbyfilter', 'ClassifiedController@get_all_classifiedbyfilterapi');
Route::POST('save_searchapi', 'SavedSearchesController@save_searchapi');
Route::POST('searchlistupdatestatus', 'SavedSearchesController@searchlistupdatestatusapi');
Route::POST('editclassified', 'ClassifiedController@editclassified_api');
Route::POST('updateclassified', 'ClassifiedController@updateapi');
Route::POST('front_delete_attachment', 'ClassifiedController@front_delete_attachmentapi');
Route::POST('getallnotification', 'MessagesController@getallnotificationapi');
Route::POST('contactquery', 'CmsController@contactapi');
// Route::POST('sendallchatconversion', 'MessagesController@sendallchatconversion');
});

