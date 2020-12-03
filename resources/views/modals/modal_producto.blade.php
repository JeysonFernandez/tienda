<div class="modal fade" id="modal-producto-{{ $producto->id }}" tabindex="-1" aria-labelledby="modal-faq-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content btn-rounded">
            <div class="modal-header no-border justify-content-center">
                <h2 class="text-center mt-3">Detalles producto</h2>
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
                                            <th>ID Producto</th>
                                            <td>{{ $producto->->id ?? '-' }}</td>
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
