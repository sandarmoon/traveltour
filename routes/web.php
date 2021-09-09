<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PickPlaceController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\frontend\FrontController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\FcategoryController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\BrandController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FrontController::class,'index'])->name('frontend.index');

Route::resource('company',CompanyController::class);
Route::get('/company/index/{id}',[CompanyController::class,'getTypePartner'])->name('company.create.partner');

Route::get('/dashboard', function () {
    return view('backend.car');
})->middleware(['auth'])->name('dashboard');

Route::resource('city',CityController::class);
Route::post('getCityAjax',[CityController::class,'getCityAjax'])->name('getCityAjax');

// Route for car_pickup pivot 
Route::post('pickuproute',[PickPlaceController::class,'pickupRoute'])->name('pickup.route');

Route::resource('pickup',PickPlaceController::class);
Route::get('getPickupAjax',[PickPlaceController::class,'getPickupAjax'])->name('getPickupAjax');


Route::resource('type',TypeController::class);
Route::post('ajax/getChildType',[TypeController::class,'getChildType'])->name('ajax.getChildType');

Route::resource('car',CarController::class);
Route::get('ajax/getCars',[CarController::class,'getCars'])->name('ajax.getCars');

// for company
Route::get('partnerships',[BackendController::class,'partnership'])->name('partnership');

Route::get('ajax/getPartnership',[BackendController::class,'getPartnershipAjax'])->name('ajax.getPartnershipAjax');

//admin view for company list
Route::get('detail/cp/{id}',[BackendController::class,'companyDetail'])->name('company.detail');

//admin confirm for partnership and revoking

Route::get('confirm/partnership/{id}/{s}',[BackendController::class,'confirmPartner'])->name('confirm.parnership');


//carbookinglist view for admin
Route::get('list/car',[BackendController::class,'carBookingList'])->name('list.car');


//booking confirm and cancel for car
//sid means status
Route::get('/confirm/{id}/{sid}/{type}',[BackendController::class,'bookingConfirmed'])->name('bookinglist.confirm');

//carbooking detail
Route::get('/list/{id}/bc',[BackendController::class,'carBookingDetail'])->name('car.booking.detail');


//Fcategory view for admin
Route::resource('fcategory',FcategoryController::class);
Route::get('ajax/getFcategory',[FcategoryController::class,'getFcategoryAjax'])->name('ajax.getFcategoryAjax');

//facilities view for admin
Route::resource('facility',FacilityController::class);
Route::get('ajax/getFacilites',[FacilityController::class,'getFacilityAjax'])->name('ajax.getFacilityAjax');

// admin crud brand
Route::resource('brand',BrandController::class);
Route::post('ajax/getBrand',[BrandController::class,'getBrand'])->name('ajax.getBrand');

// company detail update
Route::post('ajax/edit_company_logo',[BackendController::class,'edit_company_logo'])->name('ajax.edit_company_logo');
Route::post('ajax/edit_main_info',[BackendController::class,'edit_main_info'])->name('ajax.edit_main_info');

Route::post('ajax/edit_company_service_info',[BackendController::class,'edit_company_service_info'])->name('ajax.edit_company_service_info');

Route::post('ajax/edit_company_photo',[BackendController::class,'edit_company_photo'])->name('ajax.edit_company_photo');



//Room Crud process 
Route::prefix('room')->group(function () {

Route::get('/',[BackendController::class,'roomIndex'])->name('room.index');
Route::get('/create',[BackendController::class,'roomCreate'])->name('room.create');

Route::get('/{id}',[BackendController::class,'roomShow'])->name('room.show');

Route::post('/store',[BackendController::class,'roomStore'])->name('room.store');

Route::get('/{id}/edit',[BackendController::class,'roomEdit'])->name('room.edit');

Route::put('/{id}',[BackendController::class,'roomUpdate'])->name('room.update');

Route::delete('/{id}',[BackendController::class,'roomDestroy'])->name('room.destroy');

Route::get('/get/rooms',[BackendController::class,'getRoomAjax'])->name('ajax.getroomAjax');

//admin for hotel-booking list
Route::get('/hotel/bookings',[BackendController::class,'getBackendHotelBooking'])->name('backend.hotel.bookinglist');

});

//hotelbooking detail
Route::get('/list/{id}/bh',[BackendController::class,'hotelBookingDetail'])->name('hotel.booking.detail');


//Tour Crud process 
Route::prefix('tour')->group(function () {

Route::get('/',[BackendController::class,'tourIndex'])->name('tour.index');
Route::get('/create',[BackendController::class,'tourCreate'])->name('tour.create');

Route::get('/{id}',[BackendController::class,'tourShow'])->name('tour.show');

Route::post('/store',[BackendController::class,'tourStore'])->name('tour.store');

Route::get('/{id}/edit',[BackendController::class,'tourEdit'])->name('tour.edit');

Route::put('/{id}',[BackendController::class,'tourUpdate'])->name('tour.update');

Route::delete('/{id}',[BackendController::class,'tourDestroy'])->name('tour.destroy');

Route::get('/get/tours',[BackendController::class,'getTourAjax'])->name('ajax.gettourAjax');

});




//Package Crud process 
Route::prefix('package')->group(function () {

Route::get('/',[BackendController::class,'packageIndex'])->name('package.index');
Route::get('/create',[BackendController::class,'packageCreate'])->name('package.create');

Route::get('/{id}',[BackendController::class,'packageShow'])->name('package.show');

Route::post('/store',[BackendController::class,'packageStore'])->name('package.store');

Route::get('/{id}/edit',[BackendController::class,'packageEdit'])->name('package.edit');

Route::put('/{id}',[BackendController::class,'packageUpdate'])->name('package.update');

Route::delete('/{id}',[BackendController::class,'packageDestroy'])->name('package.destroy');

Route::get('/get/packages',[BackendController::class,'getPackageAjax'])->name('ajax.getpackageAjax');

});



require __DIR__.'/auth.php';


// frontend start
Route::prefix('front')->group(function () {
Route::get('/',[FrontController::class,'index'])->name('frontend.index');
Route::post('/scar',[FrontController::class,'searchCar'])->name('search.car')->middleware('auth');
// Booking survey start
Route::get('/booking/{cid}',[BookingController::class,'booking'])->name('booking');

// Hotel booking start here
Route::post('/shotel',[FrontController::class,'searchHotel'])->name('search.hotel');

// Hotel booking end here
Route::post('/rooms/h',[FrontController::class,'roomsByHotelId'])->name('rooms.hotelid');

});



Route::get('/bookingdetail',[FrontController::class,'bookingdetail'])->name('bookingdetail');

Route::post('/filter/{count}/{id}',[FrontController::class,'filterByPplCount'])->name('filter.pplcount.room');

// Room booking startng from user

// Route::get('/booking/r',[FrontController::class,'rBookingPreview'])->name('preview.room.booking');

Route::get('/booking/r/{id}',[FrontController::class,'bookingRoom'])->name('booking.room');
Route::post('/rbooking/detail',[FrontController::class,'roomBookingDetail'])->name('room.rbooking.detail');

Route::get('/bookinghistory',[FrontController::class,'bookinghistory'])->name('bookinghistory');
Route::get('/bookingdetail/{id}',[FrontController::class,'bookingdetail'])->name('bookingdetail');
Route::get('/roombookingdetail/{slug}',[FrontController::class,'roombookingdetail'])->name('roombookingdetail');


//hotel booking email validation
Route::post('/custom/validation',[FrontController::class,'customEmailValidation'])->name('hotel.booking.validation');

Route::post('/hotel/checkout',[FrontController::class,'hotelBookingCheckout'])->name('hotel.booking.checkout');
