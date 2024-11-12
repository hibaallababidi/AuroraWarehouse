<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Manager\CreateKeeperAccountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Manager\RegisterController;
use App\Http\Controllers\NeedController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecieveController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SortController;
use App\Http\Controllers\WarehouseController;
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

/*
AUTH
*/
Route::group(
    ['controller' => RegisterController::class],
    function () {
        Route::post('register', 'register');
        Route::post('verify_manager', 'verify_manager');
        Route::post('resend_code', 'Resend_verification_code');
    }
);
Route::post('/login', [LoginController::class, 'login']);
Route::group(
    ['controller' => ForgotPasswordController::class],
    function () {
        Route::post('/forgot_password', 'forgot_password');
        Route::post('/check_forgot_code', 'check_forgot_code');
        Route::post('/forgot_password_reset', 'forgot_password_reset');
    }
);

/*
MANAGER ROUTES
*/
Route::group(
    [
        'middleware' => ['jwt.guard:manager', 'jwt.auth'],
        'prefix' => '/manager'
    ], function () {
    Route::post('/create_keeper_account', [CreateKeeperAccountController::class,'create_account']);
    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::post('/reset_password', [ResetPasswordController::class, 'reset_password']);
    /*
     WAREHOUSE ROUTES
     */
    Route::group(
        ['controller' => WarehouseController::class],
        function () {
            Route::post('/add_warehouse', 'add_warehouse');
            Route::get('/manager_warehouses', 'manager_warehouses');
            Route::get('/warehouse_details/{warehouse_id}', 'warehouse_details');
        }
    );
    Route::post('/add_category', [CategoryController::class, 'add_category']);
    /*
     PRODUCT ROUTES
     */
    Route::group(
        ['controller' => ProductController::class],
        function () {
            Route::post('/add_product', 'add_product');
            Route::get('/warehouse_products/{warehouse_id}', 'warehouse_products');
        }
    );
    /*
     CLIENT ROUTES
     */
    Route::group(
        ['controller' => ClientController::class],
        function () {
            Route::post('/add_client', 'add_client');
            Route::get('/warehouse_clients/{warehouse_id}', 'warehouse_clients');
        }
    );
    /*
     RECIEVE ROUTES
     */
    Route::group(
        [
            'prefix' => '/recieve',
            'controller' => RecieveController::class
        ],
        function () {
            Route::post('/add_order', 'add_recieve_order');
            Route::post('/add_item', 'add_recieve_item');
            Route::get('/report', 'recieve_report');
        }
    );
    /*
     EXPORT ROUTES
     */
    Route::group(
      [
          'prefix' => '/export',
          'controller'=>ExportController::class
      ],
      function (){
          Route::post('/add_order','add_export_order');
          Route::post('/add_item','add_export_item');
      }
    );

    /*
     SEARCH ROUTES
     */
    Route::group(
        ['prefix' => '/search', 'controller' => SearchController::class],
        function () {
            Route::get('/product/', 'search_product');
            Route::get('/client/', 'search_client');
        }
    );
    /*
     SORT ROUTESj
     */
    Route::group(
        ['controller'=>SortController::class],
        function (){
            Route::get('/sort_quantity/{warehouse_id}','sort_quantity');
            Route::get('/sort_expiration_date/{warehouse_id}','sort_expiration_date');
        }
    );
    Route::get('/get_product_client_department/{warehouse_id}',[NeedController::class,'get_product_client_department']);
}
);
/*
KEEPER ROUTES
*/

Route::group(
    [
        'middleware' => ['jwt.guard:keeper', 'jwt.auth'],
        'prefix' => '/keeper'
    ], function () {
    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::post('/reset_password', [ResetPasswordController::class, 'reset_password']);
    /*
     WAREHOUSE ROUTES
     */
    Route::get('/warehouse_details/{warehouse_id}', [WarehouseController::class, 'warehouse_details']);
    Route::post('/add_category', [CategoryController::class, 'add_category']);
    /*
     PRODUCT ROUTES
     */
    Route::group(
        ['controller' => ProductController::class],
        function () {
            Route::post('/add_product', 'add_product');
            Route::get('/warehouse_products/{warehouse_id}', 'warehouse_products');
        }
    );
    /*
     CLIENT ROUTES
     */
    Route::group(
        ['controller' => ClientController::class],
        function () {
            Route::post('/add_client', 'add_client');
            Route::get('/warehouse_clients/{warehouse_id}', 'warehouse_clients');
        }
    );
    /*
     RECIEVE ROUTES
     */
    Route::group(
        [
            'prefix' => '/recieve',
            'controller' => RecieveController::class
        ],
        function () {
            Route::post('/add_order', 'add_recieve_order');
            Route::post('/add_item', 'add_recieve_item');
            Route::get('/report', 'recieve_report');
        }
    );
    /*
     EXPORT ROUTES
     */
    Route::group(
        [
            'prefix' => '/export',
            'controller'=>ExportController::class
        ],
        function (){
            Route::post('/add_order','add_export_order');
            Route::post('/add_item','add_export_item');
        }
    );
    /*
     SEARCH ROUTES
     */
    Route::group(
        ['prefix' => '/search', 'controller' => SearchController::class],
        function () {
            Route::get('/product/', 'search_product');
            Route::get('/client/', 'search_client');
        }
    );
    /*
     SORT ROUTES
     */
    Route::group(
        ['controller'=>SortController::class],
        function (){
            Route::get('/sort_quantity/{warehouse_id}','sort_quantity');
            Route::get('/sort_expiration_date/{warehouse_id}','sort_expiration_date');
        }
    );
    Route::get('/get_product_client_department/{warehouse_id}',[NeedController::class,'get_product_client_department']);
}
);

Route::group(
    ['controller' => NeedController::class],
    function () {
        Route::get('/get_locations', 'get_locations');
        Route::get('/get_categories', 'get_categories');
        Route::get('/get_companies/{warehouse_id}', 'get_companies');
    }
);

