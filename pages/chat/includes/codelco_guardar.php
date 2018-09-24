<?php include("base.php"); ?>
<?php


$nombre = $_POST["xnombre"];
$rut = $_POST["xrut"];
$mail = $_POST["xemail"];
$fono = $_POST["xfono"];
$opc = $_POST["xopc"];
$tipo = $_POST["xtipo"];
$glosa = "n/a";
$navegador = $_POST["xnavegador"];
$resultado = "1";
/*
mssql_select_db($GLOBALS['basededatos'],$GLOBALS['baseconexion']);
$proc = mssql_init("insertBitacoraCHAT",$GLOBALS['baseconexion']);
mssql_bind($proc,"@nombre",$nombre,SQLVARCHAR,false, false);
mssql_bind($proc,"@rut",$rut,SQLVARCHAR,false, false);
mssql_bind($proc,"@email",$mail,SQLVARCHAR,false, false);
mssql_bind($proc,"@fono",$fono,SQLVARCHAR,false, false);
mssql_bind($proc,"@opcion",$opc,SQLVARCHAR,false, false);
mssql_bind($proc,"@tipo",$tipo,SQLVARCHAR,false, false);
mssql_bind($proc,"@glosa",$glosa,SQLVARCHAR,false, false);
mssql_bind($proc,"@navegador",$navegador,SQLVARCHAR,false, false);
mssql_bind($proc,"@result", $resultado, SQLVARCHAR, true, false, 20);
$data = mssql_execute($proc,true);
mssql_free_statement($proc);
*/
$_SESSION['nombre'] = $nombre;

echo $resultado;
?>