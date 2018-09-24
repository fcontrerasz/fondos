<?php include("../conexion/conecta.php"); ?>
<?php
if(!isset($_SESSION)){
session_start();
}


if(!$_GET){
	echo "-2";
	die;
}

if($_SESSION["idusuario"] == null){
	echo "-3";
	die;
}

if($_SESSION["idusuario"]=="") die("-3");

$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);
$arr = get_defined_vars();

//var_dump($arr);

$resultado = 0;

$query = "select IDEVALUADOR from POSTULACIONES_WEB WHERE IDPOSTULACION = ".$i;
$result = $db->query($query);
if($result){ 
	$row = $result->fetch_object(); 
	if($row->IDEVALUADOR <> "" && $row->IDEVALUADOR <> $_SESSION["idusuario"] ){
		die("-5");
	}
}
$db->next_result();

$query = "UPDATE POSTULACIONES_WEB SET IDEVALUADOR = ".$_SESSION["idusuario"]." WHERE IDPOSTULACION = ".$i;
//echo $query;
$result = $db->query($query);
//or die(mysqli_error($db));
if($result){  
	$resultado = 1;
}
$db->next_result();


$db->close();
echo $resultado;
?>