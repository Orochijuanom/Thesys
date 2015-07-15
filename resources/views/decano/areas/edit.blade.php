@extends('app')

@section('sidebar')
@parent

<ul class="nav" id="main-menu">
    <li>
        <a href="{{ '/' }}decano/areas"><i class="fa fa-users fa-3x"></i>Areas Institucionales</a>
    </li>
    <li>
        <a href="{{ '/' }}decano/lineas"><i class="fa fa-sitemap fa-3x"></i>Lineas de Investigacion</a>
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
                    <div class="panel-heading title-caja">Editar {{$area->area}}</div>
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

                        <form class="form-horizontal" role="form" method="POST" action="/decano/areas/{{$area->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group input-group">
                                <span class="input-group-addon">Facultad</span>
                                <select id="facultad" name="facultad" class="form-control">
                                    <option value="{{session()->get('user.facultad')}}" selected>{{$facultades[session()->get('user.facultad')]}}</option>
                                    
                                </select>
                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon">Area</span>
                                <input type="text" id="area" name="area" class="form-control" value="{{$area->area}}">

                            </div>                        

                            <div class="form-group">
                                <div class="col-md-5 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fa fa-check">Aceptar</i>
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