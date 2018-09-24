<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php 

$rut = "-1";
if (isset($_GET['r'])) {
  $rut = $_GET['r'];
  if(substr( $rut, 0, 2 )=== "00"){
  	$rut = $_GET['r'];
  }elseif(substr( $rut, 0, 1 )=== "0"){
  	$rut = $_GET['r'];
  }else{
  if (0 === strpos($rut, '0')) {
    $rut = ltrim ($_GET['r'], '0');
  }
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

$llave = false;


$query = "SELECT * FROM POSTULACIONES_WEB WHERE rut_trabajador = ".revisaSQL($rut, "text");

//echo $query."|";

$result = $db->query($query);

if($result->num_rows == "0"){
	//$llave = true;
	//echo("-3|0");
	echo("-1|0");
}else{
	$row = $result->fetch_object();
	echo("1|".$row->IDPOSTULACION);
}
$result->close();
$db->next_result();
/*
if($llave){
	//valida que no existan rut de beneficiarios.
	$query = "SELECT * FROM LISTAR_EDUCACION_SIMPLE WHERE RUT_POSTULANTE = ".revisaSQL($rut, "text");
	$result = $db->query($query);
	
	if($result->num_rows > 0){
		echo("-2|0");
	}else{*/
		//aqui se debe validar el periodo en curso.
		//echo $_SERVER['HTTP_REFERER'];
		/*if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) {
			echo("-5|0");
		}else{
		    echo("-1|0");
		}*/
		//echo("-1|0");
		//
	//}
	//$result->close();
	//$db->next_result();
//}



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