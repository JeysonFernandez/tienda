<?php

namespace App\Http\Controllers;

use App\Models\DiasDisponibles;
use App\Models\Fecha;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use App\Models\Pedido;
use Illuminate\Http\Request;


class FechaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        dd('hola');
        $disponibilidades_actuales = [];
        $pausas_actuales = [];

        $disponibilidades = DiasDisponibles::all();
        foreach ($disponibilidades as $dsp) {
            $disponibilidades_actuales[$dsp->dia] = $dsp;
            $pausas_actuales[$dsp->dia] = json_decode($dsp->pausas);
        }

        return view('admin.fechas.fechas', compact('disponibilidades', 'disponibilidades_actuales', 'pausas_actuales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fechas.create',['notificacionProductos'=>NotificacionProducto::all(),
        'notificacionUsuarios'=>NotificacionUsuario::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha = new Fecha();
        $fecha->fecha = $request->get('fecha');
        $fecha->hora = $request->get('hora');

        $duracion = $request->get('duracion');
        $fecha->duracion = $duracion*60;
        $fecha->save();

        return redirect()->route('admin.getfechas',[
            'notificacionProductos'=>NotificacionProducto::all(),
            'notificacionUsuarios'=>NotificacionUsuario::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function show(Fecha $fecha)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function edit(Fecha $fecha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fecha $fecha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fecha $fecha)
    {
        //
    }

    public function getDiasDisponiblesTipo( Request $request )
    {

        $disponibilidades = DiasDisponibles::orderBy('dia')->get();

        $data = [];
        foreach ($disponibilidades as $d) {
            $data[] = [
                'dia' => $d->dia,
                'hora_inicio' => $d->hora_inicio,
                'hora_termino' => $d->hora_termino,
                'pausas' => $d->pausas,
            ];
        }

        return response()->json($data);




    }

    public function getHorasDisponiblesFecha ( Request $request )
    {
        $fecha = $request->fecha;
        $tipo_id = $request->tipo_id;

        if($tipo_id == 1){
            $duracion = 60;
        }else{
            $duracion = 30;
        }


        $disponibilidad = DiasDisponibles::where([
            ['dia', (date('w', strtotime($fecha)))],
        ])->first();

        if (empty($disponibilidad)) {
            return response()->json([]);
        }

        $pedidos = Pedido::whereBetween('fecha_hora_inicio', [$fecha.' 00:00:00', $fecha.' 23:59:59'])
                        ->orWhereBetween('fecha_hora_fin', [$fecha.' 00:00:00', $fecha.' 23:59:59'])->get();

        if($fecha == \Carbon\Carbon::now()->format('Y-m-d')){
            $inicio = strtotime('+30 minute',strtotime(\Carbon\Carbon::now()));
        }else{
            $inicio = strtotime($disponibilidad->hora_inicio);
        }
        $termino = strtotime($disponibilidad->hora_termino);
        $actual = $inicio;
        $horas = [];
        $i = 0;



        // Construye lista de horas disponibles según duración de tipo de cita
        while (strtotime('+'.$i * $duracion.' minutes', $inicio) < $termino) {
            $actual = strtotime('+'.$i * $duracion.' minutes', $inicio);
            $horas[] = date('H:i', $actual);
            ++$i;
        }

        foreach ($pedidos as $pedido) {
            foreach ($horas as $index => $hora) {
                $inicio_hora = strtotime($fecha.' '.$hora.':00');
                $inicio_pedido = strtotime($pedido->fecha_hora_inicio);
                $fin_hora = strtotime('+'.$duracion.' minutes', strtotime($fecha.' '.$hora.':00'));
                $fin_pedido = strtotime($pedido->fecha_hora_fin);

                if ($inicio_pedido >= $fin_hora || $fin_pedido <= $inicio_hora) {
                    continue;
                }

                unset($horas[$index]);
            }
        }

        // Quita horas que tengan tope con citas agendadas

        // Quita horas que tengan tope con pausas
        if (!empty($disponibilidad->pausas)) {
            foreach (json_decode($disponibilidad->pausas) as $pausa) {
                foreach ($horas as $index => $hora) {
                    $inicio_hora = strtotime($fecha.' '.$hora.':00');
                    $inicio_pausa = strtotime($fecha.' '.$pausa->inicio);
                    $fin_hora = strtotime('+'.$duracion.' minutes', strtotime($fecha.' '.$hora.':00'));
                    $fin_pausa = strtotime($fecha.' '.$pausa->termino);

                    if ($inicio_pausa >= $fin_hora || $fin_pausa <= $inicio_hora) {
                        continue;
                    }

                    unset($horas[$index]);
                }
            }
        }

        return response()->json(array_values($horas));
    }
}
