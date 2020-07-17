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

Route::get('/main', function () {
    return view('home_system');
})->middleware('logado')->name('main');


Route::group(['prefix' => '/'], function () {
    
    Route::get('', 'LoginController@tela_principal')->name("index");
    Route::get('login', 'LoginController@tela_login')->name("login");
    Route::post('logando', 'LoginController@logando')->name("logando");
    Route::get('deslogando', 'LoginController@deslogando')->name("deslogando");
});

/*ROTAS PARA PRODUTOS */

Route::group(['prefix' => '/category/', 'middleware' => ['logado']], function () {
    
    Route::get('list', 'CategoriaController@category_list')->name("list_category"); //LISTA FUNCIONÁRIOS
    Route::post('save_category', 'CategoriaController@save_category')->name("save_category"); // FORM CADASTRA FUNCIONÁRIO
    Route::post('edit',  'CategoriaController@category_edit')->name("edit_category"); // FORM EDITA FUNCIONÁRIO
    Route::get('del_cat/{id}', 'CategoriaController@category_del')->name("del_category");  //FORM EXCLUI FUNCIONÁRIO
});

/*ROTAS PARA FORNECEDORES */
Route::group(['prefix' => '/supplier/', 'middleware' => ['logado']], function () {
    
    Route::get('list', 'FornecedorController@supplier_list')->name("supplier_list"); //LISTA FUNCIONÁRIOS 
    Route::get('register', 'FornecedorController@supplier_register')->name("supplier_register");
    Route::post('save_register', 'FornecedorController@save_supplier')->name("save_supplier"); // FORM CADASTRA FUNCIONÁRIO
    Route::get('edit/{id}', 'FornecedorController@supplier_edit')->name("supplier_edit"); // FORM EDITA FUNCIONÁRIO
    Route::post('save_edit', 'FornecedorController@save_edit_sup')->name("save_edit_sup"); // FORM SALVA EDIÇÃO
    Route::get('del_sup/{id}', 'FornecedorController@supplier_del')->name("supplier_del");  //FORM EXCLUI FUNCIONÁRIO 
});

/*ROTAS PARA ESTOQUE */
Route::group(['prefix' => '/inventory/', 'middleware' => ['logado']], function () {
    
    Route::get('list_inventory', 'EstoqueController@inventory_list')->name("inventory_list"); //LISTA FUNCIONÁRIOS 
    Route::get('register', 'EstoqueController@inventory_register')->name("inventory_register");
    Route::post('save_register', 'EstoqueController@save_inventory')->name("save_inventory"); // FORM CADASTRA FUNCIONÁRIO
   
});

/*ROTAS PARA PRODUTOS */
Route::group(['prefix' => '/product/', 'middleware' => ['logado']], function () {
    
    Route::get('list', 'ProdutoController@product_list')->name("product_list"); //LISTA FUNCIONÁRIOS 
    Route::get('register', 'ProdutoController@product_register')->name("product_register");
    Route::post('save', 'ProdutoController@save_product')->name("save_product"); // FORM CADASTRA FUNCIONÁRIO
    Route::post('edit_prod', 'ProdutoController@product_edit')->name("product_edit"); // FORM EDITA FUNCIONÁRIO

});

/*ROTAS PARA ORDEM DE SERVIÇO */
Route::group(['prefix' => '/order/', 'middleware' => ['logado']], function () {
    
    
    Route::get('register', 'OrdemServicoController@order_register')->name("order_register");
    Route::post('save', 'OrdemServicoController@save_order')->name("save_order"); // FORM CADASTRA FUNCIONÁRIO
    Route::get('list', 'OrdemServicoController@order_list')->name("order_list"); //LISTA FUNCIONÁRIOS 
    Route::post('edit_order', 'OrdemServicoController@order_edit')->name("order_edit"); // FORM EDITA FUNCIONÁRIO*/
    Route::get('del_order/{id}', 'OrdemServicoController@order_del')->name("order_del"); // FORM EDITA FUNCIONÁRIO*/

});

/*ROTAS PARA GERAR PDF*/
Route::group(['prefix' => '/pdf/', 'middleware' => ['logado']], function () {
    
    Route::get('pdfOrderService/{id}', 'PdfController@order_pdf')->name("order_pdf");
    Route::get('pdfSale/{id}', 'PdfController@order_pdf')->name("sale_pdf");

});



/*ROTAS PARA CLIENTES */
Route::group(['prefix' => '/costumer/', 'middleware' => ['logado']], function () {
    
    Route::get('list', 'ClienteController@costumer_list')->name("list_costumer"); //LISTA FUNCIONÁRIOS
    Route::get('register', 'ClienteController@costumer_register')->name("register_cos");
    Route::post('save_register', 'ClienteController@save_register')->name("save_register"); // FORM CADASTRA FUNCIONÁRIO
    Route::get('edit/{id}', 'ClienteController@costumer_edit')->name("edit_costumer"); // FORM EDITA FUNCIONÁRIO
    Route::post('save_edit', 'ClienteController@save_edit')->name("save_edit_cos"); // FORM SALVA EDIÇÃO
    Route::get('del_emp/{id}', 'ClienteController@costumer_del')->name("del_costumer");  //FORM EXCLUI FUNCIONÁRIO
});


/*ROTAS PARA EQUIPAMENTO */
Route::group(['prefix' => '/equipment/', 'middleware' => ['logado']], function () {

    Route::get('list/{id}', 'EquipamentoController@equipment_list')->name("equipment_list"); //LISTA FUNCIONÁRIOS
    Route::get('edit/{id}', 'EquipamentoController@equipment_edit')->name("equipment_edit");
    Route::post('save', 'EquipamentoController@save_equipment')->name("save_equipment"); // FORM CADASTRA FUNCIONÁRIO
    Route::post('save_edit', 'EquipamentoController@save_edit_equip')->name("save_edit_equip"); // FORM CADASTRA FUNCIONÁRIO
    Route::get('del_emp/{id}/{id_cli}', 'EquipamentoController@equipment_del')->name("equipment_del");  //FORM EXCLUI FUNCIONÁRIO

});

/*ROTAS PARA VENDAS*/
Route::group(['prefix' => '/sale/', 'middleware' => ['logado']], function () {

    Route::get('register', 'VendaController@sale_register')->name("sale_register"); //LISTA FUNCIONÁRIOS
    Route::post('save', 'VendaController@save_sale')->name("save_sale"); // FORM CADASTRA FUNCIONÁRIO
    Route::get('list', 'VendaController@sale_list')->name("sale_list"); //LISTA FUNCIONÁRIOS
    /*Route::get('edit/{id}', 'VendaController@equipment_edit')->name("equipment_edit");
    Route::post('save_edit', 'VendaController@save_edit_equip')->name("save_edit_equip"); // FORM CADASTRA FUNCIONÁRIO
    Route::get('del_emp/{id}/{id_cli}', 'VendaController@equipment_del')->name("equipment_del");  *///FORM EXCLUI FUNCIONÁRIO

});

/*ROTAS PARA FUNCIONÁRIO */
Route::group(['prefix' => '/employee/', 'middleware' => ['logado']], function () {
    
    Route::get('keep', 'FuncionarioController@employee_list')->name("keep_employee"); //LISTA FUNCIONÁRIOS
    Route::post('register', 'FuncionarioController@employee_register')->name("register_employee"); // FORM CADASTRA FUNCIONÁRIO
    Route::get('edit/{id}', 'FuncionarioController@employee_edit')->name("edit_employee"); // FORM EDITA FUNCIONÁRIO
    Route::post('save_edit', 'FuncionarioController@save_edit')->name("save_edit"); // FORM SALVA EDIÇÃO
    Route::get('del_emp/{id}', 'FuncionarioController@employ_Del')->name("del_employee");  //FORM EXCLUI FUNCIONÁRIO
});


/*ROTAS PARA USUÁRIOS */
Route::group(['prefix' => '/user/', 'middleware' => ['logado']], function () {
    
    Route::get('keep', 'UsuarioController@user_keep')->name("user_keep"); // FORM EDITA FUNCIONÁRIO
    Route::post('register', 'UsuarioController@user_register')->name("user_register"); //LISTA FUNCIONÁRIOS
    Route::post('edit', 'UsuarioController@user_edit')->name("user_edit"); // FORM CADASTRA FUNCIONÁRIO
    Route::get('del/{id}', 'UsuarioController@user_del')->name("user_del");
  
});
