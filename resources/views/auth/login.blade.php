@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Login</b></div>
                <div class="panel-body" style="padding: 30px;">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Hubo Algunos problemas con tu entrada.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="/auth/login">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">                      
  
                        <div class="form-group input-group input-group-lg">
                            <span class="input-group-addon">Email</span>                            
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">                            
                        </div>

                        <div class="form-group input-group input-group-lg">
                            <span class="input-group-addon">Password</span>                            
                            <input type="password" class="form-control" placeholder="Contraseña" name="password" value="{{ old('email') }}">                            
                        </div>                        

                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">No cerrar sesión
                                    </label>                                    
                                </div>                                
                            </div>
                            <div class="col-md-6">
                                <a href="/password/email">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Iniciar Sesión
                                </button>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection