<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>
    <!--Incluyo el archivo de conexión para que cuando el usuario vuelve
    a ser redirijido a la misma página al pulsar el botón submit se puedan
    actualizar los datos especificados con el método post.-->
<?php
include("conexion.php");
//Uso un if para saber si se ha pulsado el botón actualizar.
if(!isset($_POST["bot_actualizar"])){
//Guardo en variables la información pasada por la url.
$idU=$_GET["id"];
$nombreU=$_GET["nombre"];
$apellidoU=$_GET["apellido"];
$direccionU=$_GET["direccion"];
}else if(isset($_POST["bot_actualizar"])){
    //Guardo en variables la información introducida por el usuario.
    $nuevoNombre=htmlentities(addslashes($_POST["nom"]));
    $nuevoApellido=htmlentities(addslashes($_POST["ape"]));
    $nuevaCalle=htmlentities(addslashes($_POST["dir"]));
    //Guardo en una variable la consulta con marcadores.
    $consulta="UPDATE datosusuarios SET nombre=:nuenom, apellido=:nueape, direccion=:nuecall WHERE id=:idU";
    //Preparo la consulta.
    $resultado=$base->prepare($consulta);
    //Ejecuto la consulta asociando las variables con los marcadores.
    $resultado->execute(array(":nuenom"=>$nuevoNombre,":nueape"=>$nuevoApellido,":nuecall"=>$nuevaCalle,":idU"=>$_POST["id"]));
    //Redirijo al usuario a la página principal.
    header("location:index.php");
}
?>
<h1>ACTUALIZAR</h1>

<p>
 
</p>
<p>&nbsp;</p>
<!--Redirijo al usuario a la misma página-->
<form name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
  <table width="25%" border="0" align="center">
    <tr>
      <td></td>
      <td><label for="id"></label>
          <!--El tipo hidden permite escribir sin que lo vea el usuario.-->
      <input type="hidden" name="id" id="id" value="<?php echo $idU ?>"></td>
    </tr>
    <tr>
      <td>Nombre</td>
      <td><label for="nom"></label>
      <input type="text" name="nom" id="nom" value="<?php echo $nombreU ?>"></td>
    </tr>
    <tr>
      <td>Apellido</td>
      <td><label for="ape"></label>
      <input type="text" name="ape" id="ape" value="<?php echo $apellidoU ?>"></td>
    </tr>
    <tr>
      <td>Dirección</td>
      <td><label for="dir"></label>
      <input type="text" name="dir" id="dir" value="<?php echo $direccionU ?>"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>