<?php
die("Estamos en proceso de revisión, mantente al tanto en las fechas publicadas.");
//if (!isset($_SERVER['HTTP_REFERER'])){ die("-5"); }
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
text-decoration: none;
background: #ab7038 !important;

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
color: #333 !important;
text-decoration: none;
}
.stdformconfirma{

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
                             
								<p>
									<label>Fecha Nacimiento del Trabajador</label>
									<div id="max-year-birthday"></div>
                                    <div style="clear:both"></div>
								</p>
                                <p>
                                    <label>Rut del Beneficiario</label>
                                    <span class="field"><input id="rutp" type="text"  maxlength="8" name="rutp" class="input-small"> <input id="dvp"  type="text"  maxlength="1" name="dvp" class="dv up"> </span>
								</p>
                                
                               <div style="height:10px;"></div>
							  <center>
 <span id="comenzar"><a href="#" class="btn">INGRESAR</a></span>
</center>
<div style="clear:both"></div>
<div id="mensaje"></div>
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

		
				

$("#comenzar").click(function(){
				
				$("#mensaje").hide().html("");
				
			
				var rut = $("#rut").val();
				var dr = $("#dv").val().toUpperCase();
				var rutp = $("#rutp").val();
				var drp = $("#dvp").val().toUpperCase();
				var m = $('select.birthMonth').val();
				var d = $('select.birthDate').val();
				var a = $('select.birthYear').val();

				 

		
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
				
				
				
		       var dataString = "b=<?php echo $_GET["b"]; ?>&r=" + rut + "&d=" + dr+"&f="+a+"-"+m+"-"+d+"&rp=" + rutp + "&dp=" + drp;
			   //$("#comenzar>a").hide();
			   //$("#comenzar").after("<img src='img/load.gif' />");

				if (window.console) console.log('--->pages/buscar_rutinscrito.php?'+dataString);
				
				//alert(dataString);
				//return false;
				
                $.ajax({
                    type: "GET",
                    url: "pages/buscar_rut_modificar.php",
                    data: dataString,
                    success: function (data) {
						if (window.console) console.log('--->DEBUG buscar_rut_modificar: '+data);
						var datos = data.split('|');
                        if (datos[0] == "1") {
							datam = "b=<?php echo $_GET["b"]; ?>&xx=1&r="+rut+"&dv="+dr+"&k=1&i="+datos[1];
							window.parent.fnParentExits(3,datam);
                        }else if(datos[0] == "-1") {
							$("#mensaje").show().html("Su Postulacion no tiene observaciones.");
							$("#comenzar>a").show();
							$("#comenzar").next().remove();
						}else if(datos[0] == "0") {
							$("#mensaje").show().html("La informacion ingresada no es valida o no existe la postulacion.");
							$("#comenzar>a").show();
							$("#comenzar").next().remove();
						}
						
                    },
                    error: function (objeto, quepaso, otroobj) {
                       if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/buscar_rut_modificar.php --> '+objeto.responseText);
                    }
                });
				
				//
		
		
})

</script>