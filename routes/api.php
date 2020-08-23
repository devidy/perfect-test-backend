<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/clientes', 'ClienteController@index');
Route::get('/clientes/{cliente}', 'ClienteController@show');
Route::post('/clientes', 'ClienteController@store');
Route::put('/clientes/{cliente}', 'ClienteController@update');

Route::get('/produtos', 'ProdutoController@index');
Route::get('/produtos/{produto}', 'ProdutoController@show');
Route::post('/produtos', 'ProdutoController@store');
Route::put('/produtos/{produto}', 'ProdutoController@update');

Route::get('/vendas', 'VendaController@index');
Route::get('/vendas/{venda}', 'VendaController@show');
Route::post('/vendas', 'VendaController@store');
Route::put('/vendas/{venda}', 'VendaController@update');
