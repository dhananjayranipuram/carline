<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::any('/home', [SiteController::class, 'index']);
Route::get('/about', [SiteController::class, 'aboutUs']);
Route::get('/cars', [SiteController::class, 'ourCars']);
Route::get('/car-details', [SiteController::class, 'carDetails']);
Route::get('/offers', [SiteController::class, 'offers']);
Route::get('/news', [SiteController::class, 'news']);
Route::get('/contact', [SiteController::class, 'contactUs']);
Route::get('/my-account', [SiteController::class, 'myAccount']);
Route::any('/my-account-details', [SiteController::class, 'myAccountDetails']);
Route::any('/my-documents', [SiteController::class, 'myDocumentDetails']);
Route::any('/edit-upload-docs', [SiteController::class, 'editUploadDocuments']);
Route::any('/missing-upload-docs', [SiteController::class, 'missingUploadDocuments']);
Route::get('/logout', [SiteController::class, 'logout']);

Route::any('/check-document-uploaded', [SiteController::class, 'checkDocumentUploaded']);
Route::any('/upload-docs', [SiteController::class, 'uploadDocuments']);
Route::any('/cancel-booking', [SiteController::class, 'cancelBooking']);
Route::any('/send-reset-link', [SiteController::class, 'sendResetLink']);
Route::any('/reset-password/{token}', [SiteController::class, 'resetPassword']);
Route::any('/reset-user-password', [SiteController::class, 'resetPasswordUpdate']);

Route::any('/send-otp', [SiteController::class, 'sendOtp']);
Route::any('/verify-otp', [SiteController::class, 'verifyOtp']);
Route::any('/register-user', [SiteController::class, 'registerUser']);
Route::any('/update-user', [SiteController::class, 'updateUser']);
Route::any('/user-login', [SiteController::class, 'loginUser']);
Route::any('/save-car-booking', [SiteController::class, 'saveCarBooking']);
Route::any('/check-car-booking', [SiteController::class, 'checkCarBooking']);

Route::any('/send-contact-us', [SiteController::class, 'sendContactUs']);
Route::any('/policies-agreements', [SiteController::class, 'policiesAgreements']);

Route::any('/terms-conditions', [SiteController::class, 'termsConditions']);
Route::any('/privacy-policy', [SiteController::class, 'privacyPolicy']);
Route::any('/refund-policy', [SiteController::class, 'refundPolicy']);
Route::any('/cancelation-policy', [SiteController::class, 'cancelationPolicy']);

Route::any('/check-rate', [SiteController::class, 'checkRate']);
Route::any('/check-time', [SiteController::class, 'checkTime']);

Route::any('/get-whatsapp-msg', [SiteController::class, 'getWhatsappMsg']);

Route::any('/site/filter-cars', [SiteController::class, 'filterCars']);
Route::any('/site/filter-offer-cars', [SiteController::class, 'filterOfferCars']);

Route::any('/admin/login', [AdminController::class, 'login'])->name('adminLogin');
Route::middleware(['check.session', 'prevent.back.history'])->group(function () {
    
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::any('/admin/get-dashboard-booking-data', [AdminController::class, 'dashboardAjax']);
    Route::any('/admin/reports', [AdminController::class, 'reports']);

    Route::get('/admin/users', [AdminController::class, 'userList']);
    Route::get('/admin/view-user', [AdminController::class, 'viewUsers']);
    Route::any('/admin/delete-user', [AdminController::class, 'deleteUsers']);
    Route::any('/admin/edit-users', [AdminController::class, 'editUsers']);
    Route::any('/admin/download-document', [AdminController::class, 'downloadDocument']);

    Route::any('/admin/bookings', [AdminController::class, 'bookingList']);
    Route::any('/admin/booking-details', [AdminController::class, 'bookingDetails']);
    Route::any('/admin/update-document-status', [AdminController::class, 'updateDocumentStatus']);

    Route::get('/admin/cars', [AdminController::class, 'cars']);
    Route::any('/admin/add-car', [AdminController::class, 'addCar']);
    Route::any('/admin/edit-car', [AdminController::class, 'editCar']);
    Route::any('/admin/delete-car', [AdminController::class, 'deleteCar']);
    Route::any('/admin/delete-car-image', [AdminController::class, 'deleteCarImage']);
    Route::any('/admin/preview-car', [AdminController::class, 'previewCar']);

    Route::get('/admin/add-specifications', [AdminController::class, 'addSpecifications']);
    Route::any('/admin/add-spec', [AdminController::class, 'addSpec']);
    Route::any('/admin/edit-spec', [AdminController::class, 'editSpec']);
    Route::any('/admin/update-spec', [AdminController::class, 'updateSpec']);
    Route::any('/admin/delete-spec', [AdminController::class, 'deleteSpec']);

    Route::get('/admin/add-emirates', [AdminController::class, 'addEmirates']);
    Route::any('/admin/add-new-emirates', [AdminController::class, 'addNewEmirates']);
    Route::any('/admin/edit-emirates', [AdminController::class, 'editEmirates']);
    Route::any('/admin/update-emirates', [AdminController::class, 'updateEmirates']);

    Route::get('/admin/add-features', [AdminController::class, 'addFeatures']);
    Route::any('/admin/save-feature', [AdminController::class, 'saveFeatures']);
    Route::any('/admin/delete-feature', [AdminController::class, 'deleteFeatures']);
    Route::any('/admin/update-feature', [AdminController::class, 'updateFeatures']);

    Route::get('/admin/add-brand', [AdminController::class, 'addBrands']);
    Route::any('/admin/edit-brand', [AdminController::class, 'editBrand']);
    Route::any('/admin/new-brand', [AdminController::class, 'addBrand']);
    Route::any('/admin/update-brand', [AdminController::class, 'updateBrand']);
    Route::any('/admin/delete-brand', [AdminController::class, 'deleteBrand']);

    Route::get('/admin/add-type', [AdminController::class, 'addTypes']);
    Route::any('/admin/edit-type', [AdminController::class, 'editType']);
    Route::any('/admin/new-type', [AdminController::class, 'addType']);
    Route::any('/admin/update-type', [AdminController::class, 'updateType']);
    Route::any('/admin/delete-type', [AdminController::class, 'deleteType']);

    Route::any('/admin/general-info', [AdminController::class, 'generalInfo']);

    Route::get('/admin/policies-agreement', [AdminController::class, 'policyAgreement']);
    Route::any('/admin/save-policy-agreement', [AdminController::class, 'savePolicyAgreement']);
    Route::any('/admin/edit-policy-agreement', [AdminController::class, 'editPolicyAgreement']);
    Route::any('/admin/update-policy-agreement', [AdminController::class, 'updatePolicyAgreement']);
    Route::any('/admin/delete-policy-agreement', [AdminController::class, 'deletePolicyAgreement']);
    
    Route::any('/admin/update-add-settings', [AdminController::class, 'updateAdditionalSettings']);
    Route::any('/admin/get-additional-settings', [AdminController::class, 'getAdditionalSettings']);

    Route::any('/admin/export-users', [AdminController::class, 'exportUsers']);
    Route::any('/admin/export-bookings', [AdminController::class, 'exportBookings']);

    Route::get('/admin/logout', [AdminController::class, 'logout']);
});
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//To create symbolic link
Route::get('/sym-link', function () {
    Artisan::call('storage:link');
});