<?php

use App\Http\Controllers\MyController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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
///
//Route::get('/index', function () {
//    return view('admin/index');
//});
//
//Route::get('/register', function () {
//    return view('user/register');
//});
//
//Route::get('/login', function () {
//    return view('user/login');
//});
///////////
Route::get('/add-products', function () {
    return view('user/add-products');
});
////
//Route::get('/database',function (){
//    Schema::create('users',function (Blueprint $table){
//        $table->increments('id');
//        $table->string('name');
//        $table->string('email')->unique();
//        $table->string('password');
//        $table->rememberToken();
//        $table->timestamps();
//    });
//});
//
Route::get('/database',function (){
    Schema::create('products',function (Blueprint $table){
        $table->increments('id');
        $table->string('name');
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2);
        $table->integer('quantity')->default(0);
        $table->rememberToken();
        $table->timestamps();
    });
});
//Goi register
Route::get('/register',[MyController::class,'create']);
Route::post('/register',[MyController::class,'store'])->name('store');
//
Route::get('/login',[MyController::class,'showLoginForm']);
Route::post('/login',[MyController::class,'login'])->name('login');
Route::post('/index',function (){
    return view('admin/index');
})->name('index');



Route::get('/add-products',[MyController::class,'created']);
Route::post('/add-products',[MyController::class,'stored'])->name('view');
Route::get('/index', function () {
    return view('admin/index');
})->name('indexed');
