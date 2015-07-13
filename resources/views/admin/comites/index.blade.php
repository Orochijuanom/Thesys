@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu"> 
    <li>
        <a href="{{ '/' }}admin/decanos"><i class="fa fa-users fa-3x"></i>Decanos</a>
    </li>
    <li>
        <a class="active-menu" href="#"><i class="fa fa-sitemap fa-3x"></i>Comité Curricular</a>
    </li>    
</ul>

@endsection

@section('content')

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">    

        <div class="container-fluid">
            <div class="row">                
                    <div class="panel panel-default">
                        <div class="panel-heading title-caja">Miembros del Comité Curricular</div>
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

                            @if(count($comites)>0)
                            <section id='no-more-tables'>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Profesor</th>
                                                <th>Programa</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($comites as $comite)

                                            <tr>
                                                <td data-title='Profesor'>{{$profesores[$comite['cod_user_ryca']]['nombre']}}</td>
                                                <td data-title='Programa'>{{$programas[$comite['cod_prog_ryca']]['programa']}}</td>
                                                <td data-title='Eliminar'>
                                                    <form action='/admin/comites/{{$comite->id}}' method='post'>
                                                        <input name='_method' type='hidden' value='DELETE'>
                                                        <input name='_token' type='hidden' value='{{csrf_token()}}'>
                                                        <button type="submit" onclick="clicked(event)" class="btn btn-danger">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>                                
                            </section>
                            @else

                            <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran miembros del comite en el sistema.</p>

                            @endif

                            <a href="{{url('admin/comites/create')}}" class="btn btn-success"><i class="fa fa-plus"> Añadir Miembros al Comité</i></a>
                            
                        </div>
                    </div> 
            </div>
        </div>
    </div>
</div>


<!-- /. PAGE INNER  -->

<!-- /. PAGE WRAPPER  -->
@endsection


