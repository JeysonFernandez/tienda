<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">


</head>

<body id="page-top">



    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('index')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Tiendit@</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('admin.index')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Bienvenida</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestion Productos
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Caracteristicas</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Caracteristicas</h6>
                        <a class="collapse-item" href="{{route('admin.categoria.verCategorias')}}">Categorias</a>
                        <a class="collapse-item" href="{{route('admin.color.getColor')}}">Color</a>
                        <a class="collapse-item" href="{{route('admin.genero.getGenero')}}">Generos</a>
                        <a class="collapse-item" href="{{route('admin.marca.getMarca')}}">Marcas</a>
                        <a class="collapse-item" href="{{route('admin.tipo.getTipo')}}">Tipos</a>
                        <a class="collapse-item" href="{{route('admin.talla.getTalla')}}">Tallas</a>
                        <a class="collapse-item" href="{{route('admin.proveedor.getProveedor')}}">Proveedores</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <!--<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Caracteristicas Productos</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>-->
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.producto.getProducto')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Tabla Productos</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.producto.getGraficoProducto')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Graficos Productos</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestion Usuarios
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.usuario.getUsuario')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Tabla Usuarios</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{route('admin.usuario.getGraficoUsuario')}}" >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Graficos Usuarios</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">
                Gestion Fechas
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.fecha.getFechas')}}" >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Fechas</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading">
                Gestion Compras
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.compra.getCompras')}}" >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Compras</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{route('admin.compra.getGraficoCom')}}" >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Graficos Compras</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading">
                Gestion Pagos
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.pago.getPagos')}}" >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Pagos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{route('admin.pago.getGraficoPag')}}" >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Graficos Pagos</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading">
                Gestion Pedidos
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.pedido.getPedido')}}" >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Pedidos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{route('admin.pedido.getGraficoPed')}}" >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Graficos Pedidos</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading">
                Notificaciones
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.notificacion.getNotificacionesUsuarios')}}" >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Notificaciones Usuarios</span>
                </a>
                <a class="nav-link" href="{{route('admin.notificacion.getNotificacionesProductos')}}" >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Notificaciones Produtos</span>
                </a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <!--<span class="badge badge-danger badge-counter">3+</span>-->
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notificaciones
                                </h6>
                                <?php $cont = 0?>
                                {{--
                                @foreach ($notificacionUsuarios as $notificacionUsuario)
                                    @if ($cont<=3)
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-success">
                                                    <i class="fas fa-donate text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">{{$notificacionUsuario->fecha_creacion}}</div>
                                                {{$notificacionUsuario->mensaje}}
                                            </div>
                                        </a>
                                    @endif
                                    <?php $cont++?>
                                @endforeach--}}
                                <a class="dropdown-item text-center small text-gray-500" href="{{route('admin.notificacion.getNotificacionesUsuarios')}}">Mostrar todas las notificaciones (Usuarios)</a>
                            </div>
                        </li>

                         <!-- Nav Item - Alerts -->
                         <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                               <!-- <span class="badge badge-danger badge-counter">3+</span>-->
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notificaciones
                                </h6>
                                <?php $cont = 0?>
                                {{--
                                @foreach ($notificacionProductos as $notificacionProducto)
                                    @if ($cont<=3)
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-success">
                                                    <i class="fas fa-donate text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">{{$notificacionProducto->fecha_creacion}}</div>
                                                {{$notificacionProducto->mensaje}}
                                            </div>
                                        </a>
                                    @endif
                                    <?php $cont++?>
                                @endforeach
                                    --}}
                                <a class="dropdown-item text-center small text-gray-500" href="{{route('admin.notificacion.getNotificacionesProductos')}}">Mostrar todas las notificaciones(Productos)</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">@auth
                                    {{Auth::user()->nombre}} {{Auth::user()->apellido}}
                                @endauth</span>
                                <img class="img-profile rounded-circle"
                                    >
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Volver a la Tienda
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('publico.logout')}}" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                @yield('contenido')


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Tiend@</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Custom scripts for all pages-->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    {{--
    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{asset('js/demo/datatables.js')}}"></script>
        --}}
     @yield('js')
</body>

</html>
