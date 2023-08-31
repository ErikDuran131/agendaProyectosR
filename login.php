<?PHP
    //iniciamos una sesion
    session_start();

    //vemos si el usuario y contraseña es válido
    require("./calendario/conexion.php");
    $conexion = regresarConexion();

    if (!empty($_POST)) {
        $email = $_POST['correo'];
        $contraseña=$_POST["contraseña"];
        
        $datos = mysqli_query($conexion,"select * from usuario where correo_electronico='$email' and contraseña='$contraseña'");

        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        //echo json_encode($resultado);
        if($resultado){
        foreach($resultado as $fila){
            //echo "Bienvenido $fila[nombre] <br>";
            //echo "Redireccionando...";
            ?>
            <div class="alert alert-success" role="alert">
                Ingresado correctamente, Bienvenido
            </div>
            <?php

            $_SESSION["autentificado"]= "1";
            $_SESSION["email"]= $email;
            $_SESSION["name"]= $fila['nombre'];
            $_SESSION["id"] = $fila['idusuario'];

            if($fila['rol'] == '1'){
                echo '<META HTTP-EQUIV="Refresh"
                CONTENT="2;URL=indexAdministrador.php">';
            }
            else if($fila['rol'] == '2'){
                echo '<META HTTP-EQUIV="Refresh"
                CONTENT="2;URL=indexUsuario.php">';
            }
            

        }
        }else {
        ?>
        <div class="alert alert-danger" role="alert">
            Usuario y/o contasena no Validas
        </div>
            <?php
            echo '<META HTTP-EQUIV="Refresh" CONTENT="20;URL=login.php">';
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="./estilos/estilo.css">
    <!-- Latest compiled and minified CSS -->
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <title>Iniciar Sesión</title>
</head>
<body>
    <header>
        <h2 class="titulo">Balconería "El Porvenir"</h2>
        <input type="checkbox" id="check">
        <label for="check" class="mostrar-menu">
            &#8801
        </label>
        <nav class="menu">
            <a href="./registrous.php">Registrar</a>
            <a href="./login.php">Iniciar Sesión</a>
            <a href="./Nosotros.php">Sobre Nosotros</a>
            <label for="check" class="esconder-menu">
                &#215
            </label>
        </nav>
    </header>
    <br>
    <br>
    <form action="login.php" method="POST">
        <h2 class="Iniciar">Iniciar Sesión</h2>
        <input type="text" name="correo" placeholder="Ingresa tu correo">
        <input type="password" name="contraseña" placeholder="Ingresa tu contraseña">
        <input type="submit" value="ENVIAR" id="boton">
    </form>


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