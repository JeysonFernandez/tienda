



<div class="col mt-2">
    <div class="card mt-3">
        <div class="card-header bg-light text-dark ">CARRITO</div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-striped" width="200">
                        <thead class="thead-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unidad</th>
                                <th>Sub-Total</th>
                                <th></th>
                            </tr>
                        </thead>
                    
                    <?php $valor = 0 ?>
                    @if (session('carro'))
                        @foreach (session('carro') as $id => $detalles)
                            <tr>
                                <?php $valor+= $detalles['precio'] * $detalles['cantidad']?>
                                <a href="/producto/{{ $detalles['id'] }}">
                                    <td>  {{$detalles['nombre']}} </td>
                                    <td> 
                                        <form action="/actualizar-carro/{{$id}}" method="POST">
                                            @csrf 
                                            <div class="row">
                                                <div class="col">
                                                    <input type="number" min="1" max="100" value="{{ $detalles['cantidad'] }}" id="cantidad" name="cantidad">
                                                </div>  
                                                <div class="col">
                                                    <button class="btn btn-sm btn-warning" type="submit">Actualizar</button>
                                                </div>
                                            </div> 
                                        </form>
                                        <!--<div class="row">
                                            <div class="col">
                                                <input type="number" min="1" max="100" value="{{ $detalles['cantidad'] }}" id="producto_{{ $id }}" name="producto_{{ $id }}">
                                            </div>
                                            <div class="col">
                                                <a href="/actualizar-carrito/{{ $id }}/" class="btn btn-warning btn-update-item" >Actualizar</a>
                                            </div>
                                        </div>-->
                                
                                    </td>
                                    <td>${{ $detalles['precio'] }}</td>
                                    <td>${{$valor}}</td>
                                    <td><a class="btn btn-danger btn-sm" href="/borrar-elemento-carro/{{$id}}"> Eliminar </a></td>
                                </a>
                            </tr> 
                        @endforeach
                    @endif
        
                    </table>
                </div>
            </div>
            <div class="row">
            <div class="col">
                <div class="form-group text-right">
                <a class="btn btn-danger" href="{{route('publico.producto.borrarCarro')}}"> Borrar Carro </a>
                </div>
                    
            </div>
            </div>
            
        </div>
    </div>
</div>        


