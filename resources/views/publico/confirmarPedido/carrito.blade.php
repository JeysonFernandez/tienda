@extends('layouts.esquema')

@section('content')
    <div class="row">
        <div class="col-12 item-carrito">
            @include('publico.confirmarPedido.itemsCarrito')
        </div>

        <div class=" col-12 info-pedido">
            @include('publico.confirmarPedido.pedido')
        </div>
    </div>

@endsection

@push('javascript')
    <script>

        let tipo_id = 1;
        let fecha = '';

        let cal_options = {
            inline: true,
            locale: 'es',
            format: 'YYYY-MM-DD',
            minDate: moment(),
            maxDate: moment().add('3','months'),
            buttons: {},
            changeMonth: false,
        };

        function actualizar_horas() {
        // GET DIAS
            $('.lista-horas').html('');
            axios({
                method: 'post',
                url: '{{route('publico.getDiasDisponiblesTipo')}}',
                data: {
                },
            }).then(function(response){

                if(response.data.length) {
                    let dias_bloqueados = [1,2,3,4,5,6,0];
                    response.data.forEach( function(valor, indice, array) {
                        dias_bloqueados.splice( dias_bloqueados.indexOf(valor.dia) ,1);
                    });
                    cal_options.daysOfWeekDisabled = dias_bloqueados;
                }

            }).then(function(){
                $('.calendario').datetimepicker('destroy');
                $('.calendario').datetimepicker(cal_options);

            });

            $('.calendario').on('change.datetimepicker', function(e){
            fecha = e.date.format('YYYY-MM-DD');
            $('form.form-agendar input[name=fecha]').val(fecha);
            axios({
                method: 'post',
                url: '{{route('publico.getHorasDisponiblesFecha')}}',
                data: {
                    fecha: e.date.format('YYYY-MM-DD'),
                    tipo_id: tipo_id,
                },
            }).then(function(response){
                $('.lista-horas').html('');

                if(response.data.length > 0) {
                    response.data.forEach( function(valor, indice, array) {
                        $('.lista-horas').append('<button type="button" class="btn btn-outline-naranjo mr-1 js-btn-hora" data-toggle="button" data-hora="'+valor+'">'+valor+'</button>');
                    });
                } else {
                    $('.lista-horas').html('<p class="text-muted p-2 text-center">No hay horas disponibles para esta fecha.</p>');
                    $('.js-btn-agendar').attr('disabled','disabled').addClass('disabled');
                }

            })
            });
        }


        $(function(){
            $('.calendario').datetimepicker(cal_options);

            $('.js-tipo').on('change',function(){
                tipo_id = $(this).val();
                console.log(tipo_id);
                actualizar_horas();
            });

            $('.lista-horas').on('click','.js-btn-hora', function(){
                let hora = $(this).data('hora');
                $('#hora').val(hora);
                $('.js-btn-hora').removeClass('active');
                $('.js-btn-agendar').removeAttr('disabled').removeClass('disabled');
            });

            actualizar_horas();
        });
    </script>
@endpush
