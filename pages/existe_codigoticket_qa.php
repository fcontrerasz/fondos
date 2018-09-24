<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php 

$c = "-1";
if (isset($_GET['c'])) {
  $c = $_GET['c'];
}

$becaes = substr($c, 0, 5); 

if($becaes == "22015"){
	$d = str_replace("22015","",$c);
	$query = "SELECT * FROM RESULTADOS_POSTULACIONES WHERE RUT_TRABAJADOR = ".revisaSQL($d, "text");
}
if($becaes == "12015"){
	$d = str_replace("12015","",$c);
	$query = "SELECT * FROM POSTULACIONES_WEB WHERE RUT_TRABAJADOR = ".revisaSQL($d, "text");
}



//echo $query;
$result = $db->query($query);
if($result->num_rows == "0"){
	die("-1");
}else{
	die("1");
}
$result->close();
$db->next_result();
$db->close();

 ?>