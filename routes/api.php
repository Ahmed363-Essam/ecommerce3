<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ManagerController;
use App\Http\Controllers\api\MallController;
use App\Http\Controllers\api\DepartmentController;
use App\Http\Controllers\api\VendorController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\VendorProductController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});



Route::get('/welcomeapi', [Controller::class, 'ahmed']);

Route::group(['namespace' => 'api'], function () {

   // Route::get('ahmed',[ManagerController::class,'index']);

   Route::group(['prefix' => 'manager'], function () {

      Route::post('/insert-manager', [ManagerController::class, 'store']);
      Route::get('/get-manager', [ManagerController::class, 'index']);

      Route::post('/show-manager-post', [ManagerController::class, 'showpost']);

      Route::get('/show-manager-get/{manager_id}', [ManagerController::class, 'showget']);

      Route::delete('/delete-manager', [ManagerController::class, 'destroy']);


      Route::put('/update-manager/{manager_id}', [ManagerController::class, 'update']);
   });


   /*****************************************************************************************/

   Route::group(['prefix' => 'mail'], function () {
      Route::post('/insert-mail', [MallController::class, 'store']);
      Route::get('/get-mail', [MallController::class, 'index']);
      Route::post('/show-mail-post', [MallController::class, 'showpost']);
      Route::get('/show-mail-get/{Mall_id}', [MallController::class, 'showget']);
      Route::delete('/delete-mail', [MallController::class, 'destroy']);

      Route::put('/update-mail/{mail}', [MallController::class, 'update']);
   });



   /**********************************/

   Route::group(['prefix' => 'department'], function () {

      Route::post('/insert-department', [DepartmentController::class, 'store']);
      Route::get('/get-department', [DepartmentController::class, 'index']);
      Route::post('/show-department-post', [DepartmentController::class, 'showDepartmentpost']);
      Route::get('/show-department-get/{department_id}', [DepartmentController::class, 'showDepartmentget']);
      Route::delete('/delete-department', [DepartmentController::class, 'destroy']);

      Route::put('/update-department/{department_id}', [DepartmentController::class, 'update']);
   });


   /********************************** */
   Route::group(['prefix' => 'vendor'], function () {

      Route::post('/insert-vendor', [VendorController::class, 'store']);
      Route::get('/get-vendor', [VendorController::class, 'index']);
      Route::post('/show-vendor-post', [VendorController::class, 'showvendorpost']);
      Route::get('/show-vendor-get/{vendor_id}', [VendorController::class, 'showvendorget']);
      Route::delete('/delete-vendor', [VendorController::class, 'destroy']);

      Route::put('/update-vendor/{vendor_id}', [VendorController::class, 'update']);
   });
   /*******************************************/

   Route::group(['prefix' => 'product'], function () {
      Route::post('/insert-product', [ProductController::class, 'store']);
      Route::get('/get-product', [ProductController::class, 'index']);
      Route::post('/show-product-post', [ProductController::class, 'showproductpost']);
      Route::get('/show-product-get/{product_id}', [ProductController::class, 'showproductget']);
      Route::delete('/delete-product', [ProductController::class, 'destroy']);

      Route::put('/update-product/{product_id}', [ProductController::class, 'update']);
   });



   //*************************************/

   Route::post('/create-vendor-product', [VendorProductController::class, 'store']);
   Route::delete('/delete-vendor-product', [VendorProductController::class, 'destroy']);
});
