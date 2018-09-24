<!DOCTYPE HTML>
<html lang="en" class=" -webkit-">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /> 
<title>Codelco - Fondo de Becas</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link href="css/estilomobile.css" rel="stylesheet" media="screen, projection">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>


//$("body").hide();

function dv(T) {
            var M = 0, S = 1; for (; T; T = Math.floor(T / 10))
                S = (S + T % 10 * (9 - M++ % 6)) % 11; return S ? S - 1 : 'K';
}

$(window).resize(function() {
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			 
		}else{
		window.location.href = "index.php";
		}
});


$( document ).ready(function() {

	console.log = function() {}

	$("#salir").parent().hide();

	$( "a" ).click(function( event ) {
  event.preventDefault();
  
  });

  $("#abrirLink_estudios").click(function() {
    window.open($(this).attr("href"));
	return false; 
  });

  $("#abrirLink_vivienda").click(function() {
    window.open($(this).attr("href"));
	return false; 
  });
  
  $("#frecuentes").click(function() {
    window.open($(this).attr("href"));
	return false; 
    });
		
  
  	$("#link_buscar").click(function(){
		var cod = $("#rutconsultar").val();
		$(".mensajeestados").hide();
		
		if(cod=="" || cod.length < 8){ 
			$("#rutconsultar").css("border", "solid RED 1px");
			$(".mensajeestados").show().html("Debes ingresa un codigo valido");
			$("#rutconsultar").focus();
			return false;
		} 
		/*
		var rutA = rut.split("-");
		if(rutA[0].length<6 || rutA[0].length>8){
			$("#rutconsultar").css("border", "solid RED 1px");
			$(".mensajeestados").show().html("RUT Incorrecto (Recuerda Ingresar Guion)");
			$("#rutconsultar").focus();
			return false;
		}  
		if(rutA[1].length<1 || rutA[1].length>1){
			$(".mensajeestados").show().html("DV Incorrecto");
			$("#rutconsultar").focus();
			return false;
		} 
		
		var resultado = dv(rutA[0]);
		if (resultado != rutA[1]) {
				$(".mensajeestados").show().html("DV Incorrecto");
				$("#rutconsultar").focus();
                return false;
        }
		*/
	
		window.location.href = "estadomobile.php?r="+cod;
	});
  
  	$("#salir").click(function(){
		$(".row0").show();
		$(".col1").show();
		$(".col2").show();
		$(".col3").show();
		$(".row2").show();
		$(this).parent().hide();
		$("#estudios").hide();
		$("#vivienda").hide();
		$("#link_becaestudios").show();
		$("#link_becavivienda").show();
		$("html, body").animate({ scrollTop: 0 }, "slow");
	})

	
	$("#link_becavivienda").click(function(){
		$("#link_becaestudios").hide();
		$(".row0").hide();
		$(".col1").hide();
		$(".col2").hide();
		$(".col3").hide();
		$(".row2").hide();
		$("#salir").parent().show();
		$("#estudios").hide();
		$("#vivienda").show();
		$("html, body").animate({ scrollTop: 0 }, "slow");
	})
	
	$("#link_becaestudios").click(function(){
		$("#link_becavivienda").hide();
		$(".row0").hide();
		$(".col1").hide();
		$(".col2").hide();
		$(".col3").hide();
		$(".row2").hide();
		$("#salir").parent().show();
		$("#estudios").show();
		$("#vivienda").hide();
		$("html, body").animate({ scrollTop: 0 }, "slow");
	})


    var slider = 1;
	var current_slider = -1;
	var num_slide = $(".grupo figure").length;

	function slideme(){
	
	$(".progress-bar").css("width", "0px");
	
	if(current_slider < (num_slide - 1)){
		if(slider == 1){
			current_slider++;
			var avanza = current_slider*100;
			$("div#slider figure.grupo").animate({ "left": '-'+(avanza)+'%' }, "slow");
		}
	}else{
		current_slider = 0;
		 $( "div#slider figure.grupo" ).fadeOut( "fast", function() {
			$("div#slider figure.grupo").animate({ "left": '0%' }, "fast");
			$( "div#slider figure.grupo" ).fadeIn( "slow");
		});
	}
	
	console.log(current_slider);
	
	$('.progress-bar').animate({ width: '768px' }, 8000, "linear", slideme);
	
    }
	
	slideme();
	
});



</script>

</head>
<body>

<div class="overlay"></div>
<header id="pageHeader" role="banner">
<!--
<nav id="menu" role="navigation">
 <h2>Navegacion</h2>
  <ul>
    <li><a href="galleries.htm" title="Ejemplo" class="">Link 1</a></li>
	<li><a href="galleries.htm" title="Ejemplo" class="">Link 2</a></li>
	<li><a href="galleries.htm" title="Ejemplo" class="">Link 3</a></li>
  </ul>
</nav> -->








<section id="content" role="main">
<div class="rowmenu"></div>


<div class="row0">


<div id="slider">

<figure class="grupo">
	<figure>
		
	    <img src="img/bcelu1.jpg">
		
		<figcaption>
				
		<div class="textos">
		<h1>FONDO &Uacute;NICO DE VIVIENDA CONCURSABLE</h1>
		<span>Para la primera vivienda de trabajadores contratistas y subcontratistas de Codelco.</span>

		<!-- <p class="bases" id="link_vivienda">Descargar Bases de la Vivienda</p> -->
		</div>

		</figcaption>
		
	</figure>
	<figure>
	    <img src="img/bcelu2.jpg">
		<figcaption>
				
		<div class="textos">
		<h1>BECAS DE EDUCACI&Oacute;N SUPERIOR</h1>
		<span>Entregaremos becas de excelencia acad&eacute;mica de educaci&oacute;n superior, para hijos de trabajadores contratistas y/o subcontratistas.</span>
		</div>
		</figcaption>
		
	</figure>

	
</figure>

<div class="progress-bar"></div>
</div>


</div>
<section class="row1">
<div class="opcionbecas"><div class="limpiar"></div>
<div id="nav">
<ul>
<li><a href="#" id="salir" style="background:#ab7038;">VOLVER</a></li>
<li><a href="#" id="link_becavivienda" style="background:#f7a30a;margin-bottom: 1px;">Fondo para la Primera Vivienda</a></li>
<li><a href="#" id="link_becaestudios"  style="background:#f7a30a;">Becas Educaci&oacute;n Superior</a></li>
</ul>
</div>
</div>
<div class="limpiar"></div>
</section>

<section class="col0">
<div id="estudios" class="descripcion_beca">

<div class="textos">
		
		<p>La Corporaci&oacute;n Nacional del Cobre de Chile entrega becas de excelencia acad&eacute;mica de educaci&oacute;n superior a estudiantes que sean hijos, c&oacute;nyuges o convivientes de trabajadores contratistas y/o los propios trabajadores. Te invitamos a que puedas conocer las bases de este beneficio y postular a trav&eacute;s de este formulario electr&oacute;nico.</p><BR>
        <p>
        <strong>Fechas Importantes:</strong>
        </p>
        <div id="nav">
<ul>
<li><a href="#" style="font-size:16px;" ><strong>13 MARZO al 13 ABRIL</strong>: <BR>Postulaciones y entrega de antecedentes</a></li>
<li><a href="#" style="font-size:16px;" ><strong>17 MAYO</strong>: <BR>Publicaci&oacute;n de resultados preliminares de las postulaciones</a></li>
<li><a href="#" style="font-size:16px;" ><strong>17 MAYO al 2 JUNIO</strong>: <BR>Apelaciones</a></li>
<li><a href="#" style="font-size:16px;" ><strong>19 JUNIO</strong>: <BR>Publicaci&oacute;n de Resultados Finales</a></li>
<li><a href="#" style="font-size:16px;" ><strong>23 JUNIO</strong>: <BR>Pago fondos Adjudicadas</a></li>
</ul>
</div>
<BR>
        
		<h3><span>POSTULA INGRESANDO DESDE TU COMPUTADOR</span><br><br>www.oticdelaconstruccion.cl/fondos2017</h3>
		</div>
        <div class="eventos">

		<div class="limpiar"></div>
		<div class="basesaqui"><a id="abrirLink_estudios" href="files/REGLAMENTO 2017 BECAS ESTUDIOS.pdf" target="_blank">VER LAS BASES</a></div>

		</div>


</div>
<div id="vivienda" class="descripcion_beca">

<div class="textos">
        <p>En la Corporaci&oacute;n Nacional del Cobre estamos interesados en que puedas postular al fondo &uacute;nico para la primera vivienda para trabajadores de empresas contratistas o subcontratistas que prestan servicios para Codelco. Inf&oacute;rmate en este sitio de los requerimientos necesarios y an&iacute;mate a postular.</p><BR>

       <p>
        <strong>Fechas Importantes: Próximamente</strong>
        </p>
        
        <!--<div id="nav">
<ul>
<li><a href="#" style="font-size:16px;" ><strong>13 JUNIO al 15 JULIO</strong>: <br>Postulaciones y entrega de antecedentes</a></li>
<li><a href="#" style="font-size:16px;" ><strong>16 AGOSTO</strong>: <br>Publicaci&oacute;n de Resultados Postulaciones</a></li>
<li><a href="#" style="font-size:16px;" ><strong>16 AGOSTO al 2 SEPTIEMBRE</strong>: <br>Apelaciones</a></li>
<li><a href="#" style="font-size:16px;" ><strong>20 SEPTIEMBRE</strong>: <br>Publicaci&oacute;n de Resultados Finales</a></li>
<li><a href="#" style="font-size:16px;" ><strong>23 SEPTIEMBRE</strong>: <br>Pago Fondos Adjudicados</a></li>
</ul>
</div>

<BR>
        
		<h3><span>POSTULA INGRESANDO DESDE TU COMPUTADOR</span><br><br>www.oticdelaconstruccion.cl/fondos2016</h3>
		</div>
        <div class="eventos">

		<div class="limpiar"></div>
		<div class="basesaqui"><a id="abrirLink_vivienda" href="files/REGLAMENTO 2016 FONDO DE VIVIENDA.pdf" target="_blank">VER LAS BASES</a></div>
		</div>-->


</div>
</section>
<div class="limpiar"></div>
<section class="col1" style="height:50px !important" >
</section>
<!--<section class="col1">

<h2>Conoce el Estado de tu Postulacion</h2>

<div class="estadopostulacion">
<form class="stdform" action="forms.html" method="post">
<div class="control-group info">
                          <div class="controls">
                            <input type="text" class="upper" id="rutconsultar" maxlength="10" placeholder="">
                            <span class="help-inline"><div class="becastipo" id="link_buscar" style="float:left">Buscar</div></span>
                          </div>
						  <div class="mensajeestados"> </div>
                        </div>
</form>
</div>

</section>-->
<section class="row2">
<div id="triangulos"></div>
</section>

<section class="col2 clasevideo">

<h2>Conoce nuestro video</h2>
<div class="video"><a id="frecuentes" href="https://www.youtube.com/watch?v=0Ep2ArlFlQo" target="_blank"><img src="img/note.png"></a></div>
<div class="clear"></div>
</section>

<section class="col3">

<h2>&iquest; Necesitas Ayuda ?</h2>
<div class="ayuda">
</div>
<div class="limpiar"></div>
<h3><span>CORREO</span> contacto@oticdelaconstruccion.cl</h3>
<h3><span>FONO</span> 600 797 8000</h3>
</section>

<!-- <section class="row3">

</section>
<section class="row4">

</section> -->



</section>



</body>
</html>