<?php
//die("Estamos en habilitando el proceso, un momento.");
//if (!isset($_SERVER['HTTP_REFERER'])){ die("-5"); }
/*
echo "<script>console.log('".$_SERVER['HTTP_REFERER']."');</script>";
*/

//echo date("d/m/y h:m");

   $time = time();
   $tiempo_actual = date('Y-m-d  H:i:s', $time);
   $strStart = $tiempo_actual;
   $strEnd   = '2017-09-05 00:00';    
   $dteStart = new DateTime($strStart);
   $dteEnd   = new DateTime($strEnd);
   $dteDiff  = $dteStart->diff($dteEnd);   

   $ladate = new DateTime();
   $a = date_format($ladate, 'Y-m-d H:i:s');

   echo "<script>console.log('Actual Hora: ".$a."');</script>";

  if($dteStart < $dteEnd){
		echo "<script>console.log('no se ha cumplido la fecha login');</script>";
  }else{
		echo "<script>console.log('se completo');</script>";
  }


if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) {
	if($dteStart < $dteEnd){
		
	}else{
//		die("Estamos en proceso de revisi&oacute;n, mantente al tanto en las fechas publicadas.");
	}
}

	//if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) {
	//	die("Estamos en proceso de revisi&oacute;n, mantente al tanto en las fechas publicadas.");
	//}

?>
<link href="css/style.default.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script src="js/jquery-birthday-picker.min.js"></script>
<script src="js/jquery.bestupper.min.js" type="text/javascript"></script>
<script src="js/jquery.numeric.js" type="text/javascript"></script>
<style>
fieldset {
display: block;
-webkit-margin-start: 0px !important;
-webkit-margin-end: 0px !important;
-webkit-padding-before:  0px !important;
-webkit-padding-start:  0px !important;
-webkit-padding-end:  0px !important;
-webkit-padding-after: 0px !important;
border: none !important;
margin:  0px !important;
padding:  0px !important;
}
.wizard .tabbedmenu {
list-style: none;
background: #f7a30a;
padding: 10px;
padding-bottom: 0;
height: 61px;
margin: 0px !important;
}
.stepContainer{
height: 350px !important;
border: none;
}
.tabbedwizard .stepContainer {
padding: 2px !important;
background: #fff;
}
.actionBar {
padding: 15px;
position: relative;
overflow: hidden;
clear: both;
border: 2px solid #f7a30a;
/* border-top: 1px solid #0866c6; */
background: #fff;
}
.actionBar a {
float: right;
display: inline-block;
padding: 5px 15px;
background: #fff;
color: #0866c6;
margin-left: 5px;
border: 2px solid #f7a30a;
}
.actionBar a.buttonDisabled {
background: #fff;
border: 2px solid #ab7038;
color: #333;
opacity: 0.5;
}
a:hover {
outline: none;
color: #333;
text-decoration: underline;
}
.wizard .tabbedmenu li a {
padding: 12.8px 8px !important;
}
.label {
font-size: 12px !important;
}
.dv{
width: 30px;
}

.stdform label {
float: left;
width: 150px;
text-align: right;
/* padding: 5px 20px 0 0; */
}

.stdform span.field, .stdform div.field {
display: block;
position: relative;
}

.input-mini{width:60px;}
.input-small{width:90px;}
.input-medium{width:150px;}
.input-large{width:210px;}
.input-xlarge{width:270px;}
.input-xxlarge{width:530px;}

#mensaje{
width: auto;
background-color: #f7a30a;
padding:10px;
display: none;
}
#mensaje2{
width: auto;
background-color: #f7a30a;
padding:10px;
display: none;
}
.btn-info, .btn-info:link {

color: white !important;
border-color: #4a96d1 !important;
}
a, a:hover, a:link, a:active, a:focus {
outline: none;
}
.stdformconfirma{

}

.stdform {
    width: 450px;
    padding-left: 10px;
}

form .stepContainer a.bt_ingreso:visited {
    background-color: #f39c00;
    color: white;
    font-size: 12px;
    padding: 5px 13px;
    text-align: center;
    text-decoration: none;
    margin-left: 10px;
}
form .stepContainer a.bt_ingreso:hover {
    background-color: #f39c00;
    color: white;
    font-size: 12px;
    padding: 5px 13px;
    text-align: center;
    text-decoration: underline !important;
    margin-left: 10px;
}
form .stepContainer a.bt_ingreso:link {
	background-color: #f39c00;
    color: white;
    font-size: 12px;
    padding: 5px 13px;
    text-align: center;
    text-decoration: none;
    margin-left: 10px;
}
</style>

<form class="stdform">
    <div class="stepContainer" style="display: block;">                    	
                        		<span style="font-size:14px;">
                               Bienvenido, por favor ingrese los siguientes datos del TRABAJADOR:
                                </span>
                                <div style="height:20px;"></div>
                                <p>
                                    <label>Rut del Trabajador</label>
                                    <span class="field"><input id="rut" type="text"  maxlength="8" name="rut" class="input-small"> <input id="dv"  type="text"  maxlength="1" name="dv" class="dv up"> </span>
								</p>
                             
								<p style="display:none;">
									<label>Fecha Nacimiento del Trabajador</label>
									<div id="max-year-birthday" style="display:none;"></div>
                                    <div style="clear:both"></div>
								</p>
                                <p style="display:none;">
                                    <label>Rut del Beneficiario</label>
                                    <span class="field"><input id="rutp" type="text"  maxlength="8" name="rutp" class="input-small"> <input id="dvp"  type="text"  maxlength="1" name="dvp" class="dv up"> </span>
								</p>
                                
                               <div style="height:10px;"></div>
							  <center>
 <span id="comenzar"><a href="#" class="bt_ingreso">INGRESAR</a></span>
</center>
<div style="clear:both; height:15px;"></div>
<div id="mensaje"></div>
								</div>

</form>

<form class="stdform" id="stdformconfirma">
    <div class="stepContainer" id="avance2" style="display: none;">        
                                <span style="font-size:14px;">
                                Antes de comenzar, por favor complete los siguientes datos:
                                </span>    
  	            	
                        	<div style="height:10px;"></div>
                                <p>
                                    <label>Correo Electr&oacute;nico</label>
                                    <span class="field"><input id="correo" type="text"  maxlength="50" name="correo" class="input-large up"></span>
                                    <div style="clear:both"></div>
								</p>
								<p>
                                    <label>Repetir Correo</label>
                                    <span class="field"><input id="repetir" type="text"  maxlength="50" name="repetir" class="input-large up"></span>
									<div style="clear:both"></div>
								</p>
                                <p>
                                	<div style="float:left; padding-left:15px;">
                                    <label>Celular</label>
                                    
                                    <span class="field" style="float: right;"><div class="selector" id="uniform-undefined"><select name="prefijo" id="prefijo" class="uniformselect" style="opacity: 9;width: 50px;">
                                        <option value="1">09</option>
                                    </select><input type="text" maxlength="8" name="celular" id="celular" class="input-small numeros"></div></span>
                                    
                                    
                                    </div>
									<div style="clear:both"></div>
                                    <div style="height:5px;"></div>
                                    <p><div class="checker" style="display:none;" id="uniform-undefined"><span><div class="checker" id="uniform-undefined"><span><input type="checkbox" id="valida" checked="checked" style="opacity: 1;">Confirmo que la informacion entregada es correcta y pertenece al TRABAJADOR.</span></div></span></div> </p>
                                    <div style="clear:both"></div>
								</p>
									<center>
<span id="confirmar"><a href="#" class="bt_ingreso">COMENZAR A POSTULAR</a></span>
</center>
<div style="clear:both"></div>
<div id="mensaje2"></div>
								</div>

</form>

<script>

$(document).keydown(function(objEvent) {
    if (objEvent.keyCode == 9) {  //tab pressed
        //objEvent.preventDefault(); // stops its action
    }
})

$(document).ready(function() {

	//console.log = function() {}
	
		<?php if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) { ?>
	console.log = function() {}
	<?php } ?>


 $(".up").bestupper();
 $("#rut").focus();
 $('#repetir').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
 
 
});

function dv(T) {
            var M = 0, S = 1; for (; T; T = Math.floor(T / 10))
                S = (S + T % 10 * (9 - M++ % 6)) % 11; return S ? S - 1 : 'K';
}

function validateEmail($email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if( !emailReg.test( $email ) ) {
		return false;
	} else {
		return true;
	}
}


$("#rut").numeric();
$("#rutp").numeric();
//$("#dv").numeric("K");

$("#max-year-birthday").birthdayPicker({
					"maxYear": "2020",
					"maxAge": 80,
					monthFormat: "long"
});

$("#confirmar").click(function(){
				$("#mensaje2").hide().html("");
				
				
				
				var rut = $("#rut").val();
				var dr = $("#dv").val().toUpperCase();
				/*var m = $('select.birthMonth').val();
				var d = $('select.birthDate').val();
				var a = $('select.birthYear').val();*/
				var c = $('#correo').val();
				var r = $('#repetir').val();
				var pref = $('#prefijo option:selected').val();
				var celu = $('#celular').val();
				var acepta = $('#valida').is(':checked');
				/*var rutp = $("#rutp").val();
				var drp = $("#dvp").val().toUpperCase();*/
				var m = "1";
				var d = "1";
				var a = "1967";

				
				if (c == "" || r == "") {
					$("#mensaje2").show().html("Completa tu Correo");
					return false;
				}
				
				if(!validateEmail(c)){
					$("#mensaje2").show().html("Primero Correo Invalido");
					return false;
				}
				if(!validateEmail(r)){
					$("#mensaje2").show().html("Segundo Correo Invalido");
					return false;
				}
				if((r!=c)){
					$("#mensaje2").show().html("Correos no son iguales");
					return false;
				}
				
				if(pref=="0"){
					$("#mensaje2").show().html("Selecciona un Prefijo");
					return false;
				}
				if(celu=="" || celu.length < 8){ 
					$("#mensaje2").show().html("Ingresa un Celular");
					return false;
				} 
				if(!acepta){
					$("#mensaje2").show().html("Debes Aceptar las condiciones");
					return false;
				}
				
				$("#confirmar").hide();
				
				dataString = "b=0&k=2&r="+rut+"&dv="+dr+"&m="+c+"&f="+celu+"&c="+a+"-"+m+"-"+d;
				
				if (window.console) console.log("pages/guarda_preinscrito_panel.php?"+dataString);
				
				//return false;
			
				$.ajax({
                    type: "GET",
                    url: "pages/guarda_preinscrito_panel.php",
                    data: dataString,
                    success: function (data) {
						var datos = data.split('|');
						//alert(datos);
						if (window.console) console.log('--->DEBUG guarda_preinscrito_panel: '+data);
                        if (datos[0] == "1") {
							dataString = "k=2&r="+rut+"&dv="+dr+"&m="+c+"&f="+celu+"&c="+a+"-"+m+"-"+d+"&i="+datos[1];
							window.parent.fnParentExits("0",dataString);
                        }else{
							$("#mensaje2").show().html("Error al intentar grabar");
							$("#confirmar").show();
						}
						
                    },
                    error: function (objeto, quepaso, otroobj) {
                       if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/recuperar.php --> '+objeto.responseText);
                    }
                });		
				
				
				
});
				
				

$("#comenzar").click(function(){
				
				$("#mensaje").hide().html("");
				
			
				var rut = $("#rut").val();
				var dr = $("#dv").val().toUpperCase();
				/*var rutp = $("#rutp").val();
				var drp = $("#dvp").val().toUpperCase();
				var m = $('select.birthMonth').val();
				var d = $('select.birthDate').val();
				var a = $('select.birthYear').val();*/
				
				var m = "1";
				var d = "1";
				var a = "1967";

				 

		
				if(rut=="" || rut.length < 7 || rut.indexOf(".") > -1 ){ 
					$("#mensaje").show().html("Completa el Rut sin puntos ni guion");
					return false;
				} 
				
				
				if (dr == "") {
					$("#mensaje").show().html("Completa el Digito Verificador");
					return false;
				}
				
				
				var res = dv(rut);
								
				if (res != dr) {
						$("#mensaje").show().html("No corresponde el DV");
						return false;
				}
				/*
				if (m == "0" || a == "0" || d == "0" ) {
					$("#mensaje").show().html("Completa tu Fecha de Nacimiento");
					return false;
				}
				
				
				if(rutp=="" || rutp.length < 7 || rutp.indexOf(".") > -1){ 
					$("#mensaje").show().html("Completa el Rut Postulante sin puntos ni guion");
					return false;
				} 
				
				
				if (drp == "") {
					$("#mensaje").show().html("Completa el Digito Verificador Postulante");
					return false;
				}
				
				var resp = dv(rutp);
								
				if (resp != drp) {
						$("#mensaje").show().html("No corresponde el DV Postulante");
						return false;
				}
				
				*/
				
		       var dataString = "r=" + rut + "&d=" + dr+"&f="+a+"-"+m+"-"+d;
			   $("#comenzar>a").hide();
			   $("#comenzar").after("<img class='loadimg' src='img/load.gif' />");

				if (window.console) console.log('--->pages/buscar_rutinscrito_panel.php?'+dataString);
				
				//alert(dataString);
				//return false;
				
                $.ajax({
                    type: "GET",
                    url: "pages/buscar_rutinscrito_panel.php",
                    data: dataString,
                    success: function (data) {
						if (window.console) console.log('--->DEBUG buscar_rutinscrito_panel: '+data);
						var datos = data.split('|');
						//alert(datos);
						//return;
						//si vale 1, quiere decir que existe
						//si vale -1 no existe y es nuevo.
                        if (datos[0] == "1") {
							datam = "b=0&xx=1&r="+rut+"&dv="+dr+"&k=1&i="+datos[1];
							console.log("datam:" + datam);
							window.parent.fnParentExits("0",datam);
							//alert("enviado");
						}else if(datos[0] == "-2"){
						
							$("#mensaje").show().html("RUT ya existe en los registros.");
							$(".loadimg").remove();
							$("#comenzar>a").show();
						}else if(datos[0] == "-3"){
							$("#mensaje").show().html("RUT no existe en periodo estudios.");
							$(".loadimg").remove();
							$("#comenzar>a").show();
						}else if(datos[0] == "-5"){
						<?php if (strpos($_SERVER['HTTP_REFERER'], 'adminme') === false) { ?>
							$("#mensaje").show().html("RUT No Encontrado durante el periodo de apelaci&oacute;n.");
							$(".loadimg").remove();
							$("#comenzar>a").show();
						<?php }else{ ?>
							 $(".stdform").hide();
							$("#avance2").show();
							$("#stdformconfirma").fadeIn();
						<?php } ?>
						}else if(datos[0] == "-1" || datos[1] == "-1" || datos[0] == "-4") {
							//$("#mensaje").show().html("No se aceptan nuevas postulaciones.");
							//return false;
							$(".stdform").hide();
							$("#avance2").show();
							$("#stdformconfirma").fadeIn();
                        }
						
                    },
                    error: function (objeto, quepaso, otroobj) {
                       if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/buscar_rutinscrito_panel.php --> '+objeto.responseText);
                    }
                });
				
				//
		
		
})

</script>