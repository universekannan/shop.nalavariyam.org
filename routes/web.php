<?php

use Illuminate\Support\Facades\Route;

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

// Route::any('{query}', function() { return view('404'); })->where('query', '.*');

Route::fallback(function () {
    return view("404");
}); 
Route::get('/', function () {
    return view('login');
});


Route::get('/login', 'App\Http\Controllers\AdminController@login');
Route::post('/checkLogin', 'App\Http\Controllers\AdminController@checkLogin');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');

Route::get('/not_allowed', 'App\Http\Controllers\CommonController@notAllowed');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@dashboard');
    Route::post('/add_roles', 'App\Http\Controllers\RolesController@addManageRolesAction');
    Route::get('/permissions/{id}', 'App\Http\Controllers\RolesController@managePermissions');
    
    Route::get('/users', 'App\Http\Controllers\UsersController@manageUsers');
    Route::post('/add_user', 'App\Http\Controllers\UsersController@addUser');
    Route::post('/edit_user', 'App\Http\Controllers\UsersController@editUser');
    Route::post('/delete_user', 'App\Http\Controllers\UsersController@deleteUser');
    Route::get('/users/attendance/{id}', 'App\Http\Controllers\UsersController@usersAttendance');

    Route::get('/users/permissions', 'App\Http\Controllers\PermissionsController@manageusers');
    Route::get('/userrole', 'App\Http\Controllers\PermissionsController@userrole');
    Route::post('/roles', 'App\Http\Controllers\PermissionsController@roles');
    Route::post('/addroles', 'App\Http\Controllers\PermissionsController@addRoles');

    Route::get('/getitembybarcode/{barcode}', 'App\Http\Controllers\BillController@getitembybarcode');
    Route::get('/barcode', 'App\Http\Controllers\ProductsController@barcode');
    Route::post('/save_barcode', 'App\Http\Controllers\ProductsController@save_barcode');
    Route::get('/products', 'App\Http\Controllers\ProductsController@manageProducts');
    Route::get('/minimum', 'App\Http\Controllers\ProductsController@minimum'); 
    Route::get('/pending', 'App\Http\Controllers\ProductsController@pending'); 
    Route::get('/approve', 'App\Http\Controllers\ProductsController@approve'); 
    Route::post('/save_purchase', 'App\Http\Controllers\ProductsController@save_purchase');
    Route::post('/approve_purchase', 'App\Http\Controllers\ProductsController@approve_purchase');
    Route::post('/cancel_purchase', 'App\Http\Controllers\ProductsController@cancel_purchase');
    Route::post('/order', 'App\Http\Controllers\ProductsController@Order');
    Route::post('/stock', 'App\Http\Controllers\ProductsController@Stock');


//Products//
    Route::get('/pharmacy/products', 'App\Http\Controllers\ProductsController@manageProducts');
    Route::post('/pharmacy/add_product', 'App\Http\Controllers\ProductsController@addProduct');
    Route::post('/pharmacy/edit_product', 'App\Http\Controllers\ProductsController@editProduct');



//packings//
    Route::get('pharmacy/packings',   'App\Http\Controllers\PharmacyCoController@managePackings');
    Route::post('pharmacy/add_packings', 'App\Http\Controllers\PharmacyCoController@addpackings');

//company//
    Route::get('/pharmacy/company', 'App\Http\Controllers\PharmacyCoController@manageCompany');
    Route::post('pharmacy/add_company', 'App\Http\Controllers\PharmacyCoController@addCompany');

//supplier//     
    Route::get('/pharmacy/supplier', 'App\Http\Controllers\PharmacyCoController@manageSupplier');
    Route::post('pharmacy/add_supplier', 'App\Http\Controllers\PharmacyCoController@addSupplier');

//Bill//
     Route::get('/newbill', 'App\Http\Controllers\BillController@manageBill');
     Route::get('/billdetails/{from}/{to}', 'App\Http\Controllers\BillController@billdetails');
     Route::get('/viewbill/{id}', 'App\Http\Controllers\BillController@viewbill');
     Route::get('/itemsearch/{query}', 'App\Http\Controllers\BillController@itemsearch');
     Route::Post('/savebill', 'App\Http\Controllers\BillController@savebill');

    
});


