
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
                <div class="card-header bg-light text-dark ">INICIA SESIÓN</div>
                <div class="card-body">

                    <form method="POST" action ="{{route('usuarios.login')}}">
                        @csrf
                        <div class="form-group ">
                            <label for="email"> Correo Electrónico </label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Ej: jeysonfernandez@gmail.com"/>
                        </div>
                        <div class="form-group ">
                            <label for="password"> Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Ej: ********"/>
                        </div>
                        <div class="form-group text-right">
                            <!--<button class="btn btn-primary"> <a href="{{route('home')}}" class>Volver</a></button>-->
                            <button type="submit" class="btn btn-primary"> Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
