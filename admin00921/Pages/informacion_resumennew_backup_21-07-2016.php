<?php include("../conexion/conecta.php"); ?>
<?php
if(!isset($_GET["i"])) die("-1");

$query = "select * from listar_resumen_basico WHERE IDPOSTULACION = ".$_GET["i"];

//die($query);

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows>0){

$row = $result->fetch_object();
$nombretitular =$row->NOMBRETRABAJADOR;
$estadopostulacion =$row->ESTADO_BECA;
$evaluador = ($row->USUARIO_NOMBRE)?$row->USUARIO_NOMBRE:"SIN EVALUADOR";

}

$result->close();
$db->next_result();


if($_GET["b"]==1){
$query = "select * from Listar_Ponderacion_Vivienda WHERE IDPOSTULACION = ".$_GET["i"];
}

if($_GET["b"]==2){
$query = "select * from Listar_Ponderacion_Estudios WHERE IDPOSTULACION = ".$_GET["i"];
}

//echo $_SESSION["perfil"];;


$result = $db->query($query);
$numRows = $result->num_rows;
if($numRows>0){
	$row = $result->fetch_object();
	$nota =$row->ponderacion;
	$fecha =$row->fecha_mod;
}
$result->close();
$db->next_result();


?>
<fieldset>
                    		<H2 style="width:650px;">NOMBRE TITULAR (ID:<?php echo $_GET["i"]; ?>): <?php echo $nombretitular; ?></H2>
                            <H2 style="width:650px;">EVALUADOR <span class="texto-titu2" style="color:#C66653; font-size:16px;"><?php echo $evaluador; ?> </span></H2>
                            <H2 class="texto-titu2">Estado actual de la postulaci&oacute;n  <a href='#' class='inline-link-g0'><?php echo $estadopostulacion; ?></a>, cambiar a <span >
                    <select id="epaso1" name="epaso1" class="text-observaciones" style="float:none !important">
                    <option value="0">-</option>
                    <?php
					//echo "call trae_avance(".$_GET["i"].")";
					//die("call trae_avance(".$_GET["i"].")");
					
							if($_SESSION["perfil"]=="2"){
							
							$result = $db->query("select IDESTADOBECA, ESTADO_BECA from ESTADO_BECA where  IDESTADOBECA in (10,3,5,7);");
							}else if($_SESSION["perfil"]=="3"){
							$result = $db->query("select IDESTADOBECA, ESTADO_BECA from ESTADO_BECA where  IDESTADOBECA in (10,3,2,1,5,7);");
							}else{
								
							$result = $db->query("call trae_avance(".$_GET["i"].")");
							
							}
							
							if($result){
								while ($row = $result->fetch_object()){
										if($row->IDESTADOBECA!=""){
											echo "<option value='".$row->IDESTADOBECA."'>".$row->ESTADO_BECA."</option>";
										}
								}
							$result->close();
							$db->next_result();
							}
							else echo($db->error);
							echo "</select>";
							$db->close();
					
					
					?>
                          
                    </span></H2><br />
                    		<H2 style="width:650px;">PONDERACION ACTUAL <span class="texto-titu2" style="color:#C66653; font-size:18px;"><?php echo $nota; ?></span>  Modificada el <span class="texto-titu2" style="color:#C66653; font-size:15px;"><?php echo $fecha; ?> </span></H2>

         			
                    
         </fieldset>
         

         
                


<?

 

?>