<?php

use App\Http\Controllers\ShippingController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ModelNameController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\BusinessSettingsController;
use App\Http\Controllers\MegaNavController;

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register admin routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


Route::get('/admin', 'AdminController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/categories/get-products-select', 'CategoryController@get_products')->name('categories.get_products');
    Route::post('/categories/products-copy', 'CategoryController@copy_products')->name('categories.copy');
    Route::post('/categories/categories-copy', 'CategoryController@copy_categories')->name('categories_all.copy');

    Route::post('/categories/categories-products-copy', 'CategoryController@copy_categories_products')->name('categories_all.copy.product_version');




    Route::resource('categories', 'CategoryController');
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
    Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');
    Route::post('/categories/published', 'CategoryController@updatePublished')->name('categories.published');




    Route::prefix('mega-nav')->name('mega_nav.')->group(function () {
        Route::get('/', [MegaNavController::class, 'index'])->name('index'); // List all mega nav items
        Route::get('/create', [MegaNavController::class, 'create'])->name('create'); // Show create form
        Route::post('/store', [MegaNavController::class, 'store'])->name('store'); // Store new mega nav item
        Route::get('/{id}/edit', [MegaNavController::class, 'edit'])->name('edit'); // Show edit form
        Route::patch('/{id}', [MegaNavController::class, 'update'])->name('update'); // Update mega nav item
        Route::delete('/{id}', [MegaNavController::class, 'destroy'])->name('destroy'); // Delete mega nav item
    });



    Route::resource('shippings', ShippingController::class);
    Route::get('/shippings/edit/{id}', 'ShippingController@edit')->name('shippings.edit');
    Route::get('/shippings/destroy/{id}', 'ShippingController@destroy')->name('shippings.destroy');
    Route::post('/shippings/featured', 'ShippingController@updateFeatured')->name('shippings.featured');



    // Route::resource('gardens', 'GardenController');
    // Route::get('/gardens/edit/{id}', 'GardenController@edit')->name('gardens.edit');
    // Route::get('/gardens/destroy/{id}', 'GardenController@destroy')->name('gardens.destroy');



    // Route::resource('testimonials', 'TestimonialController');
    // Route::get('/testimonials/edit/{id}', 'TestimonialController@edit')->name('testimonials.edit');
    // Route::get('/testimonials/destroy/{id}', 'TestimonialController@destroy')->name('testimonials.destroy');

    // Route::resource('plants', 'PlantController');
    // Route::get('/plants/edit/{id}', 'PlantController@edit')->name('plants.edit');
    // Route::get('/plants/destroy/{id}', 'PlantController@destroy')->name('plants.destroy');


    // Route::resource('results', 'ResultController');
    // Route::get('/results/edit/{id}', 'ResultController@edit')->name('results.edit');
    // Route::get('/results/destroy/{id}', 'ResultController@destroy')->name('results.destroy');

    // Route::get('/leads', 'UserResultController@index')->name('leads.index');
    // Route::get('/leads/destroy/{id}', 'UserResultController@destroy')->name('lead.destroy');

    //Product Addons - REMOVED (Extra Feature)
    // Route::resource('product-addons', 'ProductAddonController');
    // Route::get('/product-addons/edit/{id}', 'ProductAddonController@edit')->name('product-addons.edit');
    // Route::get('/product-addons/destroy/{id}', 'ProductAddonController@destroy')->name('product-addons.destroy');

    Route::get('brands/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
    Route::resource('brands', BrandController::class)->except(['show']);

    Route::get('model-names/{id}', [ModelNameController::class, 'destroy'])->name('model-names.destroy');
    Route::resource('model-names', ModelNameController::class)->except(['show']);

    Route::resource('years', YearController::class)->except(['show']);
    Route::get('years/{id}', [YearController::class, 'destroy'])->name('years.destroy');

    Route::resource('manufacturers', ManufacturerController::class)->except(['show']);
    Route::get('manufacturers/{id}', [ManufacturerController::class, 'destroy'])->name('manufacturers.destroy');






    //Route::get('/products/admin', 'ProductController@all_products')->name('products.admin');
    //Route::get('/products/seller', 'ProductController@seller_products')->name('products.seller');
    Route::get('/products/all', 'ProductController@all_products')->name('products.all');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::get('/products/admin/{id}/edit', 'ProductController@admin_product_edit')->name('products.admin.edit');
    //Route::get('/products/seller/{id}/edit', 'ProductController@seller_product_edit')->name('products.seller.edit');
    ///Route::post('/products/todays_deal', 'ProductController@updateTodaysDeal')->name('products.todays_deal');
    Route::post('/products/featured', 'ProductController@updateFeatured')->name('products.featured');
    Route::post('/products/approved', 'ProductController@updateProductApproval')->name('products.approved');
    Route::post('/products/get_products_by_subcategory', 'ProductController@get_products_by_subcategory')->name('products.get_products_by_subcategory');
    Route::post('/bulk-product-delete', 'ProductController@bulk_product_delete')->name('bulk-product-delete');

    Route::get('/load-nodes', 'ProductController@loadNodes')->name('products.loadNodes');
    Route::get('/search-nodes', 'ProductController@searchNodes')->name('products.searchNodes');



    Route::resource('customers', 'CustomerController');
    Route::get('/customers/create', 'CustomerController@create')->name('customers.create');
    Route::get('/customers/{id}/edit', 'CustomerController@edit')->name('customers.edit');
    Route::post('/customers/store/', 'CustomerController@store')->name('customers.store');
    Route::post('/customers/update/{id}', 'CustomerController@update')->name('customers.update');


    //Customer Management - SIMPLIFIED
    Route::get('/customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');
    // Removed: ban, login as customer, bulk delete (Extra Features)


    //Newsletter - REMOVED (Extra Feature)
    // Route::get('/newsletter', 'NewsletterController@index')->name('newsletters.index');
    // Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');
    // Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');

    // Route for saving website settings
    Route::post('/settings/update', [BusinessSettingsController::class, 'saveNavigationSettings'])->name('business_settings.update2');


    Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
    Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
    Route::post('/business-settings/load-home-dummy-data', 'BusinessSettingsController@loadHomePageDummyData')->name('business_settings.load_home_dummy_data');
    Route::get('/general-setting', 'BusinessSettingsController@general_setting')->name('general_setting.index');
    Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');
    Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
    Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
    Route::post('/payment_method_update_manual', 'BusinessSettingsController@payment_method_update_manual')->name('payment_method.update_manual');
    Route::get('/terms-and-conditions', 'BusinessSettingsController@terms_and_conditions')->name('terms_and_conditions.index');
    Route::get('/file_system', 'BusinessSettingsController@file_system')->name('file_system.index');
    Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
    Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
    Route::get('/google-recaptcha', 'BusinessSettingsController@google_recaptcha')->name('google_recaptcha.index');
    Route::get('/google-map', 'BusinessSettingsController@google_map')->name('google-map.index');
    Route::get('/google-firebase', 'BusinessSettingsController@google_firebase')->name('google-firebase.index');

    //Facebook Settings
    // Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
    // Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
    // Route::get('/facebook-comment', 'BusinessSettingsController@facebook_comment')->name('facebook-comment');
    // Route::post('/facebook-comment', 'BusinessSettingsController@facebook_comment_update')->name('facebook-comment.update');
    // Route::post('/facebook_pixel', 'BusinessSettingsController@facebook_pixel_update')->name('facebook_pixel.update');

    // Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    // Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
    // Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
    // Route::post('/google_recaptcha', 'BusinessSettingsController@google_recaptcha_update')->name('google_recaptcha.update');
    // Route::post('/google-map', 'BusinessSettingsController@google_map_update')->name('google-map.update');
    // Route::post('/google-firebase', 'BusinessSettingsController@google_firebase_update')->name('google-firebase.update');
    //Currency
    // Route::get('/currency', 'CurrencyController@currency')->name('currency.index');
    // Route::post('/currency/update', 'CurrencyController@updateCurrency')->name('currency.update');
    // Route::post('/your-currency/update', 'CurrencyController@updateYourCurrency')->name('your_currency.update');
    // Route::get('/currency/create', 'CurrencyController@create')->name('currency.create');
    // Route::post('/currency/store', 'CurrencyController@store')->name('currency.store');
    // Route::post('/currency/currency_edit', 'CurrencyController@edit')->name('currency.edit');
    // Route::post('/currency/update_status', 'CurrencyController@update_status')->name('currency.update_status');

    //Tax
    Route::resource('tax', 'TaxController');
    Route::get('/tax/edit/{id}', 'TaxController@edit')->name('tax.edit');
    Route::get('/tax/destroy/{id}', 'TaxController@destroy')->name('tax.destroy');
    Route::post('tax-status', 'TaxController@change_tax_status')->name('taxes.tax-status');


    //Seller Verification & Commission - REMOVED (Extra Feature)
    // Route::get('/verification/form', 'BusinessSettingsController@seller_verification_form')->name('seller_verification_form.index');
    // Route::post('/verification/form', 'BusinessSettingsController@seller_verification_form_update')->name('seller_verification_form.update');
    // Route::get('/vendor_commission', 'BusinessSettingsController@vendor_commission')->name('business_settings.vendor_commission');
    // Route::post('/vendor_commission_update', 'BusinessSettingsController@vendor_commission_update')->name('business_settings.vendor_commission.update');

    // Route::resource('/languages', 'LanguageController');
    // Route::post('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
    // Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
    // Route::post('/languages/update_rtl_status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
    // Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');

    // website setting
    Route::group(['prefix' => 'website'], function () {
        Route::get('/footer', 'WebsiteController@footer')->name('website.footer');
        Route::get('/header', 'WebsiteController@header')->name('website.header');
        Route::get('/appearance', 'WebsiteController@appearance')->name('website.appearance');
    });
    Route::get('/pages', 'WebsiteController@pages')->name('website.pages');
    Route::resource('custom-pages', 'PageController');
    Route::get('/custom-pages/edit/{id}', 'PageController@edit')->name('custom-pages.edit');
    Route::get('/custom-pages/destroy/{id}', 'PageController@destroy')->name('custom-pages.destroy');

    //Roles & Staff - REMOVED (Extra Feature - keeping simple)
    // Route::resource('roles', 'RoleController');
    // Route::get('/roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
    // Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

    // Route::resource('staffs', 'StaffController');
    // Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');

    // Route::resource('flash_deals', 'FlashDealController');
    // Route::get('/flash_deals/edit/{id}', 'FlashDealController@edit')->name('flash_deals.edit');
    // Route::get('/flash_deals/destroy/{id}', 'FlashDealController@destroy')->name('flash_deals.destroy');
    // Route::post('/flash_deals/update_status', 'FlashDealController@update_status')->name('flash_deals.update_status');
    // Route::post('/flash_deals/update_featured', 'FlashDealController@update_featured')->name('flash_deals.update_featured');
    // Route::post('/flash_deals/product_discount', 'FlashDealController@product_discount')->name('flash_deals.product_discount');
    // Route::post('/flash_deals/product_discount_edit', 'FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');

    //Subscribers - REMOVED (Extra Feature)
    // Route::get('/subscribers', 'SubscriberController@index')->name('subscribers.index');
    // Route::get('/subscribers/destroy/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

    // Route::get('/orders', 'OrderController@admin_orders')->name('orders.index.admin');
    // Route::get('/orders/{id}/show', 'OrderController@show')->name('orders.show');
    // Route::get('/sales/{id}/show', 'OrderController@sales_show')->name('sales.show');
    // Route::get('/sales', 'OrderController@sales')->name('sales.index');

    // Inhouse Orders
    Route::get('/inhouse-orders', 'OrderController@admin_orders')->name('inhouse_orders.index');
    Route::get('/inhouse-orders/{id}/show', 'OrderController@show')->name('inhouse_orders.show');

    // Seller Orders
    //  Route::get('/seller_orders', 'OrderController@seller_orders')->name('seller_orders.index');
    //  Route::get('/seller_orders/{id}/show', 'OrderController@seller_orders_show')->name('seller_orders.show');

    Route::post('/bulk-order-status', 'OrderController@bulk_order_status')->name('bulk-order-status');


    // Pickup point orders - REMOVED (Extra Feature)
    // Route::get('orders_by_pickup_point', 'OrderController@pickup_point_order_index')->name('pick_up_point.order_index');
    // Route::get('/orders_by_pickup_point/{id}/show', 'OrderController@pickup_point_order_sales_show')->name('pick_up_point.order_show');

    Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
    Route::post('/bulk-order-delete', 'OrderController@bulk_order_delete')->name('bulk-order-delete');

    //Commission - REMOVED (Extra Feature)
    // Route::post('/pay_to_seller', 'CommissionController@pay_to_seller')->name('commissions.pay_to_seller');

    //Reports - SIMPLIFIED (Keeping only essential reports)
    Route::get('/stock_report', 'ReportController@stock_report')->name('stock_report.index');
    Route::get('/in_house_sale_report', 'ReportController@in_house_sale_report')->name('in_house_sale_report.index');
    // Removed: seller_sale_report, wish_report, user_search_report, wallet-history (Extra Features)

    //Blog Section - REMOVED (Extra Feature)
    // Route::resource('blog-category', 'BlogCategoryController');
    // Route::get('/blog-category/destroy/{id}', 'BlogCategoryController@destroy')->name('blog-category.destroy');
    // Route::resource('blog', 'BlogController');
    // Route::get('/blog/destroy/{id}', 'BlogController@destroy')->name('blog.destroy');
    // Route::post('/blog/change-status', 'BlogController@change_status')->name('blog.change-status');


    //Portolio Section - REMOVED (Extra Feature)
    //  Route::resource('portfolio-category', 'PortfolioCategoryController');
    //  Route::get('/portfolio-category/destroy/{id}', 'PortfolioCategoryController@destroy')->name('portfolio-category.destroy');
    //  Route::resource('portfolio', 'PortfolioController');
    //  Route::get('/portfolio/destroy/{id}', 'PortfolioController@destroy')->name('portfolio.destroy');
    //  Route::post('/portfolio/change-status', 'PortfolioController@change_status')->name('portfolio.change-status');
    //  Route::post('/portfolio/change-feature', 'PortfolioController@change_feature')->name('portfolio.change-feature');


    //Coupons - REMOVED (Extra Feature)
    // Route::resource('coupon', 'CouponController');
    // Route::get('/coupon/destroy/{id}', 'CouponController@destroy')->name('coupon.destroy');

    //Reviews - REMOVED (Extra Feature)
    //  Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
    //  Route::post('/reviews/published', 'ReviewController@updatePublished')->name('reviews.published');

    //Support_Ticket - REMOVED (Extra Feature)
    // Route::get('support_ticket/', 'SupportTicketController@admin_index')->name('support_ticket.admin_index');
    // Route::get('support_ticket/{id}/show', 'SupportTicketController@admin_show')->name('support_ticket.admin_show');
    // Route::post('support_ticket/reply', 'SupportTicketController@admin_store')->name('support_ticket.admin_store');

    //Pickup_Points
    //  Route::resource('pick_up_points', 'PickupPointController');
    //  Route::get('/pick_up_points/edit/{id}', 'PickupPointController@edit')->name('pick_up_points.edit');
    //  Route::get('/pick_up_points/destroy/{id}', 'PickupPointController@destroy')->name('pick_up_points.destroy');

    //conversation of seller customer
    //  Route::get('conversations', 'ConversationController@admin_index')->name('conversations.admin_index');
    //  Route::get('conversations/{id}/show', 'ConversationController@admin_show')->name('conversations.admin_show');

    //  Route::post('/sellers/profile_modal', 'SellerController@profile_modal')->name('sellers.profile_modal');
    //  Route::post('/sellers/approved', 'SellerController@updateApproved')->name('sellers.approved');

    //  Route::resource('attributes', 'AttributeController');
    //  Route::get('/attributes/edit/{id}', 'AttributeController@edit')->name('attributes.edit');
    //  Route::get('/attributes/destroy/{id}', 'AttributeController@destroy')->name('attributes.destroy');

    //Colors
    // Route::get('/colors', 'AttributeController@colors')->name('colors');
    // Route::post('/colors/store', 'AttributeController@store_color')->name('colors.store');
    // Route::get('/colors/edit/{id}', 'AttributeController@edit_color')->name('colors.edit');
    // Route::post('/colors/update/{id}', 'AttributeController@update_color')->name('colors.update');
    // Route::get('/colors/destroy/{id}', 'AttributeController@destroy_color')->name('colors.destroy');

    //Addons - REMOVED (Extra Feature)
    // Route::resource('addons', 'AddonController');
    // Route::post('/addons/activation', 'AddonController@activation')->name('addons.activation');

    //Customer Bulk Upload - REMOVED (Extra Feature)
    // Route::get('/customer-bulk-upload/index', 'CustomerBulkUploadController@index')->name('customer_bulk_upload.index');
    // Route::post('/bulk-user-upload', 'CustomerBulkUploadController@user_bulk_upload')->name('bulk_user_upload');
    // Route::post('/bulk-customer-upload', 'CustomerBulkUploadController@customer_bulk_file')->name('bulk_customer_upload');
    // Route::get('/user', 'CustomerBulkUploadController@pdf_download_user')->name('pdf.download_user');
    //Customer Package - REMOVED (Extra Feature)

    // Route::resource('customer_packages', 'CustomerPackageController');
    // Route::get('/customer_packages/edit/{id}', 'CustomerPackageController@edit')->name('customer_packages.edit');
    // Route::get('/customer_packages/destroy/{id}', 'CustomerPackageController@destroy')->name('customer_packages.destroy');

    //Classified Products - REMOVED (Extra Feature)
    // Route::get('/classified_products', 'CustomerProductController@customer_product_index')->name('classified_products');
    // Route::post('/classified_products/published', 'CustomerProductController@updatePublished')->name('classified_products.published');

    //Shipping Configuration
    Route::get('/shipping_configuration', 'BusinessSettingsController@shipping_configuration')->name('shipping_configuration.index');
    Route::post('/shipping_configuration/update', 'BusinessSettingsController@shipping_configuration_update')->name('shipping_configuration.update');

    // Route::resource('pages', 'PageController');
    // Route::get('/pages/destroy/{id}', 'PageController@destroy')->name('pages.destroy');

    //Countries & Cities - REMOVED (Extra Feature)
    // Route::resource('countries', 'CountryController');
    // Route::post('/countries/status', 'CountryController@updateStatus')->name('countries.status');

    // Route::resource('cities', 'CityController');
    // Route::get('/cities/edit/{id}', 'CityController@edit')->name('cities.edit');
    // Route::get('/cities/destroy/{id}', 'CityController@destroy')->name('cities.destroy');

    Route::view('/system/update', 'backend.system.update')->name('system_update');
    Route::view('/system/server-status', 'backend.system.server_status')->name('system_server');

    // uploaded files
    Route::any('/uploaded-files/file-info', 'AizUploadController@file_info')->name('uploaded-files.info');
    Route::resource('/uploaded-files', 'AizUploadController');
    Route::get('/uploaded-files/destroy/{id}', 'AizUploadController@destroy')->name('uploaded-files.destroy');

    //Notifications - REMOVED (Extra Feature)
    // Route::get('/all-notification', 'NotificationController@index')->name('admin.all-notification');

    //Attribute Value - REMOVED (Extra Feature)
    // Route::post('/store-attribute-value', 'AttributeController@store_attribute_value')->name('store-attribute-value');
    // Route::get('/edit-attribute-value/{id}', 'AttributeController@edit_attribute_value')->name('edit-attribute-value');
    // Route::post('/update-attribute-value/{id}', 'AttributeController@update_attribute_value')->name('update-attribute-value');
    // Route::get('/destroy-attribute-value/{id}', 'AttributeController@destroy_attribute_value')->name('destroy-attribute-value');
});






Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    //Update Routes


    Route::resource('profile', 'ProfileController');


    // All Orders
    Route::get('/all_orders', 'OrderController@all_orders')->name('all_orders.index');
    Route::get('/all_orders/{id}/show', 'OrderController@all_orders_show')->name('all_orders.show');

    Route::get('/change_price/{id}', 'OrderController@change_price')->name('switch.price');
});
