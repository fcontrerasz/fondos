<?php 
if (!function_exists("revisaSQL")) {
function revisaSQL($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if($theValue == "") return 'NULL';
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

function traeIDPostulacion($rut,$beca){
 	//die("llegueeee");
	global $db;
	$query = "SELECT IDPOSTULACION FROM POSTULACIONES_WEB WHERE rut_trabajador = ".revisaSQL($rut, "text")." and IDTIPOBECA = ".revisaSQL($beca, "int");
	$result = $db->query($query);

	
	$resultado = "0";
	if($result->num_rows == "0"){
		$resultado = "-1";
	}else{
		$row = $result->fetch_object();
		$resultado = $row->IDPOSTULACION;
	}
	$result->close();
	$db->next_result();
	return $resultado;
}

function traeEstadoPostulacion($rut,$beca){
	global $db;
	$query = "SELECT ESTADO_BECA FROM listar_busqueda WHERE rut_trabajador = ".revisaSQL($rut, "text")." and IDTIPOBECA = ".revisaSQL($beca, "int");
	$result = $db->query($query);

	
	
	$resultado = "0";
	if($result->num_rows == "0"){
		$resultado = "-1";
	}else{
		$row = $result->fetch_object();
		$resultado = $row->ESTADO_BECA;
	}
	$result->close();
	$db->next_result();
	return $resultado;
}

function existeRutTrabajador($rut){
	global $db;
	$query = "SELECT IDPOSTULACION FROM POSTULACIONES_WEB WHERE rut_trabajador = ".revisaSQL($rut, "text");
	$result = $db->query($query);
	$resultado = true;
	if($result->num_rows == "0"){
		$resultado = false;
	}
	$result->close();
	$db->next_result();
	return $resultado;
}

function esPrimeraIDEDUCACION($rut){
//
	global $db;
	$query = "SELECT IDEDUCACION FROM validar_existe_rut WHERE RUT_TRABAJADOR = ".revisaSQL($rut, "text");
	$result = $db->query($query);
	$resultado = "";
	if($result->num_rows == "0"){
		$resultado = "-1";
	}else{
		$row = $result->fetch_object();
		$resultado = $row->IDEDUCACION;
	}
	$result->close();
	$db->next_result();
	return $resultado;

}

function esPrimeraIDVIVIENDA($rut){
//
	global $db;
	$query = "SELECT IDVIVIENDA FROM validar_existe_rut_vivienda WHERE RUT_TRABAJADOR = ".revisaSQL($rut, "text");
	//echo $query;
	$result = $db->query($query);
	$resultado = "";
	if($result->num_rows == "0"){
		$resultado = "-1";
	}else{
		$row = $result->fetch_object();
		$resultado = $row->IDVIVIENDA;
		if($resultado == "") $resultado = "-1";
		
	}
	$result->close();
	$db->next_result();
	return $resultado;

}

?>