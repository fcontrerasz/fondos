<?php include("../conexion/conecta.php"); ?>
<?php
if(!isset($_GET["i"])) die("-1");
if(!isset($_GET["b"])) die("-1");

$query = "select * from listar_resumen_basico WHERE IDPOSTULACION = ".revisaSQL($_GET["i"], "int")." and IDTIPOBECA = ".revisaSQL($_GET["b"], "int");

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows>0){

$row = $result->fetch_object();

$renta = "$".number_format($row->RENTA_TRABAJADOR, 0);
$renta =  str_replace(',', '.', $renta);

?>
<h3>ANTECEDENTES TRABAJADOR</h3>
<BR>
<p align="left" style="margin:0px"><span class="texto-titu3" style="display:inline; text-align:left;">NOMBRE</span><span class="inline-link-g0"><?php echo $row->NOMBRETRABAJADOR; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">RUT</span><span class="inline-link-g0"> <?php echo $row->RUTEMPLEADO; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">TIPO DE EMPRESA</span><span class="inline-link-g0"> <?php echo $row->TIPO_EMPRESA; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">RUT EMPRESA</span><span class="inline-link-g0"> <?php echo $row->RUTEMPRESA; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">RAZON SOCIAL</span><span class="inline-link-g0"> <?php echo $row->RAZONSOCIAL; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">FECHA CONTRATISTA</span><span class="inline-link-g0"> <?php echo $row->FECHA_CONTRATO; ?></span></p>
<!--<H4 style="text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">NUMERO CONTRATO</span><span class="inline-link-g0"> <?php echo $row->CONTRATO; ?></span></H4>-->
<p align="left" style="margin:0px"><span class="texto-titu3">DIVISION</span><span class="inline-link-g0"> <?php echo $row->DIVISION; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">RENTA</span><span class="inline-link-g0"> <?php echo $renta; ?></span></p>
<?
}

$result->close();
$db->next_result();
$db->close();
 

?>