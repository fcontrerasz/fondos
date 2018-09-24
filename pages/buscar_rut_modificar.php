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


$query = "SELECT * FROM RESULTADOS_POSTULACIONES WHERE RUT_TRABAJADOR = ".revisaSQL($rut, "text");
$result = $db->query($query);

//echo $result->num_rows."<----";

if($result->num_rows == "0"){
	die("-1|0");
}
$result->close();
$db->next_result();

$query = @"SELECT 
  RESULTADOS_POSTULACIONES.ESTADO,
  POSTULACIONES_WEB.IDPOSTULACION,
  POSTULACIONES_WEB.IDTIPOBECA,
  RESULTADOS_POSTULACIONES.RUT_TRABAJADOR,
  RESULTADOS_POSTULACIONES.RUT_POSTULANTE,
  POSTULACIONES_WEB.FECHA_NACIMIENTO,
  POSTULACIONES_WEB.IDESTADOBECA,
  ESTADO_BECA.ESTADO_BECA,
  POSTULACIONES_WEB.RUT_TRABAJADOR
FROM
  RESULTADOS_POSTULACIONES
  INNER JOIN POSTULACIONES_WEB ON (RESULTADOS_POSTULACIONES.IDPOST = POSTULACIONES_WEB.IDPOSTULACION)
  INNER JOIN ESTADO_BECA ON (POSTULACIONES_WEB.IDESTADOBECA = ESTADO_BECA.IDESTADOBECA) 
WHERE RESULTADOS_POSTULACIONES.RUT_TRABAJADOR = ".revisaSQL($rut, "text")." AND RESULTADOS_POSTULACIONES.RUT_POSTULANTE = ".revisaSQL($rutp, "text")." AND POSTULACIONES_WEB.FECHA_NACIMIENTO = ".revisaSQL($f, "text")." AND IDTIPOBECA = ".revisaSQL($b, "int")." AND ESTADO <> 'DESACTIVADA'";
$result = $db->query($query);

//echo ">>".$query."<<";
//echo $result->num_rows."<<";

if($result->num_rows == "0"){
	echo "0|0";
}else{
	$row = $result->fetch_object();
	//echo $row->ESTADO_BECA;
	if(($row->ESTADO_BECA == "OBSERVACIONES" || $row->ESTADO_BECA == "CORREGIDA")){
		echo "1|".$row->IDPOSTULACION;
	}else{
		echo "-1|0";
	}
}
$result->close();
$db->next_result();
$db->close();


?>