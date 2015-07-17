@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu"> 
    <li>
        <a href="#" class="active-menu"><i class="fa fa-university fa-3x"></i>Áreas Institucionales</a>
    </li>
    <li>
        <a href="{{ '/' }}decano/lineas"><i class="fa fa-lightbulb-o fa-3x"></i>Líneas de Investigación</a>
    </li>
    <li>
        <a href="{{ '/' }}decano/reportes"><i class="fa fa-bar-chart fa-3x"></i>Reportes</a>
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
                    <div class="panel-heading title-caja">Áreas de Investigación Institucionales</div>
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

                        @if(count($areas)>0)
                        <section id='no-more-tables'>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Facultad</th>
                                            <th>Área</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($areas as $area)
                                        
                                        @if($facultades[$area['cod_facu_ryca']] == $facultades[session()->get('user.facultad')])
                                        <tr>
                                            <td data-title='Facultad'>{{$facultades[$area['cod_facu_ryca']]}}</td>
                                            <td data-title='Area'>{{$area['area']}}</td>
                                            <td data-title='Editar'>
                                                <form action='/decano/areas/{{$area->id}}/edit' method='get'>
                                                    <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td data-title='Eliminar'>
                                                <form action='/decano/areas/{{$area->id}}' method='post'>
                                                    <input name='_method' type='hidden' value='DELETE'>
                                                    <input name='_token' type='hidden' value='{{csrf_token()}}'>
                                                    <button type="submit" onclick="clicked(event)" class="btn btn-danger">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        @endif

                                        @endforeach
                                    </tbody>

                                </table>
                            </div>                                
                        </section>
                        @else

                        <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran areas en el sistema.</p>

                        @endif

                        <div class="col-md-5 col-md-offset-5">
                            <a href="{{url('decano/areas/create')}}" class="btn btn-primary btn-lg"><i class="fa fa-plus"> Añadir Área</i></a>
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


