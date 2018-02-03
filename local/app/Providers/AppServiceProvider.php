<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cookie;
use App\models\Classified;
use App\models\SubscriberList;
use App\models\Category;
use App\models\Cms;
use App\models\Message;
use App\models\Query;
use App\models\SiteReport;
use App\models\User;
use App\models\Classes\PrayTime;
use Auth;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        if (\Schema::hasTable('classifieds')) {
            // Your super fun database stuff

            $frontcookie = Cookie::get('front');
            if (!empty($frontcookie)) {
                $decript = \Crypt::decrypt($frontcookie);
                view()->share('frontcookie', $decript);
            } else {
                view()->share('frontcookie', '');
            }
            $classified = new Classified;
            $task = new Category;
            $cms = new Cms;
            $SubscriberList = new SubscriberList;
            //   SubscriberList
//        $message = new Message;
//        dd(Auth::guard('web'));
//        $messagecount = $message->count_for_header();
//        $messagecount = '';
            //dd($messagecount);

            $classifiedcount = $classified->get_classifidscount();
            view()->share(['classifiedcount' => $classifiedcount]);

            $subscribercount = $SubscriberList->get_subscribercount();
            view()->share(['subscribercount' => $subscribercount]);

            $queryObj = new Query;
            $total_unread_queries = $queryObj->get_unread_queries();
            view()->share(['total_unread_queries' => $total_unread_queries]);

            $cms = new Cms;
            $cmsdata = $cms->get_allcms();
            view()->share(['cmsdata' => $cmsdata]);

            $repoart = new SiteReport;
            $mostpostedrepoartata = $repoart->getmostpostedclassified();
            view()->share(['mostpostedrepoartata' => $mostpostedrepoartata]);

            $current_date = date("Y-m-d");
            $feactured_category = Category::where('pid', 0)->where('feactured', 1)->where("status", "=", 1)->orderBy('created_at', 'DESC')->get();
            $selectedCategories = null;
            $task = new Category;
            $selectedCategories = explode(',', $selectedCategories);
            $allSubCategories = $task->getFrontCategories($selectedCategories);
            $allComCategories = $task->getFrontComCategories($selectedCategories);

            $allSubCategoriesForMenu = $task->getFrontCategoriesForMenuheader($selectedCategories);

            $footerCategories = $task->getFooterCategories();

            $informationAreaCategories = $task->getInformationAreaCategories($selectedCategories);
            view()->share(['feactured_category' => $feactured_category, 'allSubCategories' => $allSubCategories, 'allComCategories' => $allComCategories, 'allSubCategoriesForMenu' => $allSubCategoriesForMenu, 'informationAreaCategories' => $informationAreaCategories, 'footerCategories' => $footerCategories]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
