<!doctype html>
<html lang="en">

<head>
    <title>agenda</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/datatables.min.css" >
    <link rel="stylesheet" href="css/bootstrap-clockpicker.css" >
    <link rel="stylesheet" href="fullcalendar/main.css" >

    <!-- full calendar -->   
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/bootstrap-clockpicker.js"></script>
    <script src="js/moment-with-locales.min.js"></script>
    <script src="fullCalendar/main.js"></script>
    <script src="fullCalendar/locales-all.min.js"></script>

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>

        <div class="container-fluid">
          <section class="content-header">
            <h1>
              calendario
              <small>panel de control</small>
            </h1>
          </section>
        </div>

        <div class="row">
          <div class="col-10">
            <!-- <div class="container"> -->
              <!-- <div class="col-md-11 offset-md-2"> -->
                <div id='calendar'></div>
              <!-- </div> -->
            <!-- </div> -->
          </div>
          <div class="col-2">
            <div id="external-events" style="margin-bottom:1em; height:350px; border:1px solid #000; overflow:auto; padding:1em">
              <h4 class="text-center">eventos predefinidos</h4>
              <div id="listaEventosPredefinidos">

              <?php
                require_once('connDB.php');
                $conexion = regresarConexion();
                $consulta = "select id,titulo,horaInicio,horaFin,colorTexto,colorFondo from eventospredefinidos";
                $datos = mysqli_query($conexion,$consulta);
                $ep = mysqli_fetch_all($datos, MYSQLI_ASSOC);
                foreach($ep as $fila){
                  echo"<div class='fc-event' data-titulo='$fila[titulo]' data-horaInicio='$fila[horaInicio]' data-horaFin='$fila[horaFin]' data-colorFondo='$fila[colorFondo]' data-colorTexto='$fila[colorTexto]'
                  style='border-color:$fila[colorFondo]; color:$fila[colorTexto]; background-color:$fila[colorFondo]; margin:10px'>
                    $fila[titulo] [" . substr($fila['horaInicio'],0,5) . " a " .substr($fila['horaFin'],0,5) . "]</div>";
                }
              ?>



              </div>
            </div>
            <hr>
            <div class="" style="text-align:center">
              <button type="button" id="botonEventosPredefinidos" class="btn btn-success">
                administrar eventos predefinidos
              </button>
            </div>
          </div>
        </div>


      <!-- definicion del calendario -->
        <div class="container">
            <div class="col-md-11 offset-md-2">
                <div id='calendar'></div>
            </div>
        </div>
      
      <!-- formulario de eventos -->
        <div class="modal fade" id="formularioEventos" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- cabecera -->
              <div class="modal-header">

                <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                  <span aria-hidden="true">x</span>
                </button>

              </div>
              <!-- cuerpo -->
              <div class="modal-body">
                <input type="hidden" id="id">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="">titulo del evento</label>
                    <input type="text" id="titulo" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="form-row">
                  <!-- fecha inicio -->
                  <div class="form-group col-md-6">
                    <label for="">fecha de inicio:</label>
                    <div class="input-group" data-autoclose="true">
                      <input type="date" id="fechaInicio" class="form-control" value="">
                    </div>
                  </div>
                  <!-- hora inicio -->
                  <div class="form-group col-md-6" id="tituloHoraInicio">
                    <label for="">hora de inicio</label>
                    <div class="input-group clockpicker" data-autoclose="true">
                      <input type="text" id="horaInicio" class="form-control" autocomplete="off">
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <!-- fecha fin -->
                  <div class="form-group col-md-6">
                    <label for="">fecha de fin:</label>
                    <div class="input-group" data-autoclose="true">
                      <input type="date" id="fechaFin" class="form-control" value="">
                    </div>
                  </div>
                  <!-- hora fin -->
                  <div class="form-group col-md-6" id="tituloHoraFin">
                    <label for="">hora de fin</label>
                    <div class="input-group clockpicker" data-autoclose="true">
                      <input type="text" id="horaFin" class="form-control" autocomplete="off">
                    </div>
                  </div>
                </div>
                <!-- descripcion -->
                <div class="form-row">
                  <label for="">descripcion</label>
                  <textarea id="descripcion" class="form-control" rows="3"></textarea>
                </div>
                <!-- color de fondo -->
                <div class="form-row">
                  <label for="">color fondo</label>
                  <input type="color" value="#3788D8" id="colorFondo" class="form-control" style="height:36px;">
                </div>
                <!-- color de texto -->
                <div class="form-row">
                  <label for="">color texto</label>
                  <input type="color" value="#FFFFFF" id="colorTexto" class="form-control" style="height:36px;">
                </div>

              </div>

              <div class="modal-footer">
                <button type="button" id="botonAgregar" class="btn btn-success">agregar</button>
                <button type="button" id="botonModificar" class="btn btn-success">modificar</button>
                <button type="button" id="botonBorrar" class="btn btn-success">borrar</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">cancelar</button>
              </div>

            </div>
          </div>
        </div>




    </main>
    <footer>
   


    </footer>
    <!-- Bootstrap JavaScript Libraries -->


    <script>

      // //activamos el clockpicker
      $('.clockpicker').clockpicker();

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {

          events: 'datosEventos.php?accion=listar',
          dateClick: function(info){ //detecta click en la casilla del calendario
            // recuperamos la informacion del dia que seleccionamos
            // alert(info.dateStr); 
            limpiarFormulario();
            // $('#botonAgregar').show();
            // $('#botonModificar').hide();
            // $('#botonBorrar').hide();

            //detectar click en un evento o en cualquier parte del dia
            if (info.allDay) {
              $('#fechaInicio').val(info.dateStr);  //inserta la fecha que se selecciona en el click
              $('#fechaFin').val(info.dateStr);
            } else {
              let fechaHora = info.dateStr.split("T");
              $('#fechaInicio').val(fechaHora[0]);
              $('#fechaFin').val(fechaHora[0]);
              $('#horaInicio').val(fechaHora[1].substring(0,5));
              $('#horaFin').val(fechaHora[1].substring(0,5));
            }

            $('#formularioEventos').modal('show');

          },
          // se ejecuta cuando hacemos click en un evento existente
          eventClick: function(info){
            //seteamos botones a mostrar
            $('#botonAgregar').hide();
            $('#botonModificar').show();
            $('#botonBorrar').show();
            
            //recuperamos informacion
            $("#id").val(info.event.id);
            $("#titulo").val(info.event.title);
            //las fechas/horas las recuperamos directamente desde el calendario, no de la DB
            $("#fechaInicio").val(moment(info.event.start).format("YYYY-MM-DD"));
            //el formato para los minutos debe ser minuscula (mm)
            $("#horaInicio").val(moment(info.event.start).format("HH:mm"));
            //las fechas las recuperamos directamente desde el calendario, no de la DB
            $("#fechaFin").val(moment(info.event.end).format("YYYY-MM-DD"));
            //el formato para los minutos debe ser minuscula (mm)
            $("#horaFin").val(moment(info.event.end).format("HH:mm"));
            //extendedProps (porque tiene mas de 1 linea)
            $("#descripcion").val(info.event.extendedProps.description);  
            $("#colorFondo").val(info.event.backgroundColor);
            $("#colorTexto").val(info.event.textColor);




            $('#formularioEventos').modal('show');
          },

          initialView: 'dayGridMonth',
          locale:"es",
          headerToolbar:{
            left:'prev,next today',
            center:'title',
            right:'dayGridMonth,timeGridWeek,timeGridDay'
          }
        });
        calendar.render();

        //eventos de botones de la aplicacion
        // control del evento click sobre el boton AGREGAR
        $('#botonAgregar').click(function(){
          let registro = recuperarDatosFormulario();
          agregarRegistro(registro);
          $('#formularioEventos').modal('hide');
        });

        $('#botonModificar').click(function(){
          //recuperamos los datos del formulario que previamente los levanto del calendario
          let registro = recuperarDatosFormulario();
          modificarRegistro(registro);
          $('#formularioEventos').modal('hide');
        })

        $("#botonBorrar").click(function(){
          //recuperamos los datos del formulario que previamente los levanto del calendario
          let registro = recuperarDatosFormulario();
          borrarRegistro(registro);
          $('#formularioEventos').modal('hide');
        })

        //funcion ajax para dar de alta el registro
        function agregarRegistro(registro) {
          $.ajax({
            type: 'POST',
            url: 'datosEventos.php?accion=agregar',
            data: registro,
            success: function(msg){
              calendar.refetchEvents(); //si se ejecuto el alta, recarga el calendario
            },
            error: function(error){
              alert('se produjo un error al agregar el evento :' + error);
            }
          })
        }

        //funcion ajax para modificar el registro
        function modificarRegistro(registro){
          $.ajax({
            type: 'POST',
            url: 'datosEventos.php?accion=modificar',
            data: registro,
            success: function(msg){
              calendar.refetchEvents(); //si se ejecuto el alta, recarga el calendario
            },
            error: function(error){
              alert('se produjo un error al modificar el evento :' + error);
            }
          })
        }

        //funcion ajax para borrar el registro
        function borrarRegistro(registro){
          $.ajax({
            type: 'POST',
            url: 'datosEventos.php?accion=borrar',
            data: registro,
            success: function(msg){
              calendar.refetchEvents(); //si se ejecuto el alta, recarga el calendario
            },
            error: function(error){
              alert('se produjo un error al borrar el evento :' + error);
            }
          })         
        }


        //funciones que interactuan con el formulario de eventos
        function limpiarFormulario(){
          $('#id').val('');
          $('#titulo').val('');
          $('#descripcion').val('');
          $('#fechaInicio').val('');
          $('#fechaFin').val('');
          $('#horaInicio').val('');
          $('#horaFin').val('');
          $('#colorFondo').val('#3788D8'); 
          $('#colorTexto').val('#FFFFFF'); 
          $('#botonAgregar').show();
          $('#botonModificar').hide();
          $('#botonBorrar').hide();
        }

        function recuperarDatosFormulario(){
          let registro = {
            id: $('#id').val(),
            titulo: $('#titulo').val(),
            descripcion: $('#descripcion').val(),
            inicio: $('#fechaInicio').val() + ' ' + $('#horaInicio').val(),
            fin: $('#fechaFin').val() + ' ' + $('#horaFin').val(),
            colorFondo: $('#colorFondo').val(),
            colorTexto: $('#colorTexto').val()
          }
          return registro;
        }

      });


    </script>




</body>

</html>