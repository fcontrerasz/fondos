<?php require_once('../admin00921/conexion/conecta.php'); 
header('Content-type: content="text/html; charset=iso-8859-1');
if(!isset($_GET["r"]) || $_GET["r"] == "") die();
$r = $_GET["r"];
//echo $_SERVER['HTTP_REFERER'];
if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) { 
	//die();
}
?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
    $(function() {
        //$( window ).tooltip();
    });
</script>

<style>
.ui-tooltip
{
    font-size:12px;
    font-weight: bold;
}
</style>

   
<table>
             <tr>
                <th>RUT:</th>
                <th>Fecha:</th>
                <th>Estado:</th>
                <th></th>
            </tr>
        <?PHP
		$query = "select * from listar_postulaciones_panel_educacion where IDTIPOBECA = 2 AND RUT_TRABAJADOR = ".revisaSQL($r,"text")." ORDER BY FECHA_CREACION desc";
		//echo $query;
		$result = $db->query($query);
		if($result){
			 while ($row = $result->fetch_object()){
			// var_dump($row);
		?>
            <tr>
                <td><?php echo $row->RUT_POSTULANTE==""?"PENDIENTE":$row->RUT_POSTULANTE."-".$row->DV_POSTULANTE; ?></a></td>
                <td><?php
				$phpdate = strtotime( $row->FECHA_POSTULACION );
				$mysqldate = date( 'd/m/Y', $phpdate );
				 echo $mysqldate; ?></td>
                <td >
                <div style="display:inline; text-align:right;">
				<?php
                    $estadoactual = $row->IDESTADOBECA;

                    $query_estadobeca = "select * from ESTADO_BECA where IDESTADOBECA = ".$estadoactual."";
                    $result_estadobeca = $db->query($query_estadobeca);

                    if($result_estadobeca){
                         while ($row2 = $result_estadobeca->fetch_object()){

                               $mensajeactual = $row2->ESTADO_BECA_GLOSA;

                             if($estadoactual == "1"){
                                 ?><img style="display: inline; margin: 0;" src="img/ic_pend.png" width="13" height="13" /><?php
                             } 
                             elseif($estadoactual == "5"){
                                 ?>
                                 <img style="display: inline;margin: 0;" src="img/ic_ko.png" />
                                 <a onclick="ir_obs2('<?php echo $row->IDPOSTULACION; ?>');" class="enlace" style="float: right;margin-right: 17px;" href="#">Ver Obs3.</a>
                                 <?php
                             }elseif($estadoactual == "3"){ ?>

							 <img style="float: left; margin: 0 3px 0 0;" src="img/ic_obs.png" />
                             <a onclick="ir_obs2('<?php echo $row->IDPOSTULACION; ?>');" class="enlace" style="float: right;margin-right: 17px;" href="#">Ver Obs3.</a>

                             <?php }elseif($estadoactual == "2"){ ?>
							 <img style="display: inline;margin: 0;" src="img/ic_ok.png" />
							
                             <?php }else{
                                 ?>&nbsp;<?php
                             }
                         }
                    }
                    ?>
				
				<span  style="display: inline"><?php echo $row->ESTADO_BECA; ?></span>
                </div>
                </td>
                <td>
                
                <?php
                //solo con proposito de test -> COMENTAR
                $estadoactual = "3";
                ?>

                <?php //echo $row->IDPOSTULACION; ?>

                <?php if($estadoactual == "1"){ ?>
                
               </td>
                
                <?php }elseif($estadoactual == "3"){ ?>
                
                <a onclick="ir_vivienda('<?php echo $row->IDPOSTULACION; ?>');" class="encurso" style="display:inline-block;" href="#">Continuar</a></td>
 
                <?php }elseif($estadoactual == "5"){ ?>
                
                </td>


                <?php }else{ ?>
                
                <?php }?>
            </tr>
         <?PHP
		}
			 $result->close();
			 $db->next_result();
		}
		else echo($db->error);
		$db->close();
		 ?>
            
        </table>

