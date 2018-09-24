<?php
require 'phpmailer/PHPMailerAutoload.php';
//require("phpmailer/class.smtp.php");

$bodytext = "Gracias por Postular ".$g[0]->NOMBRETRABAJADOR."(".$g[0]->RUTEMPLEADO.")\n Los datos de tu postulacion son los Siguientes: \n Empresa: ".$g[0]->RUTEMPRESA." \n RAZON: ".$g[0]->RAZONSOCIAL."\n OTROS CAMPOS POR AGREGAR......";
$bodytext = wordwrap($bodytext,70);

$email = new PHPMailer();
$email->SMTPDebug = 3;  

//$email->IsSMTP();
//$email->Port = 25;
//$email->SMTPAuth = false;
//$email->Debugoutput = 'html';
//$email->SMTPSecure = 'tls';

//$email->Host = "mail.oticdelaconstruccion.cl";
//$email->Username = "autonomo";
//$email->Password = "otic2015";
//$email->SMTPSecure = 'tls';   


$email->From      = 'autonomo@oticdelaconstruccion.cl';
$email->FromName  = 'Becas DEMO';
$email->Subject   = 'Confirmacion de Postulacion';
$email->Body      = $bodytext;
$email->AddAddress( 'fcontreras@mets.cl' );


if(!$email->send()) {
    echo '|Mensaje Error: ' . $email->ErrorInfo;
} else {
    echo '|Mensaje Enviado';
}

?>