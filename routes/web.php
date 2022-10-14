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

Route::get('login', 'registrasiC@login');
Route::post('login', 'authC@proses')->name('proses.login');
Route::get('register', 'registrasiC@register');
Route::post('register', 'registrasiC@store')->name('store.register');
Route::get('forgot', 'registrasiC@forgot');
Route::put('forgot', 'registrasiC@resetpassword')->name('forgot.password');


Route::get('identitas', 'identitasC@index');