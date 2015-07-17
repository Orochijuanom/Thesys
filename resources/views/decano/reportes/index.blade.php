@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu"> 
    <li>
        <a href="{{ '/' }}decano/areas"><i class="fa fa-list fa-3x"></i>Áreas Institucionales</a>
    </li>
    <li>
        <a href="{{ '/' }}decano/lineas"><i class="fa fa-lightbulb-o fa-3x"></i>Líneas de Investigación</a>
    </li>
    <li>
        <a href="#" class="active-menu"><i class="fa fa-bar-chart fa-3x"></i>Reportes</a>
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
                        <div class="panel-heading title-caja">Líneas Investigación</div>
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

                            @if(count($lineas)>0)
                            <section id='no-more-tables'>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Línea</th>
                                                <th>Área</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach ($lineas as $linea)
                                            @if($linea->areas->cod_facu_ryca == session()->get('user.facultad'))
                                            <tr>
                                                <td data-title='linea'>{{$linea['linea']}}</td>
                                                <td data-title='Area'>{{$linea->areas->area}}</td>
                                                <td data-title='Editar'>
                                                    <form action='/decano/lineas/{{$linea->id}}/edit' method='get'>
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="fa fa-pencil-square-o"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td data-title='Eliminar'>
                                                    <form action='/decano/lineas/{{$linea->id}}' method='post'>
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

                            <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran lineas en el sistema.</p>

                            @endif

                            <div class="col-md-5 col-md-offset-5">
                            <a href="{{url('decano/lineas/create')}}" class="btn btn-primary btn-lg"><i class="fa fa-plus"> Añadir Línea</i></a>
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