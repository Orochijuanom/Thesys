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
                    <div class="panel panel-primary">
                        <div class="panel-heading title-caja">Lineas Investigación</div>
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
                                                <th>Linea</th>
                                                <th>Area</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach ($lineas as $linea)

                                            <tr>
                                                <td data-title='linea'>{{$linea['linea']}}</td>
                                                <td data-title='Area'>{{$linea->areas->area}}</td>
                                                <td data-title='Editar'>
                                                    <form action='/decano/lineas/{{$linea->id}}/edit' method='get'>
                                                        <button type="submit" onclick="clicked(event)" class="btn btn-danger">
                                                            <i class="fa fa-trash-o"></i>
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

                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>                                
                            </section>
                            @else

                            <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran lineas en el sistema.</p>

                            @endif

                            <a href="{{url('decano/lineas/create')}}" class="btn btn-success"><i class="fa fa-plus"> Añadir Linea</i></a>
                            
                        </div>
                    </div> 
            </div>
        </div>
    </div>
</div>


<!-- /. PAGE INNER  -->

<!-- /. PAGE WRAPPER  -->
@endsection


