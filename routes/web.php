<?php


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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/relatorio-manha', 'HomeController@relatorioManha')->name('relatorioManha');
Route::get('/relatorio-tarde', 'HomeController@relatorioTarde')->name('relatorioTarde');
Route::post('/storeRelatorio', 'HomeOfficeController@storeRelatorio')->name('storeRelatorio');
Route::post('/efetivar', 'HomeOfficeController@efetivar')->name('efetivar');
Route::get('/confirmacao', 'HomeController@confirmacao')->name('confirmacao');
Route::put('/upRelatorio/{id}', 'HomeOfficeController@upRelatorio')->name('upRelatorio');
Route::delete('/destroyRelatorio/{id}', 'HomeOfficeController@destroy')->name('destroyRelatorio');

Route::get('/relatorios', 'HomeController@relatorios')->name('relatorios');
Route::get('/relatorioBusca', 'HomeController@relatoriosBuscar')->name('relatoriosBusca');
Route::get('/detalhe/{id}', 'HomeController@detalhe')->name('detalhe');

Route::get('/baixar/{id}', "HomeController@baixar")->name('baixar');
Route::delete('/removerFile/{id}',"HomeOfficeController@removerAnexo")->name('removerAnexo');
Route::get('/downloadAnexo/{id}',"HomeOfficeController@downloadAnexo")->name('downloadAnexo');

Route::get('uploads/{id}/anexo/{name}','HelperController@consultarAnexo')->name("consultarAnexo");


Route::prefix('adm')->middleware('checkAdm')->group(function(){

    Route::get('/funcionarios', 'AdmController@listFuncionarios')->name('funcionarios');
    Route::get('/funcionario/{id}', 'AdmController@detalheFuncionario')->name('detalheFuncionario');
    Route::get('/funcionario/{idFun}/detalheRelatorio/{id}', 'AdmController@detalheRelatorio')->name('detalheRelatorio');
    Route::get('/funcionario/{idFun}/pdfIndividual/{id}', 'AdmController@pdfIndividual')->name('pdfIndividual');
    Route::get('/funcionariosBusca', 'AdmController@funcionariosBusca')->name('funcionariosBusca');
    Route::get('/funcionario/{id}/relatoriosBuscaFun/', 'AdmController@relatoriosBuscaFun')->name('relatoriosBuscaFun');
    Route::post('/simplificado','AdmController@simplificado')->name('simplificado');
    Route::post('/completo','AdmController@completo')->name('completo');
});
Auth::routes();

