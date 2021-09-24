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

// Route::get('/', function () {
//     return view('welcome');
// });
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\FlowerCategoryController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Frontend\UserController;

Route::prefix('/admin')->group(function(){
    Route::group(['middleware'=>['admin']],function(){

        //admin controller
        Route::match(['get','post'],'/add-admin', [AdminController::class, 'addAdmin']);
        Route::get('/admins', [AdminController::class, 'admins']);
        Route::get('/delete-admin/{id}', [AdminController::class, 'deleteAdmin']);
        Route::get('/delete-user/{id}', [AdminController::class, 'deleteUser']);
        Route::get('/users', [AdminController::class, 'users']);
        Route::post('/update-status-user', [AdminController::class,'updateUserStatus']);
        Route::match(['get','post'],'/account-settings', [AdminController::class, 'accountSettings']);
        Route::get('/logout', [AdminController::class, 'logout']);
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
    
        //session controller
        Route::match(['get', 'post'], '/add-edit-season/{id?}', [SeasonController::class,'addEditSeason']);
        Route::get('/seasons',[SeasonController::class,'seasons']);
        Route::get('/delete-season/{id}',[SeasonController::class,'deleteSeason']);
    
        //type controller
        Route::match(['get', 'post'], '/add-edit-type/{id?}', [TypeController::class,'typesAddEdit']);
        Route::get('/types',[TypeController::class,'types']);
        Route::get('/delete-type/{id}',[TypeController::class,'typesDelete']);
    
        //Flower type controller
        Route::match(['get', 'post'], '/add-edit-category/{id?}', [FlowerCategoryController::class,'categoriesAddEdit']);
        Route::get('/categories',[FlowerCategoryController::class,'flowerCategories']);
        Route::get('/delete-category/{id}',[FlowerCategoryController::class,'categoriesDelete']);
    
        //company controller
        Route::match(['get', 'post'], '/add-edit-company/{id?}', [CompanyController::class,'companiesAddEdit']);
        Route::get('/companies',[CompanyController::class,'companies']);
        Route::get('/delete-company/{id}',[CompanyController::class,'companiesDelete']);
        Route::match(['get','post'],'/price',[CompanyController::class,'addEditPrice']);
        Route::get('/price-calculate', [CompanyController::class, 'priceCalculate']);
    });

    Route::match(['get','post'],'/', [AdminController::class, 'login']);
    Route::match(['get','post'],'/forget-password', [AdminController::class, 'forgetPassword']);
});
Route::namespace('Frontend')->group(function(){
    Route::match(['get','post'],'/', [UserController::class,'login']);
    Route::match(['get','post'],'/registration', [UserController::class,'registration']);
    Route::match(['get','post'],'confirm/{code}', [UserController::class,'userConfirmEmail']);
    Route::match(['get','post'],'forget-password', [UserController::class,'forgetPassword']);
    Route::match(['get','post'],'/account-settings', [UserController::class,'accountSettings']);
    Route::group(['middleware'=>['auth']],function(){
        Route::get('/home', [FrontController::class, 'priceCalculate']);
        Route::get('/varify-again', [UserController::class, 'EmailVarifyAgain']);
        //user controller 
        Route::get('/logout', [UserController::class,'logout']);
        //Route::get('/dashboard', [UserController::class, 'dashboard']);
        Route::get('/price', [UserController::class, 'price']);
    });
    Route::get('/check', [UserController::class, 'check']);
});