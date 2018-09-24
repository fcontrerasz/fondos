<?php include("../conexion/conecta.php"); ?>
<?php
error_reporting(E_ALL);

if(!isset($_GET["i"])) die("-1");
if(!isset($_GET["b"])) die("-1");
if(!isset($_GET["l"])) die("-1");

if($_GET["l"]==""){
 die("<h2>La postulaci&oacute;n no puede ser evaluada. Revise si esta postulaci&oacute;n no se encuentra en curso o ha sido eliminada.</h2>");
}

$query = "select * from  listar_evaluadores_vivienda where IDPONDVIVIENDA = ".$_GET["l"]." and IDESTADOBECA IN (2,3,4,7,9)";

//echo "<script>console.log('".$query."');</script>";

$result = $db->query($query);
$numRows = $result->num_rows;

//echo($db->error);

if($numRows < 1){
    //echo ("<script> $('#bt_controlcalidad_clt').hide();</script>");
    echo ("<script> document.getElementById('bt_gpost').style.visibility = 'hidden';</script>");
    die("La postulacion no puede ser evaluada. Revise si esta postulacion no se encuentra en curso o ha sido eliminada.");
} else {
    echo ("<script> document.getElementById('bt_gpost').style.visibility = 'visible';</script>");
}

$row = $result->fetch_object();



?>

<table id="sort02" class="rounded-corner" style="width:100%;padding: 0; margin:0; text-align:left;">
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
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">ANTECEDENTES GENERALES</td>
                            </tr>
                            <tr>     	
                                <td>DECLARACION JURADA</td>
                                <td><input type="radio" name="r1" value="1" <?php echo $row->r1=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r1" value="2" <?php echo $row->r1=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r1" value="3" <?php echo $row->r1!="1" && $row->r1!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r1=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="1" /> <input type="text"  name="tr1" value="<?php echo $row->r1=="3"?$row->tr1:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>POSTULACION ANTERIOR</td>
                                <td><input type="radio" name="r2" value="1" <?php echo $row->r2=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r2" value="2" <?php echo $row->r2=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r2" value="3"  <?php echo $row->r2!="1" && $row->r2!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r2=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="2" /> <input type="text"  name="tr2" value="<?php echo $row->r2=="3"? $row->tr2:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>CONTRATO DE TRABAJO</td>
                                <td><input type="radio" name="r3" value="1" <?php echo $row->r3=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r3" value="2" <?php echo $row->r3=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r3" value="3"  <?php echo $row->r3!="1" && $row->r3!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r3=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="3" /> <input type="text"  name="tr3" value="<?php echo $row->r3=="3"? $row->tr3:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td><IMG src="style/img/warning.png" alt="Ingresar Remuneracion Correcta">&nbsp;CAMBIAR NUMERO DE CONTRATO</td>
                                <td><input type="radio" name="r4" value="1" <?php echo $row->r4=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r4" value="2" <?php echo $row->r4=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><!--<input type="radio" name="r4" value="3"  <?php echo $row->r4!="1" && $row->r4!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r4=="3"?"checked=\"checked\"":""; ?> >--></td>
                                <td><input type="text" style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;" name="tr4" id="tr4" value="<?php echo $row->tr4; ?>" <?php echo $row->r4=="2" ?"disabled=\"disabled\"":""; ?>></td>
                            </tr>
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
                                <td><input type="checkbox" onclick="noaplica(this)" id="7" /> <input type="text"  name="tr7" value="<?php echo $row->r7=="3"? $row->tr7:""; ?>" ></td>
                            </tr>

                            <tr>        
                            <td>MONTO REMUNERACION 1</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input type="text"  style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;"  name="tr11" id="tr11" value="<?php echo $row->tr11; ?>" ></td>
                            </tr>
                            <tr>        
                                <td>MONTO REMUNERACION 2</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input type="text"  style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;" name="tr12" id="tr12" value="<?php echo $row->tr12; ?>" ></td>
                            </tr>
                            <tr>        
                                <td>MONTO REMUNERACION 3</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input type="text"  style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;" name="tr13" id="tr13" value="<?php echo $row->tr13; ?>" ></td>
                            </tr>
                            <tr>        
                                <td>PROMEDIO REMUNERACION CALCULADO</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input disabled="disabled" type="text" id="tr14" style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;"  name="tr14" value="<?php echo $row->tr14; ?>" <?php echo $row->tr14=="1" ?"disabled=\"disabled\"":""; ?>></td>
                            </tr>

                            <!--
                            <tr>     	
                                <td>PROMEDIO DE REMUNERACION</td>
                                <td><input type="radio" name="r8" value="1" <?php echo $row->r8=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r8" value="2" <?php echo $row->r8=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r8" value="3"  <?php echo $row->r8!="1" && $row->r8!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r8=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="8" /> <input type="text"  name="tr8" value="<?php echo $row->r8=="3"? $row->tr8:""; ?>" ></td>
                            </tr>
                        -->
                        <!--
                            <tr>     	
                                <td><IMG src="style/img/warning.png" alt="Ingresar Remuneracion Correcta">&nbsp;INGRESAR REMUNERACION</td>
                                <td><input type="radio" name="r9" value="1" <?php echo $row->r9=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r9" value="2" <?php echo $row->r9=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r9" value="3"  <?php echo $row->r9!="1" && $row->r9!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r9=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="text" id="tr9" style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;"  name="tr9" value="<?php echo $row->tr9; ?>" <?php echo $row->r9=="2" ?"disabled=\"disabled\"":""; ?>></td>
                            </tr>
                        -->
                            <tr>     	
                                <td>DECLARA NUMERO DE INTEGRANTES</td>
                                <td><input type="radio" name="r10" value="1" <?php echo $row->r10=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r10" value="2" <?php echo $row->r10=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r10" value="3"  <?php echo $row->r10!="1" && $row->r10!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r10=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="10" /> <input type="text"  name="tr10" value="<?php echo $row->r10=="3"? $row->tr10:""; ?>" ></td>
                            </tr>
                            <!--<tr>     	
                                <td>CONTIENE LUGAR DE FUNCIONES</td>
                                <td><input type="radio" name="r11" value="1" <?php echo $row->r11=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r11" value="2" <?php echo $row->r11=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r11" value="3"  <?php echo $row->r11!="1" && $row->r11!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r11=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="11" /> <input type="text"  name="tr11" value="<?php echo $row->r11=="3"? $row->tr11:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>CONTIENE RENTA</td>
                                <td><input type="radio" name="r12" value="1" <?php echo $row->r12=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r12" value="2" <?php echo $row->r12=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r12" value="3"  <?php echo $row->r12!="1" && $row->r12!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r12=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="12" /> <input type="text"  name="tr12" value="<?php echo $row->r12=="3"? $row->tr12:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>VIGENCIA 30 DIAS</td>
                                <td><input type="radio" name="r13" value="1" <?php echo $row->r13=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r13" value="2" <?php echo $row->r13=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r13" value="3"  <?php echo $row->r13!="1" && $row->r13!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r13=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="13" /> <input type="text"  name="tr13" value="<?php echo $row->r13=="3"? $row->tr13:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">LIQUIDACIONES DE SUELDO</td>
                            </tr>
                            <tr>     	
                                <td>LIQUIDACION DE SUELDO 1</td>
                                <td><input type="radio" name="r14" value="1" <?php echo $row->r14=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r14" value="2" <?php echo $row->r14=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r14" value="3"  <?php echo $row->r14!="1" && $row->r14!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r14=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="14" /> <input type="text"  name="tr14" value="<?php echo $row->r14=="3"? $row->tr14:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>LIQUIDACION DE SUELDO 2</td>
                                <td><input type="radio" name="r15" value="1" <?php echo $row->r15=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r15" value="2" <?php echo $row->r15=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r15" value="3"  <?php echo $row->r15!="1" && $row->r15!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r15=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="15" /> <input type="text"  name="tr15" value="<?php echo $row->r15=="3"? $row->tr15:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>LIQUIDACION DE SUELDO 3</td>
                                <td><input type="radio" name="r16" value="1" <?php echo $row->r16=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r16" value="2" <?php echo $row->r16=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r16" value="3"  <?php echo $row->r16!="1" && $row->r16!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r16=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="16" /> <input type="text"  name="tr16" value="<?php echo $row->r16=="3"? $row->tr16:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>PROMEDIO SUELDO INFERIOR m$2.500</td>
                                <td><input type="radio" name="r17" value="1" <?php echo $row->r17=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r17" value="2" <?php echo $row->r17=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r17" value="3"  <?php echo $row->r17!="1" && $row->r17!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r17=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="17" /> <input type="text"  name="tr17" value="<?php echo $row->r17=="3"? $row->tr17:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">REMUNERACION DE SUELDO</td>
                            </tr>
                            <tr>     	
                                <td>CUMPLE REMUNERACION BRUTA</td>
                                <td><input type="radio" name="r18" value="1" <?php echo $row->r18=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r18" value="2" <?php echo $row->r18=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r18" value="3"  <?php echo $row->r18!="1" && $row->r18!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r18=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="18" /> <input type="text"  name="tr18" value="<?php echo $row->r18=="3"? $row->tr18:""; ?>" ></td>
                            </tr>-->
                          </tbody>
                          
                          <tbody id="validaciones_vivienda">
                            <tr>       
                                <td colspan="5"  style="background-color:#CC0000; color:#FFFFFF; ">ANTECEDENTES POSTULANTE</td>
                            </tr>
                            <tr>        
                                <td colspan="5"  style="height:80PX; background-color:#F3F3F3 ">
                                <div style="height:20px" class="clear"></div>
                                        <?PHP if($_GET["b"]==1){ ?>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">NOMBRE POSTULANTE</span> <?php echo $row->NOMBRE_TRABAJADOR." ".$row->PATERNO_TRABAJADOR." ".$row->MATERNO_TRABAJADOR; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">RUT POSTULANTE</span> <?php echo $row->RUT_TRABAJADOR."-".$row->DV_TRABAJADOR; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">RAZÓN SOCIAL EMPRESA</span> <?php echo $row->RAZONSOCIAL; ?></h4>
                               <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">TIPO EMPRESA</span> <?php echo $row->TIPO_EMPRESA; ?></h4>
                                    <?php } ?>
                                <div style="height:20px" class="clear"></div>
                                </td>
                            </tr>

                             <tr>     	
                                <td colspan="5"  style="background-color:#CC0000; color:#FFFFFF; ">ANTECEDENTES DE LA VIVIENDA</td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="height:80PX; background-color:#F3F3F3 ">
                                <div style="height:20px" class="clear"></div>
									<?PHP if($_GET["b"]==1){ ?>
                                    <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">DIRECCION</span> <?php echo $row->VIVIENDA_DIRECCION." NUMERO ".$row->VIVIENDA_NUMERO.", DPTO ".$row->VIVIENDA_DEPTO.", VILLA ".$row->VIVIENDA_VILLA; ?></h4><h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">COMUNA</span> <?php echo $row->COMUNA_NOMBRE; ?></h4><h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">REGION</span> <?php echo $row->REGION_NOMBRE; ?></h4>
                                    <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">DESTINO</span> <?php echo $row->DESTINO_FONDO; ?></h4>
                                    <h4 style="width:650px; text-align:left; padding-left:30PX; color:#000000;"> <span class="texto-titu2">TIPO DE DOCUMENTO</span> <?php echo $row->TIPO_DOCUMENTO=="0"?"":$row->TIPO_DOCUMENTO; ?></h4>
                                    <?php } ?>
                                <div style="height:20px" class="clear"></div>
                                </td>
                            </tr>
                            
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">DATOS DE LA VIVIENDA</td>
                            </tr>
                            <tr>     	
                                <td><IMG src="style/img/warning.png" alt="Ingresar Remuneracion Correcta">&nbsp;COINCIDE CON LO DECLARADO</td>
								<td><input type="radio" name="r19" value="1" <?php echo $row->r19=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r19" value="2" <?php echo $row->r19=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><!--<input type="radio" name="r19" value="3"  <?php echo $row->r19!="1" && $row->r19!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r19=="3"?"checked=\"checked\"":""; ?> >--></td>
                                <td><input type="text" style="display:none;"   id="tr19" name="tr19" value="<?php echo $row->tr19; ?>" >
									<select name="destino_val" id="destino_val" class="uniformselect tooltipstered" style="margin-left:23px; background-color:#FFFFCC; border:1px #990000 solid;" <?php echo $row->r19=="1"?"disabled=\"disabled\"":""; ?>>
                                        <option value="0">Seleccione</option>
										<option value="COMPRA" <?php echo $row->tr19=="COMPRA"?"selected":""; ?>>COMPRAR UNA VIVIENDA</option>
                                        <option value="CONSTRUIR - TERRENO POSTULANTE" <?php echo $row->tr19=="CONSTRUIR - TERRENO POSTULANTE"?"selected":""; ?>>CONST TERRENO POSTULANTE</option>
										<option value="CONSTRUIR - TERRENO FAMILIAR" <?php echo $row->tr19=="CONSTRUIR - TERRENO FAMILIAR"?"selected":""; ?>>CONST TERRENO FAMILIA</option>
                                        <option value="PREPAGO" <?php echo $row->tr19=="PREPAGO"?"selected":""; ?>>PREPAGAR LA VIVIENDA</option>
                                    </select>
								
								</td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">COMPRA</td>
                            </tr>
                            <tr>     	
                                <td>COPIA DE PROMESA COMPRAVENTA</td>
                                <td><input type="radio" name="r20" value="1" <?php echo $row->r20=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r20" value="2" <?php echo $row->r20=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r20" value="3"  <?php echo $row->r20!="1" && $row->r20!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r20=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="20" /> <input type="text" name="tr20" value="<?php echo $row->r20=="3"? $row->tr20:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>COPIA LEGAL LIBRETA AHORRO</td>
                                <td><input type="radio" name="r21" value="1" <?php echo $row->r21=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r21" value="2" <?php echo $row->r21=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r21" value="3"  <?php echo $row->r21!="1" && $row->r21!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r21=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="21" /> <input type="text" name="tr21" value="<?php echo $row->r21=="3"? $row->tr21:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>DOCUMENTO RESERVA</td>
                                <td><input type="radio" name="r22" value="1" <?php echo $row->r22=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r22" value="2" <?php echo $row->r22=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r22" value="3"  <?php echo $row->r22!="1" && $row->r22!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r22=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="22" /> <input type="text" name="tr22" value="<?php echo $row->r22=="3"? $row->tr22:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO ENTIDAD CAPTADORA</td>
                                <td><input type="radio" name="r23" value="1" <?php echo $row->r23=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r23" value="2" <?php echo $row->r23=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r23" value="3"  <?php echo $row->r23!="1" && $row->r23!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r23=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="23" /> <input type="text" name="tr23" value="<?php echo $row->r23=="3"? $row->tr23:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>VIGENTE (COPIA LEGALIZADA)</td>
                                <td><input type="radio" name="r24" value="1" <?php echo $row->r24=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r24" value="2" <?php echo $row->r24=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r24" value="3"  <?php echo $row->r24!="1" && $row->r24!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r24=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="24" /> <input type="text" name="tr24" value="<?php echo $row->r24=="3"? $row->tr24:""; ?>" ></td>
                            </tr>
                            <tr>        
                                <td>PROPIEDAD A NOMBRE DEL POSTULANTE</td>
                                <td><input type="radio" name="r15" value="1" <?php echo $row->r15=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r15" value="2" <?php echo $row->r15=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r15" value="3"  <?php echo $row->r15!="1" && $row->r15!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r15=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="15" /> <input type="text" name="tr15" value="<?php echo $row->r15=="3"? $row->tr15:""; ?>" ></td>
                                <!--<td><input type="text"  name="tr34" value="<?php echo $row->r34=="3"? $row->r34:""; ?>" ></td>-->
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">CONSTRUCCION - TERRENO POSTULANTE</td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO BIEN RAIZ</td>
                                <td><input type="radio" name="r25" value="1" <?php echo $row->r25=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r25" value="2" <?php echo $row->r25=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r25" value="3"  <?php echo $row->r25!="1" && $row->r25!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r25=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="25" /> <input type="text" name="tr25" value="<?php echo $row->r25=="3"? $row->tr25:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>A NOMBRE DEL POSTULANTE</td>
                                <td><input type="radio" name="r26" value="1" <?php echo $row->r26=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r26" value="2" <?php echo $row->r26=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r26" value="3"  <?php echo $row->r26!="1" && $row->r26!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r26=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="26" /> <input type="text" name="tr26" value="<?php echo $row->r26=="3"? $row->tr26:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>VIGENTE</td>
                                <td><input type="radio" name="r27" value="1" <?php echo $row->r27=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r27" value="2" <?php echo $row->r27=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r27" value="3"  <?php echo $row->r27!="1" && $row->r27!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r27=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="27" /> <input type="text" name="tr27" value="<?php echo $row->r27=="3"? $row->tr27:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">CONSTRUCCION - TERRENO TERCERO (FAMILIAR)</td>
                            </tr>
                            <tr>     	
                                <td>DECLARACION JURADA</td>
                                <td><input type="radio" name="r28" value="1" <?php echo $row->r28=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r28" value="2" <?php echo $row->r28=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r28" value="3"  <?php echo $row->r28!="1" && $row->r28!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r28=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="28" /> <input type="text" name="tr28" value="<?php echo $row->r28=="3"? $row->tr28:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO DE BIEN RAIZ</td>
                                <td><input type="radio" name="r29" value="1" <?php echo $row->r29=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r29" value="2" <?php echo $row->r29=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r29" value="3"  <?php echo $row->r29!="1" && $row->r29!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r29=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="29" /> <input type="text" name="tr29" value="<?php echo $row->r29=="3"? $row->tr29:""; ?>" ></td>
                            </tr>
<tr>     	
                                <td>VIGENTE</td>
                                <td><input type="radio" name="r30" value="1" <?php echo $row->r30=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r30" value="2" <?php echo $row->r30=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r30" value="3"  <?php echo $row->r30!="1" && $row->r30!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r30=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="30" /> <input type="text" name="tr30" value="<?php echo $row->r30=="3"? $row->tr30:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">PREPAGO</td>
                            </tr>
                            <tr>     	
                                <td>CERTIFICADO DE DEUDA</td>
                                <td><input type="radio" name="r31" value="1" <?php echo $row->r31=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r31" value="2" <?php echo $row->r31=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r31" value="3"  <?php echo $row->r31!="1" && $row->r31!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r31=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="31" /> <input type="text" name="tr31" value="<?php echo $row->r31=="3"? $row->tr31:""; ?>" ></td>
                            </tr>
                            <tr>     	
                                <td>A NOMBRE DEL POSTULANTE</td>
                                <td><input type="radio" name="r32" value="1" <?php echo $row->r32=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r32" value="2" <?php echo $row->r32=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r32" value="3"  <?php echo $row->r32!="1" && $row->r32!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r32=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="32" /> <input type="text" name="tr32" value="<?php echo $row->r32=="3"? $row->tr32:""; ?>" ></td>
                            </tr>
		                    <tr>     	
                                <td>VIGENTE</td>
                                <td><input type="radio" name="r33" value="1" <?php echo $row->r33=="1"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r33" value="2" <?php echo $row->r33=="2"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="radio" name="r33" value="3"  <?php echo $row->r33!="1" && $row->r33!="2" ?"checked=\"checked\"":""; ?> <?php echo $row->r33=="3"?"checked=\"checked\"":""; ?> ></td>
                                <td><input type="checkbox" onclick="noaplica(this)" id="33" /> <input type="text" name="tr33" value="<?php echo $row->r33=="3"? $row->tr33:""; ?>" ></td>
                            </tr>
                            <tr>         
                                <td colspan="5"  style="background-color:#5494af; color:#FFFFFF; ">OBSERVACION FINAL</td>
                            </tr>
                            <tr>        
                                <td colspan="5"><center><textarea id="obs" name="obs" style="width:98%; margin-top:20px; margin-bottom:20px; height:80px;"><?php echo $row->OBS_PASO1; ?></textarea></center></td>
                            </tr>
                            </tbody>
                            
					</table>
                    <?php
                    
$result->close();
$db->next_result();
$db->close();
 
					
					?>
					<script>
					$('#tr9').bind("change keyup input",function() { $("input[name=r9][value='1']").prop("checked",true); /*$("input[name=r8][value='2']").prop("checked",true);*/ }); 
					
					$('#tr4').bind("change keyup input",function() { $("input[name=r4][value='1']").prop("checked",true);  }); 
					
					$("#destino_val").change(function (){
						var data1 =  $("#destino_val option:selected").val();
						$("#tr19").val(data1);
						$("input[name=r19][value='2']").prop("checked",true);
						
					});
					
					
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
					});
					
					$("input[name=r9]").change(function (){
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
					});
					
					
					$("input[name=r19]").change(function (){
						var data1 =  $("input[name=r19]:checked").val();
						if(data1 == 2){
							$("#destino_val").prop('disabled', false);
							$("#tr19").val('');
							$("#destino_val").val('0');
							$("#destino_val").focus();
						}
						if(data1 == 1){
						
							$("#tr19").val('<?php echo $row->DESTINO_FONDO; ?>');
							$("#destino_val").val('<?php echo $row->DESTINO_FONDO; ?>');
							$("#destino_val").prop('disabled', true);
						}
					});

                                        function calcular_prom(){
                        var valor1 = $("#tr11").val();
                        var valor2 = $("#tr12").val();
                        var valor3 = $("#tr13").val();
                        var x1 = (valor1 === '') ? '0' : valor1;
                        var x2 = (valor2 === '') ? '0' : valor2;
                        var x3 = (valor3 === '') ? '0' : valor3;
                        var final = Math.floor((parseInt(x1)+parseInt(x2)+parseInt(x3))/3);
                        $("#tr14").val(final);
                        //$(".primera").val(final);
                        //$(".poderacion").trigger('click');
                    }
                    
                    $('#tr11').bind("change keyup input",function() { calcular_prom();  }); 
                    $('#tr12').bind("change keyup input",function() { calcular_prom();  }); 
                    $('#tr13').bind("change keyup input",function() { calcular_prom();  }); 

					</script>