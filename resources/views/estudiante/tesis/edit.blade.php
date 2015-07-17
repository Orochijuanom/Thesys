@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
    <li>
        <a href="#" class="active-menu"><i class="fa fa-book fa-3x"></i>Trabajo de Grado</a>
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
                    <div class="panel-heading title-caja">Revisar Trabajo de Grado</div>
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

                        <form class="form-horizontal" role="form" method="POST" action="/estudiante/tesis/{{$tesis->id}}" enctype="multipart/form-data">
                        <input name='_method' type='hidden' value='PUT'>
                        <input name='_token' type='hidden' value='{{csrf_token()}}'>
                        

                            <div class="form-group input-group">

                                <span class="input-group-addon">Titulo</span>
                                <textarea rows="4" id="titulo" name="titulo" class="form-control">{{$tesis->titulo}}</textarea>

                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon">Linea de Investigación</span>
                                <select id="linea" name="linea" class="form-control" disabled>
                                   
                                    <option value="{{$tesis->lineas->id}}">{{$tesis->lineas->linea}}</option>
                                </select>

                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon">Programa</span>                            
                                <select class="form-control" name="programa" disabled>
                                    
                                    <option value="{{$tesis->cod_prog_ryca}}" selected>{{$programas[$tesis->cod_prog_ryca]}}</option>

                                </select>

                            </div>

                            <div class="form-group input-group">
                                
                                <span class="input-group-addon">Semestre</span>                            
                                <select class="form-control" name="semestre" disabled>
                                    
                                    @if($tesis->semestre == 'a')
                                    
                                        <option value="a">Semestre A</option>
                                    
                                    @else
                                       
                                        <option value="b">Semestre B</option>

                                    @endif
                                </select>

                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon">Director del Proyecto</span>
                                <select id="profesor" name="profesor" class="form-control" disabled>

                                    <option value="{{$tesis->director_cod_user_ryca}}">{{$profesores[$tesis->director_cod_user_ryca]}}</option>
                                    
                                </select>
                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon">Tipo de Trabajo</span>
                                <select id="tipo" name="tipo" class="form-control" disabled>

                                    <option value="{{$tesis->tipos->id}}" selected>{{$tesis->tipos->tipo}}</option>
                                                                               
                                </select>

                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon">Estado</span>
                                <select id="estado" name="estado" class="form-control">

                                    <option value="{{$tesis->estados->id}}" selected>{{$tesis->estados->estado}}</option>
                                                               
                                                                               
                                </select>

                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon">Estudiantes</span>

                                <label class="form-control">

                                    @foreach($tesis->estudiantes as $estudiante)
                                       @inject('buscador', 'App\Classes\Buscador') 

                                        
                                        {{$nombre = $buscador->buscadorEstudiante($estudiante->username)}}
                                        </br>

                                        

                                    @endforeach

                                </label>

                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon">Observaciones</span>
                                <label class="form-control">

                                    @foreach($tesis->revisiones as $revision)

                                        {{$revision->revision}}
                                        </br>

                                    @endforeach

                                </label>

                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon">Archivo</span>
                                <input type="file" id="archivo" name="archivo" class="form-control" value="{{old('archivo')}}" required>

                            </div> 

                            <div class="form-group input-group">

                                <span class="input-group-addon">Archivo</span>
                                <label class="form-control"><a href="{{ '/' }}{{$tesis->source}}" class="btn btn-success btn-circle" target="_blank"><i class="fa fa-download fa-3x"></i></a></label>

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