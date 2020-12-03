<div class="modal fade" id="modal-usuario-{{ $usuario->id }}" tabindex="-1" aria-labelledby="modal-faq-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content btn-rounded">
            <div class="modal-header no-border justify-content-center">
                <h2 class="text-center mt-3">Detalles Usuario</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <div class="row">
                    <div class="col-lg-12 px-5">
                        <div class="card card-table shadow">
                            <div class="card-body">
                                <table id="table" class="table table-striped table-bordered display">
                                    <thead>
                                        <tr>
                                            <th>ID Usuario</th>
                                            <td>{{ $usuario->id ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nombre</th>
                                            <td>{{ $usuario->nombre ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Primer Apellido</th>
                                            <td>{{$usuario->primer_apellido ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Segundo Apellido</th>
                                            <td>{{ $usuario->segundo_apellido  ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Correo</th>
                                            <td>{{ $usuario->email ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Estado</th>
                                            <td>
                                                @if($usuario->estado_calidad == \App\Models\Usuario::ADELANTADO) Adelantado @endif
                                                @if($usuario->estado_calidad == \App\Models\Usuario::AL_DIA) Al día @endif
                                                @if($usuario->estado_calidad == \App\Models\Usuario::MOROSO) Moroso @endif


                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Cantidad Compras</th>
                                            <td>{{ $usuario->compras->count() ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Cantidad Pedidos</th>
                                            <td>{{ $usuario->pedidos->count() ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </tfoot>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
