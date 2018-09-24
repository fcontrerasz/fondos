<?php 
require_once('../admin00921/conexion/conecta.php'); 
//header('Content-type: content="text/html; charset=iso-8859-1');

if(!isset($_GET["i"]) || $_GET["i"] == "") die();


$r = $_GET["i"];



$query = "select * from listar_observacion_vivienda where IDPOSTULACION = ".revisaSQL($r,"text")." ";
//$query = "select * from listar_observacion_vivienda where IDPOSTULACION = ".revisaSQL($r,"text")." ";
//echo $query;

//var_dump($query);

$result = $db->query($query);

//var_dump($query);

if($result)
{
	while ($row = $result->fetch_object())
	{
	//var_dump($row);
	echo ("<div class='styleobs'>" . nl2br($row->OBS_PASO1) . "</div>");
	}
	$result->close();
	$db->next_result();
} else echo($db->error);
	 	$db->close();

?>



<style>
.styleobs{
    font-family: sans-serif;
    font-size: 14px;
}
</style>