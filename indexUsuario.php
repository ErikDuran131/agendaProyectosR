<?php
    require("./calendario/conexion.php");
    $conexion = regresarConexion();

    include ("seguridad.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Scripts CSS -->
    <link rel="stylesheet" href="./calendario/css/bootstrap.min.css">
    <link rel="stylesheet" href="./calendario/css/datatables.min.css">
    <link rel="stylesheet" href="./calendario/css/bootstrap-clockpicker.css">
    <link rel="stylesheet" href="./calendario/fullcalendar/main.css">
    <link rel="stylesheet" href="./estilos/Nosotros.css">
    

    <!-- Scripts JS -->
    <script src="./calendario/js/jquery-3.6.4.min.js"></script>
    <script src="./calendario/js/popper.min.js"></script>
    <script src="./calendario/js/bootstrap.min.js"></script>
    <script src="./calendario/js/datatables.min.js"></script>
    <script src="./calendario/js/bootstrap-clockpicker.js"></script>
    <script src="./calendario/js/moment-with-locales.min.js"></script>
    <script src="./calendario/fullcalendar/main.js"></script>
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>

</head>
<body>
    <!-- ----- M E N U   N A V E G A C I O N ----- -->
    <header>
        <h2 class="titulo">Balconería "El Porvenir"</h2>
        <input type="checkbox" id="check">
        <label for="check" class="mostrar-menu">
            &#8801
        </label>
        <nav class="menu">
            <a href="./registrous.php">Registrar</a>
            <a href="./Nosotros.php">Sobre Nosotros</a>
            <a href="./salir.php">Cerrar Sesion</a>
            <label for="check" class="esconder-menu">
                &#215
            </label>
        </nav>
    </header>

    <br>
    
    <!-- ----- C A L E N D A R I O ----- -->
    <div class="container-fluid">

        <section class="content-header">
            <h1>Calendario Usuario</h1>
        </section>

        <br> 

        <!-- ----- C U E R P O   C A L E N D A R I O ----- -->
        <div class="row">

            <div class="col-10">
                <div id="Calendario1" style="border: 1px solid #000; padding: 2px;"></div>
            </div>

            <div class="col-2">
                <div id="external-events" style="margin-bottom: 1em; height: 350px; border: 1px solid #000; overflow: auto; padding: 1em;">
                    <h4 class="text-center">Mis Citas</h4>
                    <div id="listaeventospredefinidos">

                        <?php

                            $datos = mysqli_query($conexion, "SELECT * FROM citas WHERE idusuario = '$_SESSION[id]'");
                            $ep = mysqli_fetch_all($datos, MYSQLI_ASSOC);

                            foreach($ep as $fila){
                                echo "<div class='fc-event' data-nombre_del_proyecto='$fila[nombre_del_proyecto]' data-fecha_del_proyecto='$fila[fecha_del_proyecto]' data-ubicacion='$fila[ubicacion]'";
                                echo "style='";
                                    if($fila['estadocita'] == '1'){
                                        echo "background-color:green;";
                                    }else if($fila['estadocita'] == '0'){
                                        echo "background-color:red;";
                                    }
                                echo "border-color:#000;color:white;margin:10px'>";
                                echo "   $fila[nombre_del_proyecto] --- $fila[fecha_del_proyecto] --- $fila[ubicacion]</div>";
                            }

                        ?>

                </div>
            </div>

            <hr>

            <div style="text-align: center;">
                <button type="button" id="BotonEventosPredefinidos" onclick="abrirFormulario();" name="button" class="btn btn-success">
                    Agregar Cita
                </button>
            </div>
        </div>
    </div>



    <!-- ----- F O R M U L A R I O   C I T A S ----- -->
    <div class="modal fade" id="FormularioEventos" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Registrar Cita</h1>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="Id">
                    <input type="hidden" id="NombreUsuario" value="<?php echo $_SESSION['name'];?>">
                    <input type="hidden" id="IdUsuario" value="<?php echo $_SESSION['id'];?>">
                    <input type="hidden" id="CorreoUsuario" value="<?php echo $_SESSION['email'];?>">
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Nombre del Proyecto:</label>
                            <input type="text" id="NombreProyecto" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Ubicacion del Proyecto:</label>
                            <input type="text" id="UbicacionProyecto" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="">Fecha de la Cita:</label>
                            <div class="input-group" data-autoclose="true">
                                <input type="date" id="FechaCita" class="form-control" value="">
                            </div>
                        </div>

                        <div class="form-group col-md-6" id="TituloHoraInicio">
                            <label for="">Hora de la Cita:</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="button" id="HoraCita" class="form-control" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" id="BotonAgregar" class="btn btn-primary">Agregar</button>
                        <button type="button" id="BotonModificar" class="btn btn-warning">Modificar</button>
                        <button type="button" id="BotonBorrar" class="btn btn-danger">Borrar</button>
                        <button type="button"  class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>

                    </div>

                </div>

            </div>
        </div>
    </div>
    
    <!-- ----- I N T E R A C C I O N   C A L E N D A R I O ----- -->
    <script>

        $('.clockpicker').clockpicker();

        let calendario1 = new FullCalendar.Calendar(document.getElementById('Calendario1'),{
            events: './calendario/datoseventos.php?accion=listar',
            dateClick: function(info){
                limpiarFormulario();
                $('#BotonAgregar').show();
                $('#BotonModificar').hide();
                $('#BotonBorrar').hide();

                if(info.allDay){
                    $('#FechaCita').val(info.dateStr);
                }else{
                    let fechaHora = info.dateStr.split("T");
                    $('#FechaCita').val(fechaHora[0]);
                    $('#HoraCita').val(fechaHora[1].substring(0,5));
                }

                $("#FormularioEventos").modal('show');
            },
            eventClick: function(info){
                $('#BotonAgregar').hide();
                $('#BotonModificar').show();
                $('#BotonBorrar').show();

                $('#Id').val(info.event.id);
                $('#NombreProyecto').val(info.event.title);
                $('#FechaCita').val(moment(info.event.start).format("YYYY-MM-DD"));
                $('#HoraCita').val(moment(info.event.start).format("HH:mm"));
                $('#UbicacionProyecto').val(info.event.extendedProps.ubication);

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
            
            if($('#HoraCita').val() >= "08:30" && $('#HoraCita').val() <= "19:00")
            {   
                    $.ajax({
                    type: 'POST',
                    url: './calendario/datoseventos.php?accion=agregarcita',
                    data: registro,
                    succes: function(msg){
                        calendario1.refetchEvents();
                    },
                    error: function(error){
                        alert("Hubo un error al agregar el evento" + error);
                    }
                    });
                
            }else{
                alert("Horario no disponible");
            }
            
        }

        function modificarRegistro(registro){
            $.ajax({
                type: 'POST',
                url: './calendario/datoseventos.php?accion=modificarcita',
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
                url: './calendario/datoseventos.php?accion=borrar',
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

            $('#NombreProyecto').val('');
            $('#UbicacionProyecto').val('');
            $('#FechaCita').val('');
            $('#HoraCita').val('');
        }

        function recuperarDatosFormulario(){
            let registro = {
                id: $('#Id').val(),
                idusuario: $('#IdUsuario').val(),
                nombreusuario: $('#NombreUsuario').val(),
                correousuario: $('#CorreoUsuario').val(),
                nombreproyecto: $('#NombreProyecto').val(),
                ubicacionproyecto: $('#UbicacionProyecto').val(),
                fechayhora: $('#FechaCita').val() + ' ' + $('#HoraCita').val(),
            }
            return registro;
        }

        function abrirFormulario(){
            limpiarFormulario();
            $('#BotonAgregar').show();
            $('#BotonModificar').hide();
            $('#BotonBorrar').hide();

            $("#FormularioEventos").modal('show');
        }
        
    </script>

    <br>
    
    <!-- ----- F O O T E R   P A G I N A ----- -->
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