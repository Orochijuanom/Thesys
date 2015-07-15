<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thesys - ITFIP</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="{{ '/' }}assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{ '/' }}assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="{{ '/' }}assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <style>        
        #wrapper{
            background-color: #fff;                       
        }        
        .content {                                   
            min-height:100%;                         
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

    <div class="content">

        <div class="search"> 
            <h1 style="text-align: center;">Buscador de Tesis</h1>
            <p>* Seleccione cada uno de los elementos por los cuales desea filtrar la búsqueda.</p>
            <form action="/search" method="POST">
                <div class="form-group">
                    <label>Escribe el título de la tesis</label>
                    <input class="form-control" placeholder="Título de la Tesis">
                </div>
                <div class="form-group input-group">                    
                    <span class="input-group-addon">Área Institucional</span>
                    <select id="area" name="area" class="form-control">
                        <option>Area 1</option>
                        <option>Area 2</option>
                        <option>Area 3</option>
                    </select>
                </div>
                <div class="form-group input-group">                    
                    <span class="input-group-addon">Línea de Investigación</span>
                    <select id="linea" name="linea" class="form-control">
                        <option>Linea 1</option>
                        <option>Linea 2</option>
                        <option>Linea 3</option>
                    </select>
                </div>
                <div class="form-group input-group">                    
                    <span class="input-group-addon">Facultad</span>
                    <select id="facultad" name="facultad" class="form-control">
                        @foreach ($facultades as $id => $facultad)
                                    
                        @if (old('facultad') == $id)

                        <option value="{{$id}}" selected>{{$facultad}}</option>
                        @else

                        <option value="{{$id}}">{{$facultad}}</option>

                        @endif

                        @endforeach
                    </select>
                </div>
                <div class="form-group input-group">                    
                    <span class="input-group-addon">Programa</span>
                    <select id="programa" name="programa" class="form-control">
                        @foreach ($programas['programas'] as $programa)
                        
                        @if (old('programa') == $programa['programa']['id'])
                        
                        <option value="{{$programa['programa']['id']}}" selected>{{$programa['programa']['programa']}}</option>
                        @else

                        <option value="{{$programa['programa']['id']}}">{{$programa['programa']['programa']}}</option>

                        @endif

                        @endforeach
                    </select>
                </div>
                @if(session()->has('user'))
                <div class="form-group input-group">
                    <span class="input-group-addon">Director del Proyecto</span>
                    <select id="profesor" name="profesor" class="form-control">
                        @foreach ($profesores as $id => $profesor)
                                    
                        @if (old('profesor') == $id)

                        <option value="{{$id}}" selected>{{$profesor}}</option>
                        @else

                        <option value="{{$id}}">{{$profesor}}</option>

                        @endif

                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group input-group">
                    <span class="input-group-addon">Tipo</span>
                    <select id="tipo" name="tipo" class="form-control">
                        @foreach ($tipos as $tipo)
                                    
                        @if (old('tipo') == $tipo->id)

                        <option value="{{$tipo->id}}" selected>{{$tipo->tipo}}</option>
                        @else

                        <option value="{{$tipo->id}}">{{$tipo->tipo }}</option>

                        @endif

                        @endforeach
                    </select>
                    <span class="input-group-addon">Estado</span>
                    <select id="estado" name="estado" class="form-control">
                        @foreach ($estados as $estado)
                                    
                        @if (old('estado') == $estado->id)

                        <option value="{{$estado->id}}" selected>{{$estado->estado}}</option>
                        @else

                        <option value="{{$estado->id}}">{{$estado->estado }}</option>

                        @endif

                        @endforeach
                    </select>
                </div>                
                <div class="form-group input-group">
                    <span class="input-group-addon">Año</span>
                    <select id="anio" name="anio" class="form-control">
                        @for ($i = 1981 ; $i <= date('Y') ; $i++)                              
                       
                        <option value="{{$i}}" selected>{{$i}}</option>
                        
                        @endfor
                    </select>
                    <span class="input-group-addon">Período</span>
                    <select id="periodo" name="periodo" class="form-control">
                        <option value="a">Semestre A</option>
                        <option value="b">Semestre B</option>                        
                    </select>
                </div>                

                <p style="text-align: center;"><a href="#" onclick="$(this).closest('form').submit()" class="btn btn-primary btn-lg"><i class="fa fa-search"></i> Buscar Tesis</a></p>
            </form>
        </div>        

    </div>

    <div id="footer">
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