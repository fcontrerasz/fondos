<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php 

$rut = "-1";
if (isset($_GET['r'])) {
  $rut = $_GET['r'];
  if (0 === strpos($rut, '0')) {
    $rut = ltrim ($_GET['r'], '0');
  }
}
$dv = "-1";
if (isset($_GET['d'])) {
  $dv = $_GET['d'];
}

$b = "-1";
if (isset($_GET['b'])) {
  $b = $_GET['b'];
}

$query = "SELECT * FROM BENEFICIADOS_VIVIENDA_2014 WHERE rut_b14 = ".revisaSQL($rut, "text");
$result = $db->query($query);
if($result->num_rows > 0){
	die("-1|0");
}
$result->close();
$db->next_result();

$query = "SELECT * FROM POSTULACIONES_WEB WHERE RUT_TRABAJADOR = ".$rut." AND DV_TRABAJADOR = ".revisaSQL($dv, "text")." and IDTIPOBECA = ".revisaSQL($b, "int");
//echo $query;
$result = $db->query($query);
if($result->num_rows == "0"){
	die("0|0");
}else{
	$row = $result->fetch_object();
	die("1|".$row->IDPOSTULACION);
}
$result->close();
$db->next_result();

$db->close();

 ?>