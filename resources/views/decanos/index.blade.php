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
                        <div class="panel-heading"><b>Decanos</b></div>
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
                            <table class='table table-responsive'>
                                <thead>
                                    <tr>
                                        <th>Funcionario</th>
                                        <th>Facultad</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($decanos as $decano)
                                        
                                        <tr>
                                            <td data-title='Funcionario'>{{$administrativos[$decano['cod_user_ryca']]['nombre']}}</td>
                                            <td data-title='Facultad'>{{$decano['cod_facu_ryca']}}</td>
                                                <td>
                                                        <input name='_method' type='hidden' value='DELETE'>
                                                        <input name='_token' type='hidden' value='{{csrf_token()}}'>
                                                        <button type='submit' class="btn btn-danger">
                                                            Eliminar Mascota
                                                        </button>
                                                    </form>
                                                </td>
                                        </tr>

                                    @endforeach
                                </tbody>

                            </table>
                            
                        </section>
                    @else

                        <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran mascotas en el sistema.</p>

                    @endif

                    
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


                                