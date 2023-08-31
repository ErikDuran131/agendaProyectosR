<?php
include ("../seguridad.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Scripts CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/bootstrap-clockpicker.css">
    <link rel="stylesheet" href="fullcalendar/main.css">
    <link rel="stylesheet" href="../estilos/Nosotros.css">

    <!-- Scripts JS -->
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/bootstrap-clockpicker.js"></script>
    <script src="js/moment-with-locales.min.js"></script>
    <script src="fullcalendar/main.js"></script>
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>

</head>
<header>
        <h2 class="titulo">Balconería "El Porvenir"</h2>
        <input type="checkbox" id="check">
        <label for="check" class="mostrar-menu">
            &#8801
        </label>
        <nav class="menu">
            <a href="../registrous.php">Registrar</a>
            <a href="../login.php">Iniciar Sesión</a>
            <a href="../Nosotros.php">Sobre Nosotros</a>
            <label for="check" class="esconder-menu">
                &#215
            </label>
        </nav>
    </header>
<body>
    <div class="container-fluid">
        <section class="content-header">
            <h1>Calendario
                <small>Panel de Control</small>
            </h1>
        </section>

        <div class="row">
            <div class="col-10">
                <div id="Calendario1" style="border: 1px solid #000; padding: 2px;"></div>
            </div>
            <div class="col-2">
                <div id="external-events" style="margin-bottom: 1em; height: 350px; border: 1px solid #000; overflow: auto; padding: 1em;">
                <h4 class="text-center">Eventos Predefinidos</h4>
                <div id="listaeventospredefinidos">

                <?php

                    require("conexion.php");
                    $conexion = regresarConexion();

                    $datos = mysqli_query($conexion, "SELECT * FROM eventospredefinidos");
                    $ep = mysqli_fetch_all($datos, MYSQLI_ASSOC);

                    foreach($ep as $fila){
                        echo "<div class='fc-event' data-titulo='$fila[titulo]' data-horafin='$fila[titulo]' data-horainicio='$fila[horainicio]' data-colorfondo='$fila[colorfondo]' data-colortexto='$fila[colortexto]'";
                        echo "style='border-color:$fila[colorfondo];color:$fila[colortexto];background-color:$fila[colorfondo];margin:10px'>";
                        echo "   $fila[titulo][" . substr($fila['horainicio'],0,5) . " a " . substr($fila['horafin'],0,5) . "]</div>";
                    }

                ?>

                </div>
            </div>
            <hr>
            <div style="text-align: center;">
                <button type="button" id="BotonEventosPredefinidos" name="button" class="btn btn-success">
                    Aministrar Eventos Predefinidos
                </button>
            </div>
            </div>
        </div>
    </div>



    <!-- Formulario de Eventos -->
    <div class="modal fade" id="FormularioEventos" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="Id">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Titulo del Evento:</label>
                            <input type="text" id="Titulo" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="">Fecha de Inicio:</label>
                            <div class="input-group" data-autoclose="true">
                                <input type="date" id="FechaInicio" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group col-md-6" id="TituloHoraInicio">
                            <label for="">Hora de Inicio:</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="button" id="HoraInicio" class="form-control" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="">Fecha de Fin:</label>
                            <div class="input-group" data-autoclose="true">
                                <input type="date" id="FechaFin" class="form-control" value="" >
                            </div>
                        </div>

                        <div class="form-group col-md-6" id="TituloHoraFin">
                            <label for="">Hora de Fin:</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="button" id="HoraFin" class="form-control" autocomplete="off" >
                            </div>
                        </div>

                    </div>

                    <div class="form-row">

                        <label for="">Descripcion:</label>
                        <textarea  id="Descripcion" class="form-control" rows="3"></textarea>

                    </div>

                    <div class="form-row">

                        <label for="">Color de Fondo:</label>
                        <input type="color" value="#3788D8" id="ColorFondo" class="form-control" style="height: 36px;">

                    </div>

                    <div class="form-row">

                        <label for="">Color de Texto:</label>
                        <input type="color" value="#ffffff" id="ColorTexto" class="form-control" style="height: 36px;">

                    </div>

                    <div class="modal-footer">
                        <button type="button" id="BotonAgregar" class="btn btn-success">Agregar</button>
                        <button type="button" id="BotonModificar" class="btn btn-success">Modificar</button>
                        <button type="button" id="BotonBorrar" class="btn btn-success">Borrar</button>
                        <button type="button"  class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>

        $('.clockpicker').clockpicker();

        let calendario1 = new FullCalendar.Calendar(document.getElementById('Calendario1'),{
            events: 'datoseventos.php?accion=listar',
            dateClick: function(info){
                limpiarFormulario();
                $('#BotonAgregar').show();
                $('#BotonModificar').hide();
                $('#BotonBorrar').hide();

                if(info.allDay){
                    $('#FechaInicio').val(info.dateStr);
                    $('#FechaFin').val(info.dateStr);
                }else{
                    let fechaHora = info.dateStr.split("T");
                    $('#FechaInicio').val(fechaHora[0]);
                    $('#FechaFin').val(fechaHora[0]);
                    $('#HoraInicio').val(fechaHora[1].substring(0,5));
                }

                $("#FormularioEventos").modal('show');
            },
            eventClick: function(info){
                $('#BotonAgregar').hide();
                $('#BotonModificar').show();
                $('#BotonBorrar').show();

                $('#Id').val(info.event.id);
                $('#Titulo').val(info.event.title);
                $('#Descripcion').val(info.event.extendedProps.descripcion);
                $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
                $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
                $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
                $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
                $('#ColorFondo').val(info.event.backgroundColor);
                $('#ColorTexto').val(info.event.textColor);

                $("#FormularioEventos").modal('show');
            }
        });

        calendario1.render();

        //Eventos botones de la aplicacion
        $('#BotonAgregar').click(function(){
            let registro = recuperarDatosFormulario();
            agregarRegistro(registro);
            $('#FormularioEventos').modal('hide');
        });

        $('#BotonModificar').click(function(){
            let registro = recuperarDatosFormulario();
            modificarRegistro(registro);
            $('#FormularioEventos').modal('hide');
        });

        $('#BotonBorrar').click(function(){
            let registro = recuperarDatosFormulario();
            borrarRegistro(registro);
            $('#FormularioEventos').modal('hide');
        })

        //Funciones de Comunicion Servidor AJAX
        function agregarRegistro(registro){
            $.ajax({
                type: 'POST',
                url: 'datoseventos.php?accion=agregar',
                data: registro,
                succes: function(msg){
                    calendario1.refetchEvents();
                },
                error: function(error){
                    alert("Hubo un error al agregar el evento" + error);
                }
            });
        }

        function modificarRegistro(registro){
            $.ajax({
                type: 'POST',
                url: 'datoseventos.php?accion=modificar',
                data: registro,
                succes: function(msg){
                    calendario1.refetchEvents();
                },
                error: function(error){
                    alert("Hubo un error al modificar el evento" + error);
                }
            });
        }

        function borrarRegistro(registro){
            $.ajax({
                type: 'POST',
                url: 'datoseventos.php?accion=borrar',
                data: registro,
                succes: function(msg){
                    calendario1.refetchEvents();
                },
                error: function(error){
                    alert("Hubo un error al borrar el evento" + error);
                }
            });
        }

        // Funciones de Interaccion Formulario Eventos
        function limpiarFormulario(){
            $('#Id').val('');
            $('#Titulo').val('');
            $('#Descripcion').val('');
            $('#FechaFin').val('');
            $('#FechaInicio').val('');
            $('#HoraInicio').val('');
            $('#HoraFin').val('');
            $('#ColorFondo').val('#3788D8');
            $('#ColorTexto').val('#ffffff');
        }

        function recuperarDatosFormulario(){
            let registro = {
                id: $('#Id').val(),
                titulo: $('#Titulo').val(),
                descripcion: $('#Descripcion').val(),
                inicio: $('#FechaInicio').val() + ' ' + $('#HoraInicio').val(),
                fin: $('#FechaFin').val() + ' ' + $('#HoraFin').val(),
                colorfondo: $('#ColorFondo').val(),
                colortexto: $('#ColorTexto').val()
            }
            return registro;
        }
        
    </script>
    <br>
    <footer>
        <div class="footer-content">
            <h3>Balconeria el Porvenir</h3>
            <ul class="socials">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy; <a href="#">Todos los derechos reservados</a>  </p>
        </div>

    </footer>
</body>
</html>