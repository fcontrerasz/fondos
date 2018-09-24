<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

if(!isset($_GET["v"])) die("-1");
$v = $_GET["v"];
$query1 = "SELECT ARCHIVO_CONTRATO as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
$query2 = "SELECT ARCHIVO_LIQ1 as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
$query3 = "SELECT ARCHIVO_LIQ2 as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
$query4 = "SELECT ARCHIVO_LIQ3 as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
$query5 = "SELECT ARCHIVO_PROMESA as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
$query6 = "SELECT ARCHIVO_PROPIEDAD as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
$query7 = "SELECT ARCHIVO_DEUDA as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");
$query8 = "SELECT ARCHIVO_DECLARACION as data FROM VIVIENDA WHERE IDVIVIENDA = ".revisaSQL($v, "text");


$result = $db->query($query1);
if($result->num_rows>0){
	$row = $result->fetch_object();
	$archivo = $row->data;
	$data = substr($archivo, strpos($archivo, ",") + 1);
	$tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
	$decodedData = base64_decode($data);
}
$result->close();
$db->close();
$extension = "";
switch($tipoarchivo)
{
    case 'image/gif'    : $extension = 'gif';   break;
    case 'image/png'    : $extension = 'png';   break;
    case 'image/jpeg'   : $extension = 'jpg';   break;
	case 'image/pdf'   : $extension = 'pdf';   break;
    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   : $extension = 'docx';   break;
    case 'application/msword'    : $extension = 'doc';   break;
    case 'image/tiff'    : $extension = 'tif';   break;
    case 'application/pdf'   : $extension = 'pdf';   break;
	case 'application/x-download'   : $extension = 'pdf';   break;
    default : $extension = 'txt'; break;
}
//header('Content-Disposition: inline; filename="archivo.'.$extension.'"');
//echo $decodedData;

$myfile = fopen("zipfiles/newfile.txt", "a") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);

die();


try{
$output_file  = "/var/tmp/demo000.".$extension;
$ifp = fopen($output_file, "wb");
fwrite($ifp,$decodedData); 
fclose($ifp);
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>