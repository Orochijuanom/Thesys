@extends('publico')

@section('contenido')

        <div class="search"> 
            <h1 style="text-align: center;">Buscador de Trabajos de Grado</h1>                 
            <form action="/search" method="POST">
                <div class="form-group input-group">
                    <input type="checkbox" id="filtrar" onclick="filtrado();"> Utilizar Búsqueda Avanzada
                </div>
                <div class="form-group">
                    <label>Escribe el título del proyecto</label>
                    <input class="form-control" placeholder="Título del proyecto o parte del título">
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
                        <select id="programa" name="programa" class="form-control" disabled>
                            <option value="0">---</option>                            
                        </select>
                    </div>
                    <div class="form-group input-group">                    
                        <span class="input-group-addon">Área Institucional</span>
                        <select id="area" name="area" class="form-control" onchange="arlin();" disabled>
                            <option value="0" selected>---</option>          
                        </select>
                    </div>
                    <div class="form-group input-group">                    
                        <span class="input-group-addon">Línea de Investigación</span>
                        <select id="linea" name="linea" class="form-control" disabled>
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
                        <select id="periodo" name="periodo" class="form-control">
                            <option value="0">---</option>
                            <option value="a">Semestre A</option>
                            <option value="b">Semestre B</option>                        
                        </select>
                    </div> 
                </div>               

                <p style="text-align: center;"><a href="#" onclick="$(this).closest('form').submit()" class="btn btn-primary btn-lg"><i class="fa fa-search"></i> Buscar Tesis</a></p>
            </form>
        </div>

@endsection        

<script type="text/javascript">
        function filtrado() {     
            if (document.getElementById('filtrar').checked == true) {
                $('#filtros').css('display','block');
            }
            else {
                $('#filtros').css('display','none');
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
            document.getElementById('programa').disabled=false;
            document.getElementById('area').disabled=false;
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
            sel.disabled=true;
            sel5.disabled=true;                 
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
        document.getElementById('linea').disabled=false;        
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
        sele.disabled=true;                
    }
}     
</script>