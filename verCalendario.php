<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

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

    <!-- definicion del calendario -->
    <div class="container">
        <!-- <div class="col-md-11 offset-md-2"> -->
        <div class="col-md-12">
            <div id='calendar'></div>
        </div>
    </div>

    <script>

        var value = getParameterByName('p');
        var consultaListado = 'datosEventos.php?accion=listar&p=' + value

        var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: consultaListado,
                initialView: 'dayGridMonth',
                locale:"es",
                headerToolbar:{
                left:'prev,next today',
                center:'title',
                right:'dayGridMonth,timeGridWeek,timeGridDay'
                },
                dateClick: function(info){ //detecta click en la casilla del calendario
                    // recuperamos la informacion del dia que seleccionamos
                    limpiarFormulario();
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
                    $("#titulo").val(info.event.titulo);
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
                    //mostramos el formulario
                    $('#formularioEventos').modal('show');
                }
            });
            calendar.render();

            // funcion para obtener el parametro desde la URl con javascript
            function getParameterByName(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }


    </script>

</body>
</html>