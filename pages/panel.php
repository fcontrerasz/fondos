<?php require_once('admin00921/conexion/conecta.php'); ?>
<?php
if (strpos($_SERVER['HTTP_REFERER'], 'adminme00921') === false) {
//die("Estamos en proceso de revisi&oacute;n, mantente al tanto en las fechas publicadas.");
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
	  
	  function ir_obs(salto){
	  
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
	  
    function ir_obs2(salto){
        $(".contenedor_observaciones").empty();
        var page = "pages/ver_observaciones_panel.php?i="+salto;
        $(".contenedor_observaciones").append("<iframe scrolling='no' src=" + page + " width='490' height='285'></iframe>"); 
        $( ".popup_observaciones" ).fadeIn();      
    }
    	  
	  	function ir_estudios(salto){
	$('#idiframe', window.parent.document).attr("src", "limpia.php" );
	var id = salto;
	//alert(salto);
	<?php
	echo 'dataString = "k=1&r='.$r.'&dv='.$dv.'&i="+id;';
	?>
	//alert(dataString);
	window.parent.fnParentExits("2",dataString); 
	
	}
	  
  </script>

</head>
<body>

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
          <a id="continuar_estudios" class="enlace" href="#">Mis Postulaciones</a>
      </div>
    <div class="popup_beneficiarios">
        <div class="titulo">Beneficiarios inscritos</div>
        <div class="separador"></div>
        <a id="agregar_estudios" class="enlace" href="#">+ Agregar postulante</a>
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
          <a id="continuar_vivienda" class="enlace" href="#">Mis Postulaciones</a>
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

		var rut = $("#rut").val();
		var dr = $("#dv").val().toUpperCase();
		var t = $('#tipo_postulante option:selected').val();
 
    if(t != "0"){

           if (Rut(rut + dr)) {

                if((rut != "") && (dr != "")) {
            		dataString = "b=2&r="+rut+"&d="+dr+"&t="+t+"&rutt=<?php echo $r; ?>&dvt=<?php echo $dv; ?>"+"&i=<?php echo traeIDPostulacion($r,2); ?>";
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
                  							       //$("#mensaje").show().html("Postulante creado correctamente.");
                  							       //$("#listar_postulaciones").load('pages/listar_postulaciones_panel.php?r=<?php echo $r;?>');
												   dataString = "k=1&r=<?php echo $r; ?>&dv=<?php echo $dv; ?>&i="+datos[1];
												   window.parent.fnParentExits("2",dataString); 
                                  }else{
								  					//alert(datos[0]);								  		
                  							       $("#mensaje").show().html("RUT ya existente en la base de datos.");
                  				   }
                            },
                              error: function (objeto, quepaso, otroobj) {
                              if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/buscar_rutpostulante_panel.php --> '+objeto.responseText);
                            }
                });		
                }else{
                    $("#mensaje").show().html("Ingrese su rut y código verificador");
                }

            } 

    } else {
        alert("Seleccione el tipo de postulante");
    }

});
	
	
	function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }

	

	
    $( "a#continuar_vivienda" ).click(function() {
				var mensajebox = $('<p style="font-size: 16px; padding: 20px;" ><br> Próximamente serán abierta las postulaciones. Confirma las fechas en la portada del sitio web. </p>');
                var dialogo = $("<div></div>").append(mensajebox).appendTo("body").dialog({
					autoOpen: false,
					width:'400', 
                    modal: true,
					draggable: false,
					resizable: false,
                    buttons: {
                        "Entiendo": function () {
                            dialogo.dialog("close");
							//window.location.reload();
                            
                        }
                    }
                });
				$(".ui-dialog-title").hide();
				
				dialogo.closest('.ui-dialog').find('.ui-dialog-titlebar').hide();
				dialogo.closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
				dialogo.dialog("open");
    });

    $( "a#continuar_estudios" ).click(function() {
        $( ".fondo_vivienda" ).fadeOut();

        $('.fondo_estudios').animate({
        	left: "40px"
        });

    $( ".popup_beneficiarios" ).fadeIn();
		$("#listar_postulaciones").load('pages/listar_postulaciones_panel.php?r=<?php echo $r;?>');
    });

    $( "#volver_beneficiarios" ).click(function() {
        $( ".fondo_vivienda" ).fadeIn();

        $('.fondo_estudios').animate({
        left: "180px"
        });

        $( ".popup_beneficiarios" ).fadeOut();
    });

    $( ".popup_observaciones #volver_obs" ).click(function() {
        $( ".popup_observaciones" ).fadeOut();
    });

    $( "#volver_nuevobeneficiario" ).click(function() {
        $( ".popup_nuevobeneficiario" ).fadeOut();
    });

    $( "#agregar_estudios" ).click(function() {
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
