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
<h3>ANTECEDENTES POSTULANTE</h3>
<BR>
<?php if($_GET["b"]== "2"){ ?>
<p align="left" style="margin:0px"><span class="texto-titu3">POSTULANTE</span><span class="inline-link-g0"> <?php echo $row->NOMBRE_POSTULANTE." ".$row->PATERNO_POSTULANTE." ".$row->MATERNO_POSTULANTE; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">RUT</span><span class="inline-link-g0"> <?php echo $row->RUT_POSTULANTE."-".$row->DV_POSTULANTE; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">FECHA NACIMIENTO</span><span class="inline-link-g0"> <?php echo date("d/m/Y", strtotime($row->NACIMIENTO_POSTULANTE)); ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">TIPO</span><span class="inline-link-g0"> <?php echo $row->TIPO_POSTULANTE; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">ENSE&Ntilde;ANZA</span><span class="inline-link-g0"> <?php echo $row->ENSENA_POSTULANTE; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">PROMEDIO</span><span class="inline-link-g0"> <?php echo $row->PROMEDIONOTAS_POSTULANTE; ?></span></p>
<p align="left" style="margin:0px"><span class="texto-titu3">TIPO INSTITUCION</span><span class="inline-link-g0"> <?php echo $row->ESTABLECIMIENTO_POSTULANTE; ?></span></p>

<?php }elseif($_GET["b"]== "1"){ ?>

<?php } ?>
<?
}

$result->close();
$db->next_result();
$db->close();
 

?>