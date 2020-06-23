<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['web','auth'], 'prefix' => 'painel'], function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

Route::group(['middleware' => ['web','auth'], 'prefix' => 'painel/funcionarios'], function(){
    Route::get('/', 'FuncionariosController@index')->name('funcionarios');
    Route::get('/extrato/{id?}', 'FuncionariosController@extrato')->name('funcionarios.extrato');
    Route::get('/novo', 'FuncionariosController@novoForm')->name('funcionarios.novo');
    Route::get('/editar/{funcionarios}', 'FuncionariosController@editarForm')->name('funcionarios.editar');
    Route::post('/novo', 'FuncionariosController@inserir')->name('funcionarios.inserir');
    Route::post('/edicao', 'FuncionariosController@edicao')->name('funcionarios.edicao');

});

Route::group(['middleware' => ['web','auth'], 'prefix' => 'painel/movimentacoes'], function(){
    Route::get('/', 'MovimentacoesController@index')->name('movimentacoes');
    Route::get('/novo', 'MovimentacoesController@novoForm')->name('movimentacoes.novo');
    Route::get('/editar/{id}', 'MovimentacoesController@editarForm')->name('movimentacoes.editar');
    Route::post('/novo', 'MovimentacoesController@inserir')->name('movimentacoes.inserir');
});
Auth::routes();
