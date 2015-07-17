@extends('app')

<link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

@section('sidebar')
@parent

<ul class="nav" id="main-menu"> 
    <li>
        <a href="{{ '/' }}decano/areas"><i class="fa fa-university fa-3x"></i>Áreas Institucionales</a>
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
                    <div class="panel-heading title-caja">Reportes</div>
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

                        <div class="form-group">
                            <label>Seleccione el reporte que desea ver</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="r1" onclick="grafica(1);">Total de Proyectos en la Facultad
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="r2" onclick="grafica(2);">Total de Proyectos por Programa
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="r3" onclick="grafica(3);">Total de Proyectos por Linea de Investigación
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="r4" onclick="grafica(4);">Total de Proyectos por Año
                                </label>
                            </div>
                        </div>

                        <div id="graph" name="graph" style="display: none;" class="ct-chart ct-perfect-fourth"></div>

                    </div>

                </div>
            </div> 
        </div>
    </div>
</div>
</div>

<script type="text/javascript">

   function grafica(g){

    $('#graph').css('display','block');

       if (g==1) {

        new Chartist.Bar('.ct-chart', {
          labels: ['Facultad de Ingeniería y Ciencias Agroindustriales'],
          series: [17]
            }, {
          distributeSeries: true,
      });

    }
    else if (g==2) {

        new Chartist.Bar('.ct-chart', {
          labels: ['Sistemas', 'Electrónica', 'Civil'],
          series: [5, 10, 15, 8, 0, 2, 7]
            }, {
          distributeSeries: true,
      });

    }
    else if (g==3) {
       
        new Chartist.Bar('.ct-chart', {
          labels: ['Linea 1', 'Linea 2', 'Linea 3'],
          series: [8, 15, 3]
            }, {
          distributeSeries: true,
      });

    }
    else{
      
        new Chartist.Bar('.ct-chart', {
          labels: ['2014', '2015'],
          series: [15, 8]
            }, {
          distributeSeries: true,
      });

    };    

}

</script>

<!-- /. PAGE INNER  -->

<!-- /. PAGE WRAPPER  -->
@endsection