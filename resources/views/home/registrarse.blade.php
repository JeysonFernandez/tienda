@extends('layouts.esquema')

@section('contenido')

        <div class="row">
            <div class="col">
                @include('home.login')
            </div>
            <div class="col">
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
                        <div class="card mt-3">
                            <div class="card-header bg-light text-black ">REGISTRATE</div>
                            <div class="card-body">
                            <form method="POST" action ="/usuarios">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                                <label for="nombre"> Nombre </label>
                                                <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}" placeholder="Ej: Christian"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="apellido"> Apellido </label>
                                            <input type="text" id="apellido" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{old('apellido')}}" placeholder="Ej: Fernández"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion"> Direccion </label>
                                    <input type="text" id="direccion" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{old('direccion')}}" placeholder="Ej: Esperidion Vera 1431, Alto Mirador"/>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="fono"> Fono</label>
                                            <input type="text" id="fono" name="fono" class="form-control @error('fono') is-invalid @enderror" value="{{old('fono')}}" placeholder="Ej: 99697121"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="sexo"> Sexo </label>
                                            <select name="sexo" id="sexo" class="form-control" >
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                                <option value="3">Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email"> Correo Electrónico</label>
                                        <input type="email" id="email" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" class="form-control @error('email') is-invalid @enderror" placeholder="chirismo123@gmail.com" value="{{old('email')}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="password"> Contraseña</label>
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="*********"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="passwordconfirmacion"> Confirmar Contraseña</label>
                                        <input type="password" id="passwordconfirmacion" name="passwordconfirmacion" class="form-control @error('passwordconfirmacion') is-invalid @enderror" placeholder="*********"/>
                                    </div>
                                    <div class="form-group text-right">
                                        <!--<button class="btn btn-primary"> <a href="{{route('home')}}" class>Volver</a></button>-->
                                        <button type="submit" class="btn btn-naranjo"> Registrarse</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
        </div>


@endsection
