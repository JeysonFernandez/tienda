<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{ProductoController,UsuarioController,BuscadorController};
use App\Http\Controllers\{CategoriaController, ColorController, TipoController, TallaController, MarcaController};
use App\Http\Controllers\{GeneroController,ProveedorController,CompraController,PagoController,FechaController,PedidoController};
use App\Http\Controllers\Admin\{DashboardController};
use App\Http\Controllers\usuario\{DashboardUsuarioController};
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

Route::get('/seleccionar-perfil',[UsuarioController::class,'seleccionarPerfil'])->name('seleccionarPerfil');




Route::group(['as' => 'publico.'], function () {
    Route::get('/busqueda', [BuscadorController::class, 'busqueda'])->name('busqueda');
    Route::post('/ajax-get-dias-disponibles-tipo',[FechaController::class, 'getDiasDisponiblesTipo'])->name('getDiasDisponiblesTipo');
    Route::post('/ajax-get-horas-disponibles-fecha',[FechaController::class, 'getHorasDisponiblesFecha'])->name('getHorasDisponiblesFecha');

    Route::group(['as'=> 'producto.'], function(){
        Route::get('/carrito',[ProductoController::class, 'carrito'])->name('carrito');
        Route::get('/añadir-al-carrito/{id}', [ProductoController::class, 'addCarrito'])->name('addCarrito');
        Route::get('/borrar-elemento-carro/{id}',[ProductoController::class, 'borrarElementoCarro'])->name('boorarElementoCarrito');
        Route::get('/borrar-carro',[ProductoController::class, 'borrarCarro'])->name('borrarCarro');
        Route::post('/actualizar-carro/{id}',[ProductoController::class, 'actualizarCarrito'])->name('actualizarCarro');
        Route::get('/ver/{id}', [ProductoController::class, 'verProducto'])->name('verProducto')->where('id', '[0-9]+');
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
        Route::get('/color',[DashboardController::class,'getColor'])->name('getColor');
        Route::delete('/colors/confirmDelete', [ColorController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/colors/update',[ColorController::class,'confirmarUpdate'])->name('confirmarUpdate');

        Route::get('/colors/crear',[ColorController::class,'create'])->name('crearColor');
        Route::post('/colors/agregar',[ColorController::class,'store'])->name('agregarColor');
    });

    Route::group(['as'=> 'tipo.'], function(){
        Route::get('/tipos', [DashboardController::class,'getTipos'])->name('getTipo');
        Route::delete('/tipos/confirmDelete', [TipoController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/tipos/update',[TipoController::class,'confirmarUpdate'])->name('confirmarUpdate');

        Route::get('/tipos/crear',[TipoController::class,'create'])->name('crearTipo');
        Route::post('/tipos/agregar',[TipoController::class,'store'])->name('agregarTipo');
    });

    Route::group(['as'=> 'talla.'], function(){
        Route::get('/tallas', [DashboardController::class,'getTallas'])->name('getTalla');
        Route::delete('/tallas/confirmDelete', [TallaController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/tallas/update',[TallaController::class,'confirmarUpdate'])->name('confirmarUpdate');

        Route::get('/tallas/crear',[TallaController::class,'create'])->name('crearTalla');
        Route::post('/tallas/agregar',[TallaController::class,'store'])->name('agregarTalla');
    });

    Route::group(['as'=> 'marca.'], function(){
        Route::get('/marcas', [DashboardController::class,'getMarcas'])->name('getMarca');
        Route::delete('/marcas/confirmDelete', [MarcaController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/marcas/update',[MarcaController::class,'confirmarUpdate'])->name('confirmarUpdate');

        Route::get('/marcas/crear',[MarcaController::class,'create'])->name('crearMarca');
        Route::post('/marcas/agregar',[MarcaController::class,'store'])->name('agregarMarca');
    });

    Route::group(['as'=> 'genero.'], function(){
        Route::get('/generos', [DashboardController::class,'getGeneros'])->name('getGenero');
        Route::delete('/generos/confirmDelete', [GeneroController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/generos/update',[GeneroController::class,'confirmarUpdate'])->name('confirmarUpdate');

        Route::get('/generos/crear',[GeneroController::class,'create'])->name('crearGenero');
        Route::post('/generos/agregar',[GeneroController::class,'store'])->name('agregarGenero');
    });

    Route::group(['as'=> 'proveedor.'], function(){
        Route::get('/proveedores',[DashboardController::class,'getProveedores'])->name('getProveedor');
        Route::delete('/proveedors/confirmDelete', [ProveedorController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/proveedors/update',[ProveedorController::class,'confirmarUpdate'])->name('confirmarUpdate');

        Route::get('/proveedors/crear',[ProveedorController::class,'create'])->name('crearProveedor');
        Route::post('/provedors/agregar',[ProveedorController::class,'store'])->name('agregarProveedor');
    });

    Route::group(['as'=> 'usuario.'], function(){
        Route::get('/usuarios', [DashboardController::class,'getUsuarios'])->name('getUsuario');
        Route::get('/usuarios/{id}/compras', [DashboardController::class,'getComprasUsuario'])->name('getCompraUsuario');
        Route::get('/usuarios/{id}/pedidos', [DashboardController::class,'getPedidosUsuario'])->name('getPedidoUsuario');
        Route::get('/graficos/usuarios', [DashboardController::class,'getGraficoUsu'])->name('getGraficoUsuario');
    });

    Route::group(['as'=> 'producto.'], function(){
        Route::get('/productos', [DashboardController::class,'getProductos'])->name('getProducto');
        Route::get('/productos/graficos', [DashboardController::class,'getGraficoProducto'])->name('getGraficoProducto');
        Route::post('/productos/grafico/tipo', [DashboardController::class,'getGraficoProducto'])->name('getGraficoProductoPost');
        Route::delete('/productos/confirmDelete', [ProductoController::class,'confirmDelete'])->name('confirmDelete');
        Route::post('/productos/update',[ProductoController::class,'confirmarUpdate'])->name('confirmarUpdate');

        Route::get('/productos/crear',[ProductoController::class,'create'])->name('crearProducto');
        Route::post('/productos/agregar',[ProductoController::class,'store'])->name('agregarProducto');
    });

    Route::group(['as'=> 'compra.'], function(){
        Route::get('/compras/{id}', [DashboardController::class,'getComprasUsuario'])->name('getCompraUsuario');
        Route::get('/compras/productos/{id}', [DashboardController::class,'getComprasProductos'])->name('getCompraProductos');
        Route::post('/compras/fecha/{id}', [DashboardController::class,'getComprasUsuario'])->name('getCompraUsuarioPost');
        Route::get('/compras', [DashboardController::class,'getCompras'])->name('getCompras');
        Route::post('/compras/fecha', [DashboardController::class,'getCompras'])->name('getCompraPost');
        Route::get('/graficos/compras', [DashboardController::class,'getGraficoCom'])->name('getGraficoCom');
        Route::post('/graficos/compras', [DashboardController::class,'getGraficoCom'])->name('getGraficoComPost');

        Route::post('/admin/compras/agregar',[CompraController::class,'agregar'])->name('agregarCompra');
        Route::post('/admin/compras/addcarrito',[CompraController::class,'addCarrito'])->name('agregarAlCarrito');
        Route::delete('/compras/confirmDelete', [CompraController::class,'confirmDelete'])->name('confirmDelete');
        Route::get('/compras/detalle/{id}',[CompraController::class,'detalleCompraUsuario'])->name('detalleUsuario');
        Route::get('/compras/detalleCuenta/{id}',[CompraController::class,'detalleCompraUsuarioCuenta'])->name('detalleUsuarioCuenta');
        Route::post('/compras/agregarCompraPedido', [CompraController::class,'agregarCompraPedido'])->name('agregarCompraPedido');
    });

    Route::group(['as'=> 'pago.'], function(){
        Route::get('/pagos', [DashboardController::class,'getPagos'])->name('getPagos');
        Route::get('/pagos/{id}', [DashboardController::class,'getPagosCompra'])->name('getPagoCompra');
        Route::get('/graficos/pagos', [DashboardController::class,'getGraficoPag'])->name('getGraficoPag');
        Route::post('/graficos/pagos', [DashboardController::class,'getGraficoPag'])->name('getGraficoPagPost');

        Route::post('/admin/pagos/agregar',[PagoController::class,'agregar'])->name('agregarPago');
        Route::delete('/pagos/confirmDelete', [PagoController::class,'confirmDelete'])->name('confirmDelete');
        Route::get('/pagos/crear',[PagoController::class,'create'])->name('crearPago');
    });

    Route::group(['as'=> 'notificacion.'], function(){
        Route::get('/notificaciones/usuarios', [DashboardController::class,'getNotificacionesUsuarios'])->name('getNotificacionesUsuarios');
        Route::get('/notificaciones/productos', [DashboardController::class,'getNotificacionesProductos'])->name('getNotificacionesProductos');
    });

    Route::group(['as'=> 'fecha.'], function(){
        Route::get('/fechas', [DashboardController::class,'getFechas'])->name('getFechas');
        Route::get('/fechas/eliminar/{fecha}{hora}',[FechaController::class,'eliminar'])->name('eliminarFecha');
        Route::get('/fechas/crear',[FechaController::class,'create'])->name('crearFecha');
        Route::get('/fechas/agregar',[FechaController::class,'store'])->name('agregarFecha');
    });

    Route::group(['as'=> 'pedido.'], function(){
        Route::get('/pedidos/{id}', [DashboardController::class,'getPedidosUsuario'])->name('getPedidoUsuario');
        Route::get('/pedidos/productos/{id}', [DashboardController::class,'getPedidosProductos'])->name('getPedidoProductos');
        Route::post('/pedidos/fecha/{id}', [DashboardController::class,'getPedidosUsuario'])->name('getPedidoUsuarioPost');
        Route::get('/pedidos', [DashboardController::class,'getPedidos'])->name('getPedido');
        Route::post('/pedidos/fecha', [DashboardController::class,'getPedidos'])->name('getPedidoPost');
        Route::get('/graficos/pedidos', [DashboardController::class,'getGraficoPed'])->name('getGraficoPed');

        Route::get('/pedidos/cancelarPedido/{id}', [PedidoController::class,'cancelar'])->name('cancelarPedido');
        Route::post('/pedidos/{id}', [PedidoController::class,'agregar'])->name('agregarPedido');
        Route::get('/pedidos/detalle/{id}',[PedidoController::class,'detallePedidoUsuario'])->name('detalleUsuario');
        Route::get('/pedidos/detalleCuenta/{id}',[PedidoController::class,'detallePedidoUsuarioCuenta'])->name('detalleUsuarioCuenta');
        Route::delete('/pedidos/confirmDelete', [PedidoController::class,'confirmDelete'])->name('confirmDelete');
        Route::get('/pedidos/comprarPedido/{id}', [PedidoController::class,'comprarPedido'])->name('comprarPedido');
    });
});
//--------------------------------------------------------------------------------------------------------------------


//Buscador
Route::get('/buscadors', [BuscadorController::class,'datos'])->name('buscador.datos');
Route::post('/buscadors/filtro', [BuscadorController::class,'filtroGeneral'])->name('buscador.filtroGeneral');
Route::post('/buscadors/barranavegacion', [BuscadorController::class,'filtroBarra'])->name('buscador.filtroBarra');

Route::group(['as'=> 'usuario.'], function(){
    Route::get('/usuario/{id}',[DashboardUsuarioController::class,'getDashboard'])->name('index');
    Route::get('/pedidos/{id}',[DashboardUsuarioController::class,'getPedidos'])->name('getPedidos');
    Route::get('/pedidos/productos/{id}',[DashboardUsuarioController::class,'getPedidosProductos'])->name('getPedidoProductos');

    Route::get('/compras/{id}',[DashboardUsuarioController::class,'getCompras'])->name('getCompras');
    Route::get('/compras/productos/{id}',[DashboardUsuarioController::class,'getComprasProductos'])->name('getCompraProductos');

    Route::get('/pagos/{id}',[DashboardUsuarioController::class,'getPagos'])->name('getPagos');

    Route::get('/notificaciones/{id}', [DashboardUsuarioController::class,'getNotificaciones'])->name('getNotificaciones');
});
