@extends('layouts.master')


@section('contenido')

<section class="mi-agenda">
    <div class="card card-table shadow">

        <div class="card-body">

            <p>
                Define tu disponiblidad indicando los días que estarán disponibles tus servicios y en qué  horarios.
            </p>
            <p>
                Puedes establecer la hora de inicio y término de cada jornada y guardarlo, pero para que se vea públicamente debes activar cada día en la casilla correspondiente.
            </p>

            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">

                        <h2 class="h6 font-weight-bold text-warning text-uppercase mb-2 border-bottom">Disponibilidad semanal</h2>




                        <div class="tab-content border px-3 py-4" style="margin-top:-1px">
                            <div class="" id="atencion-online">

                                <div class="row">
                                    <div class="col-4"><p class="border-bottom small text-muted">Día</p></div>
                                    <div class="col-4"><p class="border-bottom small text-muted">Inicio</p></div>
                                    <div class="col-4"><p class="border-bottom small text-muted">Término</p></div>
                                </div>
                                @for($dia = 1; $dia <=7; $dia++)
                                @php if($dia==7) $dia=0; @endphp
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group form-group-sm">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" data-id="1" class="custom-control-input" id="dias_1_{{$dia}}" name="dias[1][{{$dia}}]" value="1" @if(!empty($disponibilidades_actuales[1][$dia])  && $disponibilidades_actuales[1][$dia]->activo) checked @endif>
                                                <label class="custom-control-label" for="dias_1_{{$dia}}">{{nombre_dia($dia)}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <div class="input-group input-group-sm">
                                                <select class="custom-select" id="hora_inicio_1_{{$dia}}_0" name="hora_inicio[1][{{$dia}}][0]">
                                                    @for($i=0;$i<=23;$i++)
                                                    <option value="{{$i}}" @if(!empty($disponibilidades_actuales[1][$dia]) && $disponibilidades_actuales[1][$dia]->hora_inicio->hour == $i) selected @endif>{{zerofill($i,2)}}</option>
                                                    @endfor
                                                </select>
                                                <select class="custom-select" id="hora_inicio_{{1}}_{{$dia}}_1" name="hora_inicio[1][{{$dia}}][1]">
                                                    @for($i=0;$i<=59;$i++)
                                                    <option value="{{$i}}" @if(!empty($disponibilidades_actuales[1][$dia]) && $disponibilidades_actuales[1][$dia]->hora_inicio->minute == $i) selected @endif>{{zerofill($i,2)}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <div class="input-group input-group-sm">
                                                <select class="custom-select" id="hora_fin_{{1}}_{{$dia}}_0" name="hora_fin[{{1}}][{{$dia}}][0]">
                                                    @for($i=0;$i<=23;$i++)
                                                    <option value="{{$i}}" @if(!empty($disponibilidades_actuales[1][$dia]) && $disponibilidades_actuales[1][$dia]->hora_termino->hour == $i) selected @endif>{{zerofill($i,2)}}</option>
                                                    @endfor
                                                </select>
                                                <select class="custom-select" id="hora_fin_{{1}}_{{$dia}}_1" name="hora_fin[{{1}}][{{$dia}}][1]">
                                                    @for($i=0;$i<=59;$i++)
                                                    <option value="{{$i}}" @if(!empty($disponibilidades_actuales[1][$dia]) && $disponibilidades_actuales[1][$dia]->hora_termino->minute == $i) selected @endif>{{zerofill($i,2)}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php if ($dia==0) break; @endphp
                                @endfor

                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="h6 font-weight-bold text-warning text-uppercase mb-2 border-bottom">Pausas diarias</h2>

                        <div class="js-lista-pausas">
                        @foreach($pausas_actuales as $dia => $pausas)
                            @if(empty($pausas)) @continue @endif
                            @foreach($pausas as $n => $pausa)
                            <div class="row js-pausa js-pausa-{{$dia.$n}}">
                                <div class="col">
                                    <div class="form-group">
                                        <select class="custom-select custom-select-sm" id="pausa_{{$dia.$n}}_dia" name="pausas[{{$dia.$n}}][dia]">
                                            @for($i=1;$i<=7;$i++)
                                            @php if($i==7) $i=0; @endphp
                                            <option value="{{$i}}" @if($dia==$i) selected @endif>{{nombre_dia($i)}}</option>
                                            @php if ($i==0) break; @endphp
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <select class="custom-select" id="pausa_{{$dia.$n}}_inicio_h" name="pausas[{{$dia.$n}}][inicio][h]">
                                                @for($i=0;$i<=23;$i++)
                                                <option value="{{$i}}" @if(explode(':',$pausa->inicio)[0]==$i) selected @endif>{{zerofill($i,2)}}</option>
                                                @endfor
                                            </select>
                                            <select class="custom-select" id="pausa_{{$dia.$n}}_inicio_m" name="pausas[{{$dia.$n}}][inicio][m]">
                                                @for($i=0;$i<=59;$i++)
                                                <option value="{{zerofill($i,2)}}" @if(explode(':',$pausa->inicio)[1]==zerofill($i,2)) selected @endif>{{zerofill($i,2)}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <select class="custom-select" id="pausa_{{$dia.$n}}_fin_h" name="pausas[{{$dia.$n}}][fin][h]">
                                                @for($i=0;$i<=23;$i++)
                                                <option value="{{$i}}" @if(explode(':',$pausa->termino)[0]==$i) selected @endif>{{zerofill($i,2)}}</option>
                                                @endfor
                                            </select>
                                            <select class="custom-select" id="pausa_{{$dia.$n}}_fin_m" name="pausas[{{$dia.$n}}][fin][m]">
                                                @for($i=0;$i<=59;$i++)
                                                <option value="{{zerofill($i,2)}}" @if(explode(':',$pausa->termino)[1]==zerofill($i,2)) selected @endif>{{zerofill($i,2)}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-block btn-danger js-eliminar-pausa" data-pausa="{{$dia.$n}}"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            @endforeach
                        @endforeach
                        </div>
                        <hr>
                        <p class="text-right">
                            <button type="button" class="btn btn-primary btn-sm js-agregar-pausa"><i class="fas fa-fw fa-plus"></i> Agregar pausa</button>
                        </p>
                    </div>
                </div>

                <hr>

                <div class="actions">
                    <button type="sumbit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Guardar todo</button>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-sesion" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

<div id="plantilla-pausa" class="d-none">
    <div class="row js-pausa js-pausa-XXXX">
        <div class="col">
            <div class="form-group">
                <select class="custom-select custom-select-sm" id="pausa_XXXX_dia" name="pausas[XXXX][dia]">
                    @for($i=1;$i<=7;$i++)
                    @php if($i==7) $i=0; @endphp
                    <option value="{{$i}}">{{nombre_dia($i)}}</option>
                    @php if ($i==0) break; @endphp
                    @endfor
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <select class="custom-select" id="pausa_XXXX_inicio_h" name="pausas[XXXX][inicio][h]">
                        @for($i=0;$i<=23;$i++)
                        <option value="{{$i}}" @if($i==8) selected @endif>{{zerofill($i,2)}}</option>
                        @endfor
                    </select>
                    <select class="custom-select" id="pausa_XXXX_inicio_m" name="pausas[XXXX][inicio][m]">
                        @for($i=0;$i<=59;$i++)
                        <option value="{{zerofill($i,2)}}" @if(false) selected @endif>{{zerofill($i,2)}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <select class="custom-select" id="pausa_XXXX_fin_h" name="pausas[XXXX][fin][h]">
                        @for($i=0;$i<=23;$i++)
                        <option value="{{$i}}" @if($i==8) selected @endif>{{zerofill($i,2)}}</option>
                        @endfor
                    </select>
                    <select class="custom-select" id="pausa_XXXX_fin_m" name="pausas[XXXX][fin][m]">
                        @for($i=0;$i<=59;$i++)
                        <option value="{{zerofill($i,2)}}" @if(false) selected @endif>{{zerofill($i,2)}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-sm btn-block btn-danger js-eliminar-pausa" data-pausa="XXXX"><i class="fas fa-times"></i></button>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>


function swalMensaje(){
    Swal.fire({
                title: '¡Atención!',
                text: 'Si no ingresas una disponibilidad válidad, esta no se verá reflejada en el sistema. La hora de término debe ser mayor a la inicial.',
                type: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok.',
    });
}

function validar(inicio,fin){
    if(inicio.id.split('_')[4]=='0'){
        let minutoInicio = document.getElementById(inicio.id.slice(0,-1)+'1');
        let minutoFinal = document.getElementById(minutoInicio.id.replace('inicio','fin'));
        if( parseInt(inicio.value,16) > parseInt(fin.value,16) || ( parseInt(fin.value,16)==parseInt(inicio.value,16) && parseInt(minutoInicio.value,16)>=parseInt(minutoFinal.value,16) )){
            swalMensaje();
        }
    }else{
        let horaInicio = document.getElementById(inicio.id.slice(0,-1)+'0');
        let horaFinal = document.getElementById(horaInicio.id.replace('inicio','fin'));
        if( parseInt(horaInicio.value,16)>parseInt(horaFinal.value,16) || (parseInt(horaInicio.value,16)==parseInt(horaFinal.value,16) && parseInt(inicio.value,16)>=parseInt(fin.value,16)) ){
            swalMensaje();
        }
    }
}

let seleccionados=document.querySelectorAll('.custom-select');
        seleccionados.forEach(event  =>{
            event.addEventListener('change',e => {
                seleccionados.forEach(q=>{
                    if(e.target.id.split('_')[1]=='fin'){
                        if( q.id == e.target.id.replace('fin','inicio') ){
                            validar(q,e.target);
                        }
                    }else{
                        if( q.id == e.target.id.replace('inicio','fin') ){
                            validar(e.target,q);
                        }
                    }
                });
            });
    });


$(function(){
    $('.js-agregar-pausa').click(function(){
        var html = $('#plantilla-pausa').html();
        html = html.replace(new RegExp('XXXX','gi'),Date.now());
        $('.js-lista-pausas').append(html);
    });

    $('.js-eliminar-pausa').click(function(){
        var pausa = $(this).data('pausa');
        $('.js-pausa-'+pausa).remove();
    });

});
</script>
@endsection
