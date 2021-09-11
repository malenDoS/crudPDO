<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CRUD</title>
<link rel="stylesheet" type="text/css" href="hoja.css">


</head>

<body>
<!--Agrego el archivo de conexión a la base de datos-->
<?php
include("conexion.php");
//Creo un if para saber si el usuario ha pulsado el botón de insertar.
if(isset($_POST["cr"])){
    //Guardo en variables la información introducida por el usuario.
    $nombreDelUsuario=htmlentities(addslashes($_POST["Nom"]));
    $apellidoDelUsuario=htmlentities(addslashes($_POST["Ape"]));
    $nombreCalleUsuario=htmlentities(addslashes($_POST["Dir"]));
    //Guardo en una variable la consulta con marcadores.
    $consultaSql="INSERT INTO datosusuarios(nombre, apellido, direccion) VALUES(:nombU, :apellU, :calleUsuario);";
    //Preparo la consulta.
    $resultado=$base->prepare($consultaSql);
    //Vinculo las variables con los marcadores.
    $resultado->execute(array(":nombU"=>$nombreDelUsuario,":apellU"=>$apellidoDelUsuario,":calleUsuario"=>$nombreCalleUsuario));
}
/*Creo una variable para guardar el result set de la consulta de todos
 * los registros de la tabla.
 */
$conexion=$base->query("SELECT * FROM datosusuarios");
//Obtengo los resutados del pdo statement devolviendo un array de objetos.
$registros=$conexion->fetchAll(PDO::FETCH_OBJ);
?>

<h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>
<!--Incluyo la tabla en una etiqueta form para poder enviar la información
con el método post redirigiendo a la misma página cuando el usuario
quiere insertar un registro en la base de datos-->
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
  <table width="50%" border="0" align="center">
    <tr >
      <td class="primera_fila">Id</td>
      <td class="primera_fila">Nombre</td>
      <td class="primera_fila">Apellido</td>
      <td class="primera_fila">Dirección</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
    </tr> 
   <!--Uso un bucle para imprimir filas según los registros de la base
   de datos, cambio {} por : y después endforeach.
   Utilizo el bucle foreach para imprimir los datos de los usuarios de
   la base de datos, utilizando el array de objetos, con los nombres de
   las columnas como propiedades.-->
    <?php foreach($registros as $persona):?>
   	<tr>
      <td><?php echo $persona->id ?> </td>
      <td><?php echo $persona->nombre ?></td>
      <td><?php echo $persona->apellido ?></td>
      <td><?php echo $persona->direccion ?></td>
 <!--Uso los botones como link para dirigir a la página de borrar registros
 y utilizar la url para pasar la id de los registros que hay que borrar-->
 <td class="bot"><a href="borrar.php?id= <?php echo $persona->id ?>" ><input type='button' name='del' id='del' value='Borrar'></a></td>
 <td class='bot'><a href="editar.php?nombre=<?php echo $persona->nombre ?> & apellido=<?php echo $persona->apellido ?> & direccion=<?php echo $persona->direccion ?> & id=<?php echo $persona->id ?>"><input type='button' name='up' id='up' value='Actualizar'></a></td>
    </tr>     <!--Escribo una etiqueta a para redirigir a la página editar,
              para actualizar los datos, paso por la url los datos que quiero
              modificar.-->
    <?php endforeach?>
	<tr>
	<td></td>
      <td><input type='text' name='Nom' size='10' class='centrado'></td>
      <td><input type='text' name='Ape' size='10' class='centrado'></td>
      <td><input type='text' name=' Dir' size='10' class='centrado'></td>
      <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td></tr>    
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>