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

$query = "SELECT count(id) as total FROM BENEFICIADOS_VIVIENDA_ANTERIOR WHERE rut_b14 = ".revisaSQL($rut, "text");
$result = $db->query($query);
$row = $result->fetch_object();
if($row->total > 0){
		die("-3");
}
$result->close();
$db->next_result();


$query = "SELECT count(IDPOSTULACION) as total FROM POSTULACIONES_WEB WHERE IDTIPOBECA = 1 and IDESTADOBECA <> 0 and RUT_TRABAJADOR = ".revisaSQL($rut, "text");
//echo $query;
$result = $db->query($query);
$row = $result->fetch_object();
if($row->total > 0){
		die("-2");
}
$result->close();
$db->next_result();

$esv = esPrimeraIDVIVIENDA($rut);
if($esv == "-1"){
	$query = sprintf("CALL itiss_VIVIENDA_upd (NULL, NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL(traeIDPostulacion($rut,"1"), "int"));
	$result = $db->query($query);
	$db->next_result();
	//echo "0|".$query."|";
	$query = "update POSTULACIONES_WEB set IDESTADOBECA = 1 WHERE IDTIPOBECA = 1 and IDPOSTULACION = ".revisaSQL(traeIDPostulacion($rut,"1"), "int");
	$result = $db->query($query);
	$db->next_result();

	echo "1";
}else{
	echo "2";
}

$db->close();
?>