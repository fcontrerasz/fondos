<?php include("../conexion/conecta.php"); ?>
<?php

function limpiar($s)
{
$s = preg_replace("/[����]/","a",$s);
$s = preg_replace("/[����]/","A",$s);
$s = preg_replace("/[���]/","I",$s);
$s = preg_replace("/[���]/","i",$s);
$s = preg_replace("/[���]/","e",$s);
$s = preg_replace("/[���]/","E",$s);
$s = preg_replace("/[�����]/","o",$s);
$s = preg_replace("/[����]/","O",$s);
$s = preg_replace("/[���]/","u",$s);
$s = preg_replace("/[���]/","U",$s);
$s = str_replace("�","c",$s);
$s = ereg_replace("�","C",$s);
$s = ereg_replace("�","n",$s);
$s = ereg_replace("�","N",$s);
$str = ereg_replace ("�","o", $str );

return $s;
}

session_start();

if(!$_GET){
	echo "-2";
	die;
}

if($_SESSION["idusuario"] == null){
	echo "-3";
}

$usr = $_SESSION["idusuario"];
$nombre = limpiar(utf8_decode($_GET["nu_nombre"]));
$materno = limpiar(utf8_decode($_GET["nu_apellidom"]));
$paterno = limpiar(utf8_decode($_GET["nu_apellidop"]));
$fono = $_GET["nu_fono"];
$rut = $_GET["nu_rut"];
$dv = $_GET["nu_dv"];

$resultado = 0;

$proc = mssql_init("insert_cliente",$cn_licitaciones);
mssql_bind($proc,"@usuario",$usr,SQLVARCHAR,false, false);
mssql_bind($proc,"@rut",$rut,SQLVARCHAR,false, false);
mssql_bind($proc,"@dv",$dv,SQLVARCHAR,false, false);
mssql_bind($proc,"@nombre",$nombre,SQLVARCHAR,false, false);
mssql_bind($proc,"@paterno",$paterno,SQLVARCHAR,false, false);
mssql_bind($proc,"@materno",$materno,SQLVARCHAR,false, false);
mssql_bind($proc,"@fono",$fono,SQLVARCHAR,false, false);
mssql_bind($proc,"@result", $resultado, SQLVARCHAR, true, false, 20);
$data = mssql_execute($proc,true) or die("Fallo");
mssql_free_statement($proc);

echo $resultado;
?>