<?php include("../conexion/conecta.php"); ?>
<style>
div.pager {
    text-align: center;
    margin: 1em 0;
}

div.pager span {
    display: inline-block;
    width: 1.8em;
    height: 1.8em;
    line-height: 1.8;
    text-align: center;
    cursor: pointer;
    background: #646464;
    color: #fff;
    margin-right: 0.5em;
	margin-bottom: 0.5em;
}

div.pager span.active {
    background: #c00;
}
</style>
<?php

$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);
$arr = get_defined_vars();
//var_dump($f);
$buffer = "";

if(isset($q)){
$buffer = "";
}else if(isset($n)){
 if($n != ""){
	$tempInput = explode(" ",$n);
	foreach($tempInput as $values)
	{
		$buffer .= "NOMBRECOMPLETO like '%".$values."%' and ";
	}
	$buffer = substr($buffer,0,-4); 
	$buffer = " WHERE ".$buffer;
  }
}else if(isset($r)){
	if(!empty($r)){
		$buffer = "  WHERE RUT_TRABAJADOR = '".$r."'"; 
	}else{
		$buffer = ""; 
	}
  
}else if(isset($p)){
	if(!empty($p)){
		$buffer = "  WHERE RUT_POSTULANTE = '".$p."'"; 
	}else{
		$buffer = ""; 
	}
  
}else if(isset($f)){
	if(!empty($f)){
		switch($f){
		case "1": $buffer = "  WHERE ESTADO_BECA = 'EN CURSO'"; break;
		case "2": $buffer = "  WHERE ESTADO_BECA = 'POSTULADA'"; break;
		case "3": $buffer = "  WHERE ESTADO_BECA = 'OBSERVACIONES'"; break;
		case "4": $buffer = "  WHERE ESTADO_BECA = 'CORREGIDA'"; break;
		case "5": $buffer = "  WHERE ESTADO_BECA = 'RECHAZADA'"; break;
		case "6": $buffer = "  WHERE ESTADO_BECA = 'ADJUDICADA'"; break;
		case "7": $buffer = "  WHERE ESTADO_BECA = 'PENDIENTE AUDITOR'"; break;
		
		case "8": $buffer = "  WHERE IDEVALUADOR is null"; break;
		case "9": $buffer = "  WHERE IDEVALUADOR = ".$_SESSION["idusuario"]; break;
		case "10": $buffer = "  WHERE IDEVALUADOR is not null AND IDEVALUADOR <> ".$_SESSION["idusuario"]; break;
		
		case "11": $buffer = "  WHERE ESTADO_BECA = 'DESACTIVADA'"; break;
		}
	}else{
		$buffer = ""; 
		//echo "sin nada";
	}
  
}

$query = "select * from listar_busqueda_mix".$buffer." ORDER BY IDESTADOBECA DESC";

//echo $query;
//echo "<script>console.log(\"".$query."\");</script>";
//die();
$result = $db->query($query);
$numRows = $result->num_rows;

?>
<h3>RESULTADOS (<?php echo $numRows; ?>)</h3>
<table id="tabla_listar_cola" class="rounded-corner paginated" style="width:100%;padding: 0; margin:0; font-size:11px;">
<thead>
     	<tr>     	
            <td style="background-color:#E6F1F5; font-weight:bold;">TRABAJADOR</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">POSTULANTE</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">NOMBRE</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">AUDITOR</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">BECA</td>
            <td style="background-color:#E6F1F5; font-weight:bold;">ESTADO</td>
        </tr>
</thead>
<tbody>
<?php
if($result){
    while ($row = $result->fetch_object()){
	
	if($row->IDTIPOBECA == 1){
		$linkx = $row->IDPONDVIVIENDA;
	}else if($row->IDTIPOBECA == 2){
		$linkx = $row->IDPONDEDUCACION;
		//$linkx = 5;
		// VALOR ASIGNADO TEMPORALMENTE HASTA QUE SE INCLUYA IDPONDEDUCACION EN LA VISTA listar_busqueda
	}
?>
     	<tr>     	
            <td><?php 

	if(($_SESSION["perfil"]=="2" || $_SESSION["perfil"]=="3")){ ?>
    
    <a href="#" onclick="$(this).AbrirPostulacion('<?php echo $row->IDPOSTULACION; ?>','<?php echo $row->IDTIPOBECA; ?>','<?php echo $linkx; ?>');return false;">
	
	<?php //}elseif(($row->IDEVALUADOR=="" || $row->IDEVALUADOR==$_SESSION["idusuario"]) && ($row->ESTADO_BECA=="EN CURSO" || $row->ESTADO_BECA=="OBSERVACIONES" || $row->ESTADO_BECA=="POSTULADA" || $row->ESTADO_BECA=="PENDIENTE AUDITOR")){ ?>
    
    <?php 

    }elseif($_SESSION["perfil"]=="1"){
    
        if($row->IDESTADOBECA == "0"){

        }else{
    ?>



    <a href="#" onclick="$(this).AbrirPostulacion('<?php echo $row->IDPOSTULACION; ?>','<?php echo $row->IDTIPOBECA; ?>','<?php echo $linkx; ?>');return false;">
    <?php

    }
	//permite solo que se puedan ver casos modificados.
//	}elseif($row->IDTIPOBECA == 2){

	//echo "<a href='#' class='not-active'>";
		
	//}elseif(($row->IDEVALUADOR=="" || $row->IDEVALUADOR==$_SESSION["idusuario"]) && $row->FECHA_MODIFICACION!="" && $row->ESTADO_BECA=="CORREGIDA"){ 
	}elseif(($row->IDEVALUADOR=="" || $row->IDEVALUADOR==$_SESSION["idusuario"]) && ($row->ESTADO_BECA=="CORREGIDA" || $row->ESTADO_BECA=="POSTULADA" || $row->ESTADO_BECA=="PENDIENTE AUDITOR")){

    ?>
    <a href="#" onclick="$(this).AbrirPostulacion('<?php echo $row->IDPOSTULACION; ?>','<?php echo $row->IDTIPOBECA; ?>','<?php echo $linkx; ?>');return false;">
	
	<?php } ?>
	
	<?php echo $row->RUT_TRABAJADOR; ?>
    
    </a>
    <?php
    //echo "(".$row->IDESTADOBECA.")";
    ?>

    </td>
                        <!--<td><a href="#" onclick="$(this).AbrirPostulacion('<?php echo $row->IDPOSTULACION; ?>','<?php echo $row->IDTIPOBECA; ?>','<?php echo $linkx; ?>');return false;"><?php echo $row->RUT_TRABAJADOR; ?></a></td>-->
            <td><?php echo $row->RUT_POSTULANTE; ?></td>
            <td style="line-height: 12px;"><?php echo $row->NOMBRE_TRABAJADOR." ".$row->PATERNO_TRABAJADOR." ".$row->MATERNO_TRABAJADOR."<br><small style='clear:both; font-size:10px;'>".$row->FECHA_NACIMIENTO."</small>"; ?></td>
            <td><?php if($row->IDEVALUADOR==""){ ?><span><a href='#' class='inline-link-g2'>NUEVO</a></span><?php }else if($row->IDEVALUADOR==$_SESSION["idusuario"]){ ?><span><a href='#' class='inline-link-g3'>TUYO</a></span> <? }else{ ?><span><a href='#' class='inline-link-g1'>TOMADO</a></span> <? } ?></td>
            <td><?php echo $row->IDTIPOBECA==1?"VIVIENDA":"ESTUDIOS"; ?></td>
            <td <?php if($row->ESTADO_BECA=="EN CURSO"){ ?>style='background-color:#D40D12; color:#FFFFFF;' <?php }elseif($row->ESTADO_BECA=="POSTULADA"){ ?>style='background-color:#BBFF80; color:#000;' <?php }elseif($row->ESTADO_BECA=="DESACTIVADA"){ ?>style='background-color:#cc6695; color:#000;' <?php }else{ ?>style='background-color:#F0D770; color:#000;' <?php } ?>><?php echo $row->ESTADO_BECA; ?>
            <?php if($row->FECHA_MODIFICACION!="" && $row->ESTADO_BECA=="CORREGIDA"){ echo "<br>".$row->FECHA_MODIFICACION; } ?>
            </td>
        </tr>
 <?php   }
     $result->close();
     $db->next_result();
}
else echo($db->error);
$db->close();
?>
    </tbody>
     </table>
     
     <script>

$('table.paginated').each(function() {
    var currentPage = 0;
    var numPerPage = 100;
    var $table = $(this);
    $table.bind('repaginate', function() {
        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    var numRows = $table.find('tbody tr').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pager"></div>');
    for (var page = 0; page < numPages; page++) {
        $('<span class="page-number"></span>').text(page + 1).bind('click', {
            newPage: page
        }, function(event) {
            currentPage = event.data['newPage'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');
        }).appendTo($pager).addClass('clickable');
    }
    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
});
	 </script>
