<?php

use App\Http\Controllers\Admin\CalculatorController;
use App\Http\Controllers\Client\Auth\AccountDeletionController;
use App\Http\Controllers\Client\Auth\PasswordController;
use App\Http\Controllers\Client\Auth\ProfileController;
use App\Http\Controllers\Marchant\MarchantDashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DeliverychargeController as AdminDeliverychargeController;
use App\Http\Controllers\Admin\HubsController;
use App\Http\Controllers\Admin\MarchantController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\Client\ViewController;
use App\Http\Controllers\Deliveryman\DeliveryManController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Marchant\AllConsignmentController;
use App\Http\Controllers\Marchant\FraudController as MarchantFraudController;
use App\Http\Controllers\Marchant\ProductController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Pickupman\PickupManController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


Route::controller(ViewController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('tracking', 'tracking')->name('tracking');
    Route::get('contact', 'contact')->name('contact');
    Route::get('service', 'service')->name('service');
    Route::get('about', 'about')->name('about');
    Route::get('/get-destinations', 'getDestinations');
    Route::get('/get-categories', 'getCategories');
    Route::get('/get-services', 'getServices');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('/terms-condition', 'termsCondition')->name('terms-condition');
    Route::get('/parcel_booking', 'parcelBooking')->name('parcel_booking');
    Route::post('/parcel_booking', 'parcelBookingStore')->name('post.parcel_booking');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/business', 'business')->name('business.account');
    Route::get('/driver', 'driver')->name('driver.account');

    Route::get('admin/news', 'newsCreate')->name('admin.news')->middleware('isLoggedIn');
    Route::post('admin/news', 'newsStore')->name('admin.post.news')->middleware('isLoggedIn');
    Route::get('admin/news/table', 'newsIndex')->name('admin.news.table')->middleware('isLoggedIn');
    Route::get('/news/view', 'newsFront')->name('news.view');
    Route::post('admin/news/destroy', 'newsDestroy')->name('admin.news.destroy')->middleware('isLoggedIn');
});


Route::controller(AccountDeletionController::class)->group(function () {
    Route::get('account-delete', 'index')->name('account.delete');
    Route::post('account-delete', 'destroy');
});

Route::get('profile-update', [ProfileController::class, 'index'])->name('profile.update');
Route::get('password-change', [PasswordController::class, 'index'])->name('auth.password');


// ____Mrachant____
Route::resources([
    'deliverycharge' => CalculatorController::class,
    // 'delivery' => DeliveryController::class,
    'pickup' => PickupController::class,
    'product' => ProductController::class,
]);
Route::controller(MarchantDashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
    Route::get('merchant/coverage/area', 'coverageArea')->name('merchant.coverage.area');
    Route::get('merchant/pricing', 'pricing')->name('merchant.pricing');
    Route::post('marchant/delivery', 'deliveryConfirmation')->name('marchant.delivery_confirmation');
    Route::post('marchant/checkout', 'deliveryCheckout')->name('marchant.delivery_checkout');
    Route::post('marchant/cancel', 'cancelConfirmation')->name('marchant.cancel_confirmation');
    Route::post('marchant/returnAccept', 'acceptProduct')->name('marchant.accept_product_confirmation');

    Route::get('merchant/product/store', 'productCreate')->name('merchant.product.create');
    Route::post('admin/product/store', 'productStore')->name('merchant.product.store');

    Route::post('/delivery/search', 'searchme')->name('deliveryme');
    Route::post('/delivery/optionsearch', 'optionsearch')->name('optionsearch');

    Route::get('merchant/merchant_sales/report', 'merchantSaleReport')->name('merchant.merchant_sales.report');
    
});

Route::controller(MarchantFraudController::class)->group(function () {
    Route::get('/fraud_check', 'fraud_check')->name('fraud_check');
    Route::get('fraud/add_new', 'fraud_add_new')->name('fraud_add_new');
    Route::post('fraud/add_new', 'fraud_add_new_insert')->name('fraud_add_new_insert');
    Route::get('fraud/check', 'fraud_check_search')->name('fraud_check_search');
    Route::get('fraud/myentries', 'fraud_myentries')->name('fraud_myentries');
    Route::post('fraud/search', 'fraud_search')->name('fraud_search');
    Route::delete('/fraud/{id}', 'fraud_delete')->name('fraud_delete');
});


Route::controller(AdminController::class)->group(function () {
    Route::get('admin/dashboard', 'index')->name('admin.dashboard')->middleware('isLoggedIn');
    Route::get('admin/register', 'create')->name('admin.register')->middleware('isLoggedIn');
    Route::post('admin/register', 'store')->name('admin.store')->middleware('isLoggedIn');
    Route::get('admin/login', 'loginView')->name('admin.login')->middleware('alreadyLogin');
    Route::post('admin/login', 'loginCheck')->name('super.admin.login');
    Route::get('admin/table', 'tableAdmin')->name('admin.table')->middleware('isLoggedIn');
    Route::post('admin/logout', 'logout')->name('admin.logout')->middleware('isLoggedIn');
    Route::get('admin/edit', 'adminEdit')->name('admin.edit')->middleware('isLoggedIn');
    Route::post('admin/update', 'adminUpdate')->name('admin.update')->middleware('isLoggedIn');
    Route::get('admin/change/password', 'changePassword')->name('admin.change.password')->middleware('isLoggedIn');
    Route::post('admin/update/password', 'updatePassword')->name('admin.update.password')->middleware('isLoggedIn');
    Route::get('admin/delete', 'adminDelete')->name('admin.delete')->middleware('isLoggedIn');
    Route::post('admin/delete', 'adminDeleteAccount')->name('admin.delete.account')->middleware('isLoggedIn');
    Route::post('admin/delivery/search', 'searchAdmin')->name('admin.search');
    Route::post('admin/delivery/calculatorSearch', 'calculatorSearch')->name('admin.calculatorSearch');
    Route::post('admin/delivery/searchDelivery', 'searchDeliveryman')->name('admin.searchDeliveryman');
    Route::post('admin/pickupman/search', 'searchPickup')->name('admin.searchPickup');
    Route::post('admin/merchant/search', 'searchMerchant')->name('admin.searchMerchant');
    Route::post('admin/destroy', 'adminDestroy')->name('admin.destroy')->middleware('isLoggedIn');
    Route::post('admin/admin/search', 'adminSearch')->name('admin.adminSearch');
    Route::get('admin/excel/export', 'adminExcelExport')->name('admin.excel.export')->middleware('isLoggedIn');
    Route::post('admin/excel/import', 'adminExcelImport')->name('admin.excel.import')->middleware('isLoggedIn');

    Route::get('admin/pickupman', 'pickupManTable')->name('admin.pickupman');
    Route::post('admin/pickupman/confirmation', 'pickupConfirmation')->name('admin.pickupman_confirmation')->middleware('isLoggedIn');
    Route::post('admin/pickupman/cancel/confirmation', 'pickupCancelConfirmation')->name('admin.pickupman_cancel_confirmation')->middleware('isLoggedIn');
    Route::get('admin/pickupman_destroy', 'pickupmanDestroy')->name('admin.pickupman_destroy')->middleware('isLoggedIn');
    Route::get('admin/pickupman/excel/export', 'pickupmanExcelExport')->name('admin.pickupman.excel.export')->middleware('isLoggedIn');
    Route::post('admin/pickupman/excel/import', 'pickupmanExcelImport')->name('admin.pickupman.excel.import')->middleware('isLoggedIn');

    Route::get('admin/deliveryman', 'deliveryManTable')->name('admin.deliveryman');
    Route::post('admin/deliveryman/confirmation', 'deliverymanConfirmation')->name('admin.deliveryman_confirmation')->middleware('isLoggedIn');
    Route::post('admin/deliveryman/cancel/confirmation', 'deliverymanCancelConfirmation')->name('admin.deliveryman_cancel_confirmation')->middleware('isLoggedIn');
    Route::get('admin/deliveryman_destroy', 'deliverymanDestroy')->name('admin.deliveryman_destroy');
    Route::get('admin/deliveryman/excel/export', 'deliverymanExcelExport')->name('admin.deliveryman.excel.export')->middleware('isLoggedIn');
    Route::post('admin/deliveryman/excel/import', 'deliverymanExcelImport')->name('admin.deliveryman.excel.import')->middleware('isLoggedIn');

    Route::get('admin/product/delivery', 'productTable')->name('admin.product.delivery')->middleware('isLoggedIn');
    Route::get('admin/product/deliveryAjex', 'productTableAjex')->name('admin.product.deliveryAjex')->middleware('isLoggedIn');
    Route::get('admin/product/delivery/edit', 'productEdit')->name('admin.product.delivery.edit')->middleware('isLoggedIn');
    Route::post('admin/product/delivery/edit', 'productUpdate')->name('admin.product.delivery.update')->middleware('isLoggedIn');
    Route::post('admin/product/delivery', 'productDeliveryConfirmation')->name('admin.product.delivery_confirmation')->middleware('isLoggedIn');
    Route::post('admin/product/checkout', 'productDeliveryCheckout')->name('admin.product.delivery_checkout')->middleware('isLoggedIn');
    Route::post('admin/product/delivered', 'productDeliveryDelivered')->name('admin.product.delivery_delivered')->middleware('isLoggedIn');
    Route::post('admin/product/cancel', 'productCancelConfirmation')->name('admin.product.cancel_confirmation')->middleware('isLoggedIn');
    Route::post('admin/product/cancelAjex', 'productCancelConfirmationAjex')->name('admin.product.cancel_confirmationAjex')->middleware('isLoggedIn');
    Route::get('admin/product/delivery/delete', 'productDestroy')->name('admin.product.delivery.delete')->middleware('isLoggedIn');
    Route::post('admin/product/excel/import', 'productExcelImport')->name('admin.product.excel.import')->middleware('isLoggedIn');
    Route::get('admin/product/excel/export', 'productExcelExport')->name('admin.product.excel.export')->middleware('isLoggedIn');
    Route::post('admin/deliverycharge/edit', 'deliveryChargeupdate')->name('admin.deliverycharge.update')->middleware('isLoggedIn');
    Route::get('admin/product/delivery/show', 'productShow')->name('admin.product.delivery.show')->middleware('isLoggedIn');

    Route::get('admin/newsletter/subscribers', 'newsletterSubscibers')->name('admin.newsletter-subscribers')->middleware('isLoggedIn');
    Route::get('admin/newsletter_destroy', 'newsletterDestroy')->name('admin.newsletter_destroy')->middleware('isLoggedIn');


    Route::get('admin/fraud_check', 'admin_fraud_check')->name('admin.fraud_check');
    Route::get('admin/fraud/add_new', 'admin_fraud_add_new')->name('admin.fraud_add_new');
    Route::post('admin/fraud/add_new', 'admin_fraud_add_new_insert')->name('admin.fraud_add_new_insert');
    Route::get('admin/fraud/check', 'admin_fraud_check_search')->name('admin.fraud_check_search');
    Route::get('admin/fraud/myentries', 'admin_fraud_myentries')->name('admin.fraud_myentries');
    Route::post('admin/fraud/search', 'admin_fraud_search')->name('admin.fraud_search');
    Route::delete('/admin/fraud/{id}', 'admin_fraud_delete')->name('admin.fraud_delete');

    Route::get('/admin/forgot-password', 'showForgotPasswordForm')->name('admin.forgot.password');
    Route::post('/admin/forgot-password', 'sendResetLinkEmail')->name('admin.forgot.password.post');

    Route::get('/admin-reset-password/{token}', 'resetPassword');
    Route::post('/admin-reset-password/{token}', 'postResetPassword');

    Route::get('/admin/terms/edit', 'editTerms')->name('admin.terms.edit');
    Route::post('/admin/terms/update', 'updateTerms')->name('admin.terms.update');

    Route::get('/admin/about/edit', 'editAbout')->name('admin.about.edit');
    Route::post('/admin/about/update', 'updateAbout')->name('admin.about.update');

    Route::get('/admin/privacy/edit', 'editPrivacy')->name('admin.privacy.edit');
    Route::post('/admin/privacy/update', 'updatePrivacy')->name('admin.privacy.update');
    Route::post('/admin/delivery/date_search_range', 'range_date_search')->name('admin.date_range_search');
    
    Route::delete('/admin/multipledelete', 'projectDelete')->name('project.delete');
    Route::delete('/admin/multipledeletepickup', 'projectDeletepickup')->name('project.deletepickup');
    Route::delete('/admin/multipledeletedeliveryman', 'projectDeleteDeliveryman')->name('project.deletedeliveryman');
    Route::delete('/admin/multipledeletemerchant', 'projectDeleteMerchant')->name('project.deletemerchant');
    Route::delete('/admin/multipledeleteadmin', 'projectDeleteAdmin')->name('project.deleteAdmin');
    Route::delete('/admin/multipledeletecalculate', 'projectDeleteCalculate')->name('project.deleteCalculate');
});


Route::controller(MarchantController::class)->group(function () {
    Route::get('admin/merchant', 'index')->name('admin.merchant')->middleware('isLoggedIn');
    Route::get('admin/merchant/excel/export', 'merchantExcelExport')->name('admin.merchant.excel.export')->middleware('isLoggedIn');
    Route::get('/percel_delivery_charge', 'percel_delivery_charge')->name('percel_delivery_charge');
});

// Route::controller(AdminDeliveryController::class)->group(function(){
//     Route::get('admin/delivery', 'index')->name('admin.delivery')->middleware('isLoggedIn');
//     Route::get('admin/delivery/edit', 'edit')->name('admin.delivery.edit')->middleware('isLoggedIn');
//     Route::post('admin/delivery/edit', 'update')->name('admin.delivery.update')->middleware('isLoggedIn');
//     Route::post('admin/delivery', 'deliveryConfirmation')->name('admin.delivery_confirmation')->middleware('isLoggedIn');
//     Route::post('admin/checkout', 'deliveryCheckout')->name('admin.delivery_checkout')->middleware('isLoggedIn');
//     Route::post('admin/delivered', 'deliveryDelivered')->name('admin.delivery_delivered')->middleware('isLoggedIn');
//     Route::post('admin/cancel', 'cancelConfirmation')->name('admin.cancel_confirmation')->middleware('isLoggedIn');
//     Route::get('admin/delivery/delete', 'destroy')->name('admin.delivery.delete')->middleware('isLoggedIn');
// });

Route::controller(AdminDeliverychargeController::class)->group(function () {
    Route::get('admin/addDeliveryCharge', 'addDeliveryCharge')->name('addDeliveryCharge');
    Route::post('admin/addDeliveryCharge', 'storeDeliveryCharge')->name('storeDeliveryCharge');
    Route::post('/calculate_delivery_charge', 'calculate_delivery_charge')->name('calculate_delivery_charge');
    Route::post('/search-delivery', 'search')->name('search.delivery');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('merchant/delivery/search', 'search')->name('merchant.delivery.search');
    Route::get('admin/delivery/search', 'adminDeliverySearch')->name('admin.delivery.search');
});
Route::controller(AllConsignmentController::class)->group(function () {
    Route::get('merchant/all_consignment', 'all_consignment')->name('merchant.all_consignment');
    Route::get('merchant/list_byDate_all_consignment', 'list_byDate')->name('merchant.list_byDate');
    Route::get('merchant/pending_consignment', 'pending_consignment')->name('merchant.pending_consignment');
    Route::get('merchant/approval_pending_consignment', 'approval_pending_consignment')->name('merchant.approval_pending_consignment');
    Route::get('merchant/delivery_consignment', 'delivery_consignment')->name('merchant.delivery_consignment');
    Route::get('merchant/partly_delivery_consignment', 'partly_delivery_consignment')->name('merchant.partly_delivery_consignment');
    Route::get('merchant/cancel_consignment', 'cancel_consignment')->name('merchant.cancel_consignment');
    Route::get('merchant/inreview_consignment', 'inreview_consignment')->name('merchant.inreview_consignment');
    Route::get('merchant/latest_entries_consignment', 'latest_entries_consignment')->name('merchant.latest_entries_consignment');
    Route::get('merchant/pick_n_drop_consignment', 'pick_n_drop_consignment')->name('merchant.pick_n_drop_consignment');
    Route::get('merchant/stock', 'stock')->name('merchant.stock');
});

Route::get('/chatbox', [BotManController::class, 'index']);
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);


Route::controller(DeliveryManController::class)->group(function () {
    Route::get('deliveryman/dashboard', 'index')->name('deliveryman.dashboard')->middleware('deliverymanIsLoggedIn');
    Route::get('deliveryman/register', 'create')->name('deliveryman.register')->middleware('deliverymanAlreadyLogin');
    Route::post('deliveryman/register', 'store')->name('deliveryman.store');
    Route::get('deliveryman/login', 'loginView')->name('deliveryman.login')->middleware('deliverymanAlreadyLogin');
    Route::post('deliveryman/login', 'loginCheck')->name('deliveryman.login.check');
    // Route::get('admin/table', 'table')->name('admin.table')->middleware('isLoggedIn');
    Route::post('deliveryman/product/delivery/search', 'searcDeliverymanProductTable')->name('deliveryman.productDeliverySearch');
    Route::post('deliveryman/logout', 'logout')->name('deliveryman.logout')->middleware('deliverymanIsLoggedIn');
    Route::get('deliveryman/edit', 'edit')->name('deliveryman.edit')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/update', 'deliverymanUpdate')->name('deliveryman.update')->middleware('deliverymanIsLoggedIn');
    Route::get('deliveryman/change/password', 'changePassword')->name('deliveryman.change.password')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/update/password', 'updatePassword')->name('deliveryman.update.password')->middleware('deliverymanIsLoggedIn');
    Route::get('deliveryman/delete', 'deliverymanDelete')->name('deliveryman.delete')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/delete', 'deliverymanDeleteAccount')->name('deliveryman.delete.account')->middleware('deliverymanIsLoggedIn');
    Route::get('deliveryman/product/table', 'productTable')->name('deliveryman.product.table')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/product/checkout', 'productDeliveryCheckout')->name('deliveryman.product.checkout')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/product/delivered', 'productDeliveryDelivered')->name('deliveryman.product.delivered')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/product/cancel', 'productDeliveryCancel')->name('deliveryman.product.cancel')->middleware('deliverymanIsLoggedIn');
    Route::post('deliveryman/product/return', 'productDeliveryReturn')->name('deliveryman.product.return')->middleware('deliverymanIsLoggedIn');

    Route::get('deliveryman/fraud_check', 'deliveryman_fraud_check')->name('deliveryman.fraud_check');
    Route::get('deliveryman/fraud/add_new', 'deliveryman_fraud_add_new')->name('deliveryman.fraud_add_new');
    Route::post('deliveryman/fraud/add_new', 'deliveryman_fraud_add_new_insert')->name('deliveryman.fraud_add_new_insert');
    Route::get('deliveryman/fraud/check', 'deliveryman_fraud_check_search')->name('deliveryman.fraud_check_search');
    Route::get('deliveryman/fraud/myentries', 'deliveryman_fraud_myentries')->name('deliveryman.fraud_myentries');
    Route::post('deliveryman/fraud/search', 'deliveryman_fraud_search')->name('deliveryman.fraud_search');
    Route::delete('/deliveryman/fraud/{id}', 'deliveryman_fraud_delete')->name('deliveryman.fraud_delete');

    Route::get('/deliveryman-verify/{token}', 'verifyMail');

    Route::get('/deliveryman/forgot-password', 'showForgotPasswordForm')->name('deliveryman.forgot.password');
    Route::post('/deliveryman/forgot-password', 'sendResetLinkEmail')->name('deliveryman.forgot.password.post');

    Route::get('/deliveryman-reset-password/{token}', 'resetPassword');
    Route::post('/deliveryman-reset-password/{token}', 'postResetPassword');
});


Route::controller(PickupManController::class)->group(function () {
    Route::get('pickupman/dashboard', 'index')->name('pickupman.dashboard')->middleware('pickupmanIsLoggedIn');
    Route::get('pickupman/register', 'create')->name('pickupman.register')->middleware('pickupmanAlreadyLogin');
    Route::post('pickupman/register', 'store')->name('pickupman.store');
    Route::get('pickupman/login', 'loginView')->name('pickupman.login')->middleware('pickupmanAlreadyLogin');
    Route::post('pickupman/login', 'loginCheck')->name('pickupman.login.check');
    Route::post('pickupman/product/pick/search', 'searchProductPickupmanTable')->name('pickupman.productPickSearch');
    // Route::get('admin/table', 'table')->name('admin.table')->middleware('isLoggedIn');
    Route::post('pickupman/logout', 'logout')->name('pickupman.logout')->middleware('pickupmanIsLoggedIn');
    Route::get('pickupman/edit', 'edit')->name('pickupman.edit')->middleware('pickupmanIsLoggedIn');
    Route::post('pickupman/update', 'pickupmanUpdate')->name('pickupman.update')->middleware('pickupmanIsLoggedIn');
    Route::get('pickupman/change/password', 'changePassword')->name('pickupman.change.password')->middleware('pickupmanIsLoggedIn');
    Route::post('pickupman/update/password', 'updatePassword')->name('pickupman.update.password')->middleware('pickupmanIsLoggedIn');
    Route::get('pickupman/delete', 'pickupmanDelete')->name('pickupman.delete')->middleware('pickupmanIsLoggedIn');
    Route::post('pickupman/delete', 'pickupmanDeleteAccount')->name('pickupman.delete.account')->middleware('pickupmanIsLoggedIn');
    Route::get('pickupman/product/table', 'productTable')->name('pickupman.product.table')->middleware('pickupmanIsLoggedIn');
    Route::post('pickupman/product/delivery', 'productDeliveryConfirmation')->name('pickupman.product.delivery_confirmation')->middleware('pickupmanIsLoggedIn');
    Route::post('pickupman/product/return', 'productReturnConfirmation')->name('pickupman.product.return_confirmation')->middleware('pickupmanIsLoggedIn');
    Route::post('pickupman/product/return', 'productReturnConfirmation')->name('pickupman.product.return_confirmation')->middleware('pickupmanIsLoggedIn');

    Route::get('pickupman/fraud_check', 'pickupman_fraud_check')->name('pickupman.fraud_check');
    Route::get('pickupman/fraud/add_new', 'pickupman_fraud_add_new')->name('pickupman.fraud_add_new');
    Route::post('pickupman/fraud/add_new', 'pickupman_fraud_add_new_insert')->name('pickupman.fraud_add_new_insert');
    Route::get('pickupman/fraud/check', 'pickupman_fraud_check_search')->name('pickupman.fraud_check_search');
    Route::get('pickupman/fraud/myentries', 'pickupman_fraud_myentries')->name('pickupman.fraud_myentries');
    Route::post('pickupman/fraud/search', 'pickupman_fraud_search')->name('pickupman.fraud_search');
    Route::delete('/pickupman/fraud/{id}', 'pickupman_fraud_delete')->name('pickupman.fraud_delete');
    Route::post('marchant/returnAccept', 'acceptProduct')->name('marchant.accept_product_confirmation');

    Route::get('/verify/{token}', 'verifyMail');

    Route::get('/pickupman/forgot-password', 'showForgotPasswordForm')->name('forgot.password');
    Route::post('/pickupman/forgot-password', 'sendResetLinkEmail')->name('forgot.password.post');

    Route::get('/pickupman-reset-password/{token}', 'resetPassword');
    Route::post('/pickupman-reset-password/{token}', 'postResetPassword');
});


Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe')->middleware('isLoggedIn');
Route::get('/send-newsletter', [NewsletterController::class, 'sendNewsletter'])->name('send-newsletter')->middleware('isLoggedIn');
Route::get('/admin/newsletter/edit', [NewsletterController::class, 'editNewsletter'])->name('admin.newsletter.edit')->middleware('isLoggedIn');
Route::post('/admin/newsletter/update', [NewsletterController::class, 'updateNewsletter'])->name('admin.newsletter.update')->middleware('isLoggedIn');
Route::get('admin/send-newsletter/{subscriberId}', [NewsletterController::class,'sendSingleNewsletter'])->name('admin.send-single-newsletter')->middleware('isLoggedIn');
Route::post('send-selected-newsletters', [NewsletterController::class,'sendSelectedNewsletters'])->name('send.selected.newsletters')->middleware('isLoggedIn');


Route::get('lang', [LangController::class, 'lang']);
Route::get('lang/change', [LangController::class, 'lang_change'])->name('lang.change');

Route::controller(ReportController::class)->group(function(){
    Route::get('admin/daily_sales/report', 'dailySalesReport')->name('admin.daily_sales.report')->middleware('isLoggedIn');
    Route::get('admin/daily_total_sales/report', 'dailyTotalSalesReport')->name('admin.daily_total_sales.report')->middleware('isLoggedIn');
    Route::get('admin/merchant_sales/report', 'merchantSalesReport')->name('admin.merchant_sales.report')->middleware('isLoggedIn');
    Route::get('admin/return_sales/report', 'returnSalesReport')->name('admin.return_sales.report')->middleware('isLoggedIn');
    Route::get('/datesearch-daily-sales-report', 'dailySalesReport')->name('daily.sales.report')->middleware('isLoggedIn');
    Route::get('/datesearch-daily-total-sales-report', 'dailyTotalSalesReport')->name('daily.total.sales.report')->middleware('isLoggedIn');
    Route::get('/datesearch-merchant-sales-report', 'merchantSalesReport')->name('merchant.sales.report')->middleware('isLoggedIn');
    Route::get('/datesearch-return-sales-report', 'returnSalesReport')->name('return.sales.report')->middleware('isLoggedIn');
});

Route::controller(HubsController::class)->group(function () {
    Route::get('admin/hubs', 'hubsCreate')->name('admin.hubs')->middleware('isLoggedIn');
    Route::post('admin/hubs', 'hubsStore')->name('admin.post.hubs')->middleware('isLoggedIn');
    Route::get('admin/hubs/table', 'hubsIndex')->name('admin.hubs.table')->middleware('isLoggedIn');
    Route::post('admin/hubs/destroy', 'hubsDestroy')->name('admin.hubs.destroy')->middleware('isLoggedIn');
});

// require __DIR__ . '/admin.php';