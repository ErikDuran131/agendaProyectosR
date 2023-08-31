<?php
    require("./calendario/conexion.php");
    $conexion = regresarConexion();
    if(!empty($_POST))
    {
      $nombre = $_POST['nombre'];
      $contraseña = $_POST['password'];
      $estado = $_POST['estado'];
      $telefono = $_POST['telefono'];
      $email = $_POST['email'];
      $respuesta = mysqli_query($conexion, "insert into usuario (nombre,contraseña,estado,telefono,correo_electronico,rol) values('$nombre', '$contraseña', '$estado', '$telefono', '$email', '2')");
      echo "Usuario Registrado!";
      
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-
    BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">
    <!--Iconos-->
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Red+Hat+Text:400,500,700&display=swap" rel="stylesheet">
    <title>Registro Usuario</title>
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


<!--FORMUILARIO-->
<main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <form action="registrous.php" autocomplete="off" class="sign-in-form" method="POST">
              <div class="logo">
                <img src="./Img/Encabezado/Logo.png" alt="easyclass" />
                <h4>Registro de usuario Nuevo</h4>
              </div>

              <div class="heading">
                <h2>Bienvenido</h2>
                <h6>Registrate ahora</h6>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input type="text" name="nombre" id="nombre" minlength="4" class="input-field" autocomplete="off" placeholder="Ingresa tu nombre:" required/>
          
                </div>

                <div class="input-wrap">
                  <input type="password" name="password" id="password"  minlength="4" class="input-field" autocomplete="off" placeholder="Ingresa tu Password:" required/>
                </div>

                <div class="input-wrap">
                  <input type="text" name="domicilio" minlength="4" class="input-field" autocomplete="off" placeholder="Ingresa tu domicilio:" required/>
                </div>

                <div class="input-wrap">
                  <input type="text" name="estado" id="estado" minlength="4" class="input-field" autocomplete="off" placeholder="Ingresa tu estado:" required/>
                </div>

                <div class="input-wrap">
                  <input type="text" name="telefono" id="telefono" minlength="4" class="input-field" autocomplete="off" placeholder="Ingresa tu telefono:" required/>
                </div>

                <div class="input-wrap">
                  <input type="text" name="email" id="email" minlength="4" class="input-field" autocomplete="off" placeholder="Ingresa tu correo electronico:" required/>
                </div>

                <input type="submit" value="REGISTRARSE" class="sign-btn" />
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="./Img/Registrous/usuario.jpg" class="image img-1 show" alt="" />
              <img src="./Img/Registrous/usuario2.jpg" class="image img-2" alt="" />
              <img src="./Img/Registrous/usuario3.jpg" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Comienza registrandote</h2>
                  <h2>Conoce nuestro trabajo</h2>
                  <h2>Haz una reservacion con nosotros</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript file -->

    <script src="app.js"></script>
<!--Pie de Pagina-->
<br>
<footer>
        <div class="footer-content">
          <br>
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
              
</div>
</body>
</html>