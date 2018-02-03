<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AttributeTypesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
//        $this->call(AdvertisementsTableSeeder::class);
//        $this->call(AdvertisementAttachmentsTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(AttributeCategoryTableSeeder::class);
        $this->call(AttributeValueTableSeeder::class);
        $this->call(AttributeValueChildTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
//        $this->call(CategoryDeletedTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
//        $this->call(ClassifiedsTableSeeder::class);
//        $this->call(ClassifiedimageTableSeeder::class);
//        $this->call(AttributeClassifiedTableSeeder::class);
        $this->call(CmsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(FaqCategoriesTableSeeder::class);
        $this->call(FeedsTableSeeder::class);
        $this->call(FeedCategoriesTableSeeder::class);
//        $this->call(MessagesTableSeeder::class);
        $this->call(NewslettersTableSeeder::class);
        $this->call(NewsletterAttachmentsTableSeeder::class);
//        $this->call(NewsletterSubscribersTableSeeder::class);
//        $this->call(NotificationTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(PrayerTimingsTableSeeder::class);
//        $this->call(QueriesTableSeeder::class);
//        $this->call(QueryRespondsTableSeeder::class);
//        $this->call(ReportsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
//        $this->call(RoleUserTableSeeder::class);
//        $this->call(SavedSearchesTableSeeder::class);
//        $this->call(SiteVisitorsTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(SubregionsTableSeeder::class);
//        $this->call(SubscriberListsTableSeeder::class);
//        $this->call(WishlistsTableSeeder::class);
        $this->call(TemplatesTableSeeder::class);
        $this->call(PackagesTableSeeder::class);
    }
}
