<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categoria;
use App\Models\Color;
use App\Models\Genero;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Talla;
use App\Models\Proveedor;
use App\Models\Tipo;
use App\Models\Usuario;
use App\Models\Fecha;
use App\Models\Pago;
use App\Models\Compra;
use App\Models\CompraProducto;
use App\Models\DiasDisponibles;
use App\Models\Pedido;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function getDashboard()
    {
        $fechaHoy = now()->format('Y-m-d');

        $fechaUnaSemana = date("Y-m-d", strtotime(now()."+ 1 week"));

        $fechaMes = date("Y-m-d", strtotime(now() . "+ 1 month"));
        //$fechaMes = date_create_from_format("Y-m-d",$fechaMes);

        $fechaAnio = date("Y-m-d", strtotime(now() . "+ 1 year"));


        $pedidosHoy = Pedido::where('fecha','=',"$fechaHoy")->select(DB::raw('count(id) as cantidad'))->get();
        $pedidosEnUnaSemana = Pedido::whereBetween('fecha',[$fechaHoy,$fechaUnaSemana])
            ->select(DB::raw('count(id) as cantidad'))
            ->get();
        $pedidosEnUnMes = $pedidosEnUnaSemana = Pedido::whereBetween('fecha',[$fechaHoy,$fechaMes])
            ->select(DB::raw('count(id) as cantidad'))
            ->get();


        $comprasHoy = Compra::where('fecha_compra','=',"$fechaHoy")->select(DB::raw('count(id) as cantidad'))->get();


        $pagosHoy = Pago::where('fecha','=',"$fechaHoy")->where('estado','!=','a')->select(DB::raw('count(id) as
        cantidad'))->get();
        $pagosEnUnaSemana = Pago::whereBetween('fecha',["$fechaHoy","$fechaUnaSemana"])
            //->where('estado','!=','a')
            ->select(DB::raw('count(id) as cantidad'))
            ->get();
        $pagosEnUnMes = Pago::where('fecha','=',"$fechaMes")->where('estado','!=','a')->select(DB::raw('count(id) as
        cantidad'))->get();




        return view('admin.index', [
            'pedidosHoy' => $pedidosHoy,
            'pedidosEnUnaSemana' => $pedidosEnUnaSemana,
            'pedidosEnUnMes' => $pedidosEnUnMes,
            'comprasHoy' => $comprasHoy,
            'pagosHoy' => $pagosHoy,
            'pagosEnUnaSemana' => $pagosEnUnaSemana,
            'pagosEnUnMes' => $pagosEnUnMes,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }

    public function getComprasProductos($id){
        $produc = CompraProducto::where('compra_id',$id)->get();
        return view('admin.compras.productos_compra', [
        'produc' => $produc,
        'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
        'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }
    public function getPedidosProductos($id){
        $produc = Pedido::find($id);
        return view('admin.pedidos.productos_pedido', [
        'produc' => $produc,
        'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
        'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }

    public function getProductos()
    {

        $producto = Producto::where('borrado','!=',3)->get();


        return view('admin.productos.productos', [
            'productos' => $producto,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }

    public function getGraficoProducto(Request $request)
    {
        $datosNombre = [];
        $datosCantidad = [];

        $productos = DB::table('productos')
        ->select('productos.id','productos.categoria_id','productos.genero_id','productos.talla_id','productos.color_id')
        ->leftJoin('compra_producto','compra_producto.producto_id','productos.id')
        ->addSelect(DB::raw('count(producto_id) as cantidad'))
        ->groupBy('productos.id','productos.categoria_id','productos.genero_id','productos.talla_id','productos.color_id')
        ->orderBy('cantidad','desc')
        ->take(6)
        ->get();

        $categorias = Categoria::all();
        $generos = Genero::all();
        $tallas = Talla::all();
        $colors = Color::all();

        $count = 0;
        $nombreProducto = [];
        $cantidadProducto = [];
        foreach($productos as $producto){
            $nombreProducto[$count] ="";
            foreach($categorias as $categoria){
                if($categoria->id === $producto->categoria_id){
                  $nombreProducto[$count] = $nombreProducto[$count]." ".$categoria->nombre;
                }
            }
            foreach($generos as $genero){
                if($genero->id === $producto->genero_id){
                    $nombreProducto[$count] = $nombreProducto[$count]." ".$genero->nombre;
                }
            }
            foreach($tallas as $talla){
                if($talla->id === $producto->talla_id){
                    $nombreProducto[$count] = $nombreProducto[$count]." ".$talla->nombre;
                }
            }
            foreach($colors as $color){
                if($color->id === $producto->color_id){
                    $nombreProducto[$count] = $nombreProducto[$count]." ".$color->nombre;
                }
            }
            $cantidadProducto[$count] = $producto->cantidad;
            $count++;
        }

        $datosNombre[0] = $nombreProducto;
        $datosCantidad[0] = $cantidadProducto;


        $generos = $this->obtenerDatos('generos', 'genero');
        $nombre = $generos['nombres'];
        $cantidad = $generos['cantidad'];
        $valor = "generos";


        if ($request->get('opciones') === "tallas") {
            $tallas = $this->obtenerDatos('tallas', 'talla');
            $nombre = $tallas['nombres'];
            $cantidad = $tallas['cantidad'];
            $valor = "tallas";
        } else if ($request->get('opciones') === "marcas") {
            $marcas = $this->obtenerDatos('marcas', 'marca');
            $nombre = $marcas['nombres'];
            $cantidad = $marcas['cantidad'];
            $valor = "marcas";
        } else if ($request->get('opciones') === "tipos") {
            $tipos = $this->obtenerDatos('tipos', 'tipo');
            $nombre = $tipos['nombres'];
            $cantidad = $tipos['cantidad'];
            $valor = "tipos";
        } else if ($request->get('opciones') === "categorias") {
            $categorias = $this->obtenerDatos('categorias', 'categoria');
            $nombre  = $categorias['nombres'];
            $cantidad = $categorias['cantidad'];
            $valor = "categorias";
        } else if ($request->get('opciones') === "colores") {
            $colors = $this->obtenerDatos('colors', 'color');
            $nombre = $colors['nombres'];
            $cantidad = $colors['cantidad'];
            $valor = "colores";
        } else if ($request->get('opciones') === "proveedores") {
            $colors = $this->obtenerDatos('proveedor', 'proveedor');
            $nombre = $colors['nombres'];
            $cantidad = $colors['cantidad'];
            $valor = "proveedores";
        }

        $datosNombre[1] = $nombre;
        $datosCantidad[1] = $cantidad;


        return view('admin.productos.graficos', [
            'nombre' => $datosNombre,
            'cantidad' => $datosCantidad,
            'valor' => $valor,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }

    public function getGraficoPed(){
         $pedidosE = DB::table('pedidos')
         ->where('tipo','=','e')
         ->select(DB::raw('count(tipo) as cantidadE'))
         ->get();
         $pedidosV = DB::table('pedidos')
         ->where('tipo','=','v')
         ->select(db::raw('count(tipo) as cantidadV'))
         ->get();


         $nombre = ['Express','Normal'];
         $cantidad = [$pedidosE[0]->cantidadE,$pedidosV[0]->cantidadV];

        return view('admin.pedidos.graficos', [
        'nombre' => $nombre,
        'cantidad' => $cantidad,

        'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
        'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);

    }
    public function getGraficoUsu(){
        $usuarios = Usuario::where('tipo',2)->get();

        $adelantado = 0;
        $retrasado = 0;
        $aldia = 0;

        foreach($usuarios as $usuario){
            if($usuario->estado_calidad === "a"){
                $adelantado++;
            }else if($usuario->estado_calidad === "r"){
                $retrasado++;
            }else{
                $aldia++;
            }
        }


        $nombre = ['Adelantado','Al Día','Retrasado'];
        $cantidad = [$adelantado,$aldia,$retrasado];

        return view('admin.usuarios.graficos', [
        'nombre' => $nombre,
        'cantidad' => $cantidad,

        'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
        'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);

    }
    public function getGraficoCom(Request $request){



        $fechaInicial = "";
        $fechaFinal = "";
        $mensaje = "";

        $nombre = ['Pendiente','Terminada'];
        $cantidad = [];

        if ($request->get('fechaInicial') != null && $request->get('fechaFinal') != null) {

            if ($request->get('fechaInicial') < $request->get('fechaFinal')) {
                $fechaInicial = $request->get('fechaInicial');
                $fechaFinal = $request->get('fechaFinal');
                $comprasEstadoPendiente = Compra::where('estado',1)->where('compras.fecha_compra', '>=', "$fechaInicial")
                ->where('compras.fecha_compra', '<=', "$fechaFinal" )
                ->count();
                $comprasEstadoTerminada = Compra::where('estado',2)->where('compras.fecha_compra', '>=', "$fechaInicial")
                ->where('compras.fecha_compra', '<=', "$fechaFinal" )
                ->count();

                $cantidad[0] = $comprasEstadoPendiente;
                $cantidad[1] = $comprasEstadoTerminada;



            } else {
                $mensaje = "La fecha inicial tiene que ser menor a fecha final";
            }
        } else {
            $comprasEstadoPendiente = Compra::where('estado',1)
            ->count();
            $comprasEstadoTerminada = Compra::where('estado',2)
            ->count();

            $cantidad[0] = $comprasEstadoPendiente;
            $cantidad[1] = $comprasEstadoTerminada;

            $mensaje = 'Selecciones las fechas para una busqueda personalizada';
        }

        return view('admin.compras.graficos',[
            'nombre' => $nombre,
            'cantidad' => $cantidad,
            'mensaje' => $mensaje,
            'fechaInicial' => $fechaInicial,
            'fechaFinal' => $fechaFinal,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }

    public function getGraficoProductoMasVendido(){
        $productos = DB::table('productos')
        ->select('categoria_id')
        ->get();

    }

    public function getGraficoPag(Request $request){
        $fechaInicial = "";
        $fechaFinal = "";
        $mensaje = "";

        $nombre = ['Retrasado','Adelantada','A tiempo'];
        $cantidad = ["","",""];

        if ($request->get('fechaInicial') != null && $request->get('fechaFinal') != null) {
            if ($request->get('fechaInicial') < $request->get('fechaFinal')) {
                $fechaInicial = $request->get('fechaInicial');
                $fechaFinal = $request->get('fechaFinal');
                $pagosEstadoRetrasado = Pago::where('estado',1)
                ->where('pagos.fecha', '>=', "$fechaInicial")
                ->where('pagos.fecha', '<=', "$fechaFinal" )
                    ->count();
                $pagosEstadoAdelantada = Pago::where('estado',2)
                ->where('pagos.fecha', '>=', "$fechaInicial")
                ->where('pagos.fecha', '<=', "$fechaFinal" )
                    ->count();
                $pagosEstadoATiempo = Pago::where('estado',3)
                ->where('pagos.fecha', '>=', "$fechaInicial")
                ->where('pagos.fecha', '<=', "$fechaFinal" )
                    ->count();

                $cantidad[0] = $pagosEstadoRetrasado;
                $cantidad[1] = $pagosEstadoAdelantada;
                $cantidad[2] = $pagosEstadoATiempo;


        } else {
            $pagosEstadoRetrasado = Pago::where('estado',1)
                ->count();
            $pagosEstadoAdelantada = Pago::where('estado',2)
                ->count();
            $pagosEstadoATiempo = Pago::where('estado',3)
                ->count();

            $cantidad[0] = $pagosEstadoRetrasado;
            $cantidad[1] = $pagosEstadoAdelantada;
            $cantidad[2] = $pagosEstadoATiempo;
        }

        if($cantidad[0] == "" && $cantidad[1]=="" && $cantidad[2]==""){
            $mensaje ="No existen pagos";
        }
        return view('admin.pagos.graficos',[
            'nombre' => $nombre,
            'cantidad' => $cantidad,
            'mensaje' => $mensaje,
            'fechaInicial' => $fechaInicial,
            'fechaFinal' => $fechaFinal,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
            ]);
        }
    }





    function obtenerDatos($tabla, $campo)
    {
        $datos = [];
        $data = DB::table("$tabla")
            ->select("$tabla" . '.nombre as nombre')
            ->leftJoin('productos', "$tabla" . '.id', '=', 'productos.' . "$campo" . '_id')
            ->AddSelect(DB::raw('count(productos.' . "$campo" . '_id) as cantidad'))
            ->groupBy("$tabla" . '.nombre')
            ->get();
        $count = 0;
        $nombre = [];
        $cantidad = [];
        foreach ($data as $nom) {
            $nombre[$count] = $nom->nombre;
            $cantidad[$count] = $nom->cantidad;
            $count++;
        }

        $datos = ['nombres' => $nombre, 'cantidad' => $cantidad];

        return $datos;
    }



    public function getCategorias()
    {
        $categorias = Categoria::where('borrado',1)->get();
        return view('admin.categorias.categorias', [
            'categorias' => $categorias,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }
    public function getMarcas()
    {
        $marca = Marca::where('borrado','=',1)->get();

        return view('admin.marcas.marcas', [
            'marcas' => $marca,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }
    public function getTipos()
    {
        $tipo = Tipo::where('borrado','=',1)->get();

        return view('admin.tipos.tipos', [
            'tipos' => $tipo,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }
    public function getTallas()
    {
        $talla = Talla::where('borrado','=',1)->get();

        return view('admin.tallas.tallas', [
            'tallas' => $talla,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }

    public function getNotificacionesUsuarios()
    {

        return view('admin.notificaciones.notificacionesUsuarios', [
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }
    public function getNotificacionesProductos()
    {
        return view('admin.notificaciones.notificacionesProductos', [
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }

    public function getColor()
    {
        $color = Color::where('borrado','=',1)->get();

        return view('admin.colores.colors', [
            'colors' => $color,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }
    public function getGeneros()
    {
        $genero = Genero::where('borrado','=',1)->get();


        return view('admin.generos.generos', [
            'generos' => $genero,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }
    public function getProveedores()
    {
        $proveedores = Proveedor::where('borrado','=',1)->get();

        return view('admin.proveedores.proveedores', [
            'proveedores' => $proveedores,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }

    public function getUsuarios()
    {
        //$usuarios = Usuario::all()->where('tipo','!=','a');
        /*$usuarios = DB::table('usuarios')
        ->Join('pedidos', 'usuarios.id', '=', 'pedidos.usuario_id')
        ->where('usuarios.tipo', '!=', 'a')
        ->addSelect(DB::raw('count(pedidos.usuario_id) as user_count'))
        ->get();*/

        /*$usuarios = DB::table('generos')
        ->select('generos.nombre')
        ->rightJoin('productos', 'generos.id', '=', 'productos.genero_id')
        //->AddSelect(DB::raw('count(productos.genero_id) as user_count'))
        ->groupBy('generos.nombre')
        ->get();*/

        /*$usuarios = DB::table('usuarios')
            ->select('usuarios.id', 'usuarios.nombre', 'usuarios.apellido', 'usuarios.username', 'estado_calidad')
            ->where('usuarios.tipo', '!=', 'a')
            ->leftJoin('compras', 'usuarios.id', '=', 'compras.usuario_id')
            ->AddSelect(DB::raw('count(compras.usuario_id) as compras'))
            ->addSelect(DB::raw('compras.deuda_pendiente as deuda'))
            ->leftJoin('pedidos', 'usuarios.id', '=', 'pedidos.usuario_id')
            ->AddSelect(DB::raw('count(pedidos.usuario_id) as pedidos'))
            ->groupBy('usuarios.id', 'usuarios.nombre', 'usuarios.apellido', 'usuarios.username', 'estado_calidad', 'compras.deuda_pendiente')
            ->get();*/

        $usuarios = Usuario::where('tipo','<>','a')->get();

        return view('admin.usuarios.usuarios', [
            'usuarios' => $usuarios,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }
    public function getFechas(Request $request)
    {
        if ($request->isMethod('POST')) {

            try {
                DiasDisponibles::truncate();
                $dias = $request->dias;

                /**
                 * PAUSAS.
                 */
                $pausas = [];
                if (!empty($request->pausas)) {
                    foreach ($request->pausas as $p) {
                        $pausas[$p['dia']][] = [
                            'inicio' => $p['inicio']['h'].':'.$p['inicio']['m'].':00',
                            'termino' => $p['fin']['h'].':'.$p['fin']['m'].':00',
                        ];
                    }
                }

                /**
                ONLINE
                 */
                $hora_inicio = $request->hora_inicio[1];
                $hora_fin = $request->hora_fin[1];
                foreach ($hora_inicio as $dia => $hi) {
                    $hf = $hora_fin[$dia];

                    $disponible = new DiasDisponibles();
                    $disponible->dia = $dia;
                    $disponible->hora_inicio = implode(':', $hi);
                    $disponible->hora_termino = implode(':', $hf);
                    $disponible->pausas = (!empty($pausas[$dia])) ? json_encode($pausas[$dia]) : null;
                    $disponible->activo = !empty($dias[1][$dia]) ? true : false;
                    $disponible->save();
                }



                alert()->success('Datos actualizados', 'Se guardaron los datos de duración de sesiones para las especialidades.');

                return redirect(route('profesional::servicios.disponibilidad'));
                alert()->success('Datos actualizados', 'Se guardaron los datos de duración de sesiones para las especialidades.');

                return redirect(route('profesional::servicios.disponibilidad'));
            } catch (\Exception $e) {
                report($e);
                alert()->error('Error', 'No se pudo guardar los datos. Intenta otra vez.');

                return back()->withInput();
            }
        }

        $disponibilidades_actuales = [];
        $pausas_actuales = [];

        $disponibilidades = DiasDisponibles::all();
        foreach ($disponibilidades as $dsp) {
            $disponibilidades_actuales[1][$dsp->dia] = $dsp;
            $pausas_actuales[$dsp->dia] = json_decode($dsp->pausas);
        }
        return view('admin.fechas.fechas', compact('disponibilidades', 'disponibilidades_actuales', 'pausas_actuales'));


    }
    public function getPagos()
    {
        $pagos = Pago::all();

        return view('admin.pagos.pagos', [
            'pagos' => $pagos,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }


    public function getPedidos(Request $request)
    {
        $pedidos = DB::table('pedidos')
            ->select('pedidos.id', 'pedidos.fecha', 'pedidos.fecha_hora_inicio', 'pedidos.lugar_visita', 'pedidos.tipo','pedidos.estado')
            ->leftJoin('usuarios', 'usuarios.id', '=', 'pedidos.usuario_id')
            ->AddSelect(DB::raw('usuarios.email as usuario'))
            ->groupBy(
                'pedidos.id',
                'pedidos.fecha',
                'pedidos.fecha_hora_inicio',
                'pedidos.lugar_visita',
                'pedidos.tipo',
                'pedidos.estado',
                'usuarios.email'
            )
            ->get();

        $fechaInicial = "";
        $fechaFinal = "";
        $mensaje = "";

        if ($request->get('fechaInicial') != null && $request->get('fechaFinal') != null) {

            if ($request->get('fechaInicial') < $request->get('fechaFinal')) {
                $fechaInicial = $request->get('fechaInicial');
                $fechaFinal = $request->get('fechaFinal');
                $pedidos = DB::table('pedidos')
                    ->select('pedidos.id', 'pedidos.fecha', 'pedidos.fecha_hora_inicio', 'pedidos.lugar_visita',
                    'pedidos.tipo','pedidos.estado')
                    ->where('pedidos.fecha', '>=', "$fechaInicial")
                    ->where('pedidos.fecha', '<=', "$fechaFinal")->leftJoin('usuarios', 'usuarios.id', '=', 'pedidos.usuario_id')
                    ->AddSelect(DB::raw('usuarios.email as usuario'))
                    ->groupBy(
                        'pedidos.id',
                        'pedidos.fecha',
                        'pedidos.fecha_hora_inicio',
                        'pedidos.lugar_visita',
                        'pedidos.tipo',
                        'pedidos.estado',
                        'usuarios.email'
                    )
                    ->get();
            } else {
                $mensaje = "La fecha inicial tiene que ser menor a fecha final";
            }
        } else {
            $mensaje = 'Selecciones las fechas para una busqueda personalizada';
        }

        return view('admin.pedidos.pedidos', [
            'pedidos' => $pedidos,
            'mensaje' => $mensaje,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }

    public function getPedidosUsuario(Request $request, $id)
    {
        $pedidos = Pedido::where('usuario_id',$id)->get();
        $usuario = Usuario::find($id);

        $fechaInicial = "";
        $fechaFinal = "";
        $mensaje = "";

        if ($request->get('fechaInicial') != null && $request->get('fechaFinal') != null) {

            if ($request->get('fechaInicial') < $request->get('fechaFinal')) {
                $fechaInicial = $request->get('fechaInicial');
                $fechaFinal = $request->get('fechaFinal');
                $pedidos = Pedido::where('usuario_id',$id)
                    ->where('pedidos.fecha', '>=', "$fechaInicial")
                    ->where('pedidos.fecha', '<=', "$fechaFinal")->leftJoin('usuarios', 'usuarios.id', '=', 'pedidos.usuario_id')

                    ->get();
            } else {
                $mensaje = "La fecha inicial tiene que ser menor a fecha final";
            }
        } else {
            $mensaje = 'Selecciones las fechas para una busqueda personalizada';
        }

        return view('admin.usuarios.pedidos', [
            'pedidos' => $pedidos,
            'usuario' => $usuario,
            'mensaje' => $mensaje,
            'id' => $id,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }



    public function getCompras(Request $request)
    {

        $compras = Compra::all();

        $fechaInicial = "";
        $fechaFinal = "";
        $mensaje = "";

        if ($request->get('fechaInicial') != null && $request->get('fechaFinal') != null) {

            if ($request->get('fechaInicial') < $request->get('fechaFinal')) {
                $fechaInicial = $request->get('fechaInicial');
                $fechaFinal = $request->get('fechaFinal');
                $compras = Compra::where('fecha_siguiente_pago', '>=', "$fechaInicial")
                    ->where('fecha_siguiente_pago', '<=', "$fechaFinal")
                    ->get();
                $mensaje = "entro";
            } else {
                $mensaje = "La fecha inicial tiene que ser menor a fecha final";
            }
        }


        return view('admin.compras.compras', [
            'compras' => $compras,
            'mensaje' => $mensaje,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }
    public function getComprasUsuario(Request $request, $id)
    {
        $compras = Compra::where('usuario_id',$id)->get();
        $usuario = Usuario::find($id);


        $fechaInicial = "";
        $fechaFinal = "";
        $mensaje = "";

        if ($request->get('fechaInicial') != null && $request->get('fechaFinal') != null) {

            if ($request->get('fechaInicial') < $request->get('fechaFinal')) {
                $fechaInicial = $request->get('fechaInicial');
                $fechaFinal = $request->get('fechaFinal');
                $compras = Compra::where('usuario_id',$id)
                    ->where('compras.fecha_siguiente_pago', '>=', "$fechaInicial")
                    ->where('compras.fecha_siguiente_pago', '<=', "$fechaFinal")
                    ->get();
                $mensaje = "";
            } else {
                $mensaje = "La fecha inicial tiene que ser menor a fecha final";
            }
        }


        return view('admin.usuarios.compras', [
            'compras' => $compras,
            'usuario' => $usuario,
            'mensaje' => $mensaje,
            'id' => $id,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }


    public function getPagosCompra($id)
    {
        $pagos = DB::table('pagos')
            ->select('pagos.id', 'pagos.monto', 'pagos.direccion', 'pagos.fecha', 'pagos.estado')
            ->where('compra_id', '=', "$id")
            ->get();

        return view('admin.usuarios.pagos', [
            'pagos' => $pagos,
            'id' =>  $id,
            'notificacionProductos' => NotificacionProducto::orderBy('id', 'desc')->get(),
            'notificacionUsuarios' => NotificacionUsuario::orderBy('id', 'desc')->get()
        ]);
    }

    public function disponibilidad(Request $request)
    {

        if ($request->isMethod('post')) {

            try {
                DiasDisponibles::all()->delete();

                $dias = $request->dias;

                /**
                 * PAUSAS.
                 */
                $pausas = [];
                if (!empty($request->pausas)) {
                    foreach ($request->pausas as $p) {
                        $pausas[$p['dia']][] = [
                            'inicio' => $p['inicio']['h'].':'.$p['inicio']['m'].':00',
                            'termino' => $p['fin']['h'].':'.$p['fin']['m'].':00',
                        ];
                    }
                }

                /**
                ONLINE
                 */
                $hora_inicio = $request->hora_inicio;
                $hora_fin = $request->hora_fin;

                foreach ($hora_inicio as $dia => $hi) {
                    $hf = $hora_fin[$dia];

                    DiasDisponibles::create([
                        'dia' => $dia,
                        'hora_inicio' => implode(':', $hi),
                        'hora_termino' => implode(':', $hf),
                        'pausas' => (!empty($pausas[$dia])) ? json_encode($pausas[$dia]) : null,
                    ]);
                }



                alert()->success('Datos actualizados', 'Se guardaron los datos de duración de sesiones para las especialidades.');

                return redirect(route('profesional::servicios.disponibilidad'));
            } catch (\Exception $e) {
                report($e);
                alert()->error('Error', 'No se pudo guardar los datos. Intenta otra vez.');

                return back()->withInput();
            }
        }


        $disponibilidades_actuales = [];
        $pausas_actuales = [];

        $disponibilidades = DiasDisponibles::all();
        foreach ($disponibilidades as $dsp) {
            $disponibilidades_actuales[$dsp->dia] = $dsp;
            $pausas_actuales[$dsp->dia] = json_decode($dsp->pausas);
        }

        return view('admin.fechas.fechas', compact('disponibilidades', 'disponibilidades_actuales', 'pausas_actuales'));
    }
}
