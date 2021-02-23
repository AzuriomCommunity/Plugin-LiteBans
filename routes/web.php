<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Azuriom\Plugin\Litebans\Models\History;

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

Route::get('/', 'LitebansHomeController@index')->name('index');
Route::get('/mutes', 'LitebansMuteController@index')->name('mute');
Route::get('/kicks', 'LitebansKickController@index')->name('kick');
Route::get('/warns', 'LitebansWarnController@index')->name('warn');
Route::get('/history/{name}', 'LitebansHistoryController@index')->name('history');
Route::get('/history/{name}/staff', 'LitebansHistoryController@issued')->name('history.issued');
Route::get('/search', 'LitebansController@search')->name('search');
