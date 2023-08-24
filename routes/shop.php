<?php



use App\Http\Controllers\Shop\Manager\Appearance\AboutUsPageController;

use App\Http\Controllers\Shop\Manager\Appearance\BannerSectionOneController;

use App\Http\Controllers\Shop\Manager\Appearance\BannerSectionTwoController;

use App\Http\Controllers\Shop\Manager\Appearance\BestDealProductsController;

use App\Http\Controllers\Shop\Manager\Appearance\BestSellingProductsController;

use App\Http\Controllers\Shop\Manager\Appearance\ClientFeedbackController;

use App\Http\Controllers\Shop\Manager\Appearance\FeaturedProductsController;

use App\Http\Controllers\Shop\Manager\Appearance\FooterController;

use App\Http\Controllers\Shop\Manager\Appearance\HeaderController;

use App\Http\Controllers\Shop\Manager\Appearance\HeroController;

use App\Http\Controllers\Shop\Manager\Appearance\ProductsPageController;

use App\Http\Controllers\Shop\Manager\Appearance\TopCategoriesController;

use App\Http\Controllers\Shop\Manager\Appearance\TopTrendingProductsController;

use App\Http\Controllers\Shop\Manager\DashboardController;

use App\Http\Controllers\Shop\Manager\CurrenciesController;

use App\Http\Controllers\Shop\Manager\LanguageController;

use App\Http\Controllers\Shop\Manager\SettingsController;

use App\Http\Controllers\Shop\Manager\SubscribersController;

use App\Http\Controllers\Shop\Manager\CustomersController;

use App\Http\Controllers\Shop\Manager\StaffsController;

use App\Http\Controllers\Shop\Manager\Products\VariationsController;

use App\Http\Controllers\Shop\Manager\Products\VariationValuesController;

use App\Http\Controllers\Shop\Manager\Products\BrandsController;

use App\Http\Controllers\Shop\Manager\Products\UnitsController;

use App\Http\Controllers\Shop\Manager\Products\TaxesController;

use App\Http\Controllers\Shop\Manager\Products\CategoriesController;

use App\Http\Controllers\Shop\Manager\Products\ProductsController;

use App\Http\Controllers\Shop\Manager\Promotions\CouponsController;

use App\Http\Controllers\Shop\Manager\Promotions\CampaignsController;

use App\Http\Controllers\Shop\Manager\Pages\PagesController;

use App\Http\Controllers\Shop\Manager\BlogSystem\TagsController;

use App\Http\Controllers\Shop\Manager\BlogSystem\BlogCategoriesController;

use App\Http\Controllers\Shop\Manager\BlogSystem\BlogsController;

use App\Http\Controllers\Shop\Manager\Contacts\ContactUsMessagesController;

use App\Http\Controllers\Shop\Manager\Logistics\LogisticsController;

use App\Http\Controllers\Shop\Manager\Logistics\LogisticZonesController;

use App\Http\Controllers\Shop\Manager\Logistics\CountriesController;

use App\Http\Controllers\Shop\Manager\Logistics\StatesController;

use App\Http\Controllers\Shop\Manager\Logistics\CitiesController;

use App\Http\Controllers\Shop\Manager\MediaManager\MediaManagerController;

use App\Http\Controllers\Shop\Manager\Newsletters\NewslettersController;

use App\Http\Controllers\Shop\Manager\Orders\OrdersController;

use App\Http\Controllers\Shop\Manager\Stocks\StocksController;

use App\Http\Controllers\Shop\Manager\Stocks\LocationsController;

use App\Http\Controllers\Shop\Manager\Rewards\RewardsController;

use App\Http\Controllers\Shop\Manager\Refunds\RefundsController;

use App\Http\Controllers\Shop\Manager\Rewards\WalletController;

use App\Http\Controllers\Shop\Manager\OrderSettingsController;

use App\Http\Controllers\Shop\Manager\Pos\PosController;

use App\Http\Controllers\Shop\Manager\Roles\RolesController;

use App\Http\Controllers\Shop\Manager\Reports\ReportsController;

// use App\Http\Controllers\Shop\Backend\ShopManagementController;
use App\Http\Controllers\Shop\Backend\WaiterController;

use Illuminate\Support\Facades\Route;







Route::group(

    ['prefix' => 'vendor', 'middleware' => ['vendor']],

    function () {

        # dashboard

        Route::get('/', [DashboardController::class, 'index'])->name('vendor.dashboard');

        Route::get('/profile', [DashboardController::class, 'profile'])->name('vendor.profile');

        Route::post('/profile', [DashboardController::class, 'updateProfile'])->name('vendor.profile.update');



        # auth settings 

        Route::get('/settings/auth', [SettingsController::class, 'authSettings'])->name('vendor.settings.authSettings');



        # otp settings 

        Route::get('/settings/otp', [SettingsController::class, 'otpSettings'])->name('vendor.settings.otpSettings');



        # settings

        Route::post('/settings/env-key-update', [SettingsController::class, 'envKeyUpdate'])->name('vendor.envKey.update');

        Route::get('/settings/general-settings', [SettingsController::class, 'index'])->name('vendor.generalSettings');

        Route::get('/settings/smtp-settings', [SettingsController::class, 'smtpSettings'])->name('vendor.smtpSettings.index');

        Route::post('/settings/test/smtp', [SettingsController::class, 'testEmail'])->name('vendor.test.smtp');

        

        Route::post('/settings/update', [SettingsController::class, 'update'])->name('vendor.settings.update');



        #payment methods 

        Route::get('/settings/payment-methods', [SettingsController::class, 'paymentMethods'])->name('vendor.settings.paymentMethods');

        Route::post('/settings/update-payment-methods', [SettingsController::class, 'updatePaymentMethods'])->name('vendor.settings.updatePaymentMethods');



        #order settings

        Route::get('/settings/order-settings', [OrderSettingsController::class, 'index'])->name('vendor.orderSettings');

        Route::post('/settings/add-time-slot', [OrderSettingsController::class, 'store'])->name('vendor.timeslot.store');

        Route::get('/settings/edit-time-slot/{id}', [OrderSettingsController::class, 'edit'])->name('vendor.timeslot.edit');

        Route::post('/settings/update-time-slot', [OrderSettingsController::class, 'update'])->name('vendor.timeslot.update');

        Route::get('/settings/delete-time-slot/{id}', [OrderSettingsController::class, 'delete'])->name('vendor.timeslot.delete');



        # social login

        Route::get('/settings/social-media-login', [SettingsController::class, 'socialLogin'])->name('vendor.settings.socialLogin');

        Route::post('/settings/activation', [SettingsController::class, 'updateActivation'])->name('vendor.settings.activation');



        # currencies  

        Route::get('/settings/currencies', [CurrenciesController::class, 'index'])->name('vendor.currencies.index');

        Route::post('/settings/store-currency', [CurrenciesController::class, 'store'])->name('vendor.currencies.store');

        Route::get('/settings/currencies/edit/{id}', [CurrenciesController::class, 'edit'])->name('vendor.currencies.edit');

        Route::post('/settings/update-currency', [CurrenciesController::class, 'update'])->name('vendor.currencies.update');

        Route::post('/settings/update-currency-status', [CurrenciesController::class, 'updateStatus'])->name('vendor.currencies.updateStatus');



        # languages  

        Route::get('/settings/languages', [LanguageController::class, 'index'])->name('vendor.languages.index');

        Route::post('/settings/store-language', [LanguageController::class, 'store'])->name('vendor.languages.store');

        Route::get('/settings/languages/edit/{id}', [LanguageController::class, 'edit'])->name('vendor.languages.edit');

        Route::post('/settings/update-language', [LanguageController::class, 'update'])->name('vendor.languages.update');

        Route::post('/settings/update-language-status', [LanguageController::class, 'updateStatus'])->name('vendor.languages.updateStatus');

        Route::post('/settings/update-language-default-status', [LanguageController::class, 'defaultLanguage'])->name('vendor.languages.defaultLanguage');



        # localizations

        Route::get('/settings/languages/localizations/{id}', [LanguageController::class, 'showLocalizations'])->name('vendor.languages.localizations');

        Route::post('/settings/languages/key-value-store', [LanguageController::class, 'key_value_store'])->name('vendor.languages.key_value_store');



        # products

        Route::group(['prefix' => 'products'], function () {

            # products 

            Route::get('/', [ProductsController::class, 'index'])->name('vendor.products.index');

            Route::get('/add-product', [ProductsController::class, 'create'])->name('vendor.products.create');

            Route::post('/product', [ProductsController::class, 'store'])->name('vendor.products.store');

            Route::get('/update-product/{id}', [ProductsController::class, 'edit'])->name('vendor.products.edit');

            Route::post('/update-product', [ProductsController::class, 'update'])->name('vendor.products.update');

            Route::post('/update-featured-product', [ProductsController::class, 'updateFeatured'])->name('vendor.products.updateFeatureStatus');

            Route::post('/update-published-product', [ProductsController::class, 'updatePublishedStatus'])->name('vendor.products.updatePublishedStatus');

            Route::get('/delete-product/{id}', [ProductsController::class, 'delete'])->name('vendor.products.delete');



            # categories 

            Route::get('/category', [CategoriesController::class, 'index'])->name('vendor.categories.index');

            Route::get('/add-category', [CategoriesController::class, 'create'])->name('vendor.categories.create');

            Route::post('/category', [CategoriesController::class, 'store'])->name('vendor.categories.store');

            Route::get('/update-category/{id}', [CategoriesController::class, 'edit'])->name('vendor.categories.edit');

            Route::post('/update-category', [CategoriesController::class, 'update'])->name('vendor.categories.update');

            Route::post('/update-feature-category', [CategoriesController::class, 'updateFeatured'])->name('vendor.categories.updateFeatureStatus');

            Route::post('/update-top-category', [CategoriesController::class, 'updateTop'])->name('vendor.categories.updateTopStatus');

            Route::get('/products/delete-category/{id}', [CategoriesController::class, 'delete'])->name('vendor.categories.delete');



            # variations

            Route::get('/variations', [VariationsController::class, 'index'])->name('vendor.variations.index');

            Route::post('/variation', [VariationsController::class, 'store'])->name('vendor.variations.store');

            Route::get('/variations/edit/{id}', [VariationsController::class, 'edit'])->name('vendor.variations.edit');

            Route::post('/variations/update', [VariationsController::class, 'update'])->name('vendor.variations.update');

            Route::post('/variations/update-status', [VariationsController::class, 'updateStatus'])->name('vendor.variations.updateStatus');

            Route::get('/variations/delete/{id}', [VariationsController::class, 'delete'])->name('vendor.variations.delete');



            # variation values

            Route::get('/variations/{id}', [VariationValuesController::class, 'index'])->name('vendor.variationValues.index');

            Route::post('/variation-values', [VariationValuesController::class, 'store'])->name('vendor.variationValues.store');

            Route::get('/variations-values/edit/{id}', [VariationValuesController::class, 'edit'])->name('vendor.variationValues.edit');

            Route::post('/variations-values/update', [VariationValuesController::class, 'update'])->name('vendor.variationValues.update');

            Route::post('/variations-values/update-status', [VariationValuesController::class, 'updateStatus'])->name('vendor.variationValues.updateStatus');

            Route::get('/variations-values/delete/{id}', [VariationValuesController::class, 'delete'])->name('vendor.variationValues.delete');



            # brands

            Route::get('/brands', [BrandsController::class, 'index'])->name('vendor.brands.index');

            Route::post('/brand', [BrandsController::class, 'store'])->name('vendor.brands.store');

            Route::get('/brands/edit/{id}', [BrandsController::class, 'edit'])->name('vendor.brands.edit');

            Route::post('/brands/update-brand', [BrandsController::class, 'update'])->name('vendor.brands.update');

            Route::post('/brands/update-status', [BrandsController::class, 'updateStatus'])->name('vendor.brands.updateStatus');

            Route::get('/brands/delete/{id}', [BrandsController::class, 'delete'])->name('vendor.brands.delete');



            # units

            Route::get('/units', [UnitsController::class, 'index'])->name('vendor.units.index');

            Route::post('/unit', [UnitsController::class, 'store'])->name('vendor.units.store');

            Route::get('/units/edit/{id}', [UnitsController::class, 'edit'])->name('vendor.units.edit');

            Route::post('/units/update-unit', [UnitsController::class, 'update'])->name('vendor.units.update');

            Route::post('/units/update-status', [UnitsController::class, 'updateStatus'])->name('vendor.units.updateStatus');

            Route::get('/units/delete/{id}', [UnitsController::class, 'delete'])->name('vendor.units.delete');



            # taxes

            Route::get('/taxes', [TaxesController::class, 'index'])->name('vendor.taxes.index');

            Route::post('/tax', [TaxesController::class, 'store'])->name('vendor.taxes.store');

            Route::get('/taxes/edit/{id}', [TaxesController::class, 'edit'])->name('vendor.taxes.edit');

            Route::post('/taxes/update', [TaxesController::class, 'update'])->name('vendor.taxes.update');

            Route::post('/taxes/update-status', [TaxesController::class, 'updateStatus'])->name('vendor.taxes.updateStatus');

            Route::get('/taxes/delete/{id}', [TaxesController::class, 'delete'])->name('vendor.taxes.delete');

        });



        #pos 

        Route::get('/pos', [PosController::class, 'index'])->name('vendor.pos.index');

        Route::post('/pos-products', [PosController::class, 'products'])->name('vendor.pos.products');

        Route::post('/pos-customers', [PosController::class, 'customers'])->name('vendor.pos.customers');

        Route::post('/pos-customer-info', [PosController::class, 'customerInfo'])->name('vendor.pos.customerInfo');

        Route::post('/pos-new-customer', [PosController::class, 'newCustomer'])->name('vendor.pos.newCustomer');

        Route::post('/add-to-pos-cart', [PosController::class, 'addToList'])->name('vendor.pos.addToList');

        Route::post('/pos-product-info', [PosController::class, 'productInfo'])->name('vendor.pos.productInfo');

        Route::post('/delete-from-cart', [PosController::class, 'deleteFromCart'])->name('vendor.pos.deleteFromCart');

        Route::post('/handle-pos-cart-qty', [PosController::class, 'handleQty'])->name('vendor.pos.handleQty');

        Route::post('/get-variation-id', [PosController::class, 'getVariationId'])->name('vendor.pos.getVariationId');

        Route::post('/update-pos-summary', [PosController::class, 'updatePosSummary'])->name('vendor.pos.updatePosSummary');

        Route::post('/submit-pos-order', [PosController::class, 'completeOrder'])->name('vendor.pos.completeOrder');

        Route::get('/pos/invoice-download/{id}', [PosController::class, 'downloadInvoice'])->name('vendor.pos.downloadInvoice');





        # orders

        Route::group(['prefix' => 'orders'], function () {

            Route::get('/', [OrdersController::class, 'index'])->name('vendor.orders.index');

            Route::get('/{id}', [OrdersController::class, 'show'])->name('vendor.orders.show');

            Route::post('/update-payment-status', [OrdersController::class, 'updatePaymentStatus'])->name('vendor.orders.update_payment_status');

            Route::post('/update-delivery-status', [OrdersController::class, 'updateDeliveryStatus'])->name('vendor.orders.update_delivery_status');

            Route::get('/invoice-download/{id}', [OrdersController::class, 'downloadInvoice'])->name('vendor.orders.downloadInvoice');

        });



        # stocks

        Route::group(['prefix' => 'stocks'], function () {

            # stocks 

            Route::get('/add', [StocksController::class, 'create'])->name('vendor.stocks.create');

            Route::post('/get-variation-stocks', [StocksController::class, 'getVariationStocks'])->name('vendor.stocks.getVariationStocks');

            Route::post('/add', [StocksController::class, 'store'])->name('vendor.stocks.store');



            # locations

            Route::get('/locations', [LocationsController::class, 'index'])->name('vendor.locations.index');

            Route::get('/add-location', [LocationsController::class, 'create'])->name('vendor.locations.create');

            Route::post('/add-location', [LocationsController::class, 'store'])->name('vendor.locations.store');

            Route::get('/edit-location/{id}', [LocationsController::class, 'edit'])->name('vendor.locations.edit');

            Route::post('/update-location', [LocationsController::class, 'update'])->name('vendor.locations.update');

            Route::post('/update-default-location', [LocationsController::class, 'updateDefaultStatus'])->name('vendor.locations.updateDefaultStatus');

            Route::post('/update-published-location', [LocationsController::class, 'updatePublishedStatus'])->name('vendor.locations.updatePublishedStatus');

        });



        # refunds

        Route::group(['prefix' => 'refunds'], function () {

            Route::get('/', [RefundsController::class, 'configurations'])->name('vendor.refund.configurations');

            Route::get('/requests', [RefundsController::class, 'requests'])->name('vendor.refund.requests');

            Route::get('/approve/{id}', [RefundsController::class, 'approve'])->name('vendor.refund.approve');

            Route::post('/reject/{id}', [RefundsController::class, 'reject'])->name('vendor.refund.reject');



            Route::get('/refunded', [RefundsController::class, 'refunded'])->name('vendor.refund.refunded');

            Route::get('/rejected', [RefundsController::class, 'rejected'])->name('vendor.refund.rejected');

        });





        # rewards & wallet

        Route::group(['prefix' => 'rewards'], function () {

            # rewards 

            Route::get('/', [RewardsController::class, 'configurations'])->name('vendor.rewards.configurations');

            Route::get('/set-points', [RewardsController::class, 'setPoints'])->name('vendor.rewards.setPoints');

            Route::post('/store-points', [RewardsController::class, 'storePoints'])->name('vendor.rewards.storePoints');

            Route::post('/store-each-product-points', [RewardsController::class, 'storeEachProductPoints'])->name('vendor.rewards.storeEachProductPoints');



            # wallet

            Route::get('/wallet-configurations', [WalletController::class, 'configurations'])->name('vendor.wallet.configurations');

        });



        # pages

        Route::group(['prefix' => 'pages'], function () {

            Route::get('/', [PagesController::class, 'index'])->name('vendor.pages.index');

            Route::get('/add-page', [PagesController::class, 'create'])->name('vendor.pages.create');

            Route::post('/add-page', [PagesController::class, 'store'])->name('vendor.pages.store');

            Route::get('/edit/{id}', [PagesController::class, 'edit'])->name('vendor.pages.edit');

            Route::post('/update-page', [PagesController::class, 'update'])->name('vendor.pages.update');

            Route::get('/delete/{id}', [PagesController::class, 'delete'])->name('vendor.pages.delete');

        });



        # customers

        Route::group(['prefix' => 'customers'], function () {

            Route::get('/', [CustomersController::class, 'index'])->name('vendor.customers.index');

            Route::post('/update-banned-customer', [CustomersController::class, 'updateBanStatus'])->name('vendor.customers.updateBanStatus');

        });



        # tags

        Route::get('/tags', [TagsController::class, 'index'])->name('vendor.tags.index');

        Route::post('/tag', [TagsController::class, 'store'])->name('vendor.tags.store');

        Route::get('/tags/edit/{id}', [TagsController::class, 'edit'])->name('vendor.tags.edit');

        Route::post('/tags/update-tag', [TagsController::class, 'update'])->name('vendor.tags.update');

        Route::get('/tags/delete/{id}', [TagsController::class, 'delete'])->name('vendor.tags.delete');



        # blog system

        Route::group(['prefix' => 'blogs'], function () {

            # blogs

            Route::get('/', [BlogsController::class, 'index'])->name('vendor.blogs.index');

            Route::get('/add-blog', [BlogsController::class, 'create'])->name('vendor.blogs.create');

            Route::post('/add-blog', [BlogsController::class, 'store'])->name('vendor.blogs.store');

            Route::get('/edit/{id}', [BlogsController::class, 'edit'])->name('vendor.blogs.edit');

            Route::post('/update-blog', [BlogsController::class, 'update'])->name('vendor.blogs.update');

            Route::post('/update-popular', [BlogsController::class, 'updatePopular'])->name('vendor.blogs.updatePopular');

            Route::post('/update-status', [BlogsController::class, 'updateStatus'])->name('vendor.blogs.updateStatus');

            Route::get('/delete/{id}', [BlogsController::class, 'delete'])->name('vendor.blogs.delete');



            # categories

            Route::get('/categories', [BlogCategoriesController::class, 'index'])->name('vendor.blogCategories.index');

            Route::post('/category', [BlogCategoriesController::class, 'store'])->name('vendor.blogCategories.store');

            Route::get('/categories/edit/{id}', [BlogCategoriesController::class, 'edit'])->name('vendor.blogCategories.edit');

            Route::post('/categories/update-category', [BlogCategoriesController::class, 'update'])->name('vendor.blogCategories.update');

            Route::get('/categories/delete/{id}', [BlogCategoriesController::class, 'delete'])->name('vendor.blogCategories.delete');

        });



        # media manager 

        Route::get('/media-manager', [MediaManagerController::class, 'index'])->name('vendor.mediaManager.index');



        # bulk-emails

        Route::controller(NewslettersController::class)->group(function () {

            Route::get('/bulk-emails', 'index')->name('vendor.newsletters.index');

            Route::post('/bulk-emails/send', 'sendNewsletter')->name('vendor.newsletters.send');

        });



        # subscribed users

        Route::get('/subscribers', [SubscribersController::class, 'index'])->name('vendor.subscribers.index');

        Route::get('/subscribers/delete/{id}', [SubscribersController::class, 'delete'])->name('vendor.subscribers.delete');



        # coupons

        Route::group(['prefix' => 'coupons'], function () {

            Route::get('/', [CouponsController::class, 'index'])->name('vendor.coupons.index');

            Route::get('/add-coupon', [CouponsController::class, 'create'])->name('vendor.coupons.create');

            Route::post('/', [CouponsController::class, 'store'])->name('vendor.coupons.store');

            Route::get('/update-coupon/{id}', [CouponsController::class, 'edit'])->name('vendor.coupons.edit');

            Route::post('/update-coupon', [CouponsController::class, 'update'])->name('vendor.coupons.update');

            Route::get('/delete-coupon/{id}', [CouponsController::class, 'delete'])->name('vendor.coupons.delete');

        });



        # campaigns 

        Route::group(['prefix' => 'campaigns'], function () {

            Route::get('/', [CampaignsController::class, 'index'])->name('vendor.campaigns.index');

            Route::get('/add-campaign', [CampaignsController::class, 'create'])->name('vendor.campaigns.create');

            Route::post('/', [CampaignsController::class, 'store'])->name('vendor.campaigns.store');

            Route::get('/update-campaign/{id}', [CampaignsController::class, 'edit'])->name('vendor.campaigns.edit');

            Route::post('/update-campaign', [CampaignsController::class, 'update'])->name('vendor.campaigns.update');

            Route::get('/delete-campaign/{id}', [CampaignsController::class, 'delete'])->name('vendor.campaigns.delete');

            Route::post('/product_discount', [CampaignsController::class, 'productDiscount'])->name('vendor.campaigns.productDiscount');

            Route::post('/product_discount_edit', [CampaignsController::class, 'productDiscountEdit'])->name('vendor.campaigns.productDiscountEdit');

            Route::post('/update-published-status', [CampaignsController::class, 'updatePublishedStatus'])->name('vendor.campaigns.updatePublishedStatus');

        });



        # logistics system

        Route::group(['prefix' => 'logistics'], function () {

            # logistics

            Route::get('/', [LogisticsController::class, 'index'])->name('vendor.logistics.index');

            Route::get('/add-logistic', [LogisticsController::class, 'create'])->name('vendor.logistics.create');

            Route::post('/add-logistic', [LogisticsController::class, 'store'])->name('vendor.logistics.store');

            Route::get('/update-logistic/{id}', [LogisticsController::class, 'edit'])->name('vendor.logistics.edit');

            Route::post('/update-logistic', [LogisticsController::class, 'update'])->name('vendor.logistics.update');

            Route::post('/update-status', [LogisticsController::class, 'updateStatus'])->name('vendor.logistics.updateStatus');

            Route::get('/delete-logistic/{id}', [LogisticsController::class, 'delete'])->name('vendor.logistics.delete');



            # shipping zones

            Route::get('/zones', [LogisticZonesController::class, 'index'])->name('vendor.logisticZones.index');

            Route::get('/add-zone', [LogisticZonesController::class, 'create'])->name('vendor.logisticZones.create');

            Route::post('/add-zone', [LogisticZonesController::class, 'store'])->name('vendor.logisticZones.store');

            Route::get('/update-zone/{id}', [LogisticZonesController::class, 'edit'])->name('vendor.logisticZones.edit');

            Route::post('/update-zone', [LogisticZonesController::class, 'update'])->name('vendor.logisticZones.update');

            Route::get('/delete-zone/{id}', [LogisticZonesController::class, 'delete'])->name('vendor.logisticZones.delete');

            Route::post('/logistic-cities', [LogisticZonesController::class, 'getLogisticCities'])->name('vendor.logisticZones.getLogisticCities');



            # countries

            Route::get('/countries', [CountriesController::class, 'index'])->name('vendor.countries.index');

            Route::post('/update-country-status', [CountriesController::class, 'updateStatus'])->name('vendor.countries.updateStatus');



            # states

            Route::get('/states', [StatesController::class, 'index'])->name('vendor.states.index');

            Route::get('/add-state', [StatesController::class, 'create'])->name('vendor.states.create');

            Route::post('/add-state', [StatesController::class, 'store'])->name('vendor.states.store');

            Route::get('/update-state/{id}', [StatesController::class, 'edit'])->name('vendor.states.edit');

            Route::post('/update-state', [StatesController::class, 'update'])->name('vendor.states.update');

            Route::post('/update-state-status', [StatesController::class, 'updateStatus'])->name('vendor.states.updateStatus');



            # cities

            Route::get('/cities', [CitiesController::class, 'index'])->name('vendor.cities.index');

            Route::get('/add-city', [CitiesController::class, 'create'])->name('vendor.cities.create');

            Route::post('/add-city', [CitiesController::class, 'store'])->name('vendor.cities.store');

            Route::get('/update-city/{id}', [CitiesController::class, 'edit'])->name('vendor.cities.edit');

            Route::post('/update-city', [CitiesController::class, 'update'])->name('vendor.cities.update');

            Route::post('/update-city-status', [CitiesController::class, 'updateStatus'])->name('vendor.cities.updateStatus');

        });



        # roles & permissions

        Route::group(['prefix' => 'roles'], function () {

            Route::get('/', [RolesController::class, 'index'])->name('vendor.roles.index');

            Route::get('/add-role', [RolesController::class, 'create'])->name('vendor.roles.create');

            Route::post('/add-role', [RolesController::class, 'store'])->name('vendor.roles.store');

            Route::get('/update-role/{id}', [RolesController::class, 'edit'])->name('vendor.roles.edit');

            Route::post('/update-role', [RolesController::class, 'update'])->name('vendor.roles.update');

            Route::get('/delete-role/{id}', [RolesController::class, 'delete'])->name('vendor.roles.delete');

        });



        # reports

        Route::group(['prefix' => 'reports'], function () {

            Route::get('/product-sales', [ReportsController::class, 'index'])->name('vendor.reports.sales');

            Route::get('/orders', [ReportsController::class, 'orders'])->name('vendor.reports.orders');

            Route::get('/category-wise-sales', [ReportsController::class, 'categoryWise'])->name('vendor.reports.categorySales');

            Route::get('/sales-amount-report', [ReportsController::class, 'amountWise'])->name('vendor.reports.salesAmount');

            Route::get('/delivery-status-report', [ReportsController::class, 'deliveryStatus'])->name('vendor.reports.deliveryStatus');

        });



        # contact us message

        Route::group(['prefix' => 'contacts'], function () {

            Route::get('/', [ContactUsMessagesController::class, 'index'])->name('vendor.queries.index');

            Route::get('/mark-as-read/{id}', [ContactUsMessagesController::class, 'read'])->name('vendor.queries.markRead');

        });





        # appearance

        Route::group(['prefix' => 'appearance'], function () {



            # homepage - hero

            Route::get('/homepage/hero', [HeroController::class, 'hero'])->name('vendor.appearance.homepage.hero');

            Route::post('/homepage/hero', [HeroController::class, 'storeHero'])->name('vendor.appearance.homepage.storeHero');

            Route::get('/homepage/hero/edit/{id}', [HeroController::class, 'edit'])->name('vendor.appearance.homepage.editHero');

            Route::post('/homepage/hero/update', [HeroController::class, 'update'])->name('vendor.appearance.homepage.updateHero');

            Route::get('/homepage/hero/delete/{id}', [HeroController::class, 'delete'])->name('vendor.appearance.homepage.deleteHero');



            # homepage - top category 

            Route::get('/homepage/top-category', [TopCategoriesController::class, 'index'])->name('vendor.appearance.homepage.topCategories');



            # homepage - featured products 

            Route::get('/homepage/featured-products', [FeaturedProductsController::class, 'index'])->name('vendor.appearance.homepage.featuredProducts');



            # homepage - top trending products 

            Route::get('/homepage/trending-products', [TopTrendingProductsController::class, 'index'])->name('vendor.appearance.homepage.topTrendingProducts');

            Route::post('/homepage/get-products-for-trending', [TopTrendingProductsController::class, 'getProducts'])->name('vendor.appearance.homepage.getProducts');



            # homepage - banner section one

            Route::get('/homepage/banner-section-one', [BannerSectionOneController::class, 'index'])->name('vendor.appearance.homepage.bannerOne');

            Route::post('/homepage/banner-section-one', [BannerSectionOneController::class, 'storeBannerOne'])->name('vendor.appearance.homepage.storeBannerOne');

            Route::get('/homepage/banner-section-one/edit/{id}', [BannerSectionOneController::class, 'edit'])->name('vendor.appearance.homepage.editBannerOne');

            Route::post('/homepage/banner-section-one/update', [BannerSectionOneController::class, 'update'])->name('vendor.appearance.homepage.updateBannerOne');

            Route::get('/homepage/banner-section-one/delete/{id}', [BannerSectionOneController::class, 'delete'])->name('vendor.appearance.homepage.deleteBannerOne');



            # homepage - best deals products 

            Route::get('/homepage/best-deal-products', [BestDealProductsController::class, 'index'])->name('vendor.appearance.homepage.bestDeals');



            # homepage - banner section two

            Route::get('/homepage/banner-section-two', [BannerSectionTwoController::class, 'index'])->name('vendor.appearance.homepage.bannerTwo');



            # client feedback

            Route::get('/homepage/client-feedback', [ClientFeedbackController::class, 'index'])->name('vendor.appearance.homepage.clientFeedback');

            Route::post('/homepage/client-feedback', [ClientFeedbackController::class, 'store'])->name('vendor.appearance.homepage.storeClientFeedback');

            Route::get('/homepage/client-feedback/edit/{id}', [ClientFeedbackController::class, 'edit'])->name('vendor.appearance.homepage.editClientFeedback');

            Route::post('/homepage/client-feedback/update', [ClientFeedbackController::class, 'update'])->name('vendor.appearance.homepage.updateClientFeedback');

            Route::get('/homepage/client-feedback/delete/{id}', [ClientFeedbackController::class, 'delete'])->name('vendor.appearance.homepage.deleteClientFeedback');



            # homepage - best selling products 

            Route::get('/homepage/best-selling-products', [BestSellingProductsController::class, 'index'])->name('vendor.appearance.homepage.bestSelling');



            # products - listing

            Route::get('/homepage/products', [ProductsPageController::class, 'index'])->name('vendor.appearance.products.index');



            # products - details

            Route::get('/homepage/products-details', [ProductsPageController::class, 'details'])->name('vendor.appearance.products.details');

            Route::post('/homepage/products-details', [ProductsPageController::class, 'storeWidget'])->name('vendor.appearance.products.details.storeWidget');

            Route::get('/homepage/products-details/edit/{id}', [ProductsPageController::class, 'edit'])->name('vendor.appearance.products.details.editWidget');

            Route::post('/homepage/products-details/update', [ProductsPageController::class, 'update'])->name('vendor.appearance.products.details.updateWidget');

            Route::get('/homepage/products-details/delete/{id}', [ProductsPageController::class, 'delete'])->name('vendor.appearance.products.details.deleteWidget');



            # about us - intro

            Route::get('/about-us', [AboutUsPageController::class, 'index'])->name('vendor.appearance.about-us.index');



            # about us - popular brands

            Route::get('/about-us/popular-brands', [AboutUsPageController::class, 'popularBrands'])->name('vendor.appearance.about-us.popularBrands');



            # about us - features

            Route::get('/about-us/features', [AboutUsPageController::class, 'features'])->name('vendor.appearance.about-us.features');

            Route::post('/about-us/features', [AboutUsPageController::class, 'storeFeatures'])->name('vendor.appearance.about-us.storeFeatures');

            Route::get('/about-us/features/edit/{id}', [AboutUsPageController::class, 'edit'])->name('vendor.appearance.about-us.editFeatures');

            Route::post('/about-us/features/update', [AboutUsPageController::class, 'update'])->name('vendor.appearance.about-us.updateFeatures');

            Route::get('/about-us/features/delete/{id}', [AboutUsPageController::class, 'delete'])->name('vendor.appearance.about-us.deleteFeatures');



            # about us - why choose us

            Route::get('/about-us/why-choose-us', [AboutUsPageController::class, 'whyChooseUs'])->name('vendor.appearance.about-us.whyChooseUs');

            Route::post('/about-us/why-choose-us', [AboutUsPageController::class, 'storeWhyChooseUs'])->name('vendor.appearance.about-us.storeWhyChooseUs');

            Route::get('/about-us/why-choose-us/edit/{id}', [AboutUsPageController::class, 'editWhyChooseUs'])->name('vendor.appearance.about-us.editWhyChooseUs');

            Route::post('/about-us/why-choose-us/update', [AboutUsPageController::class, 'updateWhyChooseUs'])->name('vendor.appearance.about-us.updateWhyChooseUs');

            Route::get('/about-us/why-choose-us/delete/{id}', [AboutUsPageController::class, 'deleteWhyChooseUs'])->name('vendor.appearance.about-us.deleteWhyChooseUs');



            # header

            Route::get('/header', [HeaderController::class, 'index'])->name('vendor.appearance.header');



            # footer

            Route::get('/footer', [FooterController::class, 'index'])->name('vendor.appearance.footer');

        });



        # staffs

        Route::group(['prefix' => 'staffs'], function () {

            Route::get('/', [StaffsController::class, 'index'])->name('vendor.staffs.index');

            

            Route::get('/add-staff', [StaffsController::class, 'create'])->name('vendor.staffs.create');

            Route::post('/add-staff', [StaffsController::class, 'store'])->name('vendor.staffs.store');

            Route::get('/update-staff/{id}', [StaffsController::class, 'edit'])->name('vendor.staffs.edit');

            Route::post('/update-staff', [StaffsController::class, 'update'])->name('vendor.staffs.update');

            Route::get('/delete-staff/{id}', [StaffsController::class, 'delete'])->name('vendor.staffs.delete');

        });



        #shops

        Route::get('/edit-shop', [SettingsController::class, 'index'])->name('vendor.shops.edit');

        Route::get('/edit-setting-shop', [SettingsController::class, 'editSettingShop'])->name('vendor.shops.editSettingShop');



        #waiters
        Route::group(['prefix' => 'waiters'], function () {
            Route::get('/', [WaiterController::class, 'index'])->name('vendor.waiters.index');
            
            Route::get('/add-waiter', [WaiterController::class, 'create'])->name('vendor.waiters.create');
            Route::post('/add-waiter', [WaiterController::class, 'store'])->name('vendor.waiters.store');
            Route::get('/show-waiter/{id}', [WaiterController::class, 'show'])->name('vendor.waiters.show');
            Route::get('/edit-waiter/{id}', [WaiterController::class, 'edit'])->name('vendor.waiters.edit');
            Route::post('/update-waiter', [WaiterController::class, 'update'])->name('vendor.waiters.update');
            Route::get('/delete-waiter/{id}', [WaiterController::class, 'destroy'])->name('vendor.waiters.delete');
            Route::post('/update-waiter-status', [WaiterController::class, 'updateWaiterStatus'])->name('vendor.waiters.updateStatus');


            Route::post('/update-order-waiter-status', [WaiterController::class, 'updateStatusCmdServer'])->name('vendor.order-waiters.updateStatus');
            
            Route::post('/attribuer-cmd', [WaiterController::class, 'attachOrderToServeur'])->name('vendor.order-waiters.attachOrderToServeur');

        });

        // Route::group(['prefix' => 'shops'], function(){

        //     Route::get('/', [ShopManagementController::class, 'index'])->name('vendor.shops.index');

        //     Route::get('/create', [ShopManagementController::class, 'create'])->name('vendor.shops.create');

        //     Route::post('/create', [ShopManagementController::class, 'store'])->name('vendor.shops.store');

        //     Route::get('/edit/{id}', [ShopManagementController::class, 'edit'])->name('vendor.shops.edit');

        //     Route::post('/update', [ShopManagementController::class, 'update'])->name('vendor.shops.update');

        //     Route::get('/delete/{id}', [ShopManagementController::class, 'destroy'])->name('vendor.shops.delete');

        //     Route::post('/update-approved-shop', [ShopManagementController::class, 'updateShopStatus'])->name('vendor.shops.updateShopStatus');

        //     Route::post('/update-published-shop', [ShopManagementController::class, 'updateShopPublishStatus'])->name('vendor.shops.updateShopPublishStatus');

            

        // });

    }

);