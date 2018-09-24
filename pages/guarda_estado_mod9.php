<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php 
//error_reporting(0);
//if (!isset($_SERVER['HTTP_REFERER'])){ die("-5"); }
//echo $_SERVER['HTTP_X_REQUESTED_WITH'].",";
//echo $_SERVER['HTTP_REFERER'];
if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest"){ die("-5"); }


if(!isset($_GET["id"])) die("-1");
$id = $_GET["id"];

if(!isset($_GET["desde"])) die("-1");
$desde = $_GET["desde"];

$query = "UPDATE POSTULACIONES_WEB SET IDESTADOBECA = 9, FECHA_MODIFICACION = NOW() WHERE IDPOSTULACION = ".revisaSQL($id, "int");
$result = $db->query($query);
if($result){
echo "1";
}else{echo "0";}
$db->next_result();


?>