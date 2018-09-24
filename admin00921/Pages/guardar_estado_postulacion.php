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

$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);
$arr = get_defined_vars();

//var_dump($arr);
$nombreestado = "";
switch ($e) {
    case 0:
        $nombreestado = "SIN SELECCION";
        break;
    case 1:
        $nombreestado = "NUEVO";
        break;
    case 2:
        $nombreestado = "CORREGIDA";
        break;
    case 3:
        $nombreestado = "OBSERVACIONES";
        break;
    case 4:
        $nombreestado = "CORREGIDA";
        break;
    case 5:
        $nombreestado = "RECHAZADA";
        break;
    case 6:
        $nombreestado = "ADJUDICADA";
        break;
    case 7:
        $nombreestado = "PENDIENTE AUDITOR";
        break;
    case 8:
        $nombreestado = "DESACTIVADA";
        break;
    case 9:
        $nombreestado = "CORREGIDA";
        break;
    case 10:
        $nombreestado = "POSTULADA CORRECTAMENTE";
        break;
    case 11:
        $nombreestado = "RECHAZADA NO FINALIZA";
        break;
}

$resultado = 0;

$query = @"INSERT INTO `becascodelco`.`BITACORAS` (`IDBITACORA`, `IDACCION`, `IDPOSTULACION`, `GLOSA_BITACORA`, `IDUSUARIO`, FECHA_BITACORA) VALUES (NULL, '1', '".$i."', '".date("Y-m-d H:i:s")." CAMBIO DE ESTADO ".$nombreestado."', '".$_SESSION["idusuario"]."', NOW())";
//echo $query;
$result = $db->query($query);
//or die(mysqli_error($db));
if($result){  
	$resultado = 1;
}
$db->next_result();

$query = "UPDATE POSTULACIONES_WEB SET IDESTADOBECA = ".$e." WHERE IDPOSTULACION = ".$i;
//echo $query;
$result = $db->query($query);
//or die(mysqli_error($db));
if($result){  
	$resultado += 1;
}
$db->next_result();


$db->close();
echo $resultado;
?>