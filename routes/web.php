<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{ProductoController,UsuarioController,BuscadorController};

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




Route::get('/', [ProductoController::class,'homeProductos'])->name('index');
Route::view('/registrarse', 'publico.auth.registrarse')->name('publico.auth.registrarse');
Route::post('/registro',[UsuarioController::class,'registrar'])->name('publico.registro');

Route::view('/login', 'publico.auth.login')->name('publico.auth.login');

Route::post('/usuarios/login', [UsuarioController::class,'login'])->name('usuarios.login');
Route::get('/usuarios/logout', [UsuarioController::class,'logout'])->name('publico.logout');


Route::group(['as' => 'publico.'], function () {
    Route::get('/busqueda', [BuscadorController::class, 'busqueda'])->name('busqueda');
});
//--------------------------------------------------------------------------------------------------------------------
//Productos
/*
Route::delete('/productos/confirmDelete', 'ProductoController@confirmDelete')->name('productos.confirmDelete');
Route::post('/productos/update','ProductoController@confirmarUpdate')->name('productos.confirmarUpdate');
Route::resource('/productos', 'ProductoController');
Route::get('/carrito','ProductoController@carrito')->name('productos.carrito');
Route::get('/añadir-al-carrito/{id}', 'ProductoController@addCarrito');
Route::get('/borrar-elemento-carro/{id}','ProductoController@borrarElementoCarro');
Route::get('/borrar-carro','ProductoController@borrarCarro');
Route::post('/actualizar-carro/{id}','ProductoController@actualizarCarrito');

//Categorias
Route::delete('/categorias/confirmDelete', 'CategoriaController@confirmDelete')->name('categorias.confirmDelete');
Route::post('/categorias/update','CategoriaController@confirmarUpdate')->name('categorias.confirmarUpdate');
Route::resource('/categorias', 'CategoriaController');

//Tipos
Route::delete('/tipos/confirmDelete', 'TipoController@confirmDelete')->name('tipos.confirmDelete');
Route::post('/tipos/update','TipoController@confirmarUpdate')->name('tipos.confirmarUpdate');
Route::resource('/tipos', 'TipoController');

//Marcas
Route::delete('/marcas/confirmDelete', 'MarcaController@confirmDelete')->name('marcas.confirmDelete');
Route::post('/marcas/update','MarcaController@confirmarUpdate')->name('marcas.confirmarUpdate');
Route::resource('/marcas', 'MarcaController');

//Tallas
Route::delete('/tallas/confirmDelete', 'TallaController@confirmDelete')->name('tallas.confirmDelete');
Route::post('/tallas/update','TallaController@confirmarUpdate')->name('tallas.confirmarUpdate');
Route::resource('/tallas', 'TallaController');

//Colores
Route::delete('/colors/confirmDelete', 'ColorController@confirmDelete')->name('colors.confirmDelete');
Route::post('/colors/update','ColorController@confirmarUpdate')->name('colors.confirmarUpdate');
Route::resource('/colors', 'ColorController');

//Proveedores
Route::delete('/proveedors/confirmDelete', 'ProveedorController@confirmDelete')->name('proveedors.confirmDelete');
Route::post('/proveedors/update','ProveedorController@confirmarUpdate')->name('proveedors.confirmarUpdate');
Route::resource('/proveedors', 'ProveedorController');

//Generos
Route::delete('/generos/confirmDelete', 'GeneroController@confirmDelete')->name('generos.confirmDelete');
Route::post('/generos/update','GeneroController@confirmarUpdate')->name('generos.confirmarUpdate');
Route::resource('/generos', 'GeneroController');
*/
//Buscador
Route::get('/buscadors', [BuscadorController::class,'datos'])->name('buscador.datos');
Route::post('/buscadors/filtro', [BuscadorController::class,'filtroGeneral'])->name('buscador.filtroGeneral');
Route::post('/buscadors/barranavegacion', [BuscadorController::class,'filtroBarra'])->name('buscador.filtroBarra');
/*
//Pedido
Route::resource('/pedidos', 'PedidoController');
Route::get('/pedidos/cancelarPedido/{id}', 'PedidoController@cancelar');
Route::post('/pedidos/{id}', 'PedidoController@agregar');
Route::get('/pedidos/detalle/{id}','PedidoController@detallePedidoUsuario')->name('pedidos.detalleUsuario');
Route::get('/pedidos/detalleCuenta/{id}','PedidoController@detallePedidoUsuarioCuenta')->name('compras.detalleUsuarioCuenta');
Route::delete('/pedidos/confirmDelete', 'PedidoController@confirmDelete')->name('pedidos.confirmDelete');

//Compras
Route::resource('/compras', 'CompraController');
Route::post('/admin/compras/agregar','CompraController@agregar')->name('agregar.compra');
Route::post('/admin/compras/addcarrito','CompraController@addCarrito')->name('carro.compra');
Route::delete('/compras/confirmDelete', 'CompraController@confirmDelete')->name('compras.confirmDelete');
Route::get('/compras/detalle/{id}','CompraController@detalleCompraUsuario')->name('compras.detalleUsuario');
Route::get('/compras/detalleCuenta/{id}','CompraController@detalleCompraUsuarioCuenta')->name('compras.detalleUsuarioCuenta');

//Fechas
Route::resource('/fechas', 'FechaController');
Route::get('/fechas/eliminar/{fecha}{hora}','FechaController@eliminar');

//Pagos
Route::resource('/pagos', 'PagoController');
Route::post('/admin/pagos/agregar','PagoController@Agregar')->name('agregar.pago');
Route::delete('/pagos/confirmDelete', 'PagoController@confirmDelete')->name('pagos.confirmDelete');

Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\DashboardController@getDashboard')->name('admin.index');
    Route::get('/categorias', 'Admin\DashboardController@getCategorias')->name('admin.getcategoria');
    Route::get('/color', 'Admin\DashboardController@getColor')->name('admin.getcolor');
    Route::get('/tipos', 'Admin\DashboardController@getTipos')->name('admin.gettipo');
    Route::get('/tallas', 'Admin\DashboardController@getTallas')->name('admin.gettalla');
    Route::get('/marcas', 'Admin\DashboardController@getMarcas')->name('admin.getmarca');
    Route::get('/generos', 'Admin\DashboardController@getGeneros')->name('admin.getgenero');
    Route::get('/proveedores', 'Admin\DashboardController@getProveedores')->name('admin.getproveedor');

    Route::get('/usuarios', 'Admin\DashboardController@getUsuarios')->name('admin.getusuario');
    Route::get('/usuarios/{id}', 'Admin\DashboardController@getCompraUsuario')->name('admin.getcomprausuario');
    Route::get('/graficos/usuarios', 'Admin\DashboardController@getGraficoUsu')->name('admin.getgraficousu');

    Route::get('/productos', 'Admin\DashboardController@getProductos')->name('admin.getproducto');
    Route::get('/productos/graficos', 'Admin\DashboardController@getGraficoProducto')->name('admin.getgraficoproducto');
    Route::post('/productos/grafico/tipo', 'Admin\DashboardController@getGraficoProducto')->name('admin.getgraficoproductopost');


    Route::get('/compras/{id}', 'Admin\DashboardController@getComprasUsuario')->name('admin.getcomprausuario');
    Route::get('/compras/productos/{id}', 'Admin\DashboardController@getComprasProductos')->name('admin.getcompraproductos');
    Route::post('/compras/fecha/{id}', 'Admin\DashboardController@getComprasUsuario')->name('admin.getcomprausuariopost');
    Route::get('/compras', 'Admin\DashboardController@getCompras')->name('admin.getcompras');
    Route::post('/compras/fecha', 'Admin\DashboardController@getCompras')->name('admin.getcomprapost');
    Route::get('/graficos/compras', 'Admin\DashboardController@getGraficoCom')->name('admin.getgraficocom');
    Route::post('/graficos/compras', 'Admin\DashboardController@getGraficoCom')->name('admin.getgraficocom');

    Route::get('/pagos', 'Admin\DashboardController@getPagos')->name('admin.getpagos');
    Route::get('/pagos/{id}', 'Admin\DashboardController@getPagosCompra')->name('admin.getpagocompra');
    Route::get('/graficos/pagos', 'Admin\DashboardController@getGraficoPag')->name('admin.getgraficopag');
    Route::post('/graficos/pagos', 'Admin\DashboardController@getGraficoPag')->name('admin.getgraficopag');


    Route::get('/notificaciones/usuarios', 'Admin\DashboardController@getNotificacionesUsuarios')->name('admin.getnotificacionesusuarios');
    Route::get('/notificaciones/productos', 'Admin\DashboardController@getNotificacionesProductos')->name('admin.getnotificacionesproductos');

    Route::get('/fechas', 'Admin\DashboardController@getFechas')->name('admin.getfechas');

    Route::get('/pedidos/{id}', 'Admin\DashboardController@getPedidosUsuario')->name('admin.getpedidousuario');
    Route::get('/pedidos/productos/{id}', 'Admin\DashboardController@getPedidosProductos')->name('admin.getpedidosproductos');
    Route::post('/pedidos/fecha/{id}', 'Admin\DashboardController@getPedidosUsuario')->name('admin.getpedidousuariopost');
    Route::get('/pedidos', 'Admin\DashboardController@getPedidos')->name('admin.getpedido');
    Route::post('/pedidos/fecha', 'Admin\DashboardController@getPedidos')->name('admin.getpedidopost');

    Route::get('/graficos/pedidos', 'Admin\DashboardController@getGraficoPed')->name('admin.getgraficoped');
});



Route::prefix('usuario')->group(function(){
    Route::get('/{id}','usuario\DashboardUsuarioController@getCompras')->name('usuarioMenu.index');
    Route::get('/pedidos/{id}','usuario\DashboardUsuarioController@getPedidos')->name('usuarioMenu.getpedidos');
    Route::get('/pedidos/productos/{id}','usuario\DashboardUsuarioController@getPedidosProductos')->name('usuarioMenu.getpedidoproductos');

    Route::get('/compras/{id}','usuario\DashboardUsuarioController@getCompras')->name('usuarioMenu.getcompras');
    Route::get('/compras/productos/{id}','usuario\DashboardUsuarioController@getComprasProductos')->name('usuarioMenu.getcompraproductos');

    Route::get('/pagos/{id}','usuario\DashboardUsuarioController@getPagos')->name('usuarioMenu.getpagos');

    Route::get('/notificaciones/{id}', 'usuario\DashboardUsuarioController@getNotificaciones')->name('usuarioMenu.getnotificaciones');
});*/
