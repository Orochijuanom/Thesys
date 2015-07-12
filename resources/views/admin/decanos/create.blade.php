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
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading title-caja">Asignar Decanos</div>
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

                            <form class="form-horizontal" role="form" method="POST" action="/admin/decanos">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group input-group">
                                    <span class="input-group-addon">Administrativo</span>
                                    <select id="administrativo" name="administrativo" class="form-control">
                                        @foreach ($administrativos['administrativos'] as $administrativo)

                                        @if (old('administrativo') == $administrativo['administrativo']['id'])

                                        <option value="{{$administrativo['administrativo']['id']}}" selected>{{$administrativo['administrativo']['nombres']}} {{$administrativo['administrativo']['apellidos']}}</option>
                                        @else

                                        <option value="{{$administrativo['administrativo']['id']}}">{{$administrativo['administrativo']['nombres']}} {{$administrativo['administrativo']['apellidos']}}</option>

                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon">Facultad</span>
                                    <select class="form-control" name="facultad">
                                        {{$facultad = ""}}
                                        @foreach ($programas['programas'] as $programa)

                                        @if ($facultad == $programa['programa']['facultad'])

                                        {{$facultad = $programa['programa']['facultad']}}

                                        @else

                                        @if (old('facultad') == $programa['programa']['facultad'])

                                        <option value="{{$programa['programa']['facultad']}}" selected>{{$programa['programa']['facultad']}}</option>
                                        @else

                                        <option value="{{$programa['programa']['facultad']}}">{{$programa['programa']['facultad']}}</option>

                                        @endif

                                        {{$facultad = $programa['programa']['facultad']}}

                                        @endif

                                        @endforeach

                                    </select>

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

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
@endsection