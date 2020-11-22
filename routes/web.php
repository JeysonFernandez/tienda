<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{ProductoController,UsuarioController,BuscadorController};
use App\Http\Controllers\{CategoriaController, ColorController, TipoController, TallaController, MarcaController};
use App\Http\Controllers\{GeneroController,ProveedorController,CompraController,PagoController,FechaController,PedidoController};
use App\Http\Controllers\Admin\{DashboardController};
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
    Route::get('/ver/{id}', [BuscadorController::class, 'verProducto'])->name('ver-producto')->where('id', '[0-9]+');

    Route::group(['as'=> 'producto.'], function(){
        Route::get('/carrito',[ProductoController::class, 'carrito'])->name('carrito');
        Route::get('/añadir-al-carrito/{id}', [ProductoController::class, 'addCarrito'])->name('addcarrito');
        Route::get('/borrar-elemento-carro/{id}',[ProductoController::class, 'borrarElementoCarro'])->name('boorarelementocarrito');
        Route::get('/borrar-carro',[ProductoController::class, 'borrarCarro'])->name('borrarcarro');
        Route::post('/actualizar-carro/{id}',[ProductoController::class, 'actualizarCarrito'])->name('actualizarcarro');
    });
});

//ADMIN-----------------------------------------------------------------------------------------------------------------------------------------
Route::group(['as'=> 'admin.'], function(){
    Route::get('/admin',[DashboardController::class,'index'])->name('index');
    Route::group(['as'=> 'categoria.'], function(){
        Route::delete('/categorias/confirmDelete', [CategoriaController::class,'confirmDelete'])->name('confirmDelete');
        Route::get('/categorias', [DashboardController::class,'getCategorias'])->name('verCategorias');
        Route::get('/categorias/crear', [CategoriaController::class,'crearCategoria'])->name('crearCategoria');
        Route::get('/categoria/editar/{id}',[CategoriaController::class,'editarCategoria'])->name('editarCategoria');
        Route::post('/categorias/update',[CategoriaController::class,'guardarCategoria'])->name('guardarCategoria');
    });

    Route::group(['as'=> 'color.'], function(){
        Route::get('/color',[DashboardController::class,'getColor'])->name('getcolor');
        Route::delete('/colors/confirmDelete', [ColorController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/colors/update',[ColorController::class,'confirmarUpdate'])->name('confirmarUpdate');
    });

    Route::group(['as'=> 'tipo.'], function(){
        Route::get('/tipos', [DashboardController::class,'getTipos'])->name('gettipo');
        Route::delete('/tipos/confirmDelete', [TipoController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/tipos/update',[TipoController::class,'confirmarUpdate'])->name('confirmarUpdate');
    });

    Route::group(['as'=> 'talla.'], function(){
        Route::get('/tallas', [DashboardController::class,'getTallas'])->name('gettalla');
        Route::delete('/tallas/confirmDelete', [TallaController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/tallas/update',[TallaController::class,'confirmarUpdate'])->name('confirmarUpdate');
    });

    Route::group(['as'=> 'marca.'], function(){
        Route::get('/marcas', [DashboardController::class,'getMarcas'])->name('getmarca');
        Route::delete('/marcas/confirmDelete', [MarcaController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/marcas/update',[MarcaController::class,'confirmarUpdate'])->name('confirmarUpdate');
    });

    Route::group(['as'=> 'genero.'], function(){
        Route::get('/generos', [DashboardController::class,'getGeneros'])->name('getgenero');
        Route::delete('/generos/confirmDelete', [GeneroController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/generos/update',[GeneroController::class,'confirmarUpdate'])->name('confirmarUpdate');
    });

    Route::group(['as'=> 'proveedor.'], function(){
        Route::get('/proveedores',[DashboardController::class,'getProveedores'])->name('getproveedor');
        Route::delete('/proveedors/confirmDelete', [ProveedorController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/proveedors/update',[ProveedorController::class,'confirmarUpdate'])->name('confirmarUpdate');
    });

    Route::group(['as'=> 'usuario.'], function(){
        Route::get('/usuarios', [DashboardController::class,'getUsuarios'])->name('getusuario');
        Route::get('/usuarios/{id}', [DashboardController::class,'getCompraUsuario'])->name('getcomprausuario');
        Route::get('/graficos/usuarios', [DashboardController::class,'getGraficoUsu'])->name('getgraficousu');
    });

    Route::group(['as'=> 'producto.'], function(){
        Route::get('/productos', [DashboardController::class,'getProductos'])->name('getproducto');
        Route::get('/productos/graficos', [ProductoController::class,'getGraficoProducto'])->name('getgraficoproducto');
        Route::post('/productos/grafico/tipo', [ProductoController::class,'getGraficoProducto'])->name('getgraficoproductopost');
        Route::delete('/productos/confirmDelete', [ProductoController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/productos/update',[ProductoController::class,'confirmarUpdate'])->name('confirmarUpdate');

        Route::get('/productos/agregar',[ProductoController::class,'create'])->name('crearproducto');
        Route::get('/productos/agregar',[ProductoController::class,'store'])->name('agregarproducto');
    });

    Route::group(['as'=> 'compra.'], function(){
        Route::get('/compras/{id}', [DashboardController::class,'getComprasUsuario'])->name('getcomprausuario');
        Route::get('/compras/productos/{id}', [DashboardController::class,'getComprasProductos'])->name('getcompraproductos');
        Route::post('/compras/fecha/{id}', [DashboardController::class,'getComprasUsuario'])->name('getcomprausuariopost');
        Route::get('/compras', [DashboardController::class,'getCompras'])->name('getcompras');
        Route::post('/compras/fecha', [DashboardController::class,'getCompras'])->name('getcomprapost');
        Route::get('/graficos/compras', [DashboardController::class,'getGraficoCom'])->name('getgraficocom');
        Route::post('/graficos/compras', [DashboardController::class,'getGraficoCom'])->name('getgraficocompost');

        Route::post('/admin/compras/agregar',[CompraController::class,'agregar'])->name('agregarcompra');
        Route::post('/admin/compras/addcarrito',[CompraController::class,'addCarrito'])->name('agregarcarritocompra');
        Route::delete('/compras/confirmDelete', [CompraController::class,'confirmDelete'])->name('confirmDelete');
        Route::get('/compras/detalle/{id}',[CompraController::class,'detalleCompraUsuario'])->name('detalleUsuario');
        Route::get('/compras/detalleCuenta/{id}',[CompraController::class,'detalleCompraUsuarioCuenta'])->name('detalleUsuarioCuenta');
    });

    Route::group(['as'=> 'pago.'], function(){
        Route::get('/pagos', [DashboardController::class,'getPagos'])->name('getpagos');
        Route::get('/pagos/{id}', [DashboardController::class,'getPagosCompra'])->name('getpagocompra');
        Route::get('/graficos/pagos', [DashboardController::class,'getGraficoPag'])->name('getgraficopag');
        Route::post('/graficos/pagos', [DashboardController::class,'getGraficoPag'])->name('getgraficopagpost');

        Route::resource('/pagos', 'PagoController');
        Route::post('/admin/pagos/agregar',[PagoController::class,'Agregar'])->name('agregar');
        Route::delete('/pagos/confirmDelete', [PagoController::class,'confirmDelete'])->name('confirmDelete');
    });

    Route::group(['as'=> 'notificacion.'], function(){
        Route::get('/notificaciones/usuarios', [DashboardController::class,'getNotificacionesUsuarios'])->name('getnotificacionesusuarios');
        Route::get('/notificaciones/productos', [DashboardController::class,'getNotificacionesProductos'])->name('getnotificacionesproductos');
    });

    Route::group(['as'=> 'fecha.'], function(){
        Route::get('/fechas', [DashboardController::class,'getFechas'])->name('getfechas');
        Route::resource('/fechas', 'FechaController');
        Route::get('/fechas/eliminar/{fecha}{hora}',[FechaController::class,'eliminar'])->name('eliminarfecha');
    });

    Route::group(['as'=> 'pedido.'], function(){
        Route::get('/pedidos/{id}', [DashboardController::class,'getPedidosUsuario'])->name('getpedidousuario');
        Route::get('/pedidos/productos/{id}', [DashboardController::class,'getPedidosProductos'])->name('getpedidosproductos');
        Route::post('/pedidos/fecha/{id}', [DashboardController::class,'getPedidosUsuario'])->name('getpedidousuariopost');
        Route::get('/pedidos', [DashboardController::class,'getPedidos'])->name('getpedido');
        Route::post('/pedidos/fecha', [DashboardController::class,'getPedidos'])->name('getpedidopost');
        Route::get('/graficos/pedidos', [DashboardController::class,'getGraficoPed'])->name('getgraficoped');

        Route::get('/pedidos/cancelarPedido/{id}', [PedidoController::class,'cancelar'])->name('cancelarpedido');
        Route::post('/pedidos/{id}', [PedidoController::class,'agregar'])->name('agregarpedido');
        Route::get('/pedidos/detalle/{id}',[PedidoController::class,'detallePedidoUsuario'])->name('detalleUsuario');
        Route::get('/pedidos/detalleCuenta/{id}',[PedidoController::class,'detallePedidoUsuarioCuenta'])->name('detalleUsuarioCuenta');
        Route::delete('/pedidos/confirmDelete', [PedidoController::class,'confirmDelete'])->name('confirmDelete');
    });
});
//--------------------------------------------------------------------------------------------------------------------
/*
*/
//Buscador
Route::get('/buscadors', [BuscadorController::class,'datos'])->name('buscador.datos');
Route::post('/buscadors/filtro', [BuscadorController::class,'filtroGeneral'])->name('buscador.filtroGeneral');
Route::post('/buscadors/barranavegacion', [BuscadorController::class,'filtroBarra'])->name('buscador.filtroBarra');
/*

Route::prefix('usuario')->group(function(){
    Route::get('/{id}','usuario\DashboardUsuarioController@getCompras')->name('usuarioMenu.index');
    Route::get('/pedidos/{id}','usuario\DashboardUsuarioController@getPedidos')->name('usuarioMenu.getpedidos');
    Route::get('/pedidos/productos/{id}','usuario\DashboardUsuarioController@getPedidosProductos')->name('usuarioMenu.getpedidoproductos');

    Route::get('/compras/{id}','usuario\DashboardUsuarioController@getCompras')->name('usuarioMenu.getcompras');
    Route::get('/compras/productos/{id}','usuario\DashboardUsuarioController@getComprasProductos')->name('usuarioMenu.getcompraproductos');

    Route::get('/pagos/{id}','usuario\DashboardUsuarioController@getPagos')->name('usuarioMenu.getpagos');

    Route::get('/notificaciones/{id}', 'usuario\DashboardUsuarioController@getNotificaciones')->name('usuarioMenu.getnotificaciones');
});*/
