@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
    <li>
        <a href="{{ '/' }}estudiante/tesis" class="active-menu"><i class="fa fa-list fa-3x"></i>Trabajo de Grado</a>
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
                    <div class="panel-heading title-caja">Cargar Trabajo de Grado</div>
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

                        <form class="form-horizontal" role="form" method="POST" action="/estudiante/tesis" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group input-group">

                                <span class="input-group-addon">Titulo</span>
                                <input type="text" id="titulo" name="titulo" class="form-control" value="{{old('titulo')}}" required>

                            </div>  

                            <div class="form-group input-group">

                                <span class="input-group-addon">Linea de Investigación</span>
                                <select id="linea" name="linea" class="form-control">
                                    @foreach ($lineas as $linea)

                                            @if (old('linea') == $linea->id)
                                            
                                                <option value="{{$linea->id}}" selected>{{$linea->linea}}</option>
                                            @else

                                                <option value="{{$linea->id}}">{{$linea->linea}}</option>

                                            @endif
                                            
                                        @endforeach
                                    
                                </select>

                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon">Programa</span>                            
                                <select class="form-control" name="programa">
                                    
                                    <option value="{{session()->get('user.programa')}}" selected>{{$programas[session()->get('user.programa')]}}</option>

                                </select>

                            </div>

                            <div class="form-group input-group">
                                
                                <span class="input-group-addon">Semestre</span>                            
                                <select class="form-control" name="semestre">
                                    
                                    @if(old('semestre') == 'a')
                                        <option value="a" selected>Semestre A</option>
                                        <option value="b">Semestre B</option>
                                    @elseif(old('semestre') == 'b')
                                        <option value="a">Semestre A</option>
                                        <option value="b" selected>Semestre B</option>
                                    @else
                                        <option value="a">Semestre A</option>
                                        <option value="b">Semestre B</option>
                                    @endif
                                </select>

                            </div> 

                            <div class="form-group input-group">
                                <span class="input-group-addon">Director del Proyecto</span>
                                <select id="profesor" name="profesor" class="form-control">
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

                                <span class="input-group-addon">Tipo de Trabajo</span>
                                <select id="tipo" name="tipo" class="form-control">
                                    @foreach ($tipos as $tipo)

                                            @if (old('tipo') == $tipo->id)
                                            
                                                <option value="{{$tipo->id}}" selected>{{$tipo->tipo}}</option>
                                            @else

                                                <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>

                                            @endif
                                            
                                    @endforeach
                                    
                                </select>

                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon">Archivo</span>
                                <input type="file" id="archivo" name="archivo" class="form-control" value="{{old('archivo')}}" required>

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