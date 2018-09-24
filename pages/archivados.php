<?php require_once('../admin00921/conexion/conecta.php'); ?>
<?php

if(!isset($_GET["v"])) die("-1");
$v = $_GET["v"];

$query = array("","SELECT ARCHIVO_CONTRATO as data FROM EDUCACION WHERE ARCHIVO_CONTRATO IS NOT NULL AND IDEDUCACION = ".revisaSQL($v, "text"),"SELECT ARCHIVO_LIQ1 as data FROM EDUCACION WHERE ARCHIVO_LIQ1 IS NOT NULL AND IDEDUCACION = ".revisaSQL($v, "text"),"SELECT ARCHIVO_LIQ2 as data FROM EDUCACION WHERE ARCHIVO_LIQ2 IS NOT NULL AND IDEDUCACION = ".revisaSQL($v, "text"),"SELECT ARCHIVO_LIQ3 as data FROM EDUCACION WHERE ARCHIVO_LIQ3 IS NOT NULL AND IDEDUCACION = ".revisaSQL($v, "text"),"SELECT ARCHIVO_CERT_ALUMNO as data FROM EDUCACION WHERE ARCHIVO_CERT_ALUMNO IS NOT NULL AND IDEDUCACION = ".revisaSQL($v, "text"),"SELECT ARCHIVO_CONC_NOTAS as data FROM EDUCACION WHERE ARCHIVO_CONC_NOTAS IS NOT NULL AND IDEDUCACION = ".revisaSQL($v, "text"),"SELECT ARCHIVO_CERT_NAC as data FROM EDUCACION WHERE ARCHIVO_CERT_NAC IS NOT NULL AND  IDEDUCACION = ".revisaSQL($v, "text"),"SELECT ARCHIVO_CERT_MATRI as data FROM EDUCACION WHERE ARCHIVO_CERT_MATRI IS NOT NULL AND   IDEDUCACION = ".revisaSQL($v, "text"),"SELECT ARCHIVO_DECLARA as data FROM EDUCACION WHERE ARCHIVO_DECLARA IS NOT NULL AND    IDEDUCACION = ".revisaSQL($v, "text"),"SELECT ARCHIVO_SEGUROCOMP as data FROM EDUCACION WHERE ARCHIVO_SEGUROCOMP IS NOT NULL AND IDEDUCACION = ".revisaSQL($v, "text"));

$nombres = array("","ARCHIVO_CONTRATO","ARCHIVO_LIQ1","ARCHIVO_LIQ2","ARCHIVO_LIQ3","ARCHIVO_CERT_ALUMNO","ARCHIVO_CONC_NOTAS","ARCHIVO_CERT_NAC"," ARCHIVO_CERT_MATRI","ARCHIVO_DECLARA","ARCHIVO_SEGUROCOMP");


$listado = array();


for ($x = 1; $x <= 10; $x++) {
  //echo "The number is: $x <br>";
  $str = $query[$x];
  //echo "Ronda ".$x."<br>";
  $result = $db->query($str);
  //echo "Ejecutando la query: ".$str." <br>";
  //echo "Encontraron: ".$result->num_rows."<br>";
  if($result->num_rows>0){
    $row = $result->fetch_object();
    $archivo = $row->data;
    $data = substr($archivo, strpos($archivo, ",") + 1);
    $tipoarchivo =  substr($archivo, 5, strpos($archivo, ";") - 5);
    $decodedData = base64_decode($data);
    $extension = "";

    switch($tipoarchivo)
    {
        case 'image/gif'    : $extension = 'gif';   break;
        case 'image/png'    : $extension = 'png';   break;
        case 'image/jpeg'   : $extension = 'jpg';   break;
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   : $extension = 'docx';   break;
        case 'application/msword'    : $extension = 'doc';   break;
        case 'image/tiff'    : $extension = 'tif';   break;
        case 'application/pdf'   : $extension = 'pdf';   break;
        default : $extension = 'txt'; break;
    }
    $filename = $nombres[$x]."_".$v."_".$x.".".$extension;
    //echo "tmp/".$filename."<br>";
    array_push($listado, $filename);
    $fp = fopen("tmp/".$filename, 'wb');
    fwrite($fp, $decodedData);
    fclose($fp);
  }

}

$result->close();
$db->next_result();
$db->close();

$zip = new ZipArchive();
$tmp_file = tempnam('.', '');
$zip->open($tmp_file, ZipArchive::CREATE);

# loop through each file
foreach ($listado as $file) {
  $zip->addFile("tmp/".$file, basename($file));
  //unlink("tmp/".$file);
}

# close zip
$zip->close();

# send the file to the browser as a download
header('Content-disposition: attachment; filename="zip'.$v.'_'.date("Y_m_d_H_i").'.zip"');
header('Content-type: application/zip');
readfile($tmp_file);
unlink($tmp_file);

foreach ($listado as $file) {
  unlink("tmp/".$file);
}

?>