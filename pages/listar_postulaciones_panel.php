<?php 
//die();
require_once('../admin00921/conexion/conecta.php'); 
header('Content-type: content="text/html; charset=iso-8859-1');
if(!isset($_GET["r"]) || $_GET["r"] == "") die();
$r = $_GET["r"];
if(!isset($_GET["b"]) || $_GET["b"] == "") die();
$b = $_GET["b"];


//echo $_SERVER['HTTP_REFERER'];
if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) { 
	//die();
}

/*
   $time = time();
   $tiempo_actual = date('Y-m-d  H:i:s', $time);
   $strStart = $tiempo_actual;
   $strEnd   = '2017-07-20 23:59';    
   $dteStart = new DateTime($strStart);
   $dteEnd   = new DateTime($strEnd);
   $dteDiff  = $dteStart->diff($dteEnd);    
   if($dteStart < $dteEnd){
        echo "<script>console.log('no se ha cumplido la fecha');</script>";
   }else{
        echo "<script>console.log('se completo');</script>";
        die();
   }*/

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
<?php
date_default_timezone_set('America/Santiago'); 
//echo date("Y-m-d H:i:s")."<br>";
//contabiliza los dias que faltan para los resultados finales.
$datestr="2016-09-19 23:00:10";//Your date
$date=strtotime($datestr);//Converted to a PHP date (a second count)
$diff=$date-time();//time returns current time in seconds
$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=round(($diff-$days*60*60*24)/(60*60));
$daysv=floor($diff/(60*60*24));
//echo round(($diff/60),0);
//var_dump($_GET);

//contabiliza los dias que faltan para comenzar con las apelaciones de cada beca (estudios).
$datestrx="2016-05-30 00:00:00";//Your date
$datex=strtotime($datestrx);//Converted to a PHP date (a second count)
$diffx=$datex-time();//time returns current time in seconds
$daysx=floor($diffx/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hoursx=round(($diffx-$daysx*60*60*24)/(60*60));
$daysx=0;
$days_x=floor($diffx/(60*60*24));



if( ($b!="2222" ) ) {
    //&& round(($diff/60),0) > 0) ) {

    //echo "entre";

?>

<table>
             <tr>
                <th>RUT:</th>
                <th>Fecha:</th>
                <th>Estado:</th>
                <th></th>
            </tr>
        <?PHP
		if($b=="2"){
		$query = "select * from listar_postulaciones_panel_educacion where IDTIPOBECA = 2 AND RUT_TRABAJADOR = ".revisaSQL($r,"text")." ORDER BY FECHA_CREACION desc";
		}elseif($b=="1"){		
		$query = "select * from listar_postulaciones_panel_vivienda where IDTIPOBECA = 1 AND RUT_TRABAJADOR = ".revisaSQL($r,"text")." ORDER BY FECHA_CREACION desc";
        //die($query);
		}else die();
		
		//listar_postulaciones_panel_vivienda
		//echo "console.log('".$query."');";
		$result = $db->query($query);
		if($result){
			 while ($row = $result->fetch_object()){
			//var_dump($row);
		?>
            <tr>
                <td><?php 
				if($b=="2"){
					echo $row->RUT_POSTULANTE==""?"PENDIENTE":$row->RUT_POSTULANTE."-".$row->DV_POSTULANTE; 
				}else{
					echo $row->RUT_TRABAJADOR."-".$row->DV_TRABAJADOR; 
				}
				
				?></td>
                <td><?php
				$phpdate = strtotime( $row->FECHA_POSTULACION );
				$mysqldate = date( 'd/m/Y', $phpdate );
				 echo $mysqldate; ?></td>
                <td >
                <div style="display:inline; text-align:right;">
				<?php
                    $estadoactual = $row->IDESTADOBECA;
                    //echo $estadoactual;

                    $query_estadobeca = "select * from ESTADO_BECA where IDESTADOBECA = ".$estadoactual."";
                    $result_estadobeca = $db->query($query_estadobeca);

                    if($result_estadobeca){
                         while ($row2 = $result_estadobeca->fetch_object()){

                               $mensajeactual = $row2->ESTADO_BECA_GLOSA;

                             if($estadoactual == "1"){
                                 ?><img style="display: inline; margin: 0;" src="img/ic_pend.png" width="13" height="13" /><?php
                             } 
                             elseif($estadoactual == "5"){

                                if($b=="1"){
                                 ?>
                                 <img style="display: inline;margin: 0;" src="img/ic_ko.png" />
                                 <a onclick="ir_obs_final_v('<?php echo $row->IDPOSTULACION; ?>');" class="enlace" style="float: right;margin-right: 17px;" href="#">Ver Obs.</a>
                                 <?php }elseif($b == "1"){ ?>
                                 <img style="display: inline;margin: 0;" src="img/ic_ko.png" />
                                 <a onclick="ir_obs2('<?php echo $row->IDPOSTULACION; ?>');" class="enlace" style="float: right;margin-right: 17px;" href="#">Ver Obs.</a>
                                 <?php
                             }
                             }elseif($estadoactual == "3"){ ?>

							 <img style="float: left; margin: 0 3px 0 0;" src="img/ic_obs.png" />
                             <a onclick="ir_obs('<?php echo $row->IDPOSTULACION; ?>');" class="enlace" style="float: right;margin-right: 17px;" href="#">Ver Obs.</a>

                             <?}elseif($estadoactual == "6"){ 

                                if($b=="2"){
                                ?>

                             <img style="float: left; margin: 0 3px 0 0;" src="img/ic_ok.png" />
                             <a onclick="ir_obs_final('<?php echo $row->IDPOSTULACION; ?>');" class="enlace" style="float: right;margin-right: 17px;" href="#">Ver Obs.</a>
                            <?php }elseif($b == "1"){ ?>

                             <img style="float: left; margin: 0 3px 0 0;" src="img/ic_ok.png" />
                             <a onclick="ir_obs_final_v('<?php echo $row->IDPOSTULACION; ?>');" class="enlace" style="float: right;margin-right: 17px;" href="#">Ver Obs.</a>

                             <?php } }elseif($estadoactual == "2"){ ?>
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
                //$estadoactual = "3";
                //echo("estadoactual:" . $estadoactual);
                ?>

                <?php //echo $row->IDPOSTULACION; ?>

                <?php if($estadoactual == "1"){ ?>
                
                 <?php if($b == "2"){ ?>
                 <a onclick="ir_estudios('<?php echo $row->IDPOSTULACION; ?>');" class="encurso" href="#">Continuar</a>

                    </td>
                 <?php }else{ ?>
                 <a onclick="ir_vivienda('<?php echo $row->IDPOSTULACION; ?>');" class="encurso" href="#">Continuar</a>
                 </td>
                <?php } ?>
				
				<?php }elseif($estadoactual == "3"){ ?>
                
                <!--<a onclick="ir_vivienda_mod('<?php echo $row->IDPOSTULACION; ?>');" class="encurso" style="display:inline-block;" href="#">Continuar3</a></td>-->
                <?php if($b == "2"){ ?>
                <a onclick="ir_estudios_mod('<?php echo $row->IDPOSTULACION; ?>');" class="encurso" style="display:inline-block;" href="#">Continuar</a></td>
                <?php }else if($b == "1"){ ?>

                <a onclick="ir_vivienda_mod('<?php echo $row->IDPOSTULACION; ?>');" class="encurso" style="display:inline-block;" href="#">Continuar</a>

                <?php } ?>



                <?php }elseif($estadoactual == "5"){ ?>
                
                <!--<a onclick="ir_obs3('<?php echo $row->IDPOSTULACION; ?>');" class="enlace" href="#">Ver Obs.</a>--></td>

                <?php }elseif($estadoactual == "2"){ ?>

                        <script type="text/javascript">
                        var url = parent.(window.location.href);
var params = url.split('?');

alert(params[1]);
                        </script>
                        <?php 
                        if((strpos($_SERVER['HTTP_REFERER'], 'eval') === true)){
                        ?>
                        <a onclick="ir_estudios('<?php echo $row->IDPOSTULACION; ?>');" class="encurso" style="display:inline-block;" href="#">Continuar</a>
                        <?php 
                        }
                        ?>
                         </td>

                <?php }elseif($estadoactual == "9"){ ?>

                        <?php 
                        if((strpos($_SERVER['HTTP_REFERER'], 'eval') === true)){
                        ?>
                        <a onclick="ir_estudios('<?php echo $row->IDPOSTULACION; ?>');" class="encurso" style="display:inline-block;" href="#">Continuar</a>
                        <?php 
                        }
                        ?>             
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
 <?php }else{ 
 
		if($b=="114"){ 
 ?>
	 <table>
            <tr>
                <th>RUT:</th>
                <th>Fecha:</th>
                <th>Estado:</th>
                <th></th>
            </tr>
        <?PHP
		if($b=="2"){
			//$query = "select * from RESULTADOS_FINALES_BECAS_ESTUDIOS_2016 where RUT_TRABAJADOR = ".revisaSQL($r,"text")." ORDER BY RUT_TRABAJADOR desc";
		}elseif($b=="1"){	
			//$query = "select * from RESULTADOS_FINALES_BECAS_VIVIENDA_2017 where RUT_TRABAJADOR = ".revisaSQL($r,"text")." ORDER BY RUT_TRABAJADOR desc";	
			$query = "select * from listar_postulaciones_panel_vivienda where IDTIPOBECA = 1 AND RUT_TRABAJADOR = ".revisaSQL($r,"text")." ORDER BY FECHA_CREACION desc";
			//$query = "-1";
		}else die();
		$result = $db->query($query);
		if($result){
		 while ($row = $result->fetch_object()){
		?>
            <!---<tr>
                <td><?php
					echo $row->RUT_P; 
				?></td>
                <td>
				<span  style="display: inline"><?php echo $row->ESTADO_ADJ; ?></span>
                </td>
                <td>
                <a onclick="ir_obs_final_v('<?php echo $row->IDPOSTULACION; ?>');" class="enlace" href="#">Ver Obs.</a>
                </td>
                

            </tr>-->
             <tr>
                <td><?php 
                if($b=="2"){
                    echo $row->RUT_POSTULANTE==""?"PENDIENTE":$row->RUT_POSTULANTE."-".$row->DV_POSTULANTE; 
                }else{
                    echo $row->RUT_TRABAJADOR."-".$row->DV_TRABAJADOR; 
                }
                
                ?></td>
                <td><?php
                $phpdate = strtotime( $row->FECHA_POSTULACION );
                $mysqldate = date( 'd/m/Y', $phpdate );
                 echo $mysqldate; ?></td>
                <td >
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
 
 <?php } }?>