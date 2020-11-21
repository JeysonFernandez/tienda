
        <ul class=" dropdown-bar-content list-inline d-block d-lg-flex align-items-center justify-content-between">
            <div class="items-links">
                {{--Tipo de proyecto--}}

                <li class=" nav-dropdown mr-5 ">
                    <div class="btn-group">
                        <div class="row">
                            <div class="col-5 mr-4">
                                <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="pr-2 fas fa-fw fa-tools"></i>Categoria
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-left black-link">
                                    @foreach ($categorias as $categoria )
                                        <a name="tipo-proyecto" class="dropdown-item active" data-id="{{$categoria->id}}" href="#">{{$categoria->nombre}}</a>
                                        <div class="dropdown-divider"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-5">
                                <p id="titulo-proyecto" class="p-busqueda ">
                                    Categorias
                                </p>
                            </div>

                        </div>

                    </div>
                </li>
                <li class=" nav-dropdown mr-5 ">
                    <div class="btn-group">
                        <div class="row">
                            <div class="col-5 mr-4">
                                <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="pr-2 fas fa-fw fa-tools"></i>Colores
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-left black-link">
                                    @foreach ($colores as $color )
                                        <a name="tipo-proyecto" class="dropdown-item active" data-id="{{$color->id}}" href="#">{{$color->nombre}}</a>
                                        <div class="dropdown-divider"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-5">
                                <p id="titulo-proyecto" class="p-busqueda ">
                                    Colores
                                </p>
                            </div>

                        </div>

                    </div>
                </li>
                <li class=" nav-dropdown mr-5 ">
                    <div class="btn-group">
                        <div class="row">
                            <div class="col-5 mr-4">
                                <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="pr-2 fas fa-fw fa-tools"></i>Marcas
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-left black-link">
                                    @foreach ($marcas as $marca )
                                        <a name="tipo-proyecto" class="dropdown-item active" data-id="{{$marca->id}}" href="#">{{$marca->nombre}}</a>
                                        <div class="dropdown-divider"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-5">
                                <p id="titulo-proyecto" class="p-busqueda ">
                                    Marca
                                </p>
                            </div>

                        </div>

                    </div>
                </li>
                <li class=" nav-dropdown mr-5 ">
                    <div class="btn-group">
                        <div class="row">
                            <div class="col-5 mr-4">
                                <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="pr-2 fas fa-fw fa-tools"></i>Tallas
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-left black-link">
                                    @foreach ($tallas as $talla )
                                        <a name="tipo-proyecto" class="dropdown-item active" data-id="{{$talla->id}}" href="#">{{$talla->nombre}}</a>
                                        <div class="dropdown-divider"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-5">
                                <p id="titulo-proyecto" class="p-busqueda ">
                                    Tallas
                                </p>
                            </div>

                        </div>

                    </div>
                </li>
                <li class=" nav-dropdown mr-5 ">
                    <div class="btn-group">
                        <div class="row">
                            <div class="col-5 mr-4">
                                <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="pr-2 fas fa-fw fa-tools"></i>Proveedores
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-left black-link">
                                    @foreach ($proveedores as $proveedor )
                                        <a name="tipo-proyecto" class="dropdown-item active" data-id="{{$proveedor->id}}" href="#">{{$proveedor->nombre}}</a>
                                        <div class="dropdown-divider"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-5">
                                <p id="titulo-proyecto" class="p-busqueda ">
                                    Proveedores
                                </p>
                            </div>

                        </div>

                    </div>
                </li>
                <li class=" nav-dropdown mr-5 ">
                    <div class="btn-group">
                        <div class="row">
                            <div class="col-5 mr-4">
                                <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="pr-2 fas fa-fw fa-tools"></i>Tipos
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-left black-link">
                                    @foreach ($tipos as $tipo )
                                        <a name="tipo-proyecto" class="dropdown-item active" data-id="{{$tipo->id}}" href="#">{{$tipo->nombre}}</a>
                                        <div class="dropdown-divider"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-5">
                                <p id="titulo-proyecto" class="p-busqueda ">
                                    Tipo
                                </p>
                            </div>

                        </div>

                    </div>
                </li>
                <li class=" nav-dropdown mr-5 ">
                    <div class="btn-group">
                        <div class="row">
                            <div class="col-5 mr-4">
                                <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="pr-2 fas fa-fw fa-tools"></i>Generos
                                </button>
                                <div class="dropdown-menu shadow dropdown-menu-left black-link">
                                    @foreach ($generos as $genero )
                                        <a name="tipo-proyecto" class="dropdown-item active" data-id="{{$genero->id}}" href="#">{{$genero->nombre}}</a>
                                        <div class="dropdown-divider"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-5">
                                <p id="titulo-proyecto" class="p-busqueda ">
                                    Generos
                                </p>
                            </div>

                        </div>

                    </div>
                </li>


                <li class="nav-dropdown">
                    <form id="form-buscador" method="get" action="{{ route('publico.busqueda') }}">

                    <input type="hidden" id="tipo_concesion_id" name="tipo_concesion_id"  value="{{$input['tipo_concesion_id'] ?? '' }}">
                    <input type="hidden" id="region_id" name="region_id"  value="{{$input['region_id'] ?? '' }}">
                    <input type="hidden" id="tipo_yacimiento_id" name="tipo_yacimiento_id"  value="{{$input['tipo_yacimiento_id'] ?? '' }}">
                    <input type="hidden" id="recurso_primario_id" name="recurso_primario_id"  value="{{$input['recurso_primario_id'] ?? '' }}">

                    <input type="hidden" id="nombre_tipo_concesion" name="nombre_tipo_concesion"  value="{{$input['nombre_tipo_concesion'] ?? '' }}">
                    <input type="hidden" id="nombre_region" name="nombre_region"  value="{{$input['nombre_region'] ?? '' }}">
                    <input type="hidden" id="nombre_tipo_yacimiento" name="nombre_tipo_yacimiento"  value="{{$input['nombre_tipo_yacimiento'] ?? '' }}">
                    <input type="hidden" id="nombre_recurso_primario" name="nombre_recurso_primario"  value="{{$input['nombre_recurso_primario'] ?? '' }}">

                    <input type="hidden" id="buscador_texto_filtro" name="buscadorTexto"  value="{{$input['buscadorTexto'] ?? ''}}">
                    {{--<a id="boton-borrar"  class="btn btn-pcm-pale-blue w-md-50 boton-buscar font-weight-bold"><span>Limpiar <i class="ml-2 fas fa-caret-right"></i></span></a>--}}

                    </form>
                    <button id="boton-buscar" type="" onclick="ejecutar_form_buscador()" class="btn btn-success boton-buscar-filtro font-weight-bold"><span>Buscar  <i class="ml-2 fas fa-caret-right"></i></span></button>
                </li>

            </div>

        </ul>
