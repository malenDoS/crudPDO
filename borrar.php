<?php
//Incluyo el archivo de la conexión para poder usar la conexión.
include("conexion.php");
//Uso el valor del id que paso utilizando la url.
$idUsuarios=$_GET["id"];
//Ejecuto el query con el id indicado.
$base->query("DELETE FROM datosusuarios WHERE id='$idUsuarios'");
//Redirijo al usuario a la página del login.
header("location:index.php");
?>


