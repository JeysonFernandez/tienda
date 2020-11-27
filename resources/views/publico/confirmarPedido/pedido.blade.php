<div class="col-sm-12  mt-2">
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Auth::user()->id)
        <?php $idUsuario = Auth::user()->id?>
        <?php $nombre = Auth::user()->nombre?>
        <?php $apellido= Auth::user()->apellido?>
    @endif
    <?php $minimo = 1000000 ?>
    @if (session('carro'))
        @foreach ( session('carro') as $id => $detalles )
            @if($detalles['precio']<=$minimo)
                <?php $minimo = $detalles['precio'] ?>
            @endif
        @endforeach
    @endif
    <div class="card mt-3">
        <div class="card-header bg-light text-black ">CONFIRMAR PEDIDO</div>
        <div class="card-body">
        <form method="POST" action ="/pedidos/{{$idUsuario}}">
                @csrf
                <div class="form-group">
                    <label for="lugar"> Lugar de Entrega </label>
                    <input type="text" id="lugar" name="lugar" class="form-control" value="{{old('lugar')}}" placeholder="Ej: Esperidion Vera 1431, Alto Mirador"/>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fecha"> Fecha</label>
                        <input type="date" id="fecha" name="fecha" value="{{old('fecha')}}" class="form-control @error('fecha') is-invalid @enderror"/>
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="hora"> Hora</label>
                        <input type="time" id="hora" name="hora" value="{{old('hora')}}" class="form-control @error('hora') is-invalid @enderror"/>
                    </div>
                </div>  
                <div class="form-group">
                    <label for="tipo"> Tipo </label>
                    <select name="tipo" id="tipo" class="form-control" >
                        <option value="e">Express (urgencia)</option>
                        <option value="v">Visita</option>
                    </select>
                </div>
                
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary"> Confirmar</button>
                </div>
            </form>
        </div>
    </div>

</div>

