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
            <h1 style="text-align: center;">Buscador de Trabajos de Grado</h1>                 
            <form action="/search" method="GET">                
                <div class="form-group input-group">
                    <input type="checkbox" id="filtrar" name="filtrar" value="1" onclick="filtrado();"> Utilizar Búsqueda Avanzada                    
                </div>
                <div class="form-group" id="sencillo" name="sencillo">
                    <label>Escribe el título del proyecto</label>
                    <input class="form-control" id="titulo" name="titulo" placeholder="Título del proyecto o parte del título">
                </div>                
                <div id="filtros" style="display: none;">
                    <p>Seleccione cada uno de los elementos por los cuales desea filtrar la búsqueda.</p>                    
                    <div class="form-group input-group">                    
                        <span class="input-group-addon">Facultad</span>
                        <select id="facultad" name="facultad" onchange="facul();" class="form-control">
                            <option value="0">---</option>
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
                        <select id="programa" name="programa" class="form-control" style="display: none;">
                            <option value="0">---</option>                            
                        </select>
                    </div>
                    <div class="form-group input-group">                    
                        <span class="input-group-addon">Área Institucional</span>
                        <select id="area" name="area" class="form-control" onchange="arlin();" style="display: none;">
                            <option value="0" selected>---</option>          
                        </select>
                    </div>
                    <div class="form-group input-group">                    
                        <span class="input-group-addon">Línea de Investigación</span>
                        <select id="linea" name="linea" class="form-control" style="display: none;">
                            <option value="0">---</option>
                        </select>
                    </div>
                    @if(session()->has('user'))
                    <div class="form-group input-group">
                        <span class="input-group-addon">Director del Proyecto</span>
                        <select id="profesor" name="profesor" class="form-control">
                            <option value="0">---</option>
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
                            <option value="0">---</option>                                                        
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
                            <option value="0">---</option>

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

                            <option value="{{$i}}">{{$i}}</option>

                            @endfor
                            <option value="0" selected>---</option>
                        </select>
                        <span class="input-group-addon">Período</span>
                        <select id="semestre" name="semestre" class="form-control">
                            <option value="0">---</option>
                            <option value="a">Semestre A</option>
                            <option value="b">Semestre B</option>                        
                        </select>
                    </div> 
                </div>               

                <p style="text-align: center;"><a href="#" onclick="$(this).closest('form').submit()" class="btn btn-primary btn-lg"><i class="fa fa-search"></i> Buscar Tesis</a></p>
            </form>
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

    <script type="text/javascript">
        function filtrado() {     
            if (document.getElementById('filtrar').checked == true) {
                $('#filtros').css('display','block');
                $('#sencillo').css('display','none');
                document.getElementById('titulo').value="";
            }
            else {
                $('#filtros').css('display','none');
                $('#sencillo').css('display','block');
            }             
        } 

        function facul(){   
            var sel = document.getElementById('programa');
            var length = sel.options.length;
            for (i = 0; i < length; i++) {
              sel.remove(sel.selectedIndex);
          }
          var sel5 = document.getElementById('area');
          var length2 = sel5.options.length;
          for (i = 0; i < length2; i++) {
              sel5.remove(sel5.selectedIndex);
          }

          var option2 = document.createElement('option');
          option2.innerHTML = "---";
          option2.value = 0;
          option2.selected = true;
          sel.appendChild(option2);
          var option6 = document.createElement('option');
          option6.innerHTML = "---";
          option6.value = 0;
          option6.selected = true;
          sel5.appendChild(option6);
          var f = document.getElementById('facultad').value;
          if (f != 0 ) {
            document.getElementById('programa').style.display="block";
            document.getElementById('area').style.display="block";            
            @foreach($programas as $id => $programa)
            if ({{$programa['facultad']}} == f) {
                var option = document.createElement('option');
                option.innerHTML = "{{$programa['programa']}}";
                option.value = {{$id}};
                sel.appendChild(option);
            }                
            @endforeach

            @foreach ($areas as $area)
            if ({{$area->cod_facu_ryca}} == f) {
                var option5 = document.createElement('option');
                option5.innerHTML = "{{$area->area}}";
                option5.value = {{$area->id}};
                sel5.appendChild(option5);
            }            
            @endforeach
        }
        else {
            sel.style.display = "none";
            sel5.style.display = "none";                
        }         
    }  

    function arlin(){   
        var sele = document.getElementById('linea');
        var largo = sele.options.length;
        for (j = 0; j < largo; j++) {
          sele.remove(sele.selectedIndex);
      }
      var option4 = document.createElement('option');
      option4.innerHTML = "---";
      option4.value = 0;
      option4.selected = true;
      sele.appendChild(option4);
      var a = document.getElementById('area').value;
      if (a != 0 ) {
        document.getElementById('linea').style.display="block";                
        @foreach($lineas as $linea)
        if ({{$linea->area_id}} == a) {
            var option3 = document.createElement('option');
            option3.innerHTML = "{{$linea->linea}}";
            option3.value = {{$linea->id}};
            sele.appendChild(option3);
        }                
        @endforeach
    }
    else {
        sele.style.display = "none";                
    }
}     
</script>    

</body>
</html>