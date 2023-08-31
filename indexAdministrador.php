<?php
    include ("seguridad.php");
    require("./calendario/conexion.php");
    $conexion = regresarConexion();

    
    if(!empty($_POST))
    {
        $id = $_POST['id'];
        $opcion = $_POST['opcion'];
        if($opcion == 'usuario'){
            $respuesta = mysqli_query($conexion, "delete from usuario where idusuario = '$id'");
        }else if($opcion == 'cita'){
            $respuesta = mysqli_query($conexion, "delete from citas where idcitas = '$id'");
        }else if($opcion =='confirmacion'){
            echo "Cita Confirmada";
            $respuesta = mysqli_query($conexion, "update citas set estadocita = '1' where idcitas ='$id'");
        }else if($opcion =='desconfirmacion'){ 
            $respuesta = mysqli_query($conexion, "update citas set estadocita = '0' where idcitas ='$id'");
        }else{
            echo "Error consulta";
        }     
        
    }
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
    <link rel="stylesheet" href="./estilos/font-awesome.css">
    <link rel="stylesheet" href="./estilos/administrador.css">
    

    <!-- Scripts JS -->
    <script src="./calendario/js/jquery-3.6.4.min.js"></script>
    <script src="./calendario/js/popper.min.js"></script>
    <script src="./calendario/js/bootstrap.min.js"></script>
    <script src="./calendario/js/datatables.min.js"></script>
    <script src="./calendario/js/bootstrap-clockpicker.js"></script>
    <script src="./calendario/js/moment-with-locales.min.js"></script>
    <script src="./calendario/fullcalendar/main.js"></script>
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <script src="./administrador.js"></script>
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
            <a href="./Nosotros.php">Sobre Nosotros</a>
            <a href="./salir.php">Cerrar Sesion</a>
            <label for="check" class="esconder-menu">
                &#215
            </label>
        </nav>
    </header>

    <br>

    <!-- ----- V I S T A S   A D M I N I S T R A D O R ----- -->
    <div class="wrap" style="min-height:60vh;">
        <ul class="tabs">
            <li><a href="#tab1"><span class="fa fa-calendar"></span><span class="tab-text">Calendario</span></a></li>
            <li><a href="#tab2"><span class="fa fa-calendar-check-o"></span><span class="tab-text">Citas</span></a></li>
            <li><a href="#tab3"><span class="fa fa-user"></span><span class="tab-text">Usuarios</span></a></li>
        </ul>
        <div class="secciones">

            <!-- ----- P E S T A Ñ A   C A L E N D A R I O ----- -->
            <article id="tab1">
                <h1>Calendario Administrador</h1>
                <div id="Calendario1" style="border: 1px solid #000; padding: 2px;"></div>
            </article>

            <!-- ----- P E S T A Ñ A   C I T A S ----- -->
            <article id="tab2">
                <h1>Citas Registradas</h1>
                <table class="table table-responsive table striped">
                    <thead>
                        <th>Nombre</th>   
                        <th>Correo Electronico</th> 
                        <th>Fecha del Proyecto</th>
                        <th>Nombre del Proyecto</th>
                        <th>Ubicacion</th>
                        <th>Confirmar</th>
                        <th>Modificar</th>  
                        <th>Eliminar</th> 
                    </thead>
                    <tbody> 
                        <?php 
                            $datos = mysqli_query($conexion, "SELECT * FROM citas");
                            $ep = mysqli_fetch_all($datos, MYSQLI_ASSOC);

                            foreach($ep as $fila){
                                $datos = [
                                    "id" => $fila['idcitas'],
                                    "idU" =>  $fila['idusuario'],
                                    "nombreU" => $fila['nombreUsuario'],
                                    "email" => $fila['correo_electronico'],

                                    "nombreP" => $fila['nombre_del_proyecto'],
                                    "ubicacion" => $fila['ubicacion'],
                                    "fecha" => $fila['fecha_del_proyecto']
                                ];
                                $eDatos = json_encode($datos);
                                
                                echo "<tr>";
                                    echo "<td>$fila[nombreUsuario]</td>";
                                    echo "<td>$fila[correo_electronico]</td>";
                                    echo "<td>$fila[fecha_del_proyecto]</td>";
                                    echo "<td>$fila[nombre_del_proyecto]</td>";
                                    echo "<td>$fila[ubicacion]</td>";
                                    
                                    echo "<td>";
                                        if($fila['estadocita'] == '0'){
                                            echo "<label class='toggle'>";
                                            echo "<input id='estado' class='toggle-checkbox' type='checkbox' onclick='abrirFormulariConfirmacion($eDatos)' >";
                                            echo "<div class='toggle-switch'></div>";
                                            echo "</label>";
                                        }else{
                                            echo "<label class='toggle'>";
                                            echo "<input id='estado' class='toggle-checkbox' type='checkbox' onclick='abrirFormulariDesconfirmacion($eDatos)' checked>";
                                            echo "<div class='toggle-switch'></div>";
                                            echo "</label>";
                                        }
                                        
                                    echo "</td>";

                                    echo "<td><button class='btn btn-warning fa fa-cogs' onclick='abrirFormulario($eDatos)'></button></td>";

                                    echo '<form action="" method="POST">';
                                        echo "<input type='hidden' id='opcion' name='opcion' value='cita'></input>";
                                        echo "<input type='hidden' id='id' name='id' value='$fila[idcitas]'></input>";
                                        echo '<td><button type="submit"  class="fa fa-trash-o btn btn-danger" id="BotonBorrarUsuario"></button></td>';
                                    echo '</form>';
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </article>

            <!-- ----- P E S T A Ñ A   U S U A R I O S ----- -->
            <article id="tab3">
                <h1>Usuarios</h1>
                <table class="table table-responsive table striped">
                    <thead>
                        <th>Nombre</th>
                        <th>Contraseña</th>
                        <th>Estado</th>
                        <th>Telefono</th>
                        <th>Correo Electronico</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                        
                    </thead>
                    <tbody>
                        <?php 
                            $datos = mysqli_query($conexion, "SELECT * FROM usuario");
                            $ep = mysqli_fetch_all($datos, MYSQLI_ASSOC);

                            foreach($ep as $fila){
                                $datos = [
                                    "id" =>  $fila['idusuario'],
                                    "nombre" => $fila['nombre'],
                                    "contraseña" => $fila['contraseña'],
                                    "estado" => $fila['estado'],
                                    "telefono" => $fila['telefono'],
                                    "email" => $fila['correo_electronico']
                                ];
                                $eDatos = json_encode($datos);

                                echo "<tr>";
                                    echo "<td>$fila[nombre]</td>";
                                    echo "<td>$fila[contraseña]</td>";
                                    echo "<td>$fila[estado]</td>";
                                    echo "<td>$fila[telefono]</td>";
                                    echo "<td>$fila[correo_electronico]</td>";
                                    
                                    echo "<td><button type='button' class='btn btn-warning fa fa-cogs' onclick='abrirFormularioUsuario($eDatos)'></button></td>";
                                    
                                    echo '<form action="" method="POST">';
                                        echo "<input type='hidden' id='opcion' name='opcion' value='usuario'></input>";
                                        echo "<input type='hidden' id='id' name='id' value='$fila[idusuario]'></input>";
                                        echo '<td><button type="submit"  class="fa fa-trash-o btn btn-danger" id="BotonBorrarUsuario"></button></td>';
                                    echo '</form>';
                            }
                        ?>
                    </tbody>
                </table>
            </article>


        </div>
    </div>
    

    <!-- ----- F O R M U L A R I O   C I T A S ----- -->
    <div class="modal fade" id="FormularioEventos" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Modificar Cita</h1>
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
                        <button type="button" id="BotonAgregar" class="btn btn-success">Agregar</button>
                        <button type="button" id="BotonModificar" class="btn btn-success">Modificar</button>
                        <button type="button" id="BotonBorrar" class="btn btn-success">Borrar</button>
                        <button type="button"  class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- ----- F O R M U L A R I O   U S U A R I O ----- -->
    <div class="modal fade" id="FormularioUsuarios" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Modificar Usuario</h1>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>

                <div class="modal-body">
                    
                    <input type="hidden" id="IdU">
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Nombre:</label>
                            <input type="text" id="Nombre" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Contraseña:</label>
                            <input type="text" id="Contraseña" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Estado:</label>
                            <input type="text" id="Estado" class="form-control" placeholder="">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Telefono:</label>
                            <input type="text" id="Telefono" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Correo Electronico:</label>
                            <input type="text" id="Email" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="BotonModificarUsuario" class="btn btn-warning">Modificar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
    
    <!-- ----- F O R M U L A R I O   C O N F I R M A C I O N ----- -->
    <div class="modal fade" id="FormularioConfirmacion" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Confirmar Cita</h1>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" id="IdCita" name="id">
                        <input type="hidden" id="opcion" name="opcion" value="confirmacion" >
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">¿Estas seguro de confirmar esta cita?</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="BotonModificarUsuario" class="btn btn-primary">Confirmar Cita</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ----- F O R M U L A R I O   D E S C O N F I R M A C I O N ----- -->
    <div class="modal fade" id="FormularioDesconfirmacion" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Confirmar Cita</h1>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" id="IdCitaD" name="id">
                        <input type="hidden" id="opcion" name="opcion" value="desconfirmacion" >
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">¿Estas seguro de cancelar esta cita?</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="BotonModificarUsuario" class="btn btn-danger">Cancerlar Cita</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

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
                $('#IdUsuario').val(info.event.extendedProps.idU);
                $('#NombreUsuario').val(info.event.nU);
                $('#CorreoUsuario').val(info.event.email);

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
        });

        $('#BotonModificarUsuario').click(function(){
            let registro = recuperarDatosFormularioUsuario();
            modificarUsuario(registro);
            console.log("Datos recuperads", registro);
            $('#FormularioUsuarios').modal('hide');
        });


        //Funciones de Comunicion Servidor AJAX
        function agregarRegistro(registro){
            $.ajax({
                type: 'POST',
                url: './calendario/datoseventos.php?accion=agregar',
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

        function modificarUsuario(registro){
            $.ajax({
                type: 'POST',
                url: './calendario/datoseventos.php?accion=modificarusuario',
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
            $('#IdUsuario').val('');
            $('#NombreUsuario').val('');
            $('#CorreoUsuario').val('');
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

        

        function abrirFormulario(datos){
            limpiarFormulario();
            const id = datos.id;
            const idU = datos.idU;
            const nombreU = datos.nombreU;
            const email = datos.email;
            const nombre = datos.nombreP;
            const ubicacion = datos.ubicacion;
            const fecha = datos.fecha;

            $('#Id').val("" + id);
            $('#IdUsuario').val("" + idU);
            $('#NombreUsuario').val("" + nombreU);
            $('#CorreoUsuario').val("" + email);

            $('#NombreProyecto').val("" + nombre);
            $('#UbicacionProyecto').val("" + ubicacion);
            $('#FechaCita').val(moment("" + fecha).format("YYYY-MM-DD"));
            $('#HoraCita').val(moment("" + fecha).format("HH:mm"));
            
            $('#BotonAgregar').hide();
            $('#BotonModificar').show();
            $('#BotonBorrar').hide();
            
            $('#FormularioEventos').modal('show');
        }

        function limpiarFormularioUsuario(){
            $('#IdU').val('');
            $('#Nombre').val('');
            $('#Contraseña').val('');
            $('#Estado').val('');
            $('#Telefono').val('');
            $('#Email').val('');
        }

        function recuperarDatosFormularioUsuario(){
            let registro = {
                id: $('#IdU').val(),
                nombre: $('#Nombre').val(),
                contraseña: $('#Contraseña').val(),
                estado: $('#Estado').val(),
                telefono: $('#Telefono').val(),
                email: $('#Email').val(),
            }
            return registro;
            
        }

        function abrirFormularioUsuario(datos){
            limpiarFormularioUsuario();
            const id = datos.id;
            const nombre = datos.nombre;
            const contraseña = datos.contraseña;
            const estado = datos.estado;
            const telefono = datos.telefono;
            const email = datos.email;
            
            $('#IdU').val("" + id);
            $('#Nombre').val("" + nombre);
            $('#Contraseña').val("" + contraseña);
            $('#Estado').val("" + estado);
            $('#Telefono').val("" + telefono);
            $('#Email').val("" + email);
            
            $('#BotonModificarUsuario').show();
            
            $('#FormularioUsuarios').modal('show');
        }

        function abrirFormulariConfirmacion(datos){
            const id = datos.id;
            
            $('#IdCita').val("" + id);
            
            $('#FormularioConfirmacion').modal('show');
        }
        function abrirFormulariDesconfirmacion(datos){
            const id = datos.id;
            
            $('#IdCitaD').val("" + id);
            
            $('#FormularioDesconfirmacion').modal('show');
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