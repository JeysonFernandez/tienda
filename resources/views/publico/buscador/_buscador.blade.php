
        <ul class="nav flex-column">
            <li class=" row nav-item nav-dropdown">
                <div class="col btn-group tipo-buscado">
                    <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pr-2 fas fa-fw fa-tools"></i>Categoria
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-left black-link">
                        @foreach ($categorias as $categoria )
                            <a name="categoria" class="dropdown-item active" data-id="{{$categoria->id}}" href="#">{{$categoria->nombre}}</a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                    <div class="container-toast" aria-live="polite" aria-atomic="true">
                        <div id="toast-categoria" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
                            <div class="toast-header">
                                <span id="card-nombre-categoria" class=" toast-title mr-auto"></span>
                                <button id="btn-toast-categoria" type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
            <li class=" row nav-item nav-dropdown">
                <div class="col btn-group">
                    <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pr-2 fas fa-fw fa-tools"></i>Colores
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-left black-link">
                        @foreach ($colores as $color )
                            <a name="color" class="dropdown-item active" data-id="{{$color->id}}" href="#">{{$color->nombre}}</a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                    <div class="container-toast" aria-live="polite" aria-atomic="true">
                        <div id="toast-color" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
                            <div class="toast-header">
                                <span id="card-nombre-color" class=" toast-title mr-auto"></span>
                                <button id="btn-toast-color" type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
            <li class=" row nav-item nav-dropdown">
                <div class="col btn-group">
                    <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pr-2 fas fa-fw fa-tools"></i>Marcas
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-left black-link">
                        @foreach ($marcas as $marca )
                            <a name="marca" class="dropdown-item active" data-id="{{$marca->id}}" href="#">{{$marca->nombre}}</a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                    <div class="container-toast" aria-live="polite" aria-atomic="true">
                        <div id="toast-marca" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
                            <div class="toast-header">
                                <span id="card-nombre-marca" class=" toast-title mr-auto"></span>
                                <button id="btn-toast-marca" type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
            <li class=" row nav-item nav-dropdown">
                <div class="col btn-group">
                    <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pr-2 fas fa-fw fa-tools"></i>Tallas
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-left black-link">
                        @foreach ($tallas as $talla )
                            <a name="talla" class="dropdown-item active" data-id="{{$talla->id}}" href="#">{{$talla->nombre}}</a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                    <div class="container-toast" aria-live="polite" aria-atomic="true">
                        <div id="toast-talla" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
                            <div class="toast-header">
                                <span id="card-nombre-talla" class=" toast-title mr-auto"></span>
                                <button id="btn-toast-talla" type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
            <li class=" row nav-item nav-dropdown">
                <div class="col btn-group">
                    <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pr-2 fas fa-fw fa-tools"></i>Proveedores
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-left black-link">
                        @foreach ($proveedores as $proveedor )
                            <a name="proveedor" class="dropdown-item active" data-id="{{$proveedor->id}}" href="#">{{$proveedor->nombre}}</a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                    <div class="container-toast" aria-live="polite" aria-atomic="true">
                        <div id="toast-proveedor" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
                            <div class="toast-header">
                                <span id="card-nombre-proveedor" class=" toast-title mr-auto"></span>
                                <button id="btn-toast-proveedor" type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
            <li class=" row nav-item nav-dropdown">
                <div class="col btn-group">
                    <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pr-2 fas fa-fw fa-tools"></i>Tipos
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-left black-link">
                        @foreach ($tipos as $tipo )
                            <a name="tipo" class="dropdown-item active" data-id="{{$tipo->id}}" href="#">{{$tipo->nombre}}</a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                    <div class="container-toast" aria-live="polite" aria-atomic="true">
                        <div id="toast-tipo" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
                            <div class="toast-header">
                                <span id="card-nombre-tipo" class=" toast-title mr-auto"></span>
                                <button id="btn-toast-tipo" type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
            <li class=" row nav-item nav-dropdown">
                <div class="col btn-group">
                    <button id="titulo-proyecto" class="dropdown-toggle dropdown-titulo px-3"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="pr-2 fas fa-fw fa-tools"></i>Generos
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-left black-link">
                        @foreach ($generos as $genero )
                            <a name="genero" class="dropdown-item active" data-id="{{$genero->id}}" href="#">{{$genero->nombre}}</a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                    <div class="container-toast" aria-live="polite" aria-atomic="true">
                        <div id="toast-genero" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
                            <div class="toast-header">
                                <span id="card-nombre-genero" class=" toast-title mr-auto"></span>
                                <button id="btn-toast-genero" type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </li>
            <li class="nav-dropdown">
                <form id="form-buscador" method="get" action="{{ route('publico.busqueda') }}">

                <input type="hidden" id="categoria_id"  name="categoria_id"  value="{{$input['categoria_id'] ?? ''}}">
                <input type="hidden" id="marca_id"      name="marca_id"      value="{{$input['marca_id']     ?? ''}}">
                <input type="hidden" id="talla_id"      name="talla_id"      value="{{$input['talla_id']     ?? ''}}">
                <input type="hidden" id="proveedor_id"  name="proveedor_id"  value="{{$input['proveedor_id'] ?? ''}}">
                <input type="hidden" id="tipo_id"       name="tipo_id"       value="{{$input['tipo_id']      ?? ''}}">
                <input type="hidden" id="genero_id"     name="genero_id"     value="{{$input['genero_id']    ?? ''}}">
                <input type="hidden" id="color_id"      name="color_id"      value="{{$input['color_id']    ?? ''}}">

                <input type="hidden" id="nombre_categoria"  name="nombre_categoria"  value="{{$input['nombre_categoria'] ?? '' }}">
                <input type="hidden" id="nombre_marca"      name="nombre_marca"      value="{{$input['nombre_marca'] ?? '' }}"    >
                <input type="hidden" id="nombre_talla"      name="nombre_talla"      value="{{$input['nombre_talla'] ?? '' }}"    >
                <input type="hidden" id="nombre_proveedor"  name="nombre_proveedor"  value="{{$input['nombre_proveedor'] ?? '' }}">
                <input type="hidden" id="nombre_tipo"       name="nombre_tipo"       value="{{$input['nombre_tipo'] ?? '' }}"     >
                <input type="hidden" id="nombre_genero"     name="nombre_genero"     value="{{$input['nombre_genero'] ?? '' }}"   >
                <input type="hidden" id="nombre_color"      name="nombre_color"      value="{{$input['nombre_color'] ?? '' }}"   >

                <input type="hidden" id="buscador_texto_filtro"   name="buscadorTexto"  value="{{$input['buscadorTexto'] ?? ''}}">
                {{--<a id="boton-borrar"  class="btn btn-pcm-pale-blue w-md-50 boton-buscar font-weight-bold"><span>Limpiar <i class="ml-2 fas fa-caret-right"></i></span></a>--}}

                </form>
                <button id="boton-buscar" type="" onclick="ejecutar_form_buscador()" class="btn btn-success boton-buscar-filtro font-weight-bold"><span>Buscar  <i class="ml-2 fas fa-caret-right"></i></span></button>
            </li>
        </ul>





