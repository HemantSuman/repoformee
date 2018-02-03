<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 9,
                'name' => 'admin_add',
                'display_name' => 'Add Category ',
                'controler_name' => 'CategoriesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 10,
                'name' => 'admin_edit',
                'display_name' => 'Edit Category',
                'controler_name' => 'CategoriesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 11,
                'name' => 'admin_delete',
                'display_name' => 'Delete Category',
                'controler_name' => 'CategoriesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 13,
                'name' => 'admin_index',
                'display_name' => 'View Subcategory ',
                'controler_name' => 'CategoriesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 14,
                'name' => 'admin_add',
                'display_name' => 'Add Attribute',
                'controler_name' => 'AttributesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 16,
                'name' => 'admin_edit',
                'display_name' => 'Edit Attribute',
                'controler_name' => 'AttributesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 17,
                'name' => 'admin_delete',
                'display_name' => 'Delete Attribute',
                'controler_name' => 'AttributesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 18,
                'name' => 'admin_categorydetail',
                'display_name' => 'View Category / Subcategory',
                'controler_name' => 'AttributesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 19,
                'name' => 'admin_add',
                'display_name' => 'Add Classified ',
                'controler_name' => 'ClassifiedController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 20,
                'name' => 'admin_edit',
                'display_name' => 'Edit Classified ',
                'controler_name' => 'ClassifiedController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 21,
                'name' => 'admin_delete',
                'display_name' => 'Delete Classified ',
                'controler_name' => 'ClassifiedController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 22,
                'name' => 'admin_approve',
                'display_name' => 'Approve Classified ',
                'controler_name' => 'ClassifiedController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 23,
                'name' => 'admin_reject',
                'display_name' => 'Reject Classified ',
                'controler_name' => 'ClassifiedController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 24,
                'name' => 'admin_index',
                'display_name' => 'View Classified ',
                'controler_name' => 'ClassifiedController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 25,
                'name' => 'admin_add',
                'display_name' => 'Add Advertisement ',
                'controler_name' => 'AdvertisementsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 26,
                'name' => 'admin_edit',
                'display_name' => 'Edit Advertisement ',
                'controler_name' => 'AdvertisementsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 27,
                'name' => 'admin_delete',
                'display_name' => 'Delete Advertisement ',
                'controler_name' => 'AdvertisementsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 28,
                'name' => 'admin_index',
                'display_name' => 'View Advertisement ',
                'controler_name' => 'AdvertisementsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 29,
                'name' => 'admin_add',
                'display_name' => 'Add New Feed ',
                'controler_name' => 'FeedsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 30,
                'name' => 'admin_edit',
                'display_name' => 'Edit Feed ',
                'controler_name' => 'FeedsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 31,
                'name' => 'admin_delete',
                'display_name' => 'Delete Feed ',
                'controler_name' => 'FeedsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 32,
                'name' => 'admin_create',
                'display_name' => 'Add Newsletter ',
                'controler_name' => 'NewslettersController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 33,
                'name' => 'admin_edit',
                'display_name' => 'Edit Newsletter ',
                'controler_name' => 'NewslettersController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 34,
                'name' => 'admin_delete',
                'display_name' => 'Delete Newsletter ',
                'controler_name' => 'NewslettersController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 35,
                'name' => 'admin_add_register_user',
                'display_name' => 'Add  Register User ',
                'controler_name' => 'UsersController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 36,
                'name' => 'register_edit',
                'display_name' => 'Edit Register User ',
                'controler_name' => 'UsersController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 37,
                'name' => 'admin_delete_registeruser',
                'display_name' => 'Delete Register User ',
                'controler_name' => 'UsersController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 38,
                'name' => 'create',
                'display_name' => 'Add New Role ',
                'controler_name' => 'RoleController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 39,
                'name' => 'edit',
                'display_name' => 'Edit Role ',
                'controler_name' => 'RoleController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 40,
                'name' => 'destroy',
                'display_name' => 'Delete Role ',
                'controler_name' => 'RoleController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 41,
                'name' => 'admin_index',
                'display_name' => 'view Inbox / Support Tickets',
                'controler_name' => 'QueriesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 42,
                'name' => 'admin_chat',
                'display_name' => 'Reply view Inbox / Support Tickets',
                'controler_name' => 'QueriesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 43,
                'name' => 'admin_adduser',
                'display_name' => 'Add  Admin User ',
                'controler_name' => 'UsersController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 44,
                'name' => 'admin_edit',
                'display_name' => 'Edit Admin User ',
                'controler_name' => 'UsersController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 45,
                'name' => 'admin_delete',
                'display_name' => 'Delete  Admin User ',
                'controler_name' => 'UsersController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 46,
                'name' => 'admin_index_info',
                'display_name' => 'View Information Category ',
                'controler_name' => 'CategoriesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 47,
                'name' => 'admin_add_info',
                'display_name' => 'Add Information Category ',
                'controler_name' => 'CategoriesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 48,
                'name' => 'admin_edit_info',
                'display_name' => 'Edit Information Category',
                'controler_name' => 'CategoriesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 49,
                'name' => 'admin_delete_info',
                'display_name' => 'Delete Information Category',
                'controler_name' => 'CategoriesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 50,
                'name' => 'admin_index',
                'display_name' => 'View Food Products',
                'controler_name' => 'FoodProductsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 51,
                'name' => 'admin_add',
                'display_name' => 'Add Food Products',
                'controler_name' => 'FoodProductsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 52,
                'name' => 'admin_edit',
                'display_name' => 'Edit Food Products',
                'controler_name' => 'FoodProductsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 53,
                'name' => 'admin_delete',
                'display_name' => 'Delete Food Products',
                'controler_name' => 'FoodProductsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 54,
                'name' => 'admin_index',
                'display_name' => 'View Restricted Ingredients',
                'controler_name' => 'RestrictedIngredientsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 55,
                'name' => 'admin_add',
                'display_name' => 'Add Restricted Ingredients',
                'controler_name' => 'RestrictedIngredientsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 56,
                'name' => 'admin_edit',
                'display_name' => 'Edit Restricted Ingredients',
                'controler_name' => 'RestrictedIngredientsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 57,
                'name' => 'admin_delete',
                'display_name' => 'Delete Restricted Ingredients',
                'controler_name' => 'RestrictedIngredientsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 58,
                'name' => 'admin_index',
                'display_name' => 'View Groups',
                'controler_name' => 'GroupsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 59,
                'name' => 'admin_add',
                'display_name' => 'Add Groups',
                'controler_name' => 'GroupsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 60,
                'name' => 'admin_edit',
                'display_name' => 'Edit Groups',
                'controler_name' => 'GroupsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 61,
                'name' => 'admin_delete',
                'display_name' => 'Delete Groups',
                'controler_name' => 'GroupsController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 62,
                'name' => 'admin_index',
                'display_name' => 'View Membership Plans',
                'controler_name' => 'MembershipPlansController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 63,
                'name' => 'admin_add',
                'display_name' => 'Add Membership Plans',
                'controler_name' => 'MembershipPlansController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 64,
                'name' => 'admin_edit',
                'display_name' => 'Edit Membership Plans',
                'controler_name' => 'MembershipPlansController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 65,
                'name' => 'admin_delete',
                'display_name' => 'Delete Membership Plans',
                'controler_name' => 'MembershipPlansController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 66,
                'name' => 'admin_index',
                'display_name' => 'View Promo Codes',
                'controler_name' => 'PromoCodesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 67,
                'name' => 'admin_add',
                'display_name' => 'Add Promo Codes',
                'controler_name' => 'PromoCodesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 68,
                'name' => 'admin_edit',
                'display_name' => 'Edit Promo Codes',
                'controler_name' => 'PromoCodesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 69,
                'name' => 'admin_delete',
                'display_name' => 'Delete Promo Codes',
                'controler_name' => 'PromoCodesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 70,
                'name' => 'admin_index',
                'display_name' => 'View Packages',
                'controler_name' => 'PackagesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 71,
                'name' => 'admin_add',
                'display_name' => 'Add Packages',
                'controler_name' => 'PackagesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 72,
                'name' => 'admin_edit',
                'display_name' => 'Edit Packages',
                'controler_name' => 'PackagesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 73,
                'name' => 'admin_delete',
                'display_name' => 'Delete Packages',
                'controler_name' => 'PackagesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 74,
                'name' => 'add_corporate',
                'display_name' => 'Add New Corporate ',
                'controler_name' => 'RoleController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 75,
                'name' => 'edit_corporate',
                'display_name' => 'Edit Corporate ',
                'controler_name' => 'RoleController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 78,
                'name' => 'admin_index',
                'display_name' => 'View Templates',
                'controler_name' => 'TemplatesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 79,
                'name' => 'admin_add',
                'display_name' => 'Add Templates',
                'controler_name' => 'TemplatesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 80,
                'name' => 'admin_edit',
                'display_name' => 'Edit Templates',
                'controler_name' => 'TemplatesController',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}