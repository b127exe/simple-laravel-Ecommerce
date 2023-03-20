<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::group(["prefix" => "products"],function(){
   Route::get('/',[ProductController::class , "index"])->middleware('guard'); 
   Route::get('/insert',[ProductController::class , "insert"])->middleware('guard'); 
   Route::post('/insert-store',[ProductController::class , "insertStore"])->middleware('guard'); 
   Route::get('/single-product/{id}',[ProductController::class , "singleProduct"])->middleware('guard'); 
   Route::get('/update/{id}',[ProductController::class , "update"])->middleware('guard'); 
   Route::post('/update-store/{id}',[ProductController::class , "updateStore"])->middleware('guard'); 
   Route::get('/trash/{id}',[ProductController::class , "trash"])->middleware('guard'); 
   Route::get('/trash-view',[ProductController::class , "trashView"])->middleware('guard'); 
   Route::get('/restore/{id}',[ProductController::class , "restore"])->middleware('guard'); 
   Route::get('/delete/{id}',[ProductController::class , "delete"])->middleware('guard'); 
}); 

Route::get('/product-center',[ProductController::class , 'productCenter'])->middleware('guard');
Route::get('/add-cart/{id}',[ProductController::class , 'addCart'])->middleware('guard');
Route::get('/all-cart',[ProductController::class , 'allCart'])->middleware('guard');
Route::get('/remove-all-cart',[ProductController::class , 'removeAllCart'])->middleware('guard');
Route::get('/remove-cart/{id}',[ProductController::class , 'removeCart'])->middleware('guard');

Route::get('/login',[ProductController::class , 'login']);
Route::post('/login-store',[ProductController::class , 'loginStore']);
Route::get('/register',[ProductController::class , 'register']);
Route::post('/register-store',[ProductController::class , 'registerStore']);

Route::get('/destory-session',function(){
   session()->forget('cart');
   session()->forget('role');
   session()->forget('email');
});