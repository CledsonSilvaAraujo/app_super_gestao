<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;


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

Route::get('/', [PrincipalController::class, 'index'])->name('site.index');
Route::get('/sobre-nos', [SobreNosController::class, 'index'])->name('site.sobrenos');
Route::get('/contato', [ContatoController::class, 'index'])->name('site.contato');
Route::get('/login', [ContatoController::class, 'index'])->name('site.login');

Route::get('/contato/{nome}/{categoria_id}',
function (
    string $nome = "Desconhecido",
    int $categoria_id = 1,
    ) {
        return "Olá, $nome, você escolheu a categoria $categoria_id.";
})
    ->where('categoria_id', '[0-9]+')
    ->where('nome', '[A-Za-z]+');


Route::get('/contato/{nome}/{categoria}/{assunto?}/{mensagem?}',
function (
    string $nome,
    string $categoria,
    string $assunto = "Sem Assunto",
    string $mensagem = "Mensagem não informada"
    ) {
        return "Olá, $nome, você escolheu a categoria $categoria, com o assunto $assunto e escreveu a mensagem: $mensagem.";
})
->where('nome', '[A-Za-z]+');

Route::prefix('/app')->group(function () {
    Route::get('/clientes', [ContatoController::class, 'index'])->name('app.clientes');
    Route::get('/fornecedores', [ContatoController::class, 'index'])->name('app.fornecedores');
    Route::get('/produtos', [ContatoController::class, 'index'])->name('app.produtos');
});

//Redirect
Route::get('/rota1', function () {
    echo "Rota 1";
})->name('site.rota1');

Route::get('/rota2', function () {
    return redirect()->route('site.rota1');
})->name('site.rota2');
//

//Fallback
Route::fallback(function () {
    echo "A rota acessada não existe. <a href='".route('site.index')."'>Clique aqui</a> para ir para a página inicial.";
});
