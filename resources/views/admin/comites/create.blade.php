@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
    <li>
        <a href="{{ '/' }}admin/decanos"><i class="fa fa-users fa-3x"></i>Decanos</a>
    </li>
    <li>
        <a class="active-menu" href="{{ '/' }}admin/comites"><i class="fa fa-sitemap fa-3x"></i>Comité Curricular</a>
    </li>    
</ul>

@endsection

@section('content')

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">    

        <div class="container-fluid">
            <div class="row">                
                    <div class="panel panel-primary">
                        <div class="panel-heading title-caja">Asignar Miembros del Comite Curricular</div>
                        <div class="panel-body" style="padding: 30px;">
                            @if (Session::get('mensagge'))
                            <div class="alert alert-success">
                                {{Session::get('mensagge')}}
                                <br><br>            
                            </div>
                        @endif

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

                            <form class="form-horizontal" role="form" method="POST" action="/admin/comites">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group input-group">
                                    <span class="input-group-addon">Profesor</span>                            
                                    <select class="form-control" name="profesor">

                                        @foreach ($profesores as $id => $profesor)

                                            @if (old('profesor') == $id)
                                            
                                                <option value="{{$id}}" selected>{{$profesor}}</option>
                                            @else

                                                <option value="{{$id}}">{{$profesor}}</option>

                                            @endif
                                            
                                        @endforeach

                                    </select>

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
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
@endsection