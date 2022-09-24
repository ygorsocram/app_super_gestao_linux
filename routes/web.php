<?php

use Dotenv\Util\Str;
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

Route::get('/', [\App\Http\Controllers\PrincipalController::class,'principal']);
Route::get('/sobre-nos', [\App\Http\Controllers\SobreNosController::class,'sobreNos']);
Route::get('/contato',[\App\Http\Controllers\ContatoController::class,'contato']);

Route::get('/contato/{nome}/{texto?}/{categoriaId}', function (string $nome, string $texto = "Tessste", int $categoriaId) {
    echo "Teste: $nome - $texto - $categoriaId";
})->where('categoriaId', '[0-9]+')->where('nome','[A-Za-z]+');

Route::prefix('/app')->group(function() {
    Route::get('/login',[\App\Http\Controllers\loginController::class,'login']);
    Route::get('/contato',[\App\Http\Controllers\clientesController::class,'clientes']);
    Route::get('/produtos',[\App\Http\Controllers\ProdutosController::class,'produtos']);
});
