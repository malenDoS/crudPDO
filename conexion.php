<?php
//Creo una conexión utilizando la librería PDO.
try{
$base=new PDO("mysql:host=localhost; dbname=usuarios","root","nloeig31416");
//Cambio el charset de la conexión.
$base->exec("SET CHARACTER SET UTF8");
//Cambio los atributos.
$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    echo"No se ha podido realizar la conexión ".$e->getMessage();
}
?>
