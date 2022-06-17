<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BuyerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/seller/signup', [SellerController::class, 'signup']);
Route::post('/seller/login', [SellerController::class, 'login']);
Route::post('/seller/add_item', [SellerController::class, 'add_item']);
Route::post('/seller/show_item', [SellerController::class, 'show_item']);
Route::post('/seller/delete_item', [SellerController::class, 'delete_item']);
Route::post('/seller/selling_history', [SellerController::class, 'selling_history']);
Route::post('/seller/transfer_amount', [SellerController::class, 'transfer_amount']);

Route::post('/buyer/signup', [BuyerController::class, 'signup']);
Route::post('/buyer/login', [BuyerController::class, 'login']);
Route::post('/buyer/add_amount', [BuyerController::class, 'add_amount']);
Route::post('/buyer/buy_item', [BuyerController::class, 'buy_item']);
Route::post('/buyer/save_item', [BuyerController::class, 'save_item']);
Route::post('/buyer/show_saved_items', [BuyerController::class, 'show_saved_items']);
Route::post('/buyer/delete_save_item', [BuyerController::class, 'delete_save_item']);
Route::post('/buyer/buying_history', [BuyerController::class, 'buying_history']);
Route::post('/buyer/review_item', [BuyerController::class, 'review_item']);