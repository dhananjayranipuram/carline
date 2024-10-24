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

Route::get('/', [SiteController::class, 'index']);
Route::get('/about', [SiteController::class, 'aboutUs']);
Route::get('/cars', [SiteController::class, 'ourCars']);
Route::get('/car-details', [SiteController::class, 'carDetails']);
Route::get('/offers', [SiteController::class, 'offers']);
Route::get('/news', [SiteController::class, 'news']);
Route::get('/contact', [SiteController::class, 'contactUs']);

Route::any('/send-otp', [SiteController::class, 'sendOtp']);
Route::any('/verify-otp', [SiteController::class, 'verifyOtp']);
Route::any('/register-user', [SiteController::class, 'registerUser']);

Route::any('/site/filter-cars', [SiteController::class, 'filterCars']);

Route::any('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

Route::get('/admin/cars', [AdminController::class, 'cars']);
Route::any('/admin/add-car', [AdminController::class, 'addCar']);
Route::any('/admin/edit-car', [AdminController::class, 'editCar']);

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

Route::get('/admin/general-info', [AdminController::class, 'generalInfo']);
Route::any('/admin/save-general-info', [AdminController::class, 'saveGeneralInfo']);

Route::get('/admin/policies-agreement', [AdminController::class, 'policyAgreement']);
Route::any('/admin/save-policy-agreement', [AdminController::class, 'savePolicyAgreement']);
Route::any('/admin/edit-policy-agreement', [AdminController::class, 'editPolicyAgreement']);
Route::any('/admin/update-policy-agreement', [AdminController::class, 'updatePolicyAgreement']);
Route::any('/admin/delete-policy-agreement', [AdminController::class, 'deletePolicyAgreement']);

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
