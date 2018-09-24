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
$t = "-1";
if (isset($_GET['t'])) {
  $t = $_GET['t'];
}
$b = "-1";
if (isset($_GET['b'])) {
  $b = $_GET['b'];
}
$i = "-1";
if (isset($_GET['i']) && $_GET['i'] != "") {
  $i = $_GET['i'];
}
$rutt = "-1";
if (isset($_GET['rutt']) && $_GET['rutt'] != "") {
  $rutt = $_GET['rutt'];
}
$dvt = "-1";
if (isset($_GET['dvt']) && $_GET['dvt'] != "") {
  $dvt = $_GET['dvt'];
}


//dvt

$esv = esPrimeraIDEDUCACION($rutt);
if($esv=="-1") die("-1|0");

if($b=="2"){
$query = "SELECT count(IDPOSTULACION) as total FROM POSTULACIONES_WEB WHERE IDTIPOBECA = 2 and RUT_TRABAJADOR = ".revisaSQL($rut, "text");
}else{
//$query = "SELECT * FROM POSTULACIONES_WEB WHERE rut_trabajador = ".revisaSQL($rut, "text");
}

$result = $db->query($query);

$row = $result->fetch_object();

if($row->total > 0){
	if($rutt <> $rut){
		die("-2|0|".$rutt."|".$rut);
	}
}
$result->close();
$db->next_result();


if($b=="2"){
$query = "SELECT IDEDUCACION FROM LISTAR_EDUCACION_SIMPLE WHERE RUT_POSTULANTE = ".revisaSQL($rut, "text");
}else{
//$query = "SELECT * FROM POSTULACIONES_WEB WHERE rut_trabajador = ".revisaSQL($rut, "text");
}

$result = $db->query($query);

if($result->num_rows == "0"){
	echo "1|";
}else{
	die("-1|0");
}
$result->close();
$db->next_result();



$query = "";
if($b == "2"){

	if($esv==""){
	
		$query2 = sprintf("CALL `itiss_POSTULACIONES_WEB_upd` (%s, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, @result);",revisaSQL($i, "int"));
		$result = $db->query($query2);
		$db->next_result();

		$query = sprintf("CALL itiss_EDUCACION_upd (NULL, NULL,%s,NULL,%s,%s,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($i, "int"),revisaSQL($t, "text"),revisaSQL($rut, "int"),revisaSQL($dv, "text"));
		$result = $db->query($query);
	
		if($result){
			echo $i;
		}else{
			echo "-1";
		}
	
	}else{
	
		$query2 = sprintf("CALL `itiss_POSTULACIONES_WEB_upd` (NULL, 1, %s, NULL, NULL, NULL, NULL, NULL, NULL, %s, %s, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, @result);",2, revisaSQL($rutt, "text"),revisaSQL($dvt, "text"));
		$result = $db->query($query2);
		$db->next_result();

		$query = "SELECT @result as resultado, LAST_INSERT_ID() as id";
		$result = $db->query($query);
		$row = $result->fetch_object();
		if($row->resultado=="1"){
		$ultimo = $row->id;
		}else{ die("-1"); }
		$result->close();
		$db->next_result();
	
		$query = sprintf("CALL itiss_EDUCACION_upd (NULL, NULL,%s,NULL,%s,%s,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($ultimo, "int"),revisaSQL($t, "text"),revisaSQL($rut, "int"),revisaSQL($dv, "text"));
		$result = $db->query($query);
		
		echo $ultimo;
	
	}
	
}

$db->close();
?>