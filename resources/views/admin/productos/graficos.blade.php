
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
                  <h6 class="m-0 font-weight-bold text-primary">Cantidad de productos por</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('admin.producto.getgraficoproductopost')}}" method="POST">
                    @csrf
                    <select id="opciones" name="opciones">
                      <option id="categorias" value="categorias" @if ($valor === 'categorias')
                          selected
                      @endif>Categorias</option>
                      <option id="tallas" value="tallas" @if ($valor === 'tallas')
                          selected
                      @endif>Tallas</option>
                      <option id="tipos" value="tipos" @if ($valor === 'tipos')
                          selected
                      @endif>Tipos</option>
                      <option id="colores" value="colores" @if ($valor === 'colores')
                          selected
                      @endif>Colores</option>
                      <option id="generos" value="generos" @if ($valor === 'generos')
                          selected
                      @endif>Generos</option>
                      <option id="marcas" value="marcas" @if ($valor === 'marcas')
                          selected
                      @endif>Marca</option>
                      <option id="proveedores" value="proveedores" @if ($valor === 'proveedores')
                          selected
                      @endif>Proveedores</option>
                    </select>
                    <button type="submit">Mostrar</button>
                  </form>
                  
                  
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                  
                </div>
              </div>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">5 productos más vendidos</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="productoVendido"></canvas>
                  </div>
                  
                </div>
              </div>

              <!-- Bar Chart -->
              

            </div>

            <!-- Donut Chart -->
            
          </div>

        </div>
        <!-- /.container-fluid -->


@endsection

@section('js')
  <script type="text/javascript">


 
  var nombres = @json($nombre[1]);
  var data = @json($cantidad[1]);
  graficoArea(nombres,data);
  
   var nombres = @json($nombre[0]);
  var data = @json($cantidad[0]);
  var grafico = "productoVendido";
  graficosBar(nombres,data,grafico);
  
  

  
  </script>


@endsection



