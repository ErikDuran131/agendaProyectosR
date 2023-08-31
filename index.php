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
<div class="container-fluid">
        <section class="content-header">
            <h1>Calendario
                <small></small>
            </h1>
        </section>
        <br> 
        <div class="row">
            <div class="col-10">
                <div id="Calendario1" style="border: 1px solid #000; padding: 2px;"></div>
            </div>
            <div class="col-2">
                <div id="external-events" style="margin-bottom: 1em; height: 350px; border: 1px solid #000; overflow: auto; padding: 1em;">
                <h4 class="text-center">Mis citas</h4>
                <div id="listaeventospredefinidos">

                </div>
            </div>
            <hr>
            <div style="text-align: center;">
                <form action="registrous.php">    
                    <button type="submit" id="BotonEventosPredefinidos" name="button" class="btn btn-success">
                        Agenda tu cita   
                    </button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <script>

        let calendario1 = new FullCalendar.Calendar(document.getElementById('Calendario1'),{
            events: './calendario/datoseventos.php?accion=listar'
        });
        calendario1.render();

        
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