<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos/Nosotros.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-
    BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">
    <!--Iconos-->
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Red+Hat+Text:400,500,700&display=swap" rel="stylesheet">
    <title>Sobre Nosotros</title>
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
<main>
    <!-- Acerca de nosotros -->
    <section class="acerca-de">
    <div class="info-container">
      <h1>Acerca de Nosotros</h1>
      <p>Aqui en la balconeria "El porvenir" fabricamos todo tipo de trabajos que van desde puertas, ventanas, barandales, escaleras, a su vez realizamos trabajos como fabricacion e instalacion de tejabanes y vigetas</p>
      <br>
      <b>ESTAMOS EN LA SIGUIENTE DIRECCION:</b>
      <b>"El porvenir"</b>
      <br>
      <p>PUEDES CONTACTARNOS AL SIGUIENTE NUMERO DE TELEFONO:</p>
      <p>346-100-98-85</p>
      <div class="about-gallery">
        <img src="Img/nosotros/n1.jpg" alt="">  
        <img src="Img/nosotros/n3.jpg" alt="">
        <img src="Img/nosotros/n2.jpg" alt="">

      </div>
    </section>

   <!-- Nuestros proyectos -->
   <section class="our-projects">
      <div class="skew-arriba"></div>
   <div class="deg-background"></div>
   
   <div class="ejeZproject">
      <div class="container-project">
        <div class="project-title">
          <h2>Nuestros Trabajos</h2>
        </div>
          <div class="project-img">
            <img src="Img/nosotros/p1.jpg" alt="">
            <img src="Img/nosotros/p2.jpg" alt="">
            <img src="Img/nosotros/p3.jpg" alt="">
            <img src="Img/nosotros/p4.jpg" alt="">
            <img src="Img/nosotros/ventana.jpg" alt="">
         </div>
   <div class="skew-abajo"></div>
   </section>

   <!-- Testimonios -->
   <section class="testimonios">
    <div class="testimonios-title">
    </div>

     <div class="box-testimonio">
      <div class="card-testimonio">
        <div class="card-img"><img src="./Img/nosotros/01.jpeg" alt=""></div>
        <div class="testimonio-text">
        <h4>VIGUETAS</h4>
        <p>Nos especializamos en el diseño, fabricación y montaje de viguetas de alta resistencia y calidad</p>
        </div>
      </div>

      <div class="card-testimonio">
          <div class="card-img"><img src="./Img/nosotros/02.jpeg" alt=""></div>
          <div class="testimonio-text">
          <h4>PUERTAS</h4>
          <p>fabricamos e instalamos puertas de metal para exteriores con gran variedad de diseños</p>
          </div>
        </div>

        <div class="card-testimonio">
            <div class="card-img"><img src="./Img/nosotros/03.jpeg" alt=""></div>
            <div class="testimonio-text">
            <h4>BARANDALES</h4>
            <p>Contamos con una amplia selección de fabricaciones de barandales de fierro forjado</p>
            </div>
          </div>

          <div class="card-testimonio">
              <div class="card-img"><img src="./Img/nosotros/04.jpeg" alt=""></div>
              <div class="testimonio-text">
              <h4>TEJABANES</h4>
              <p>Nos especializamos en el montaje de tejabanes</p>
              </div>
            </div>
     </div>
   </section>

 </main> 
 
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
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>