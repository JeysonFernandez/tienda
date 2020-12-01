@extends('layouts.master')
@section('contenido')

        <!-- Begin Page Content -->
        <div class="container-fluid" >

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-8 col-lg-7">

              <!-- Area Chart -->
              <div class="card  shadow mb-4">
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

  var ctx = document.getElementById('productoVendido');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombres,
            datasets: [{
                label: 'Producto',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(215, 99, 132, 0.2)',
                    'rgba(114, 162, 205, 0.2)',
                    'rgba(200, 216, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(215, 99, 132, 1)',
                    'rgba(114, 162, 205, 1)',
                    'rgba(200, 216, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });




  </script>


@endsection
