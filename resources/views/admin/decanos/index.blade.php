@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
    <li>
        <a class="active-menu" href="#"><i class="fa fa-users fa-3x"></i>Decanos</a>
    </li>
    <li>
        <a href="{{ '/' }}admin/comites"><i class="fa fa-sitemap fa-3x"></i>Comité Curricular</a>
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
                    <div class="panel-heading title-caja">Decanos</div>
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

                        @if(count($decanos)>0)
                        <section id='no-more-tables'>

                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Administrativo</th>
                                            <th>Facultad</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($decanos as $decano)

                                        <tr>
                                            <td data-title='Administrativo'>{{$administrativos[$decano['cod_user_ryca']]['nombre']}}</td>
                                            <td data-title='Facultad'>{{$facultades[$decano['cod_facu_ryca']]}}</td>
                                            <td data-title='Eliminar' class="center">
                                                <form action='/admin/decanos/{{$decano->id}}' method='post'>
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

                        <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran decanos en el sistema.</p>

                        @endif

                        <a href="{{url('admin/decanos/create')}}" class="btn btn-success"><i class="fa fa-plus"> Añadir Decano</i></a> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection