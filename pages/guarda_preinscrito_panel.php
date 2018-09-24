<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php 

$rut = "-1";
$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);
$arr = get_defined_vars();
//var_dump($arr);
//echo $variables[1];
$ultimo = 0;
if(existeRutTrabajador($r)){ die("-99"); }

$query1 = sprintf("CALL `itiss_POSTULACIONES_WEB_upd` (NULL, 0, %s, NULL, NULL, NULL, NULL, NULL, NULL, %s, %s, NULL, NULL, NULL, %s, NULL, NULL, NULL, NULL, NULL, %s, NULL, %s, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, @result);",1, revisaSQL($r, "text"),revisaSQL($dv, "text"),revisaSQL($c, "text"),revisaSQL($m, "text"),revisaSQL("09-".$f, "text"));
$result = $db->query($query1);
$db->next_result();

$query2 = sprintf("CALL `itiss_POSTULACIONES_WEB_upd` (NULL, 0, %s, NULL, NULL, NULL, NULL, NULL, NULL, %s, %s, NULL, NULL, NULL, %s, NULL, NULL, NULL, NULL, NULL, %s, NULL, %s, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, @result);",2, revisaSQL($r, "text"),revisaSQL($dv, "text"),revisaSQL($c, "text"),revisaSQL($m, "text"),revisaSQL("09-".$f, "text"));
$result = $db->query($query2);
$db->next_result();

//echo $query;

$query = "SELECT @result as resultado, LAST_INSERT_ID() as id";
$result = $db->query($query);
$row = $result->fetch_object();
if($row->resultado=="1"){
	$ultimo = $row->id;
	echo $row->resultado."|".$row->id;
}else{ echo $row->resultado."|0";  }
$result->close();
$db->next_result();

/*

if($ultimo>0){
	$query3 = sprintf("CALL itiss_VIVIENDA_upd (NULL, NULL,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($ultimo, "int"));
	$query4 = sprintf("CALL itiss_EDUCACION_upd (NULL, NULL,%s,NULL,NULL,%s,%s,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,@result);",revisaSQL($ultimo, "int"),revisaSQL($rp, "int"),revisaSQL($dp, "text"));
	//echo $query;
	$result = $db->query($query3);
	$result = $db->query($query4);
	$db->next_result();
}*/
$db->close();

?>