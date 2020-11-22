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
                  <h6 class="m-0 font-weight-bold text-primary">Tipo de pedidos</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="productoVendido"></canvas>
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
  var grafico = "productoVendido";
  graficosBar(nombres,data,grafico);
  
  

  
  </script>


@endsection
