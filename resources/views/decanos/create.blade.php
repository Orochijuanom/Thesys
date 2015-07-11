@extends('app')

@section('sidebar')
@parent

@endsection

@section('content')

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">    

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Asignar Decanos</b></div>
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

                                <div class="form-group input-group input-group-lg">
                                    <span class="input-group-addon">Funcionario</span>                            
                                    <select class="form-control" name="funcionario">

                                        @foreach ($administrativos['administrativos'] as $administrativo)

                                            @if (old('funcionario') == $administrativo['administrativo']['id'])
                                            
                                                <option value="{{$administrativo['administrativo']['id']}}" selected>{{$administrativo['administrativo']['nombres']}} {{$administrativo['administrativo']['apellidos']}}</option>
                                            @else

                                                <option value="{{$administrativo['administrativo']['id']}}">{{$administrativo['administrativo']['nombres']}} {{$administrativo['administrativo']['apellidos']}}</option>

                                            @endif
                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group input-group input-group-lg">
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
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Guardar
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