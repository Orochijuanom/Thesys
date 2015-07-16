@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
    <li>
        <a class="active-menu" href="/estudiante/login"><i class="fa fa-book fa-3x"></i>Estudiante</a>
    </li>
    <li>
        <a href="tab-panel.html"><i class="fa fa-check-square-o fa-3x"></i>Jurado</a>
    </li>
    <li>
        <a href="/decano/login"><i class="fa fa-user fa-3x"></i>Decano</a>
    </li>
    <li>
        <a href="/comite/login"><i class="fa fa-users fa-3x"></i>Comité Curricular</a>
    </li>            
    <li>
        <a href="/admin/login"><i class="fa fa-tachometer fa-3x"></i>Administrador</a>
    </li>
</ul>

@endsection

@section('content')

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">    

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading title-caja">Estudiante</div>
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

                            <form class="form-horizontal" role="form" method="POST" action="/estudiante/login">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>                            
                                    <input type="text" class="form-control" placeholder="Usuario" name="username" value="{{ old('username') }}" required>                            
                                </div>

                                <div class="form-group input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>                            
                                    <input type="password" class="form-control" placeholder="Contraseña" name="password" value="{{ old('email') }}" required>                            
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon">Programa</span>                            
                                    <select class="form-control" name="programa">

                                        @foreach ($programas as $id => $programa)

                                        @if (old('programa') == $id)

                                        <option value="{{$id}}" selected>{{$programa}}</option>
                                        @else

                                        <option value="{{$id}}">{{$programa}}</option>

                                        @endif

                                        @endforeach

                                    </select>

                                </div>                        

                                <div class="form-group">

                                    <div class="col-md-6">
                                        <a href="http://ryca.itfip.edu.co/RYCAWeb/">¿Olvidaste tu contraseña?</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-5 col-md-offset-5">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fa fa-check"> Aceptar</i>
                                        </button>                                
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
@endsection