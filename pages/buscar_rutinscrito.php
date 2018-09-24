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
$f = "-1";
if (isset($_GET['f'])) {
  $f = $_GET['f'];
}

$b = "-1";
if (isset($_GET['b'])) {
  $b = $_GET['b'];
}

$rutp = "-1";
if (isset($_GET['rp'])) {
  $rutp = $_GET['rp'];
  if (0 === strpos($rutp, '0')) {
    $rutp = ltrim ($_GET['rp'], '0');
  }
}
$dvp = "-1";
if (isset($_GET['dp'])) {
  $dvp = $_GET['dp'];
}

$query = "SELECT * FROM POSTULACIONES_WEB WHERE rut_trabajador = ".revisaSQL($rut, "text")." and IDTIPOBECA = ".revisaSQL($b, "int");
//." and fecha_nacimiento = ".revisaSQL($f, "text");
$result = $db->query($query);
//echo $query;
//echo "<br>";
if($result->num_rows == "0"){
	die("-1|0");
}
$result->close();
$db->next_result();

$query = "SELECT * FROM listar_maestro_postulaciones_educacion_login WHERE rut_postulante = ".revisaSQL($rutp, "text")." and IDESTADOBECA <> 8";
$result = $db->query($query);
//echo $query;
//echo "<br>";
if($result->num_rows > 1){
//	echo $query;
	die("-2|0");
}
$result->close();
$db->next_result();


$query = "";
if($b == "2"){
	$query = "SELECT * FROM listar_maestro_postulaciones_educacion_login WHERE rut_trabajador = ".revisaSQL($rut, "text")." and rut_postulante = ".revisaSQL($rutp, "text")." and IDESTADOBECA <> 8";
}

//echo $query;
$en = 0;
$result = $db->query($query);
if($result->num_rows>0){
	$en = 1;
}
$result->close();
$db->next_result();

if($en == 1){
$query = "";
if($b == "2"){
	$query = "SELECT IDPOSTULACION FROM listar_maestro_postulaciones_educacion_login WHERE rut_trabajador = ".revisaSQL($rut, "text")." and dv_trabajador = ".revisaSQL($dv, "text")." and fecha_nacimiento = ".revisaSQL($f, "text")." and IDTIPOBECA = ".revisaSQL($b, "int")." and rut_postulante = ".revisaSQL($rutp, "text")." and dv_postulante = ".revisaSQL($dvp, "text")." and IDESTADOBECA <> 8";
}

$result = $db->query($query);
if($result->num_rows>0){
	$row = $result->fetch_object();
	die("1|".$row->IDPOSTULACION);
}
$result->close();
$db->next_result();

}else if($en == 0){
	die("-1|0");
}


/*
$query = "";
if($b == "2"){
	$query = "SELECT IDPOSTULACION FROM listar_maestro_postulaciones_educacion_login WHERE rut_trabajador = ".revisaSQL($rut, "text")." and dv_trabajador = ".revisaSQL($dv, "text")." and fecha_nacimiento = ".revisaSQL($f, "text")." and IDTIPOBECA = ".revisaSQL($b, "int")." and rut_postulante is null and IDESTADOBECA <> 8";
}

//echo $query;

$result = $db->query($query);
if($result->num_rows>0){
	$row = $result->fetch_object();
	die("-3|".$row->IDPOSTULACION);
}else{ echo "0|0"; }
$result->close();
$db->next_result();
*/
//die("5");
//else{ echo "|-3"; }


$db->close();

 ?>