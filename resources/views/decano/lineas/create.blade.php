@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
    <li>
        <a href="{{ '/' }}decano/areas"><i class="fa fa-university fa-3x"></i>Áreas Institucionales</a>
    </li>
    <li>
        <a href="{{ '/' }}decano/lineas" class="active-menu"><i class="fa fa-lightbulb-o fa-3x"></i>Líneas de Investigación</a>
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
                    <div class="panel-heading title-caja">Crear Línea de investigación</div>
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

                        <form class="form-horizontal" role="form" method="POST" action="/decano/lineas">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group input-group">

                                <span class="input-group-addon">Área</span>
                                <select id="area" name="area" class="form-control">
                                    @foreach ($areas as $area)

                                            @if (old('area') == $area->id)
                                            
                                                <option value="{{$area->id}}" selected>{{$area->area}}</option>
                                            @else

                                                <option value="{{$area->id}}">{{$area->area}}</option>

                                            @endif
                                            
                                        @endforeach
                                    
                                </select>

                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon">Línea</span>
                                <input type="text" id="linea" name="linea" class="form-control" value="{{old('linea')}}">
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
<!-- /. PAGE WRAPP -->
@endsection