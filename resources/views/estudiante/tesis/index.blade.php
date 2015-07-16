@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
    <li>
        <a href="{{ '/' }}estudiante/tesis" class="active-menu"><i class="fa fa-book fa-3x"></i>Trabajo de Grado</a>
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
                    <div class="panel-heading title-caja">Trabajo de Grado</div>
                    <div class="panel-body" style="padding: 30px;">
                        @if (Session::get('mensagge_delete'))
                        <div class="alert alert-success">
                            {{Session::get('mensagge_delete')}}
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

                        @if(count($estudiante['tesis'])>0)

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Director</th>
                                        <th>Estado</th>
                                        <th>Archivo</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($estudiante->tesis as $tesis)

                                    @if(session()->get('user.programa') == $tesis['cod_prog_ryca'])
                                    <tr>
                                        <td data-title='titulo' style="max-width:450px"><a href="estudiante/tesis/{{$tesis->id}}">{{$tesis['titulo']}}</td></a>                 
                                        <td data-title='Profesor'>{{$profesores[$tesis['director_cod_user_ryca']]}}</td>
                                        @foreach($estados as $estado)

                                        @if($estado['id'] == $tesis['estado_id'])

                                        <td data-title='Estado'>{{$estado['estado']}}</td>

                                        @endif

                                        @endforeach

                                        <td data-title='archivo'>
                                        <a href="{{ '/' }}{{$tesis->source}}" class="btn btn-success btn-circle"><i class="fa fa-download fa-3x"></i></a>
                                        </td>
                                    </tr>

                                    @else

                                    <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran Tesis en el sistema.</p>

                                    @endif

                                    @endforeach
                                </tbody>

                            </table>
                        </div>                                

                        @else

                        <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran Tesis en el sistema.</p>

                        @endif

                        <div class="col-md-5 col-md-offset-5">
                            <a href="{{url('estudiante/tesis/create')}}" class="btn btn-primary btn-lg"><i class="fa fa-plus"> Añadir Tesis</i></a>
                        </div>

                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>


<!-- /. PAGE INNER  -->

<!-- /. PAGE WRAPPER  -->
@endsection