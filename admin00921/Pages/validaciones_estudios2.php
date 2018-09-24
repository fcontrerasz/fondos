<?php include("../conexion/conecta.php");
//header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<?php
error_reporting(E_ALL);

if(!isset($_GET["i"])) die("-1");
if(!isset($_GET["b"])) die("-1");
if(!isset($_GET["l"])) die("-1");

if($_GET["l"]==""){
 die("<h2>La postulaci&oacute;n no puede ser evaluada. Revise si esta postulaci&oacute;n no se encuentra en curso o ha sido eliminada.</h2>");
}

$query = "select * from  listar_evaluadores_estudios where IDPONDEDUCACION = ".$_GET["l"]." and IDESTADOBECA IN (2,3,4,7,9)";

//echo $query;

$result = $db->query($query);
$numRows = $result->num_rows;

//echo($db->error);

if($numRows < 1){
 die("La postulación no puede ser evaluada. Revise si esta postulación no se encuentra en curso o ha sido eliminada");
}

$row = $result->fetch_object();



?>
<input type="hidden" class="nota" name="nota" id="nota" value="" />
<table id="sort02" class="rounded-corner" style="width:100%;padding: 0; margin:0; text-align:left;">
					<thead>
                            <tr>     	
                                <td colspan="5"  style="background-color:#CC0000; color:#FFFFFF; ">ANTECEDENTES TRABAJADOR</td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="height:80PX; background-color:#F3F3F3 ">
                                <div style="height:20px" class="clear"></div>
									    <?PHP if($_GET["b"]==2){ 
										
										$renta = "$".number_format($row->RENTA_TRABAJADOR, 0);
										$renta =  str_replace(',', '.', $renta);
										
										?>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">NOMBRE TRABAJADOR</span> <?php echo $row->NOMBRE_TRABAJADOR." ".$row->PATERNO_TRABAJADOR." ".$row->MATERNO_TRABAJADOR; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">RUT</span> <?php echo $row->RUT_TRABAJADOR."-".$row->DV_TRABAJADOR; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">TIPO EMPRESA</span> <?php echo $row->TIPO_EMPRESA; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">RAZON SOCIAL</span> <?php echo $row->RAZONSOCIAL; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">DIVISION</span> <?php echo $row->DIVISION; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">RENTA PROMEDIO</span> <?php echo $renta; ?></h4>
                                    <?php } ?>
                                <div style="height:20px" class="clear"></div>
                                </td>
                            </tr>
                    </thead>
                    <thead>
                            <tr>     	
                                <td colspan="5"  style="height:20px; background: none !important; border: 0px !Important; ">&nbsp;</td>
                            </tr>
                      </thead>
                    <thead>
                            <tr>     	
                                <td style="background-color:#FBFBFB; font-weight:bold; height:20px; text-align:left; border-top: 1px solid white;">&nbsp;</td>
                                <td style="background-color:#E6F1F5; font-weight:bold;">SI</td>
                                <td style="background-color:#E6F1F5; font-weight:bold;">NO</td>
                                <td style="background-color:#E6F1F5; font-weight:bold;">OBS</td>
                                 
                                <td style="background-color:#E6F1F5; font-weight:bold;width: 200px;">N/A    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OBSERVACIONES</td>
                            </tr>
                    </thead>
                    <tbody>
                             <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">ANTECEDENTES GENERALES</td>
                            </tr>
                            <tr>     	
                                <td>DECLARACION JURADA</td>
                                <td><input type="radio" name="r1" value="1" <?php echo $row->r1=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r1" value="2" <?php echo $row->r1=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r1" value="3" <?php echo $row->r1!="1" && $row->r1!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r1=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="1" /> <input type="text"  name="tr1" value="<?php echo $row->r1=="3"?$row->tr1:""; ?>" ></td>
                            </tr>
                            <!--<tr>     	
                                <td>POSTULACION ANTERIOR</td>
                                <td><input type="radio" name="r2" value="1" <?php echo $row->r2=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r2" value="2" <?php echo $row->r2=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r2" value="3"  <?php echo $row->r2!="1" && $row->r2!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r2=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="2" /> <input type="text"  name="tr2" value="<?php echo $row->r2=="3"? $row->tr2:""; ?>" ></td>
                            </tr>-->
                            <tr>     	
                                <td>CONTRATO DE TRABAJO</td>
                                <td><input type="radio" name="r3" value="1" <?php echo $row->r3=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r3" value="2" <?php echo $row->r3=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r3" value="3"  <?php echo $row->r3!="1" && $row->r3!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r3=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="3" /> <input type="text"  name="tr3" value="<?php echo $row->r3=="3"? $row->tr3:""; ?>" ></td>
                            </tr>
                            <!--<tr>     	
                                <td><IMG src="style/img/warning.png" alt="Ingresar Remuneracion Correcta">&nbsp;CAMBIAR NUMERO DE CONTRATO</td>
                                <td><input type="radio" name="r4" value="1" <?php echo $row->r4=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r4" value="2" <?php echo $row->r4=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="text" style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;" name="tr4" id="tr4" value="<?php echo $row->tr4; ?>" <?php echo $row->r4=="2" ?"disabled=\"disabled\"":""; ?>></td>
                            </tr>-->
                            <tr>     	
                                <td>LIQUIDACION DE SUELDO 1</td>
                                <td><input type="radio" name="r5" value="1" <?php echo $row->r5=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r5" value="2" <?php echo $row->r5=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r5" value="3"  <?php echo $row->r5!="1" && $row->r5!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r5=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="5" /> <input type="text"  name="tr5" value="<?php echo $row->r5=="3"? $row->tr5:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>LIQUIDACION DE SUELDO 2</td>
                                <td><input type="radio" name="r6" value="1" <?php echo $row->r6=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r6" value="2" <?php echo $row->r6=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r6" value="3"  <?php echo $row->r6!="1" && $row->r6!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r6=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="6" /> <input type="text"  name="tr6" value="<?php echo $row->r6=="3"? $row->tr6:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>LIQUIDACION DE SUELDO 3</td>
                                <td><input type="radio" name="r7" value="1" <?php echo $row->r7=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r7" value="2" <?php echo $row->r7=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r7" value="3"  <?php echo $row->r7!="1" && $row->r7!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r7=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="7" /> <input type="text"   name="tr7" value="<?php echo $row->r7=="3"? $row->tr7:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>MONTO REMUNERACION 1</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              <td>&nbsp;</td>
                                <td><input type="text"  style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;"  name="tr8" id="tr8" value="<?php echo $row->tr8; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>MONTO REMUNERACION 2</td>
                                <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                                <td><input type="text"  style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;" name="tr9" id="tr9" value="<?php echo $row->tr9; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>MONTO REMUNERACION 3</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              <td>&nbsp;</td>
                                <td><input type="text"  style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;" name="tr10" id="tr10" value="<?php echo $row->tr10; ?>" ></td>
                            </tr>
                            <!--<tr>     	
                                <td>PROMEDIO DE REMUNERACION</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              <td><input type="text"   style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;" name="tr8" value="<?php echo $row->r8=="3"? $row->tr8:""; ?>" ></td>
                            </tr>-->
                            <tr>     	
                                <td>PROMEDIO REMUNERACION CALCULADO</td>
                                <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                                <td><input disabled="disabled" type="text" id="tr11" style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;"  name="tr11" value="<?php echo $row->tr11; ?>" <?php echo $row->r11=="2" ?"disabled=\"disabled\"":""; ?>></td>
                            </tr>
                            
                          </tbody>
                                              <tbody>
                            <tr>     	
                                <td colspan="5"  style="height:20px; background: none !important; border: 0px !Important; ">&nbsp;</td>
                            </tr>
                      </tbody>
                          <tbody id="validaciones_estudios">
                             <tr>     	
                                <td colspan="5"  style="background-color:#CC0000; color:#FFFFFF; ">ANTECEDENTES ESTUDIOS</td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="height:80PX; background-color:#F3F3F3 ">
                                <div style="height:20px" class="clear"></div>
									    <?PHP if($_GET["b"]==2){ ?>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">NOMBRE POSTULANTE</span> <?php echo $row->NOMBRE_POSTULANTE." ".$row->PATERNO_POSTULANTE." ".$row->MATERNO_POSTULANTE; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">RUT</span> <?php echo $row->RUT_POSTULANTE."-".$row->DV_POSTULANTE; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">FECHA NACIMIENTO</span> <?php echo date("d/m/Y", strtotime($row->NACIMIENTO_POSTULANTE)); ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">TIPO POSTULANTE</span> <?php echo $row->TIPO_POSTULANTE; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">ENSE&Ntilde;ANZA QUE CURSA</span> <?php echo $row->ENSENA_POSTULANTE; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">PROMEDIO NOTAS</span> <?php echo $row->PROMEDIONOTAS_POSTULANTE; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">TIPO INSTITUCION</span> <?php echo $row->ESTABLECIMIENTO_POSTULANTE; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">INSTITUCION A&Ntilde;O ANTERIOR</span> <?php echo $row->ANTENSENA_POSTULANTE; ?></h4>
                                    <?php } ?>
                                <div style="height:20px" class="clear"></div>
                                </td>
                            </tr>
                            </tbody>
                                                                         <tbody>
                            <tr>     	
                                <td colspan="5"  style="height:20px; background: none !important; border: 0px !Important; ">&nbsp;</td>
                            </tr>
                      </tbody>
                        <thead>
                                <tr>        
                                    <td style="background-color:#FBFBFB; font-weight:bold; text-align:left; border-top: 1px solid white;">&nbsp;</td>
                                    <td style="background-color:#E6F1F5; font-weight:bold;">SI</td>
                                    <td style="background-color:#E6F1F5; font-weight:bold;">NO</td>
                                    <td style="background-color:#E6F1F5; font-weight:bold;">OBS</td>
                                    <td style="background-color:#E6F1F5; font-weight:bold;width: 200px;">N/A    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OBSERVACIONES</td>
                                </tr>
                        </thead>
                            <tbody>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">TIPO POSTULANTE</td>
                            </tr>
                            <tr>     	
                                <td>COINCIDE CON LO DECLARADO</td>
								<td><input type="radio" name="r19" value="1" <?php echo $row->r19=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r19" value="2" <?php echo $row->r19=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><!--<input type="radio" name="r19" value="3"  <?php echo $row->r19!="1" && $row->r19!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r19=="3"?"checked=\"checked\"":""; ?> >--></td>
                                <td><input type="text" style="display:none;"   id="tr19" name="tr19" value="<?php echo $row->tr19; ?>" >
									<!--<select name="destino_val" id="destino_val" class="uniformselect tooltipstered" style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;" <?php echo $row->r19=="1"?"disabled=\"disabled\"":""; ?>>
                                        <option value="0">Selecione</option>
										<option value="COMPRA" <?php echo $row->tr19=="COMPRA"?"selected":""; ?>>COMPRAR UNA VIVIENDA</option>
                                        <option value="CONSTRUIR - TERRENO POSTULANTE" <?php echo $row->tr19=="CONSTRUIR - TERRENO POSTULANTE"?"selected":""; ?>>CONST TERRENO POSTULANTE</option>
										<option value="CONSTRUIR - TERRENO FAMILIAR" <?php echo $row->tr19=="CONSTRUIR - TERRENO FAMILIAR"?"selected":""; ?>>CONST TERRENO FAMILIA</option>
                                        <option value="PREPAGO" <?php echo $row->tr19=="PREPAGO"?"selected":""; ?>>PREPAGAR LA VIVIENDA</option>
                                    </select>-->
                                    
                                    <select name="destino" id="destino" class="uniformselect tooltipstered" style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;"  <?php echo $row->r19=="1"?"disabled=\"disabled\"":""; ?>>
                                        <option value="0" <?php echo $row->tr19==""?"selected":""; ?>>Seleccione</option>
										<option value="HIJO" <?php echo $row->tr19=="HIJO"?"selected":""; ?>>HIJO DEL TRABAJADOR</option>
                                        <option value="CONYUGE" <?php echo $row->tr19=="CONYUGE"?"selected":""; ?>>CONYUGE DEL TRABAJADOR</option>
                                        <option value="CONVIVIENTE" <?php echo $row->tr19=="CONVIVIENTE"?"selected":""; ?>>CONVIVIENTE DEL TRABAJADOR</option>
                                        <option value="TRABAJADOR" <?php echo $row->tr19=="TRABAJADOR"?"selected":""; ?>>TRABAJADOR</option>
                                    </select>
								
								</td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">TIPO INSTITUCION A&Ntilde;O ANTERIOR</td>
                            </tr>
                            <tr>     	
                                <td>COINCIDE CON LO DECLARADO 
                                 </td>
								<td><input type="radio" name="r20" value="1" <?php echo $row->r20=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r20" value="2" <?php echo $row->r20=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><!--<input type="radio" name="r19" value="3"  <?php echo $row->r20!="1" && $row->r20!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r20=="3"?"checked=\"checked\"":""; ?> >--></td>
                                <td><input type="text" style="display:none;"   id="tr20" name="tr20" value="<?php echo $row->tr20; ?>" >                                 
                                   <select id="ensenanzabene_select" name="ensenanzabene_select" class="uniformselect tooltipstered"  style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;">
                                        <option value="0" <?php echo $row->tr20==""?"selected":""; ?>>Seleccione</option>
                                        <option value="UNIVERSIDAD" <?php echo $row->tr20=="UNIVERSIDAD"?"selected":""; ?>>UNIVERSIDAD</option>
                                        <option value="INSTITUTO PROFESIONAL" <?php echo $row->tr20=="INSTITUTO PROFESIONAL"?"selected":""; ?>>INSTITUTO PROFESIONAL</option>
                                        <option value="FUERZAS ARMADAS" <?php echo $row->tr20=="FUERZAS ARMADAS"?"selected":""; ?>>FUERZAS ARMADAS</option>
                                        <option value="ENSENANZA MEDIA" <?php echo $row->tr20=="ENSENANZA MEDIA"?"selected":""; ?>>ENSE&Ntilde;ANZA MEDIA</option>
                                        <option value="CFT" <?php echo $row->tr20=="CFT"?"selected":""; ?>>CFT</option>
                                        <option value="OTRO" <?php echo $row->tr20=="OTRO"?"selected":""; ?>>OTRO</option>
                                    </select>								
								</td>
                            </tr>
                           <!-- <tr>     	
                                <td>TIPO DE INSTITUCION</td>
                                <td><input type="radio" name="r20" value="1" <?php echo $row->r20=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r20" value="2" <?php echo $row->r20=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r20" value="3"  <?php echo $row->r20!="1" && $row->r20!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r20=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="20" /> <input type="text" name="tr20" value="<?php echo $row->r20=="3"? $row->tr20:""; ?>" ></td>
                            </tr>-->
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">ALUMNO REGULAR</td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO DE ALUMNO</td>
                                <td><input type="radio" name="r21" value="1" <?php echo $row->r21=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r21" value="2" <?php echo $row->r21=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r21" value="3"  <?php echo $row->r21!="1" && $row->r21!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r21=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="21" /> <input type="text" name="tr21" value="<?php echo $row->r21=="3"? $row->tr21:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO VIGENTE</td>
                                <td><input type="radio" name="r22" value="1" <?php echo $row->r22=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r22" value="2" <?php echo $row->r22=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r22" value="3"  <?php echo $row->r22!="1" && $row->r22!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r22=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="22" /> <input type="text" name="tr22" value="<?php echo $row->r22=="3"? $row->tr22:""; ?>" ></td>
                            </tr>
                             <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">CONCENTRACION DE NOTAS</td>
                            </tr>
                            <tr>     	
                                <td>CONCENTRACION DE NOTAS</td>
                                <td><input type="radio" name="r23" value="1" <?php echo $row->r23=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r23" value="2" <?php echo $row->r23=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r23" value="3"  <?php echo $row->r23!="1" && $row->r23!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r23=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="23" /> <input type="text" name="tr23" value="<?php echo $row->r23=="3"? $row->tr23:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>CORRESPONDE A PERIODO ANTERIOR</td>
                                <td><input type="radio" name="r24" value="1" <?php echo $row->r24=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r24" value="2" <?php echo $row->r24=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r24" value="3"  <?php echo $row->r24!="1" && $row->r24!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r24=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="24" /> <input type="text" name="tr24" value="<?php echo $row->r24=="3"? $row->tr24:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>PROMEDIO DE NOTAS IGUAL O SUPERIOR A 4</td>
                                <td><input type="radio" name="r25" value="1" <?php echo $row->r25=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r25" value="2" <?php echo $row->r25=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r25" value="3"  <?php echo $row->r25!="1" && $row->r25!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r25=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="25" /> <input type="text" name="tr25" value="<?php echo $row->r25=="3"? $row->tr25:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>INGRESAR PROMEDIO DE NOTAS</td>
                                <td><input type="radio" name="r26" value="1" <?php echo $row->r26=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r26" value="2" <?php echo $row->r26=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td>&nbsp;</td>
                                <td><input type="hidden" id="r26_old" value="<?php echo $row->PROMEDIONOTAS_POSTULANTE; ?>" ><input type="text" style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;" name="tr26" id="tr26" value="<?php echo $row->tr26; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">POSTULANTE: HIJO</td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO DE NACIMIENTO ASIG. FAM.</td>
                                <td><input type="radio" name="r27" value="1" <?php echo $row->r27=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r27" value="2" <?php echo $row->r27=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r27" value="3"  <?php echo $row->r27!="1" && $row->r27!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r27=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="27" /> <input type="text" name="tr27" value="<?php echo $row->r27=="3"? $row->tr27:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>MENOS DE 25 A&Ntilde;OS AL 31 DE DIC</td>
                                <td><input type="radio" name="r28" value="1" <?php echo $row->r28=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r28" value="2" <?php echo $row->r28=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r28" value="3"  <?php echo $row->r28!="1" && $row->r28!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r28=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="28" /> <input type="text" name="tr28" value="<?php echo $row->r28=="3"? $row->tr28:""; ?>" ></td>
                            </tr>
                           <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">POSTULANTE: CONYUGE</td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO DE MATRIMONIO ASIG. FAM.</td>
                                <td><input type="radio" name="r29" value="1" <?php echo $row->r29=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r29" value="2" <?php echo $row->r29=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r29" value="3"  <?php echo $row->r29!="1" && $row->r29!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r29=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="29" /> <input type="text" name="tr29" value="<?php echo $row->r29=="3"? $row->tr29:""; ?>" ></td>
                            </tr>
                                                        <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">POSTULANTE: CONVIVIENTE</td>
                            </tr>
<tr>     	
                                <td>CERTIFICADO ACUERDO UNION CIVIL O CERTIFICADO DE CONVIVENCIA</td>
                                <td><input type="radio" name="r30" value="1" <?php echo $row->r30=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r30" value="2" <?php echo $row->r30=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r30" value="3"  <?php echo $row->r30!="1" && $row->r30!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r30=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="30" /> <input type="text" name="tr30" value="<?php echo $row->r30=="3"? $row->tr30:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">OBSERVACION FINAL</td>
                            </tr>
                            <tr>     	
                                <td colspan="5"><center><textarea id="obs" name="obs" style="width:98%; margin-top:20px; margin-bottom:20px; height:80px;"><?php echo $row->OBS_PASO1; ?></textarea></center></td>
                            </tr>
                            </tbody>
                            
                            <tbody>
                            <tr>     	
                                <td colspan="5"  style="height:20px; background: none !important; border: 0px !Important; ">&nbsp;</td>
                            </tr>
                      		</tbody>
                            <tbody>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">CALCULO PONDERACION DEL POSTULANTE</td>
                            </tr>
                             <tr>     	
                                <td colspan="5" >
                                
                                <div class="calculo_estudios">
<div style="height:5px;" class="clear"></div>
                			<!--<H2 style="width:650px;">PF = 60% * (85%*RA + 15%*IE) + 40% * (70%*RM + 30%*GF)</H2>-->
                    		<H2 style="width:650px;">PF = 60% * (85%*RA + 15%*IE) + 40% * (RM)</H2>
                            <span class="texto-titu2" style="text-align:left;float:left;">

D&oacute;nde:<br />

RA : Puntaje Rendimiento Acad&eacute;mico<br />

IE : Puntaje Instituci&oacute;n de Estudios A&ntilde;o Anterior<br />

RM : Puntaje Remuneraci&oacute;n Bruta Mensual<br />

<!--GF : Puntaje por Grupo Familiar<br />-->




</span><br />
<div style="clear:both; height:10px;"></div>
<div style="display:inline" id="listado_campos_eva">
                 <ul style="display:list-item">
                    <li><div style="float:left"><label>RM</label><input type="text" maxlength="" class="text-medium primera" name="pond_1" id="pond_12" value="<?php echo $row->tr11; ?>" readonly="readonly" /></div></li>
                    <li><div style="float:left"><label>IE</label><input type="text" maxlength="" class="text-medium segunda" name="pond_2" id="pond_22" value="<?php echo $row->tr20; ?>" readonly="readonly"   /></div></li>
                    <!--<li><div style="float:left"><label>GF</label><input type="text" maxlength="3" class="text-medium" name="pond_3" id="pond_32" value=""  disabled="disabled" /><i>Grupo Familiar:  <span id="pondx_32"></span></i></div></li>-->
                    <li><div style="float:left"><label>RA</label><input type="text" maxlength="" class="text-medium tercera" name="pond_4" id="pond_42"  value="<?php echo $row->tr26; ?>" readonly="readonly"   /></div></li>
                 </ul>
                    <div style="height:20px" class="clear"></div>
		            <div style="height:5px" class="clear"></div>
                </div>

<div style="height:5px;" class="clear"></div>
          <div style="text-align:center; display:none;"><input type="button" name="bt_calcula_ponderacion" id="bt_calcula_ponderacion222" value="CALCULAR" class="button-submit poderacion" /></div>
   <div style="height:15px;" class="clear"></div>
   
   <h2 style="width:650px;">LA PONDERACION TOTAL ES DE: <a href="#" class="active pond_final" id="pond_final222"> 
    <?php echo $row->ponderacion; ?>%</a> </h2>

	</div>
                                
                                
                                
                                </td>
                            </tr>
                            </tbody>
                            
					</table>
                    <?php
                    
$result->close();
$db->next_result();
$db->close();
 
					
					?>
					<script>
					
					function encode_utf8(s) { 
					 return unescape(encodeURIComponent(s)); 
					} 
					
					function decode_utf8(s) { 
						 return decodeURIComponent(escape(s)); 
					}
					
					$(".poderacion").click(function () {
					//alert(1);
				var x = $("#idpostulacion").val();
				var dataString = "i="+x;
				var ruta = "Pages/ponderacion_estudios.php";
				$.ajax({
					type: "GET",
					url: ruta,
					data: dataString,
					async: false,
					success: function (data) {
						//alert(data);
						if (window.console) console.log('--->DEBUG '+ruta+': '+data);
						var res = data.split("|");
	
						/*$("#pondx_1"+b).html(res[0]);
						$("#pondx_3"+b).html(res[1]);
						$("#pondx_4"+b).html(res[2]);
						$("#pondx_2"+b).html(res[3]);
						$("#pond_1"+b).val(res[6]);
						$("#pond_2"+b).val(res[7]);
						$("#pond_3"+b).val(res[8]);
						$("#pond_4"+b).val(res[9]);*/
						$(".pond_final").html(res[10]+"%");
						$("#nota").val(res[10]);
						$("#idnota").val(res[10]);
						
				
						
					},
					error: function (objeto, quepaso, otroobj) {
					   if (window.console) console.log('ERROR AL INTENTAR ENVIAR  Pages/ponderacion.php --> '+objeto.responseText);
					}
				})
				
								
			});
					//$('#tr9').bind("change keyup input",function() { $("input[name=r9][value='1']").prop("checked",true); /*$("input[name=r8][value='2']").prop("checked",true);*/ }); 
					
					//$('#tr4').bind("change keyup input",function() { $("input[name=r4][value='1']").prop("checked",true);  }); 
					
					$('#tr26').bind("change keyup input",function() { 
						var d1 = $('#tr26').val();
						
						$(".tercera").val(d1); 
						$(".poderacion").trigger('click');
						
						//alert($(".tercera").val());
					
					}); 
					
										
					$('#tr20').bind("change keyup input",function() { 
						var d1 = $('#tr20').val();
						$(".segunda").val(d1); 
						$(".poderacion").trigger('click');
					}); 
					
					
					
					
					
					function calcular_prom(){
						var valor1 = $("#tr8").val();
						var valor2 = $("#tr9").val();
						var valor3 = $("#tr10").val();
						var x1 = (valor1 === '') ? '0' : valor1;
						var x2 = (valor2 === '') ? '0' : valor2;
						var x3 = (valor3 === '') ? '0' : valor3;
						var final = Math.floor((parseInt(x1)+parseInt(x2)+parseInt(x3))/3);
						$("#tr11").val(final);
						$(".primera").val(final);
						$(".poderacion").trigger('click');
						
					}
					
					
				
					$("input[name=r26]").change(function (){
						var data1 =  $("input[name=r26]:checked").val();
						//alert(data1);
						var da = "";
						if(data1 == 2){
							da = $("#r26_old").val();
							$("#tr26").val(da);
						}
						if(data1 == 1){
							$("#tr26").val("");
						}
						$(".tercera").val(da);
						$(".poderacion").trigger('click');
					});
					
					
					$('#tr8').bind("change keyup input",function() { calcular_prom();  }); 
					$('#tr9').bind("change keyup input",function() { calcular_prom();  }); 
					$('#tr10').bind("change keyup input",function() { calcular_prom();  }); 
					
					$("#destino").change(function (){
						var data1 =  $("#destino option:selected").val();
						$("#tr19").val(data1);
						$("input[name=r19][value='2']").prop("checked",true);
					});
					
					//$("#pond_22").hide();
					
					$("#ensenanzabene_select").change(function (){
						var data1 =  $("#ensenanzabene_select option:selected").val();
						$("#tr20").val(data1);
						$("#listado_campos_eva").find( "#pond_22" ).val(data1);
					
						//alert(data1);
						//alert($("#tr20").val());
						$("input[name=r20][value='2']").prop("checked",true);
					});
					
					
					/*
					$("input[name=r4]").change(function (){
						var data1 =  $("input[name=r4]:checked").val();
						if(data1 == 1){
							$("#tr4").prop('disabled', false);
							$("#tr4").val('');
							$("#tr4").focus();
						}
						if(data1 == 2){
							$("#tr4").val('<?php echo $row->CONTRATO; ?>');
							$("#tr4").prop('disabled', true);
						}
					});*/
					
					/*$("input[name=r9]").change(function (){
						var data1 =  $("input[name=r9]:checked").val();
						if(data1 == 1){
							$("#tr9").prop('disabled', false);
							$("#tr9").val('');
							$("#tr9").focus();
						}
						if(data1 == 2){
							$("#tr9").val('<?php echo $row->RENTA_TRABAJADOR; ?>');
							$("#tr9").prop('disabled', true);
						}
					});*/
					
					
					$("input[name=r19]").change(function (){
						var data1 =  $("input[name=r19]:checked").val();
						if(data1 == 2){
							$("#destino").prop('disabled', false);
							$("#tr19").val('');
							$("#destino").val('0');
							$("#destino").focus();
						}
						if(data1 == 1){
						
							$("#tr19").val('<?php echo $row->TIPO_POSTULANTE; ?>');
							$("#destino").val('<?php echo $row->TIPO_POSTULANTE; ?>');
							$("#destino").prop('disabled', true);
						}
					});
					
					$("input[name=r20]").change(function (){
						var data1 =  $("input[name=r20]:checked").val();
						//alert(data1);
						if(data1 == 2){
							$("#ensenanzabene_select").prop('disabled', false);
							$("#tr20").val('');
							$("#ensenanzabene_select").val('0');
							$("#ensenanzabene_select").focus();
							$("#listado_campos_eva").find( "#pond_22" ).val('');
						} 
						if(data1 == 1){
							
							$("#tr20").val('<?php echo strtr(utf8_decode($row->ANTENSENA_POSTULANTE), "Ñ","N"); ?>');
							$("#listado_campos_eva").find( "#pond_22" ).val('<?php echo strtr(utf8_decode($row->ANTENSENA_POSTULANTE), "Ñ","N"); ?>');
							$("#ensenanzabene_select").val('<?php echo strtr(utf8_decode($row->ANTENSENA_POSTULANTE), "Ñ","N"); ?>');
							$("#ensenanzabene_select").prop('disabled', true);
						}
						//alert($("#tr20").val());
					});
					
					
					$(".poderacion").trigger('click');
					
					</script>