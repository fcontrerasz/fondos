<?php 
require_once('../admin00921/conexion/conecta.php'); 
//header('Content-type: content="text/html; charset=iso-8859-1');

if(!isset($_GET["i"]) || $_GET["i"] == "") die();


$r = $_GET["i"];



$query = "select * from RESULTADOS_VIVIENDA_2017 where IDPOS = ".revisaSQL($r,"text")." ";
//echo $query;
//die();
$result = $db->query($query);

if($result)
{
	while ($row = $result->fetch_object())
	{
	//var_dump($row);
	echo ("<div class='styleobs'>" . $row->ESTADO_ADJ . "</div><BR>");
	echo ("<div class='styleobs'>" . nl2br($row->GLOSA) . "</div>");
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