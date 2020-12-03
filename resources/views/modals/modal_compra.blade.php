<div class="modal fade" id="modal-compra-{{ $compra->id }}" tabindex="-1" aria-labelledby="modal-faq-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content btn-rounded">
            <div class="modal-header no-border justify-content-center">
                <h2 class="text-center mt-3">Detalles Compra</h2>
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
                                            <th>ID Compra</th>
                                            <td>{{ $compra->id ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Fecha Compra</th>
                                            <td>{{ $compra->fecha_compra ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Deuda Total</th>
                                            <td>${{$compra->deuda_total ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Deuda Pendiente</th>
                                            <td>${{ $compra->deuda_pendiente  ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Fecha Siguiente Pago</th>
                                            <td>{{ $compra->fecha_siguiente_pago ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Estado</th>
                                            <td>
                                                @if($compra->estado == \App\Models\Compra::Pendiente) Pendiente @endif
                                                @if($compra->estado == \App\Models\Compra::Completado) Completado @endif

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Cantidad Productos Comprados</th>
                                            <td>{{ $compra->compraproducto->count() ?? '-' }}</td>
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
