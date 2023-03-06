<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::group(["prefix" => "products"],function(){
   Route::get('/',[ProductController::class , "index"]); 
   Route::get('/insert',[ProductController::class , "insert"]); 
   Route::post('/insert-store',[ProductController::class , "insertStore"]); 
   Route::get('/single-product/{id}',[ProductController::class , "singleProduct"]); 
   Route::get('/update/{id}',[ProductController::class , "update"]); 
   Route::post('/update-store/{id}',[ProductController::class , "updateStore"]); 
   Route::get('/trash/{id}',[ProductController::class , "trash"]); 
   Route::get('/trash-view',[ProductController::class , "trashView"]); 
   Route::get('/restore/{id}',[ProductController::class , "restore"]); 
   Route::get('/delete/{id}',[ProductController::class , "delete"]); 
}); 