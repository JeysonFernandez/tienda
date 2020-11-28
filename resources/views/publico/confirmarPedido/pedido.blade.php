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

                <div class="form-group">
                    <label for="tipo"> Tipo </label>
                    <select name="tipo" id="tipo" class="form-control" >
                        <option value="e">Express (urgencia)</option>
                        <option value="v">Visita</option>
                    </select>
                </div>
                <div class="form-row pl-2">

                    <div class="calendario"></div>
                    <div class="lista-horas p-2">4</div>
                </div>

                <input type="hidden" name="fecha" id='fecha' value="">
                <input type="hidden" name="hora" id='hora' value="">
                <button type="submit" class="btn btn-naranjo btn-block disabled js-btn-agendar" disabled>Agendar hora seleccionada</button>
            </form>
        </div>
    </div>

</div>

