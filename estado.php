<?php require_once('admin00921/conexion/conecta.php'); ?>
<?php 
header('Content-Type: text/html; charset=ISO-8859-1');

//die("Estamos en proceso de validación, revisa las fechas que se publicarán los resultados.");

if(!isset($_GET["r"])) die("-1");
//if(!isset($_GET["d"])) die("-1");
$r = $_GET["r"];
$becaes = substr($r, 0, 5); 
$e = 0;
$n = "RUT NO ENCONTRADO";
$tipob = 0;

//echo $becaes;

if($becaes == "22015"){
	$tipob = 2;
	$d = str_replace("22015","",$r);
	$query = "SELECT * FROM RESULTADOS_POSTULACIONES WHERE ESTADO <> 'DESACTIVADA' AND (RUT_TRABAJADOR like '%".$d."%' or RUT_POSTULANTE like '%".$d."%') ";
	
}
if($becaes == "12015"){
	//die();
	$tipob = 1;
	echo '<script>console.log("'.$r.'");</script>';
	if (strpos($r,'1201512015') !== false) {
		$d = substr($r, 5); 
	}else{
		$d = str_replace("12015","",$r);
	}
	if(substr( $d, 0, 1 ) === "0"){
		//die("El rut a consultar no puede iniciar con '0'.");
	}
	//if($r != "120158504479") die();
	
	$query = @"SELECT * from Listado_Resultados_Vivienda_2015 where RUT_TRABAJADOR = ".revisaSQL(trim($d), "text");
	
	/*$query = @"SELECT
  CONCAT(ESTADO_BECA.ESTADO_BECA, ' (', ESTADO_BECA.ESTADO_BECA_GLOSA, ')') AS ESTADO,
  POSTULACIONES_WEB.IDPOSTULACION,
  POSTULACIONES_WEB.RUT_TRABAJADOR,
  POSTULACIONES_WEB.IDTIPOBECA,
  PONDERACION_VIVIENDA.* 
FROM POSTULACIONES_WEB
  INNER JOIN ESTADO_BECA
    ON POSTULACIONES_WEB.IDESTADOBECA = ESTADO_BECA.IDESTADOBECA
  INNER JOIN VIVIENDA
    ON VIVIENDA.IDPOSTULACION = POSTULACIONES_WEB.IDPOSTULACION
  LEFT OUTER JOIN PONDERACION_VIVIENDA
    ON VIVIENDA.IDPONDVIVIENDA = PONDERACION_VIVIENDA.IDPONDVIVIENDA
WHERE POSTULACIONES_WEB.RUT_TRABAJADOR = ".revisaSQL(trim($d), "text")." AND POSTULACIONES_WEB.IDTIPOBECA = 1";*/

 //echo $query;
/* echo '<script>console.log('.$query.');</script>';*/
}
if($becaes != "12015" && $becaes != "22015"){
	die();
}
//echo $query;
$result = $db->query($query);
//echo $result->num_rows;
if($result->num_rows == "0"){
	die("No se encontraron coincidencias con el Rut ingresado. <br> Intente ingresar el rut del trabajador o postulante sin puntos, ni dígito verificador y ni guion");
}

//$d = $_GET["d"];

//echo $query;

?>
<link href="css/style.default.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>
<style>
body{
font-size:12px;
}
.label {
-moz-border-radius: 0;
-webkit-border-radius: 0;
border-radius: 0;
font-size: 13px;
text-shadow: none;
font-weight: normal;
text-transform: uppercase;
padding: 2px 5px;
}

.label-success{
background-color: #bedd5c;
}

.tag {
    font-family: Helvetica, Arial, sans-serif;
    background: #c2c3c4;
    display: inline-block;
    color: #fff;
    position: relative;
    padding: 10px;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    /*margin: 0 70px 0 0;*/
    text-decoration: none;
	float: left;
}

.label-info{
background-color: #f7a30a;
}

.ui-accordion .ui-accordion-header {
background-color: #f3f3f3 !important;
border: 0;
padding:15px !important;
margin: 0px;
border: 1px solid #FCB904 !important;
}
.ui-accordion-header {
font-size: 12px;
text-shadow: 1px 1px rgba(255,255,255,0.3);
cursor: pointer;
margin-top: 10px !important;
}
.ui-accordion-content {
padding: 10px !important;
border-left: 1px solid #FCB904 !important;
border-right: 1px solid #FCB904 !important;
border-bottom: 1px solid #FCB904 !important;
color: #666 !important;
overflow: hidden !important;
background: #fff !important;
}
.filtro{
font-family: 'Lato', verdana !important;
font-size: 12px !important;
background-color: #f7a30a;
padding:5px;
cursor: pointer;
color: white;
}
.todas{
font-family: 'Lato', verdana !important;
font-size: 12px !important;
background-color: #784e27;
padding:5px;
cursor: pointer;
}
a, a:hover, a:link, a:active, a:focus {
outline: none;
color: white !important;
text-decoration: none;
}


</style>
<?php 
$llave = 0;
if($result){
	while ($row = $result->fetch_object()){
		$n = $row->ESTADO_FINAL;
		$e = $row->IDESTADOBECA;
		$ruttra = $row->RUT_TRABAJADOR;
		$rutpost = $row->RUT_POSTULANTE;
		$o = $row->GLOSA;
		if (strpos($n,'OBSERVACIONES') !== false) {
    		$llave = 1;
		}
		if (strpos($n,'CORREGIDA') !== false) {
    		$llave = 1;
		}
?>
<div class="tag" >RUT TRABAJADOR:</div>
<span style="border:1px solid #c2c3c4; float:left; padding:9px;"><?php echo $ruttra; ?></span>
<div style="clear:both"></div>
<?php if($becaes == "22015"){ ?>
<h2>RUT POSTULANTE: <?php echo $rutpost; ?></h2>
<h1>ESTADO : <?php echo utf8_decode($n); ?></h1>
<h2>OBSERVACION: <?php echo utf8_decode($o); ?></h2>
<?php }else if($becaes == "12015"){ ?>
<br>
<br>
<div class="tag" >ESTADO: </DIV>
<span style="border:1px solid #c2c3c4; float:left; padding:9px;"><?php echo utf8_decode($n); ?></span>
  <br>

<p><br>
</p>
<?php if (strpos($n,'OBSERVACIONES') !== false) { ?>
<div class="tag" >TABLA DE DETALLES: </DIV>
</BR>

<table id="sort02" class="rounded-corner" style="width:100%;padding: 0; margin:0; text-align:left; font-size:12PX;">
                    <thead>
                            <tr>     	
                                <td style="background-color:#FBFBFB; font-weight:bold; text-align:left; border-top: 1px solid white;">&nbsp;</td>
                                <td style="background-color:#E6F1F5; font-weight:bold;"><div align="center">SI CUMPLE</div></td>
                                <td style="background-color:#E6F1F5; font-weight:bold;"><div align="center">NO CUMPLE</div></td>
                                 
                                <td style="background-color:#E6F1F5; font-weight:bold;width: 200px;">OBSERVACIONES</td>
                            </tr>
                    </thead>
                    <tbody>
                             <tr>     	
                                <td colspan="4" style="background-color:#5494af; color:#FFFFFF; ">ANTECEDENTES GENERALES</td>
                            </tr>
                            <tr>     	
                                <td>PRESENTA DECLARACION JURADA</td>
                                <td><div align="center">
                                  <input type="radio" name="r1" value="1" <?php echo $row->r1=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r1" value="3" <?php echo $row->r1=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr1" value="<?php echo $row->r1=="3"?$row->tr1:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>HA POSTULADO ANTERIORMENTE</td>
                                <td><div align="center">
                                  <input type="radio" name="r2" value="1" <?php echo $row->r2=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r2" value="3" <?php echo $row->r2=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr2" value="<?php echo $row->r2=="3"?$row->tr2:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>PRESENTA CONTRATO DE TRABAJO</td>
                                <td><div align="center">
                                  <input type="radio" name="r3" value="1" <?php echo $row->r3=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r3" value="3" <?php echo $row->r3=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr3" value="<?php echo $row->r3=="3"?$row->tr3:""; ?>"></td>
                            </tr>
                            
                            <tr>     	
                                <td>PRESENTA LIQUIDACION DE SUELDO 1</td>
                                <td><div align="center">
                                  <input type="radio" name="r5" value="1" <?php echo $row->r5=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r5" value="3" <?php echo $row->r5=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr5" value="<?php echo $row->r5=="3"?$row->tr5:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>PRESENTA LIQUIDACION DE SUELDO 2</td>
                                <td><div align="center">
                                  <input type="radio" name="r6" value="1" <?php echo $row->r6=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r6" value="3" <?php echo $row->r6=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr6" value="<?php echo $row->r6=="3"?$row->tr6:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>PRESENTA LIQUIDACION DE SUELDO 3</td>
                                <td><div align="center">
                                  <input type="radio" name="r7" value="1" <?php echo $row->r7=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r7" value="3" <?php echo $row->r7=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr7" value="<?php echo $row->r7=="3"?$row->tr7:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>PROMEDIO DE REMUNERACION CONCUERDA CON DOCUMENTACION</td>
                                <td><div align="center">
                                  <input type="radio" name="r8" value="1" <?php echo $row->r8=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r8" value="3" <?php echo $row->r8=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr8" value="<?php echo $row->r8=="3"?$row->tr8:""; ?>"></td>
                            </tr>
                            
                            <tr>     	
                                <td>DECLARA NUMERO DE INTEGRANTES</td>
                                <td><div align="center">
                                  <input type="radio" name="r10" value="1" <?php echo $row->r10=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r10" value="3" <?php echo $row->r10=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr10" value="<?php echo $row->r10=="3"?$row->tr10:""; ?>"></td>
                            </tr>
                            
  </tbody>
                          
                          <tbody id="validaciones_vivienda">
                           
                            <tr>     	
                                <td colspan="4" style="background-color:#5494af; color:#FFFFFF; ">DATOS DE LA VIVIENDA</td>
                            </tr>
                            <tr>     	
                                <td>COINCIDE CON LO DECLARADO</td>
								<td><div align="center">
								  <input type="radio" name="r19" value="1" <?php echo $row->r19=="1"?"checked=\"checked\"":""; ?>>
							    </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r19" value="3" <?php echo $row->r19=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" id="tr19" name="tr19" value="<?php echo $row->r19=="3"?"CORRESPONDE A ".$row->tr19:""; ?>">
							  </td>
                            </tr>
                            <tr>     	
                                <td colspan="4" style="background-color:#5494af; color:#FFFFFF; ">SI ES DE TIPO COMPRA</td>
                            </tr>
                            <tr>     	
                                <td>COPIA DE PROMESA COMPRAVENTA</td>
                                <td><div align="center">
                                  <input type="radio" name="r20" value="1" <?php echo $row->r20=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r20" value="3" <?php echo $row->r20=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr20" value="<?php echo $row->r20=="3"?$row->tr20:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>COPIA LEGAL LIBRETA AHORRO</td>
                                <td><div align="center">
                                  <input type="radio" name="r21" value="1" <?php echo $row->r21=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r21" value="3" <?php echo $row->r21=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr21" value="<?php echo $row->r21=="3"?$row->tr21:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>DOCUMENTO RESERVA</td>
                                <td><div align="center">
                                  <input type="radio" name="r22" value="1" <?php echo $row->r22=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r22" value="3" <?php echo $row->r22=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr22" value="<?php echo $row->r22=="3"?$row->tr22:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO ENTIDAD CAPTADORA</td>
                                <td><div align="center">
                                  <input type="radio" name="r23" value="1" <?php echo $row->r23=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r23" value="3"  <?php echo $row->r23=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr23" value="<?php echo $row->r23=="3"?$row->tr23:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>VIGENTE (COPIA LEGALIZADA)</td>
                                <td><div align="center">
                                  <input type="radio" name="r24" value="1" <?php echo $row->r24=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r24" value="3" <?php echo $row->r24=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr24" value="<?php echo $row->r24=="3"?$row->tr24:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td colspan="4" style="background-color:#5494af; color:#FFFFFF; ">SI ES DE TIPO CONSTRUCCION - TERRENO POSTULANTE</td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO BIEN RAIZ</td>
                                <td><div align="center">
                                  <input type="radio" name="r25" value="1" <?php echo $row->r25=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r25" value="3" <?php echo $row->r25=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr25" value="<?php echo $row->r25=="3"?$row->tr25:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>A NOMBRE DEL POSTULANTE</td>
                                <td><div align="center">
                                  <input type="radio" name="r26" value="1" <?php echo $row->r26=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r26" value="3" <?php echo $row->r26=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr26" value="<?php echo $row->r26=="3"?$row->tr26:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>VIGENTE</td>
                                <td><div align="center">
                                  <input type="radio" name="r27" value="1" <?php echo $row->r27=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r27" value="3" <?php echo $row->r27=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr27" value="<?php echo $row->r27=="3"?$row->tr27:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td colspan="4" style="background-color:#5494af; color:#FFFFFF; ">SI ES DE TIPO CONSTRUCCION - TERRENO TERCERO (FAMILIAR)</td>
                            </tr>
                            <tr>     	
                                <td>DECLARACION JURADA</td>
                                <td><div align="center">
                                  <input type="radio" name="r28" value="1" <?php echo $row->r28=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r28" value="3" <?php echo $row->r28=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr28" value="<?php echo $row->r28=="3"?$row->tr28:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>INDICA AUTORIZACION A CONSTRUCCION</td>
                                <td><div align="center">
                                  <input type="radio" name="r29" value="1" <?php echo $row->r29=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r29" value="3" <?php echo $row->r29=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr29" value="<?php echo $row->r29=="3"?$row->tr29:""; ?>"></td>
                            </tr>
<tr>     	
                                <td>VIGENTE</td>
                                <td><div align="center">
                                  <input type="radio" name="r30" value="1" <?php echo $row->r30=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r30" value="3" <?php echo $row->r30=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr30" value="<?php echo $row->r30=="3"?$row->tr30:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td colspan="4" style="background-color:#5494af; color:#FFFFFF; ">SI ES DE TIPO PREPAGO</td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO DE DEUDA</td>
                                <td><div align="center">
                                  <input type="radio" name="r31" value="1" <?php echo $row->r31=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r31" value="3"  <?php echo $row->r31=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr31" value="<?php echo $row->r31=="3"?$row->tr31:""; ?>"></td>
                            </tr>
                            <tr>     	
                                <td>A NOMBRE DEL POSTULANTE</td>
                                <td><div align="center">
                                  <input type="radio" name="r32" value="1" <?php echo $row->r32=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r32" value="3"  <?php echo $row->r32=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr32" value="<?php echo $row->r32=="3"?$row->tr32:""; ?>"></td>
                            </tr>
		                    <tr>     	
                                <td>VIGENTE</td>
                                <td><div align="center">
                                  <input type="radio" name="r33" value="1" <?php echo $row->r33=="1"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><div align="center">
                                  <input type="radio" name="r33" value="3"  <?php echo $row->r33=="3"?"checked=\"checked\"":""; ?>>
                                </div></td>
                                <td><input type="text" name="tr33" value="<?php echo $row->r33=="3"?$row->tr33:""; ?>"></td>
                            </tr>
  </tbody>
</table>
                    <br><br>
                    <SMALL><i>NO APLICA: El evaluador indica que este ítem no corresponde o no presenta observaciones en la postulación-</i> </SMALL>
<?php } //fin es observacion o corregida?>
                    
<?php } ?>
<br>
<br>
<?php
	}
}
$result->close();
$db->next_result();
$db->close();

?>
<?php if("MAYOR 4 DE OCTUBRE"==""){ ?>
<center><a class="filtro ingresar" href="#">Continuar con mi postulación</a></center>
<?php } ?>
<br>
<br>
<script>
<?php if (strpos($n,'OBSERVACIONES') !== false) { ?>
$(document).ready(function() {
window.parent.fnCambiaDialogoEscala('600',880);
});
<?php } ?>
<?php if ($llave == 1) { ?>
$(".ingresar").click(function(){
	window.parent.fnAbreFormularioObs(<?php echo $tipob; ?>);		
})
<?php } ?>
</script>