@extends('layouts.esquema')

@section('content')
<section class="main-resultados my-5">
    <div class="container-fluid">
        <div class="row align-items-end mb-5">
            <div class="col-xl-2">
                <h1>Resultados</h1>
                <p class="text-muted">
                    <i class="fas fa-home"></i> /
                    <b>Buscador</b> /
                    Resultados
                </p>
            </div>

        </div>
        <hr>
        <div class="row mt-5 ">
            <div class="col-3">
                <div class="p-0 dropdown-bar">
                    @include('publico.buscador._buscador')


                </div>
            </div>
            <div class="col-9 card-resultados">
                @isset($productos)
                    @foreach ($productos as $producto )
                    <div class="row">
                        <div class="card col-4 mx-1" >
                            <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">{{$producto}}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Marca:       {{$producto->marca ?? ''}}</li>
                            <li class="list-group-item">Categoria:   {{$producto->categoria ?? ''}}</li>
                            <li class="list-group-item">Proveedor:   {{$producto->proveedor ?? ''}}</li>
                            <li class="list-group-item">Color:       {{$producto->color ?? ''}}</li>
                            <li class="list-group-item">Talla:       {{$producto->talla ?? ''}}</li>
                            <li class="list-group-item">Tipos:       {{$producto->tipo ?? ''}}</li>
                            <li class="list-group-item">Generos:     {{$producto->genero ?? ''}}</li>
                            </ul>
                            <div class="card-body">
                            <a href="{{route('publico.ver-producto',['id' => $producto->id])}}" class="card-link">Ver más</a>
                            <a href="#" class="card-link">Añadir al carrito</a>
                            </div>
                        </div>
                        <div class="card col-4 mx-1" >
                            <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">{{$producto}}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Marca:       {{$producto->marca ?? ''}}</li>
                            <li class="list-group-item">Categoria:   {{$producto->categoria ?? ''}}</li>
                            <li class="list-group-item">Proveedor:   {{$producto->proveedor ?? ''}}</li>
                            <li class="list-group-item">Color:       {{$producto->color ?? ''}}</li>
                            <li class="list-group-item">Talla:       {{$producto->talla ?? ''}}</li>
                            <li class="list-group-item">Tipos:       {{$producto->tipo ?? ''}}</li>
                            <li class="list-group-item">Generos:     {{$producto->genero ?? ''}}</li>
                            </ul>
                            <div class="card-body">
                            <a href="{{route('publico.ver-producto',['id' => $producto->id])}}" class="card-link">Ver más</a>
                            <a href="#" class="card-link">Añadir al carrito</a>
                            </div>
                        </div>
                        <div class="card col-4 mx-1" >
                            <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">{{$producto}}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Marca:       {{$producto->marca ?? ''}}</li>
                            <li class="list-group-item">Categoria:   {{$producto->categoria ?? ''}}</li>
                            <li class="list-group-item">Proveedor:   {{$producto->proveedor ?? ''}}</li>
                            <li class="list-group-item">Color:       {{$producto->color ?? ''}}</li>
                            <li class="list-group-item">Talla:       {{$producto->talla ?? ''}}</li>
                            <li class="list-group-item">Tipos:       {{$producto->tipo ?? ''}}</li>
                            <li class="list-group-item">Generos:     {{$producto->genero ?? ''}}</li>
                            </ul>
                            <div class="card-body">
                            <a href="#" class="card-link">Ver más</a>
                            <a href="#" class="card-link">Añadir al carrito</a>
                            </div>
                        </div>
                    </div>

                    @endforeach
                @else
                    No hay datos
                @endisset
            </div>


        </div>
    </div>
</section>
@endsection

@push('javascript')

<script>


        const categoria = document.querySelectorAll('a[name=categoria]');
        const marca = document.querySelectorAll('a[name=marca]');

        const inputCategoria = document.getElementById('categoria_id');
        const inputMarca = document.getElementById('marca_id');

        const inputNombreCategoria = document.getElementById('nombre_categoria');
        const inputNombreMarca = document.getElementById('nombre_marca');

        const botonBuscar = document.querySelector('#boton-buscar');
        //const botonBorrar = document.querySelector('#boton-borrar');

        const cardNombreCategoria = document.getElementById('card-nombre-categoria');
        const cardNombreMarca =  document.getElementById('card-nombre-marca');

        const toastCategoria = $('#toast-categoria');
        const toastMarca = $('#toast-marca');

        const btnCerrartoastCategoria = document.getElementById('btn-toast-categoria');
        const btnCerrartoastMarca = document.getElementById('btn-toast-marca');


        //const botonBorrar = document.querySelector('#boton-borrar');

        let arregloBuscador = {
                    categoria_id: inputCategoria.value,
                    marca_id: inputMarca.value,
        }

        /*
        Filtro
        botonBorrar.addEventListener('click',e =>{

            cerrar_toast(cardNombreCategoria,toastCategoria,inputCategoria,inputNombreCategoria);
            cerrar_toast(cardNombreMarca,toastMarca,inputMarca,inputNombreMarca);
            cerrar_toast(cardNombreTipoYacimiento,toastTipoYacimiento,inputTipoYacimiento,inputNombreTipoYacimiento);
            cerrar_toast(cardNombreRecurso,toastRecurso,inputRecursoPrimario,inputNombreRecursoPrimario);
            recurso_por_tipo_yacimiento('');
            cerrar_toast(cardNombreRecurso,toastRecurso,inputRecursoPrimario,inputNombreRecursoPrimario);
            document.getElementById('buscador_texto_nav_bar').value = '';
            botonBuscar.innerHTML = `<span>Buscar <i class="ml-2 fas fa-caret-right"></i></span>`;
        });*/

        /*
            function cantidad_concesiones( buscados ) {
            $.ajax({
                url: "{{ route('publico.contador-busqueda') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    buscados: buscados
                },
                success: function (response) {

                    if (inputRecursoPrimario.value == '' && inputMarca.value == '' && inputCategoria.value == '' && inputTipoYacimiento.value ==''){

                        botonBuscar.innerHTML = `<span>Buscar<i class="ml-2 fas fa-caret-right"></i></span>`;
                    }else{
                         botonBuscar.innerHTML = `<span>Buscar (${response})<i class="ml-2 fas fa-caret-right"></i></span>`;
                    }
                }
            });

        }*/





        cantidad_concesiones( arregloBuscador );

        if(arregloBuscador['categoria_id'] != ''){
            cardNombreCategoria.innerHTML = inputNombreCategoria.value;
            toastCategoria.toast('show');
        }
        if(arregloBuscador['marca_id'] != ''){
            cardNombreMarca.innerHTML = inputNombreMarca.value;
            toastMarca.toast('show');
        }



        function rellenar_arreglo_buscador(){
            const arregloBuscador = {
                    categoria_id: inputCategoria.value,
                    marca_id: inputMarca.value,
                }
            return arregloBuscador;
        }

        function cerrar_toast(cardNombre,toast,input,nombre){
            if(cardNombre.innerHTML != ''){
                cardNombre.innerHTML = '';
                toast.toast('hide');
                input.value = '';
                nombre.value = '';

                arregloBuscador = rellenar_arreglo_buscador();
                cantidad_concesiones( arregloBuscador );
            }
        }




        categoria.forEach(event  =>{
            event.addEventListener('click',e => {
                inputCategoria.value=e.target.getAttribute('data-id');
                inputNombreCategoria.value = e.target.innerHTML;

                cardNombreCategoria.innerHTML = e.target.innerHTML;
                toastCategoria.toast('show')



                arregloBuscador = rellenar_arreglo_buscador();

                cantidad_concesiones( arregloBuscador );
            });
        });

        marca.forEach(event  =>{
            event.addEventListener('click',e => {
                inputMarca.value=e.target.getAttribute('data-id');
                inputNombreMarca.value = e.target.innerHTML;

                cardNombreMarca.innerHTML = e.target.innerHTML;
                toastMarca.toast('show')

                arregloBuscador = rellenar_arreglo_buscador();

                cantidad_concesiones( arregloBuscador );
            });
        });






        btnCerrartoastCategoria.addEventListener('click', e =>{
            cerrar_toast(cardNombreCategoria,toastCategoria,inputCategoria,inputNombreCategoria);
        });

        btnCerrartoastMarca.addEventListener('click', e =>{
            cerrar_toast(cardNombreMarca,toastMarca,inputMarca,inputNombreMarca);
        });

</script>


@endpush
