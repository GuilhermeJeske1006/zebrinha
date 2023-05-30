<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PagSeguroController;



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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/produtos', [ShopController::class, 'index'])->name('produtos');
Route::match(['get', 'post'], '/produtos/{idcategoria}', [ShopController::class, 'index'])->name('produto_por_id');
Route::post( '/carrinho', [ShopController::class, 'adicionarCarrinho'])->name('adicionar_carrinho');
Route::get('/sobre', [AboutController::class, 'index'])->name('sobre');
Route::get('/contato', [ContactController::class, 'index'])->name('contato');
Route::get('/carrinho', [ShopController::class, 'carrinho'])->name('carrinho');

Route::get('/detalhes/{id}', [ShopController::class, 'Details'])->name('details');
Route::post('/comentar', [ShopController::class, 'Comentar'])->name('comentar');
Route::match(['get', 'post'], '/excluircarrinho', [ShopController::class, 'excluirCarrinho'])->name('excluir_carrinho');
Route::get('/endereco', [AdressController::class, 'Endereco'])->name('endereco');
Route::post('/enviar-email', [EmailController::class, 'enviar'])->name('enviar_email');
Route::post('/enviar-newsletter', [ProfileController::class, 'enviarNewsletter'])->name('enviar_newsletter');
Route::match(['get', 'post'],'/checkout/pagamento', [ShopController::class, 'getPagamento'])->name('getPagamento');
Route::get('/tamanhos-para-cor/{cor}/{produto_id}', [ShopController::class, 'tamanhosParaCor']);
Route::get('/pagamento/pix', [ShopController::class, 'pagamentoPix'])->name('pagamentoPix');
Route::match(['get', 'post'],'/pagamento/boleto', [ShopController::class, 'pagamentoBoleto'])->name('pagamentoBoleto');



Route::middleware([
    'auth:sanctum',
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('/perfil', [ProfileController::class, 'Perfil'])->name('perfil');
    Route::put('/perfil/editar', [ProfileController::class, 'editPerfil'])->name('edit_perfil');
    Route::get('/checkout', [ShopController::class, 'Check'])->name('checkout');
    Route::get('/compras/historico', [ShopController::class, 'historico'])->name('compra_historico');
    Route::post('/finalizar/pedido', [ShopController::class, 'finalizarPedido'])->name('finalizar_pedido');
    Route::put('/endereco/edit', [AdressController::class, 'edit'])->name('endereco.edit');
    Route::match(['get', 'post'],'/enviar/endereco', [AdressController::class, 'adicionarEndereco'])->name('adicionar_endereco');
    Route::get('/checkout/pagar', [ShopController::class, 'pagamento'])->name('pagamento');
    Route::post('/pagseguro/payment', [PagSeguroController::class, 'makePayment'])->name('makePayment');
    Route::get('/checkout/pix', [PagSeguroController::class, 'pix'])->name('pix');
    Route::match(['get', 'post'],'/checkout/boleto', [PagSeguroController::class, 'boleto'])->name('boleto');
    // Route::post('/checkout/pagar', [PagSeguroController::class, 'getKey'])->name('getKey');


});
