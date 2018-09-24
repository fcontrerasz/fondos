<?php

	include("nusoap.php");
	
    if(!isset($_GET["xrut"])){
		die("-1");	
	}
	$xrut = $_GET["xrut"];
	
	$murl = 'http://64.76.180.231:1401/InfoAiep/TWSInfoAiep.asmx?WSDL';				
	$client = new soapclient($murl, array("trace" => 1, "exception" => 0));
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$client->debug_flag = true;
	$año = 0;
	$semestre = 0;
	
	$result = $client->call('DatosAlumno', array('codAcceso' => 'Token@Totalpack13','Rut_Alumno' => $xrut,'Anno' => $año,'semestre' => $semestre), 'http://mets.cl','http://64.76.180.231:1401/InfoAiep/TWSInfoAiep.asmx');
	
	
	if ($client->fault){
		 escribe_log($client->response);
		 die("-3~".$client->response);	
	}    
	$err = $client->getError();
	if ($err) {
		escribe_log(utf8_encode($client->response));
		die("-3~".$err."_".utf8_encode($client->response));	
	}
	
	if (!isset($result["DatosAlumnoResult"]) || $result["DatosAlumnoResult"] == 0) {
	   echo "-2~Web Service Vacio";
	   exit;
	}
	
	$data = $result["DatosAlumnoResult"];

	if($data != 0 && strpos($data, '~') !== FALSE){	
		$data = explode("~",$data);
		echo "2~".$data[4]." ".$data[2]." ".$data[3]."|".$data[16];
	}else{
		echo "-1~Vacio";
	}

?>