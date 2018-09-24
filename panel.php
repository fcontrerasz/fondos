<?php require_once('admin00921/conexion/conecta.php'); ?>
<?php
if (strpos($_SERVER['HTTP_REFERER'], 'adminme00921') === false) {
 //die("Lo Sentimos, estamos en proceso de mantenci&oacute;n, volveremos a estar online a las 20:00 hrs.");
}
//die("Estamos en proceso de revisión, mantente al tanto en las fechas publicadas.");
header('Content-Type: text/html; charset=UTF-8'); 
//if (!isset($_SERVER['HTTP_REFERER'])){ die("-5"); }
$cod = explode("?", $_SERVER['REQUEST_URI']);
$variables = base64_decode($cod[1]);
parse_str($variables);
//$arr = get_defined_vars();  
//var_dump($arr);
//echo $variables;
//die();
if(!isset($_SESSION)) {
     session_start();
}

date_default_timezone_set('America/Santiago'); 
$datestr="2017-06-13 23:59:00";//Your date
$date=strtotime($datestr);//Converted to a PHP date (a second count)
$diff=$date-time();//time returns current time in seconds
$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=round(($diff-$days*60*60*24)/(60*60));
$daysv=floor($diff/(60*60*24));
//echo($daysv);

$datestr_2="2016-09-20 20:59:00";//Your date
$date_2=strtotime($datestr_2);//Converted to a PHP date (a second count)
$diff_2=$date_2-time();//time returns current time in seconds
$days_2=floor($diff_2/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours_2=round(($diff_2-$days_2*60*60*24)/(60*60));
$daysv_2=floor($diff_2/(60*60*24));

 $time = time();
 $tiempo_actual = date('Y-m-d  H:i:s', $time);
 $strStart = $tiempo_actual;
 $strEnd   = '2017-09-05 00:00';    
 $dteStart = new DateTime($strStart);
 $dteEnd   = new DateTime($strEnd);
 $dteDiff  = $dteStart->diff($dteEnd);    
   //echo "-->".$dteDiff;
 //var_dump($dteDiff);
   //Salida de data.
//$nume =  
 // echo $dteDiff->format("%r%a");
  //echo "<br>";
  //echo $dteDiff->format("%r%i");   
//echo $dteStart->format('u');
//echo $_SERVER['HTTP_REFERER'];
//die();
if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) {
  if($dteStart < $dteEnd){
    echo "<script>console.log('no se ha cumplido la fecha');</script>";
  }else{
    echo "<script>console.log('se completo');</script>";
    //die("Estamos en proceso de revisión, mantente al tanto en las fechas publicadas.");
  }
}else{
  echo "<span>Eres Administrador.</span>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Beneficiarios</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
 <link href="css/style_panel.css" rel="stylesheet" type="text/css" />

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

  <!-- JQuery
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>
      $(function() {
         // $( document ).tooltip();
      });
	  
	  function ir_obs_old(salto){
	  
				var page = "pages/ver_observaciones_panel.php?i="+salto;
                var dialogo = $("<div></div>").html('<iframe style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="100%"></iframe>').dialog({
                   autoOpen: false,
					width:'400', 
                    modal: true,
					draggable: false,
					resizable: false,
                   height: 400,
                   width: 400,
                   buttons: {
                        "Entiendo": function () {
                            dialogo.dialog("close");
                        }
                    }
               });
				$(".ui-dialog-title").hide();
				
				dialogo.closest('.ui-dialog').find('.ui-dialog-titlebar').hide();
				dialogo.closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
				dialogo.dialog("open");
	  
	  
	  }

     function ir_obs(salto){
      //alert(salto);
        $(".contenedor_observaciones").empty();
        var page = "pages/ver_observaciones_panel.php?i="+salto;
        $(".contenedor_observaciones").append("<iframe style='border: 0px; overflow:hidden;' scrolling='no' src=" + page + " width='490' height='285'></iframe>"); 
        $( ".popup_observaciones" ).fadeIn();      
    }
	  
    function ir_obs2(salto){
      //alert(salto);
        $(".contenedor_observaciones").empty();
        var page = "pages/ver_observaciones_panel_estudio.php?i="+salto;
        $(".contenedor_observaciones").append("<iframe style='border: 0px; overflow:hidden;' scrolling='no' src=" + page + " width='490' height='285'></iframe>"); 
        $( ".popup_observaciones" ).fadeIn();      
    }
	
	function ir_obs_final(salto){
        $(".contenedor_observaciones").empty();
        var page = "pages/ver_observaciones_panel_final.php?i="+salto;
        $(".contenedor_observaciones").append("<iframe style='border: 0px; overflow:hidden;' scrolling='no' src=" + page + " width='490' height='285'></iframe>"); 
        $( ".popup_observaciones" ).fadeIn();      
    }
	
	function ir_obs_final_v(salto){
        $(".contenedor_observaciones").empty();
        var page = "pages/ver_observaciones_panel_final_v.php?i="+salto;
        $(".contenedor_observaciones").append("<iframe style='border: 0px; overflow:hidden;' scrolling='no' src=" + page + " width='490' height='285'></iframe>"); 
        $( ".popup_observaciones" ).fadeIn();      
    }
 
      function ir_vivienda(salto){
         // alert("En mantención.")
          
          $('#idiframe', window.parent.document).attr("src", "limpia.php" );
          var id = salto;
          <?php
          echo 'dataString = "k=1&r='.$r.'&dv='.$dv.'&i="+id;';
          ?>
          window.parent.fnParentExits("1",dataString); 
      }

      function ir_vivienda_mod(salto){
         // alert("En mantención.")
          
          $('#idiframe', window.parent.document).attr("src", "limpia.php" );
          var id = salto;
          <?php
          echo 'dataString = "k=1&r='.$r.'&dv='.$dv.'&i="+id;';
          ?>
          window.parent.fnParentExits("4",dataString); 
      }

      function ir_estudios_noeval(){
      alert("El usuario actual solo esta disponible para los estados de revisión de postulación y de revisión de apelación");
  }

	  	function ir_estudios(salto){
	$('#idiframe', window.parent.document).attr("src", "limpia.php" );
	var id = salto;
	//alert(salto);
	<?php
	echo 'dataString = "k=1&r='.$r.'&dv='.$dv.'&i="+id;';
	?>
console.log(dataString);
	window.parent.fnParentExits("2",dataString); 
	}
	  
          function ir_estudios_mod(salto){
  $('#idiframe', window.parent.document).attr("src", "limpia.php" );
  var id = salto;
  //alert(salto);
  <?php
  echo 'dataString = "k=1&r='.$r.'&dv='.$dv.'&i="+id;';
  ?>
  //alert(dataString);
  window.parent.fnParentExits("3",dataString); 
  }

  </script>

</head>
<body>

<style type="text/css">
#msg_finvivienda{
    position: absolute;
    background-color: white;
    width: 70%;
    height: 50%;
    left: 15%;
    top: 17%;
    line-height: 20px;
    font-size: 14px;
    -moz-box-shadow:    0px 0px 10px #999;
    -webkit-box-shadow: 0px 0px 10px #999;
    box-shadow:         0px 0px 10px #999;
    display: none;
}
#msg_finvivienda h3{
    margin-top: 30px;
    margin-left: 40px;
    margin-bottom: 20px;
    font-weight: bold;
}
#msg_finvivienda p{
    margin-bottom: 10px;
    margin-left: 40px;
    margin-right: 40px;
}
#msg_finvivienda .bt_msg_finvivienda{
    background-color: #f39c00;
    color: white;
    font-size: 12px;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    margin-left: 245px;
    margin-top: 50px;
    width: 100px;
    cursor: pointer;
}
</style>
  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div id="beneficiarios">
    <h2>Seleccione el beneficio al que desea postular</h2>
      <div class="fondo_estudios">
          <img src="img/ic2.png" />
          <div class="titulo">Beca de estudios</div>
          <div>&nbsp;</div>
          <!--<div class="estado">Estado: observaciones <a href="#" title="Debe reescanear documentos"> (1 mensaje)</a></div>-->
          <div class="clear"></div>
          <a id="continuar_estudios" class="enlace" style="" href="#">Mis Postulaciones</a>
      </div>
    <div class="popup_beneficiarios">
        <div class="titulo">Beneficiarios inscritos</div>
        <div class="separador"></div>
        <?php if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) { 
         if(round(($diff/60),0) <= 0) { ?>
         
        <?php //echo '<a id="agregar_vivienda" class="enlace" href="#">+ Agregar postulante Vivienda</a>'; ?>
         
        <? } }else{ ?>
        
        <?php //echo '<a id="agregar_vivienda" class="enlace" href="#">+ Agregar postulante Vivienda</a>'; ?>
        
        <?php } ?> 
        
        <a id="agregar_estudios" style="display:none;" class="enlace" href="#">+ Agregar postulante</a>
        <div id="listar_postulaciones"></div>
        <div id="volver_beneficiarios" class="volver">< VOLVER</div>
    </div>

    <div class="popup_observaciones">
        <div class="titulo">Observaciones del Beneficiario</div>
        <div class="separador"></div>
        <div class="contenedor_observaciones"></div>
        <div id="volver_obs" class="volver">< VOLVER</div>
    </div>

    <div class="fondo_vivienda">
          <img src="img/ic1.png" />
          <div class="titulo">Fondo primera vivienda</div>
          
          <!--<div class="estado">Estado: abierto</div>-->
           <div>&nbsp;</div>
          <div class="clear"></div>
          <?php //if($dteStart < $dteEnd){ ?>
          <a id="continuar_vivienda" class="enlace" href="#">Mis Postulaciones</a>
          <?php //} ?>
      </div>
      <div class="popup_nuevovivienda">
        <div style="display:none;" class="titulo">Agregar postulante - vivienda</div>
        <div class="separador"></div>
        <form>
            <div class="desc">RUT:</div><input type="text" maxlength="8" name="rut" id="rut"><input type="text" id="dv" name="dv" size="1" maxlength="1" style="width:20px; margin-left:5px;">
            <div class="clear"></div>

            <div class="desc">TIPO:</div>
            <select name="tipo_postulante" id="tipo_postulante">
            <option value="0">Seleccione:</option>
            <option value="HIJO">HIJO DEL TRABAJADOR</option>
            <option value="CONYUGE">CONYUGE DEL TRABAJADOR</option>
            <option value="CONVIVIENTE">CONVIVIENTE DEL TRABAJADOR</option>
            <option value="TRABAJADOR">TRABAJADOR</option>
            </select>
            <div class="clear"></div>

            <input type="button" id="validar_postulante_vivienda" class="enlace" value="Confirmar postulación">
            
            <div id="mensaje">
            
            </div>
            
        </form>
        <div id="volver_nuevobeneficiariov" class="volver">< Volver al panel de becas</div>
    </div>
    <div class="popup_nuevobeneficiario">
        <div class="titulo">Agregar postulante</div>
        <div class="separador"></div>
        <form>
            <div class="desc">RUT:</div><input type="text" maxlength="8" name="rut" id="rut"><input type="text" id="dv" name="dv" size="1" maxlength="1" style="width:20px; margin-left:5px;">
            <div class="clear"></div>

            <div class="desc">TIPO:</div>
            <select name="tipo_postulante" id="tipo_postulante">
            <option value="0">Seleccione:</option>
            <option value="HIJO">HIJO DEL TRABAJADOR</option>
            <option value="CONYUGE">CONYUGE DEL TRABAJADOR</option>
            <option value="CONVIVIENTE">CONVIVIENTE DEL TRABAJADOR</option>
            <option value="TRABAJADOR">TRABAJADOR</option>
            </select>
            <div class="clear"></div>

            <input type="button" id="validar_postulante_estudios" class="enlace" value="Confirmar postulación">
            
            <div id="mensaje">
            
            </div>
            
        </form>
        <div id="volver_nuevobeneficiario" class="volver">< Volver al panel de becas</div>
    </div>

    <div id="msg_finvivienda">
        <h3>Estimado postulante:</h3>
        <p>Junto con saludar, le comentamos que ha finalizado la etapa de Apelación.</p>
        <p>Recordar que la publicación de los resultados finales es el día 20 de Septiembre de 2016, donde podrá revisar el estado final de su postulación.</p>
        <p style="font-style: italic;">Atte. <br />Equipo Vivienda 2016</p>
        <div class="bt_msg_finvivienda">Aceptar</div>
    </div>

</div>

<script>
$( document ).ready(function() {

function revisarDigito( dvr )
{ 
  dv = dvr + "" 
  if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K') 
  {   
    alert("Debe ingresar un digito verificador valido");    
    //window.document.form1.rut.focus();    
    //window.document.form1.rut.select();   
    return false; 
  } 
  return true;
}

function revisarDigito2( crut )
{ 
  largo = crut.length;  
  if ( largo < 2 )  
  {   
    alert("Debe ingresar el rut completo")    
   // window.document.form1.rut.focus();    
    //window.document.form1.rut.select();   
    return false; 
  } 
  if ( largo > 2 )    
    rut = crut.substring(0, largo - 1); 
  else    
    rut = crut.charAt(0); 
  dv = crut.charAt(largo-1);  
  revisarDigito( dv );  

  if ( rut == null || dv == null )
    return 0  

  var dvr = '0' 
  suma = 0  
  mul  = 2  

  for (i= rut.length -1 ; i >= 0; i--)  
  { 
    suma = suma + rut.charAt(i) * mul   
    if (mul == 7)     
      mul = 2   
    else          
      mul++ 
  } 
  res = suma % 11 
  if (res==1)   
    dvr = 'k' 
  else if (res==0)    
    dvr = '0' 
  else  
  {   
    dvi = 11-res    
    dvr = dvi + ""  
  }
  if ( dvr != dv.toLowerCase() )  
  {   
    alert("EL rut es incorrecto");
    //window.document.form1.rut.focus();    
    //window.document.form1.rut.select();   
    return false  
  }

  return true
}

function Rut(texto)
{ 
  var tmpstr = "";  
  for ( i=0; i < texto.length ; i++ )   
    if ( texto.charAt(i) != ' ' && texto.charAt(i) != '.' && texto.charAt(i) != '-' )
      tmpstr = tmpstr + texto.charAt(i);  
  texto = tmpstr; 
  largo = texto.length; 

  if ( largo < 2 )  
  {   
    alert("Debe ingresar el rut completo");  
    //window.document.form1.rut.focus();    
    //window.document.form1.rut.select();   
    return false; 
  } 

  for (i=0; i < largo ; i++ ) 
  {     
    if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i) !="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i) !="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i) !="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i) != "K" )
    {     
      alert("El valor ingresado no corresponde a un R.U.T valido");     
      //window.document.form1.rut.focus();      
      //window.document.form1.rut.select();     
      return false;   
    } 
  } 

  var invertido = ""; 
  for ( i=(largo-1),j=0; i>=0; i--,j++ )    
    invertido = invertido + texto.charAt(i);  
  var dtexto = "";  
  dtexto = dtexto + invertido.charAt(0);  
  dtexto = dtexto + '-';  
  cnt = 0;  

  for ( i=1,j=2; i<largo; i++,j++ ) 
  {   
    //alert("i=[" + i + "] j=[" + j +"]" );   
    if ( cnt == 3 )   
    {     
      dtexto = dtexto + '.';      
      j++;      
      dtexto = dtexto + invertido.charAt(i);      
      cnt = 1;    
    }   
    else    
    {       
      dtexto = dtexto + invertido.charAt(i);      
      cnt++;    
    } 
  } 

  invertido = ""; 
  for ( i=(dtexto.length-1),j=0; i>=0; i--,j++ )    
    invertido = invertido + dtexto.charAt(i); 

   //window.document.form1.rut.value = invertido.toUpperCase()   

  if ( revisarDigito2(texto) )    
    return true;  

  return false;
}


		<?php if(!isset($_GET["adminme"])){ ?>
	//console.log = function() {}
	<?php } ?>
	
	$("#listar_postulaciones").load('pages/listar_postulaciones_panel.php?r=<?php echo $r;?>');
	

$("#validar_postulante_estudios").click(function() {

    $( ".popup_nuevobeneficiario #mensaje").empty();

		var rut = $(".popup_nuevobeneficiario #rut").val();
		var dr = $(".popup_nuevobeneficiario #dv").val().toUpperCase();
		var t = $('.popup_nuevobeneficiario #tipo_postulante option:selected').val();
 
    console.log("rut:" + rut);
    console.log("dr:" + dr);
    console.log("t:" + t);


    if(t != "0"){

           if (Rut(rut + dr)) {

                if((rut != "") && (dr != "")) {
            		dataString = "b=2&r="+rut+"&d="+dr+"&t="+t+"&rutt=<?php echo $r; ?>&dvt=<?php echo $dv; ?>"+"&i=<?php echo traeIDPostulacion($r,2); ?>";
                console.log("dataString: " + dataString);
            		$.ajax({
                        type: "GET",
                        url: "pages/buscar_rutpostulante_panel.php",
                        data: dataString,
                        success: function (data) {

          							<?PHP if(isset($_get['adminme'])){ ?>
                      						   alert("-->"+data);
          							<?PHP } ?>

            						    var datos = data.split('|');
            						    if (window.console) console.log('--->DEBUG buscar_rutpostulante_panel: '+data);
                                  if (datos[0] == "1" && datos[1] != "-1") {
                                         console.log("inscripcion ok");
                  							       //$("#mensaje").show().html("Postulante creado correctamente.");
                  							       //$("#listar_postulaciones").load('pages/listar_postulaciones_panel.php?r=<?php echo $r;?>');
            												   dataString = "k=1&r=<?php echo $r; ?>&dv=<?php echo $dv; ?>&i="+datos[1];
            												   window.parent.fnParentExits("2",dataString); 
                                  }else{
								  					//alert(datos[0]);			
                                       console.log("RUT ya existente en la base de datos.");					  		
                  							       $(".popup_nuevobeneficiario #mensaje").show().html("RUT ya existente en la base de datos.");
                  				        }
                            },
                              error: function (objeto, quepaso, otroobj) {
                              if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/buscar_rutpostulante_panel.php --> '+objeto.responseText);
                            }
                });		
                }else{
                    $(".popup_nuevobeneficiario #mensaje").show().html("Ingrese su rut y código verificador");
                }

            } 

    } else {
        alert("Seleccione el tipo de postulante");
    }

});
	
	
	function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }

	
    $( "#msg_finvivienda .bt_msg_finvivienda" ).click(function() {
              $("#msg_finvivienda").fadeOut();
    });
	
    $( "a#continuar_vivienda" ).click(function() {
    //alert("Lo sentimos, este proceso aún no comienza.");
    //return false;

          <?php
             if($daysv_2 > 0)
              {
          ?>
              $("#msg_finvivienda").fadeIn();
              //alert("El proceso de apelaciones ha finalizado. Los resultados finales serán publicados el 20 de septiembre de 2016.");
          <?php
              } else {
          ?>    

            	     <?php
                      if (strpos($_SERVER['HTTP_REFERER'], 'adminme000') === false) 
                      { 
            		    ?>
            		  
            		  //alert("Sitio, en mantención.");
            		  //return false;
            		  
                    		  <?php if(round(($diff/60),0) > 0) { ?>
                              //alert("Las postulaciones comienzan el lunes 13 de Junio, Quedan <?php echo $hours; ?> horas para comenzar.");
                              //return false;
                          <?php } ?>

                  <?php } ?>

                    $( "#agregar_vivienda" ).show();
                    $( ".fondo_estudios" ).fadeOut();

                    $('.fondo_vivienda').animate({
                      left: "40px"
                    });
                   // alert("1");
                    $( ".popup_beneficiarios" ).fadeIn();
                    $("#listar_postulaciones").load('pages/listar_postulaciones_panel.php?b=1&r=<?php echo $r;?>');
            	      // $( "#agregar_vivienda" ).show();
	  
              <?php
                  } 
              ?>   
    });



    $( "a#continuar_estudios" ).click(function() {
	//	alert("Lo sentimos, este proceso ya finalizó.");
	//	return false;
		$( "#agregar_vivienda" ).hide();
        <?php
          if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) { 
		  


if(round(($diff/60),0) > 0) {
		  
		  
		  ?>
          //alert("Etapa de Apelación finalizada. Quedan <?php echo $hours; ?> horas de espera para la publicación de resultados.");
          //return false;
        <?php }else{ echo ""; } } ?>
		
		    var currentdate = new Date(); 
		    var datetime = currentdate.getDate() + "/" + (currentdate.getMonth()+1)  + "/" + currentdate.getFullYear() + " " + currentdate.getHours() + ":" + currentdate.getMinutes() + ":" + currentdate.getSeconds();
		
		    //console.log(">"+datetime+"<");
				
        $( ".fondo_vivienda" ).fadeOut();

        $('.fondo_estudios').animate({
        	left: "40px"
        });

      $( ".popup_beneficiarios" ).fadeIn();

		  $("#listar_postulaciones").load('pages/listar_postulaciones_panel.php?b=2&r=<?php echo $r;?>');

    });


    $( "#volver_beneficiarios" ).click(function() {
        $( ".fondo_vivienda" ).fadeIn();
        $( ".fondo_estudios" ).fadeIn();

        $('.fondo_estudios').animate({
        left: "180px"
        });

        $('.fondo_vivienda').animate({
        left: "470px"
        });

        $( ".popup_beneficiarios" ).fadeOut();
    });

    $( ".popup_observaciones #volver_obs" ).click(function() {
        $( ".popup_observaciones" ).fadeOut();
    });

    $( "#volver_nuevobeneficiario" ).click(function() {
        $( ".popup_nuevobeneficiario" ).fadeOut();
    });
	
	$( "#volver_nuevobeneficiariov" ).click(function() {
        $( ".popup_nuevovivienda" ).fadeOut();
    });
	
	
	
	
	 $( "#agregar_vivienda" ).click(function() {
	
		var dataString = "r=<?php echo $r; ?>";
		//alert(dataString);
		$.ajax({
			type: "GET",
			url: "pages/buscar_rutpostulante_panel_vivienda.php",
			data: dataString,
			async: false,
			success: function (data) {
			    
				if (window.console) console.log('--->DEBUG buscar_rutpostulante_panel_vivienda: '+data);
				if (data == "1") {
					 $("#listar_postulaciones").load('pages/listar_postulaciones_panel.php?b=1&r=<?php echo $r;?>');
				}else if(data == "-3") {
					alert("Nuestros registros indican que usted ya fue un beneficiado. Lo sentimos, no puede volver a postular.");			
				}else{
					alert("Ya tienes una postulación en curso, no puedes agregar otra.");
					
				}	
			}
		});
	
	 
	 /*
        $( ".popup_nuevovivienda #rut" ).val("");
        $( ".popup_nuevovivienda #dv").val("");
        $( ".popup_nuevovivienda #mensaje").empty();
        $( ".popup_nuevovivienda #tipo_postulante").val($(".popup_nuevobeneficiario #tipo_postulante option:first").val());
        
        $( ".popup_nuevovivienda" ).fadeIn();
		*/
    });
	
    $( "#agregar_estudios4453" ).click(function() {
        $( ".popup_nuevobeneficiario #rut" ).val("");
        $( ".popup_nuevobeneficiario #dv").val("");
        $( ".popup_nuevobeneficiario #mensaje").empty();
        $( ".popup_nuevobeneficiario #tipo_postulante").val($(".popup_nuevobeneficiario #tipo_postulante option:first").val());
        $( ".popup_nuevobeneficiario" ).fadeIn();
    });


});
</script>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
