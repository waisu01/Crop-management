<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Models\Item;
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


Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('login');
Route::get('/account/touroku', [App\Http\Controllers\AccountController::class, 'touroku']);
Route::post('/account/tourokujikkou',[App\Http\Controllers\AccountController::class, 'tourokujikkou']);
Route::post('/account/auth',[App\Http\Controllers\AccountController::class, 'auth']);
Route::get('/logout', [App\Http\Controllers\AccountController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {

    //ホーム画面表示用
    Route::get('/home', [HomeController::class, 'home'])->name('home.home');
    //一覧画面表示用
    Route::get('/home/list', [HomeController::class, 'list'])->name('home.list');
    // 詳細画面表示用
    Route::get('/home/show/{id}', [HomeController::class, 'show'])->name('home.show');

});

Route::group(['middleware' => ['auth', 'can:admin']], function () {

    // ユーザー一覧画面を表示
    Route::get('/user/index',[App\Http\Controllers\UserController::class, 'index']);
    // ユーザー編集画面を表示
    Route::get('/user/edit/{id}',[App\Http\Controllers\UserController::class, 'edit']);
    // 更新処理
    Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update']);
    // 削除処理
    Route::post('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

    // 画面遷移：デフォルトは商品管理画面へ遷移
	Route::get('/item', [App\Http\Controllers\ItemController::class,'view_ItemList']);

	// 画面遷移：商品管理画面へ遷移
	Route::get('/item/ItemList',[App\Http\Controllers\ItemController::class,'view_ItemList'])->name('ItemList');

	// 画面遷移：商品登録画面へ遷移
	Route::post('/item/ItemRegister/{from}/{user_id}', [App\Http\Controllers\ItemController::class,'view_ItemRegister'])->name('ItemRegister');

	// 画面遷移：商品登録画面へ遷移(バリデーションエラー用)
	Route::get('/item/ItemRegister/{from}/{user_id}', [App\Http\Controllers\ItemController::class,'view_ItemRegister']);

	// 画面遷移：商品登録の確認画面へ遷移
	Route::post('/item/ItemRegisterCheck/{user_id}', [App\Http\Controllers\ItemController::class,'view_ItemRegisterCheck'])->name('ItemRegisterCheck');

	// 画面遷移：商品更新画面へ遷移
	Route::post('/item/ItemUpdate/{item}/{user_id}', [App\Http\Controllers\ItemController::class,'view_ItemUpdate'])->name('ItemUpdate');

	// 画面遷移：商品更新画面へ遷移
	Route::post('/item/ItemUpdate/{user_id}', [App\Http\Controllers\ItemController::class,'view_ItemUpdate'])->name('ItemUpdate_bak');

	// 画面遷移：商品更新画面へ遷移(バリデーションエラー用)
	Route::get('/item/ItemUpdate/{item}/{user_id}', [App\Http\Controllers\ItemController::class,'view_ItemUpdate']);

	// 画面遷移：商品更新の確認画面へ遷移
	Route::post('/item/ItemUpdateCheck/{user_id}', [App\Http\Controllers\ItemController::class,'view_ItemUpdateCheck'])->name('ItemUpdateCheck');

	// 画面遷移：商品削除画面へ遷移
	Route::post('/item/ItemDelete/{item}/{user_id}', [App\Http\Controllers\ItemController::class,'view_ItemDelete'])->name('ItemDelete');

	// DB操作：指定した商品IDのカラムを削除
	Route::post('/item/delte_Item/{id}/{user_id}', [App\Http\Controllers\ItemController::class,'delete_Item'])->name('deleteItemDB');

	// DB操作：指定した商品の内容を更新
	Route::post('/item/update_Item/{user_id}', [App\Http\Controllers\ItemController::class,'update_Item'])->name('updateItemDB');

	// DB操作：入力した商品情報を登録
	Route::post('/item/register_Item/', [App\Http\Controllers\ItemController::class,'register_Item'])->name('registerItemDB');


});