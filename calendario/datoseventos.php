<?php

    header('Content-Type: application/json');

    require("conexion.php");

    $conexion = regresarConexion();

    switch($_GET['accion']){
        
        // ----- M O S T R A R   C I T A S -----
        case 'listar':

            $datos = mysqli_query($conexion,"select idcitas as id,
                        nombre_del_proyecto as title,
                        ubicacion as ubication,
                        fecha_del_proyecto as start
                        from citas");
            $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
            echo json_encode($resultado);
            
            break;

        // ----- R E C U P E R A R   C I T A -----
        case 'listarCita':
    
            $datos = mysqli_query($conexion,"select idcitas as id,
                        idusuario as idU,
                        nombreUsuario as nU,
                        correo_electronico as email,
                        nombre_del_proyecto as title,
                        ubicacion as ubication,
                        fecha_del_proyecto as start
                        from citas where idcitas = '$_POST[idCita]");
            $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
            echo json_encode($resultado);

            break;
        
        // ----- A G R E G A R   C I T A -----
        case 'agregarcita':
            
                $respuesta = mysqli_query($conexion, "insert into citas (idusuario,nombreUsuario,correo_electronico, fecha_del_proyecto,nombre_del_proyecto,ubicacion,estadocita) values('$_POST[idusuario]','$_POST[nombreusuario]','$_POST[correousuario]','$_POST[fechayhora]','$_POST[nombreproyecto]','$_POST[ubicacionproyecto]','0')");
                echo json_encode($respuesta);
            

            break;

        // ----- M O D I F I C A R   C I T A -----
        case 'modificarcita':

            $respuesta = mysqli_query($conexion, "update citas set fecha_del_proyecto = '$_POST[fechayhora]',
                                nombre_del_proyecto = '$_POST[nombreproyecto]',
                                ubicacion = '$_POST[ubicacionproyecto]'
                                where idcitas = '$_POST[id]'");
                                echo json_encode($respuesta);
        
            break;
        
        // ----- E L I M I N A R   C I T A -----
        case 'borrar':

            $respuesta = mysqli_query($conexion, "delete from citas where idcitas = '$_POST[id]'");
            echo json_encode($respuesta);

            break;

        // ----- M O D I F I C A R   U S U A R I O -----
        case 'modificarusuario':

            $respuesta = mysqli_query($conexion, "update usuario set nombre = '$_POST[nombre]',
                                contraseña = '$_POST[contraseña]',
                                estado = '$_POST[estado]',
                                telefono = '$_POST[telefono]',
                                correo_electronico = '$_POST[email]'
                                where idusuario = '$_POST[id]'");
                                echo json_encode($respuesta);
        
            break;

    }
?>