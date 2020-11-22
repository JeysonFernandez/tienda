@extends('layouts.master')
@section('contenido')
  
        <!-- Begin Page Content -->
        <div class="container-fluid" >
          
          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-8 col-lg-7">

              <!-- Area Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Estados de los pagos</h6>
                </div>
                <div class="card-body">
                  <h5>{{$mensaje}}</h5>
                  <form action="{{route('admin.getgraficopag')}}" method="POST">
                      @csrf
                      <input type="date" name="fechaInicial" id="fechaInicial" @if ($fechaInicial != "")
                          value="{{$fechaInicial}}"
                      @endif >
                      <input type="date" name="fechaFinal" id="fechaFinal" @if ($fechaFinal != "")
                          value="{{$fechaFinal}}"
                      @endif  >
                      <button type="submit">Mostrar</button>
                  </form>
                  <div class="chart-area">
                    <canvas id="estadoPagos"></canvas>
                  </div>
                  
                </div>
              </div>
              

            </div>

            <!-- Donut Chart -->
            
          </div>

        </div>
        <!-- /.container-fluid -->


@endsection

@section('js')
  <script type="text/javascript">


 
  var nombres = @json($nombre);
  var data = @json($cantidad);
  var grafico = "estadoPagos";
  graficosBar(nombres,data,grafico);
  
  

  
  </script>


@endsection
