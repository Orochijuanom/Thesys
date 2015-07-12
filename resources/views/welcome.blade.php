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
        <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">         
            @if (!session()->has('user'))
            <a href="/admin/login" class="btn btn-danger square-btn-adjust">Login</a>
            @else
            <a href="http://thesys.vivecundinamarca.com/admin/home">{{ session('user.name') }}</a>
            <a href="/logout" class="btn btn-danger square-btn-adjust">Cerrar Sesión</a>
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
                <div class="form-group">
                    <label>Área Institucional</label>
                    <select id="area" name="area" class="form-control">
                        <option>Area 1</option>
                        <option>Area 2</option>
                        <option>Area 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Linea de Investigación</label>
                    <select id="linea" name="linea" class="form-control">
                        <option>Linea 1</option>
                        <option>Linea 2</option>
                        <option>Linea 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Facultad</label>
                    <select id="facultad" name="facultad" class="form-control">
                        <option>Facultad 1</option>
                        <option>Facultad 2</option>
                        <option>Facultad 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Programa</label>
                    <select id="programa" name="programa" class="form-control">
                        <option>Programa 1</option>
                        <option>Programa 2</option>
                        <option>Programa 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Director del Proyecto</label>
                    <select id="director" name="director" class="form-control">
                        <option>Director 1</option>
                        <option>Director 2</option>
                        <option>Director 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tipo de Proyecto</label>
                    <select id="tipo" name="tipo" class="form-control">
                        <option>Tipo 1</option>
                        <option>Tipo 2</option>
                        <option>Tipo 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado de la Tesis</label>
                    <select id="estado" name="estado" class="form-control">
                        <option>Estado 1</option>
                        <option>Estado 2</option>
                        <option>Estado 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Año</label>
                    <select id="anio" name="anio" class="form-control">
                        <option>Año 1</option>
                        <option>Año 2</option>
                        <option>Año 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Período Académico</label>
                    <select id="periodo" name="periodo" class="form-control">
                        <option>Semestre A</option>
                        <option>Semestre B</option>                        
                    </select>
                </div>

                <p style="text-align: center;"><a href="#" onclick="$(this).closest('form').submit()" class="btn btn-primary"><i class="fa fa-search"></i> Buscar Tesis</a></p>
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