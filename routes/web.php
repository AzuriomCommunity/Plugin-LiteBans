<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your plugin. These
| routes are loaded by the RouteServiceProvider of your plugin within
| a group which contains the "web" middleware group and your plugin name
| as prefix. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::middleware('can:litebans.bans')->get('/', 'LitebansHomeController@index')->name('index');
    Route::middleware('can:litebans.mutes')->get('/mutes', 'LitebansMuteController@index')->name('mute');
    Route::middleware('can:litebans.kicks')->get('/kicks', 'LitebansKickController@index')->name('kick');
    Route::middleware('can:litebans.warns')->get('/warns', 'LitebansWarnController@index')->name('warn');
    Route::middleware('can:litebans.player')->get('/joueur/{name}', 'LitebansHistoryController@index')->name('history');
    Route::middleware('can:litebans.player')->get('/joueur/{name}/staff', 'LitebansHistoryController@issued')->name('history.issued');
    Route::middleware('can:litebans.player')->get('/search', 'LitebansController@search')->name('search');
    Route::middleware('can:litebans.player')->get('/mes-sanctions', 'LitebansController@profile')->name('profile');
});
