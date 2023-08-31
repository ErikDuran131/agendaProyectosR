<?PHP
//Inicio la sesión
session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO AL REVISAR QUE LA VARIABLE TENGA 1
if ($_SESSION["autentificado"] != "1") {
//si no existe, se dirige a la Página de Inicio
header("Location: login.php");
//salimos del script
exit();
}
?>