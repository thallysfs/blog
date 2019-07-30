<?php

 use App\Artigo;
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
    $lista = Artigo::listaArtigosSite(3);
    return view('site', compact('lista'));
})->name('site');

Route::get('/artigo/{id}/{titulo?}', function ($id) {
    $artigo = Artigo::find($id);
    if($artigo){
        return view('artigo', compact('artigo'));
    }
    return redirect()->route('site');
    
})->name('artigo');

Auth::routes();

//->name é o apelido da rota, me possibilita de usar o helper rout(home) sem usar o "\"
Route::get('/admin', 'AdminController@index')->name('admin');

//criei um grupo de rotas que serão protegidas.
//o prefixo incrementa o nome 'admin' na url
//o namespace me insenta de colocar na rota a pasta 'Admin' do controller antes da função. Ex: Route::get('/home', 'Admin/HomeController@index')->name('home');
//middleware chega se o usuároi está logado antes de direcionar a rota
Route::middleware('auth')->prefix('admin')->namespace('Admin')->group(function () {
    //->middleware('can:eAdmin') verifica a minha regra no arquivo AuthServiceProvider e restringe acesso.
    Route::resource('artigos', 'ArtigosController')->middleware('can:autor'); 
    Route::resource('usuarios', 'UsuariosController')->middleware('can:eAdmin'); 
    Route::resource('autores', 'AutoresController')->middleware('can:eAdmin');
    Route::resource('adm', 'AdminController')->middleware('can:eAdmin');
});
