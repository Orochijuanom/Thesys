<!DOCTYPE html>
<html lang="es">
<head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyectos Thesys - ITFIP</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="{{ '/' }}assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{ '/' }}assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="{{ '/' }}assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="icon" href="{{ '/' }}assets/img/favicon.png" type="image/png" sizes="32x32" />

    <style>        
        #wrapper{
            background-color: #fff;                       
        }        
        .content {                                   
            min-height:100%;
            background-color: #fff;                         
        }
        .title {
            font-size: 96px;
            margin-bottom: 40px;
        } 
        .search{
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
        }
        #footer{
            height: 35px;            
        }
        .celdas{
            text-align:center; 
            vertical-align: middle !important;
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Thesys</a> 
        </div>
        <div style="color: white; padding: 15px 10px 5px 0; float: right; font-size: 16px;">         
            @if (!session()->has('user'))
            <a href="/estudiante/login" class="btn btn-danger square-btn-adjust">Login</a>
            @else
            <a href="{{ session('user.tipo') }}/home" style="text-decoration: underline; color: #fff;" title="Ir al menú de Usuario">{{ session('user.name') }}</a>&nbsp;
            <a href="/logout" class="btn btn-danger square-btn-adjust" title="Cerrar Sesión"><i class="fa fa-sign-out fa-lg"></i></a>
            @endif
        </div>
    </nav>   
    <!-- /. NAV TOP  --> 

    <div class="content" style="padding: 20px">

        <div class="panel panel-primary">
            <div class="panel-heading title-caja">Ficha del Proyecto</div>
            <div class="panel-body">

                <div style="text-align:center">
                    <img src="/assets/img/logo.png" width="150px">
                </div>

                <div class="col-md-12 col-sm-12">
                    <h4 class="titulo-ficha">TÍTULO</h4>
                    <p style="text-transform: uppercase;">{{$tesis->titulo}}</p>
                </div>

                <div class="col-md-6 col-sm-6">
                    <h4 class="titulo-ficha">FACULTAD</h4>
                    <p></p>
                </div>

                <div class="col-md-6 col-sm-6">
                    <h4 class="titulo-ficha">PROGRAMA</h4>
                    <p>{{$programas[$tesis->cod_prog_ryca]}}</p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h4 class="titulo-ficha">ÁREA INSTITUCIONAL</h4>
                    <p></p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h4 class="titulo-ficha">LÍNEA DE INVESTIGACIÓN</h4>
                    <p>{{$tesis->lineas->linea}}</p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h4 class="titulo-ficha">INTEGRANTES</h4>
                    <p>@foreach($tesis->estudiantes as $estudiante)
                                       @inject('buscador', 'App\Classes\Buscador') 
                                        
                                        {{$nombre = $buscador->buscadorEstudiante($estudiante->username)}}
                                        </br>
                                        
                                    @endforeach
                                    </p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h4 class="titulo-ficha">DIRECTOR</h4>
                    <p></p>
                </div>                
                <div class="col-md-6 col-sm-6">
                    <h4 class="titulo-ficha">TIPO</h4>
                    <p>{{$tesis->tipos->tipo}}</p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h4 class="titulo-ficha">ESTADO</h4>
                    <p>{{$tesis->estados->estado}}</p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h4 class="titulo-ficha">AÑO</h4>
                    <p>{{substr($tesis->created_at,0,4)}}</p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h4 class="titulo-ficha">PERÍODO</h4>
                    <p>
                        @if($tesis->semestre == 'a')                                    
                        Semestre A
                        @else                                       
                        Semestre B
                        @endif                    
                    </p>
                </div>
            </div>
            <div class="panel-footer" style="text-align: center;">
                <a href="{{ '/' }}{{$tesis->source}}" class="btn btn-success btn-circle" target="_blank" title="Descargar Proyecto">
                    <i class="fa fa-download fa-3x"></i></a>
                </div>

            </div>

        </div>

        <div id="footer" style="text-align: center;">
            <img src="/assets/img/logow.png"><br />
            Roberto Andrés Díaz Ricardo<br />
            Juan Sebastian Cruz Perdomo<br />       
            Miguel Mauricio Correcha Peña<br />
            Ingeniería de Sistemas - ITFIP 2015
        </div> 

        <!-- JQUERY SCRIPTS -->
        <script src="{{ '/' }}assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="{{ '/' }}assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="{{ '/' }}assets/js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="{{ '/' }}assets/js/custom.js"></script>    

    </body>
    </html>