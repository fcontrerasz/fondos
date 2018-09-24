<?php 
header('Content-type: text/html; charset=UTF-8'); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
//date_default_timezone_set('America/Santiago');
putenv("TZ=America/Argentina/Buenos_Aires");
header('Content-Type: text/html; charset=ISO-8859-1'); 
$now= time();
?>
<?php include("conexion/conecta.php"); ?>
<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$hasta = strtotime("2015-09-14 11:30:00");
$desde = strtotime(date("Y-m-d H:i:s",strtotime('-3 hours')));
//echo $desde;

if($desde > $hasta)
{
	if($_SESSION["perfil"]=="1"){ 
		//unset($_SESSION['idusuario']);
		//session_destroy();
	}
}
$now = time(); 
/*

*/

if(!isset($_SESSION["idusuario"]) || ($now > $_SESSION['expire'])){
header("Location: login.php");
}

$busqueda = -1;
if(isset($_GET["txtBuscar"])){
	$busqueda = $_GET["txtBuscar"];
}


$query = "select * from listar_busqueda where IDPOSTULACION = ".revisaSQL($busqueda, "int");
// where USUARIO_LOGIN = ".revisaSQL($nombre, "text")." AND USUARIO_CLAVE = ".revisaSQL($clave, "text");

//echo $query;

$result = $db->query($query);

if($result->num_rows == "0"){
	$numRows = 0;
}else{
	if($result){
		while ($row = $result->fetch_object()){
			$g[] = $row;
		}
		$numRows = 1;
		 $result->close();
		 $db->next_result();
	}else echo($db->error);
}
$db->close();

//echo $numRows;
//var_dump($g);

//echo "NUMERO: ".$numRows;

//var_dump($g[0]);

if($_SESSION["idusuario"]=="3"){
var_dump($g[0]);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<title>Administrador</title>
<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<script src="../js/jquery-2.0.0.min.js" type="text/javascript"></script>
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<!--<script type="text/javascript" src="style/js/jNice.js"></script>
<script type="text/javascript" src="style/js/jquery.autocomplete.js"></script>-->
<script type="text/javascript" src="style/js/jquery.facelist.js"></script>
<script src="style/js/jquery.bestupper.min.js" type="text/javascript"></script>
<script src="style/js/jquery.numeric.js" type="text/javascript"></script>

<!--<script src="https://code.jquery.com/jquery-1.12.0.min.js" type="text/javascript"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js" type="text/javascript"></script>
<link href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />-->
<script src="style/js/jquery.tablesorter.min.js" type="text/javascript"></script>


<!--<script src="style/js/jquery.gmap-1.1.0-min.js" type="text/javascript"></script>-->

<link href="style/css/estilo.css" rel="stylesheet" type="text/css" />
<!--<script src="Scripts/jquery.limit-1.0.source.js" type="text/javascript"></script>-->
<link href="style/css/facelist.css" rel="stylesheet"  type="text/css" media="screen" title="Facelist" charset="utf-8" />
<style>
.ui-widget-header{
background:none !important;
border:none !important;
margin-bottom: 20px;
}
.ui-widget-content{
background:none !important;
border:none !important;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
border:none !important;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active{
border:none !important;
background:#999999 !important;
color:#FFFFFF !important;
}
.ui-tabs .ui-tabs-panel {
padding: 3em 1.4em !important;
}
#linkCorregirEstudios{
    margin-top: 15px;
    border-top: 1px solid #ccc;
    padding-top: 20px;
}
#linkCorregirEstudios a:link{
    font: 11px Arial, Helvetica, sans-serif;
    color: #646464 !important;
    width: 102px;
    height: 25px;
    cursor: pointer;
    border: none;
    padding: 6px 10px;
    background-color: #dddddd;
    text-align: center;
    text-transform: uppercase;
    text-decoration: none;
}
#linkCorregirEstudios a:visited{
    color: #646464 !important;
    text-decoration: none;
}
</style>

<script language="JavaScript">
<!--
history.forward();
// -->
</script>
<script language="javascript" type="text/javascript">

		jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

function fnCuelgaLlamada()
{
	$('<div></div>').appendTo('body')
    .html('<div><center><h6>�Desea terminar la gesti�n ?</h6><br><br><span>Luego de confirmar la p�gina ser� redireccioanda.</span></center></div>')
    .dialog({
        modal: true,
        title: 'Teminar',
        zIndex: 10000,
        autoOpen: true,
        width: '450px',
		height: '250',
        resizable: false,
        buttons: {
            "Si": function () {
				window.location.href = "gestion.php";				
            },
            No: function () {
                $(this).dialog("close");
            }
        },
        close: function (event, ui) {
            $(this).remove();
        }
    });
}

function noaplica(elm){
			var id = $(elm).attr('id');
			if ($(elm).prop("checked")){
				$("input[name*='r"+id+"'][value=3]").prop('checked', 'checked');
				$("#"+id).next().val("NO APLICA");
			}else{
				$("#"+id).next().val("");
			}
		}

		


		var tid = setTimeout("mycode()", 100);
		
		function mycode() {
		  restantetiempo();
		  tid = setTimeout("mycode()", 100);
		}
				
		function calcular(v1,v2)
		{
			horas1=v1.split(":"); 
			horas2=v2.split(":");
			horatotale=new Array();
				for(a=0;a<3;a++) 
				{
					horas1[a]=(isNaN(parseInt(horas1[a])))?0:parseInt(horas1[a]) 
					horas2[a]=(isNaN(parseInt(horas2[a])))?0:parseInt(horas2[a])
					horatotale[a]=(horas1[a]-horas2[a]);
				}
			horatotal=new Date(); 
			horatotal.setHours(horatotale[0]);
			horatotal.setMinutes(horatotale[1]);
			horatotal.setSeconds(horatotale[2]);
			if(horatotal.getHours()<10){
			hora = "0"+horatotal.getHours()
			}else{
			hora = horatotal.getHours();
			}
			if(horatotal.getMinutes()<10){
			minutos = "0"+horatotal.getMinutes();
			}else{
			minutos = horatotal.getMinutes();
			}
			if(horatotal.getSeconds()<10){
			segundos = "0"+horatotal.getSeconds();
			}else{
			segundos = horatotal.getSeconds();
			}
			if(horatotal.getHours()==0){
				return "<strong style='color:#FF0000'> Tu sesi�n vence en: "+hora+":"+minutos+":"+segundos+" </strong>";
			}else{
				return "<strong> Tu sesi�n vence en: "+hora+":"+minutos+":"+segundos+" </strong>";
			}
		}
		
		function restantetiempo(){
			var vence = new Date("<?php echo date('Y/m/d H:i:s', $_SESSION['expire']); ?>");
			var currentTime = new Date();
			var horasx = currentTime.getHours();
			var minux = currentTime.getMinutes();
			var segux = currentTime.getSeconds();
			var fechat = horasx+":"+minux+":"+segux;
			//document.writeln('hora: ' + fechat);
			var data = calcular("<?php echo date('H:i:s', $_SESSION['expire']); ?>",fechat);
			$("#time_rest").html(data);
			if(currentTime > vence){
			    llavesalirf5 = false;
				window.location.reload();
				//alert(currentTime + " __ " + vence);
			}
    	}
		
	
		function timerrest(){
		
			$.ajax({
                    error: function (objeto, quepaso, otroobj) {
                        alert("Error inesperado al intentar procesar la solicitud \n contacte a su administrador");
                    },
                    type: "POST",
                    url: "Pages/tiempo.php",
                    data: dataString,
                    success: function (data) {
                        $("#time_rest").html("Tu sesi�n vence en: "+data);
						if(data=="1"){
							window.location.reload();
						}
                    }
                });
				
		}
		
		
		
        function findValue(li) {
            if (li == null) return alert("Sin Data");
            if (!!li.extra) sValue = li.extra[0];
            else sValue = li.selectValue;
        }
		
		function xenviar(datax){
			$(this).Dialogo(datax);
		}
		
        function selectItem(li) {
            findValue(li);
        }

        function remove_accent(str) {
            var map={'\\n':'','\\n':'','�':'A','�':'A','�':'A','�':'A','�':'A','�':'A','�':'AE','�':'C','�':'E','�':'E','�':'E','�':'E','�':'I','�':'I','�':'I','�':'I','�':'D','�':'N','�':'O','�':'O','�':'O','�':'O','�':'O','�':'O','�':'U','�':'U','�':'U','�':'U','�':'Y','�':'s','�':'a','�':'a','�':'a','�':'a','�':'a','�':'a','�':'ae','�':'c','�':'e','�':'e','�':'e','�':'e','�':'i','�':'i','�':'i','�':'i','�':'n','�':'o','�':'o','�':'o','�':'o','�':'o','�':'o','�':'u','�':'u','�':'u','�':'u','�':'y','�':'y','A':'A','a':'a','A':'A','a':'a','A':'A','a':'a','C':'C','c':'c','C':'C','c':'c','C':'C','c':'c','C':'C','c':'c','D':'D','d':'d','�':'D','d':'d','E':'E','e':'e','E':'E','e':'e','E':'E','e':'e','E':'E','e':'e','E':'E','e':'e','G':'G','g':'g','G':'G','g':'g','G':'G','g':'g','G':'G','g':'g','H':'H','h':'h','H':'H','h':'h','I':'I','i':'i','I':'I','i':'i','I':'I','i':'i','I':'I','i':'i','I':'I','i':'i','?':'IJ','?':'ij','J':'J','j':'j','K':'K','k':'k','L':'L','l':'l','L':'L','l':'l','L':'L','l':'l','?':'L','?':'l','L':'L','l':'l','N':'N','n':'n','N':'N','n':'n','N':'N','n':'n','?':'n','O':'O','o':'o','O':'O','o':'o','O':'O','o':'o','�':'OE','�':'oe','R':'R','r':'r','R':'R','r':'r','R':'R','r':'r','S':'S','s':'s','S':'S','s':'s','S':'S','s':'s','�':'S','�':'s','T':'T','t':'t','T':'T','t':'t','T':'T','t':'t','U':'U','u':'u','U':'U','u':'u','U':'U','u':'u','U':'U','u':'u','U':'U','u':'u','U':'U','u':'u','W':'W','w':'w','Y':'Y','y':'y','�':'Y','Z':'Z','z':'z','Z':'Z','z':'z','�':'Z','�':'z','?':'s','�':'f','O':'O','o':'o','U':'U','u':'u','A':'A','a':'a','I':'I','i':'i','O':'O','o':'o','U':'U','u':'u','U':'U','u':'u','U':'U','u':'u','U':'U','u':'u','U':'U','u':'u','?':'A','?':'a','?':'AE','?':'ae','?':'O','?':'o'};
            var res='';
            for (var i=0;i<str.length;i++){
                c=str.charAt(i);
                res+=map[c]||c;
            }
            return res;
        } 

        function limpiarTab() {
            $("#tab1").removeClass("active");
            $("#tab2").removeClass("active");
            $("#tab3").removeClass("active");
            $("#tab4").removeClass("active");
			$("#tab5").removeClass("active");
			$("#tab7").removeClass("active");
			$("#tab8").removeClass("active");
			//console.log("fin limpieza");
        }

        function CambioEstado(numero,estado){
            //var data1 = $("#opcion"+numero).find(':selected').val();
            var data1 = estado;
            
            

            if(data1 == 5){
                //alert("es 5");
                $(".motivos").show();
                $("#finalsv"+numero).show();
                $("#finalcv"+numero).hide();
            }

            if(data1 == 4){
                //alert("es 4");
                $(".motivos").show();
                $("#finalcv"+numero).show();
                $("#finalsv"+numero).hide();
            }

            if(data1 < 4){
                //alert("no es");
                $(".motivos").hide();
                $("#finalcv"+numero).hide();
                $("#finalsv"+numero).hide();
            }


        }

        
        function habilitarCrear() {
            $("#nu_nombre").removeAttr("disabled");
            $("#nu_apellidom").removeAttr("disabled");
			$("#nu_apellidop").removeAttr("disabled");
            $("#nu_fono").removeAttr("disabled");
        }

        function deshabilitarCrear() {
            $("#nu_rut").attr("disabled","disabled");
            $("#nu_dv").attr("disabled","disabled");
        }




        

        function sublimpiarTab() {

            $("#tab31").removeClass();
            $("#tab32").removeClass();
            $("#tab33").removeClass();
        }

        function subTabOcultar() {
			
			$(".numresume").removeClass("active");
		    $(".numpaso1").removeClass("active");
		    $(".numpaso2").removeClass("active");
		    $(".numpaso3").removeClass("active");
		    $(".numpaso4").removeClass("active");
		    $(".numpaso5").removeClass("active");
		    $(".numpaso6").removeClass("active");
		    $(".numpaso7").removeClass("active");
			$("#tabresumen").hide();
            $("#tabpaso1").hide();
            $("#tabpaso2").hide();
            $("#tabpaso3").hide();
            $("#tabpaso4").hide();
            $("#tabpaso5").hide();
            $("#tabpaso6").hide();
            $("#tabpaso7").hide();
        }

        function TabOcultar() {
            $("#Tab_Buscar").hide();
            $("#Tab_Cliente").hide();
            $("#Tab_Administracion").hide();
			$("#Tab_AdministracionCola").hide();
            $("#Tab_Historico").hide();
			$("#Tab_Cola").hide();
			
        }

        function TerminarLlamado() {
            document.location.href = "gestion.php";
        }
		
		function playSound(url){   
		  $("#sound").html("<embed src='"+url+"' hidden=true autostart=true loop=false>");
		}
		
		<?php if($busqueda>0){ ?>
		var llavesalirf5 = true;
		window.onbeforeunload = function() {
			if(llavesalirf5) return "Estas Seguro de Salir, Se perderan las gestiones realizadas.";
	   }
	   <?php } ?>
	   
	   $(window).load(function() {
		$("body").fadeIn("slow");
		});
		
		$(document).keydown(function(e) {
			var elid = $(document.activeElement).hasClass('textInput');
			if (e.keyCode === 8 && !elid) {
				//return false;
			};
		});

window.history.forward();
window.onload = function()
{
  window.history.forward();
};

window.onunload = function() {
  null;
};

/*
$(function() {
    var loading = function() {
    var over = '<div id="overlay">' +
            '<img id="loading" src="http://bit.ly/pMtW1K">' +
            '</div>';
        $(over).appendTo('body');
        $(document).keyup(function(e) {
            if (e.which === 27) {
                $('#overlay').remove();
            }
        });
    };
});*/


		function MostrarLoad() {
            var over = '<div id="overlay">' +
            '<img id="loading" src="style/img/loading00.gif">' +
            '</div>';
        	$(over).appendTo('body');
			return $.ajax();
        }

		function quitarLoad() {
            $('#overlay').remove();
        }
	
   $(document).ready(function () {
   
   $(window).on('hashchange',function(){ 
    var ele = location.hash.slice(1);
	$("#"+ele).trigger('click');
	});
   
   
  $(function() {
    $( "#tabs" ).tabs();
  });

   
   history.go = function(){};
   
   //tabla_listar_cola
   $('a').click(function (e) {
    	e.preventDefault();
	});
	
	
	
	$("#bt_postulacion_estado").click(function () {
				//alert(1);
				var x = $("#idpostulacion").val();
				var b = $("#idtipobeca").val();
				var l = $("#idlinkqa").val();
				var e =  $("#epaso1 option:selected").val();
				//return false;
				if(e == 0) return false;
				var botnaux = $(this);
				botnaux.next().remove();
				// alert(1);
				var dataString = 'i='+x+'&b='+b+'&l='+l+'&e='+e;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/guardar_estado_postulacion.php",
				data: dataString,
				async: false,
				success: function (data) {
						console.log(data);
						if(data == 2){ 
							botnaux.show();
							
							botnaux.after("<span><a href='#' class='inline-link-g2'>Guardado Correctamente</a></span>");
							//$(".numresume").trigger('click');
						}
				}}));
    });
   
   
   $("#btn_filtro_cola_rut").click(function () {
   			var filtro =  $("#filtro_cola_rut").val();
			$(this).listarCola("r="+filtro);
    });
	
	$("#btn_filtro_cola_postulante").click(function () {
   			var filtro =  $("#filtro_cola_postulante").val();
			$(this).listarCola("p="+filtro);
    });
   
    $("#btn_filtro_cola_nombre").click(function () {
   			var filtro =  $("#filtro_cola_nombre").val();
			$(this).listarCola("n="+filtro);
    });
   
   
   
   $("#filtro_cola_estado_1").change(function (){
   		var filtroest =  $("#filtro_cola_estado option:selected").val();
   		var filtroest1 =  $("#filtro_cola_estado_1 option:selected").val();
		//$("#filtro_cola_estado").val(0);
		//$("#filtro_cola_estado_1").val(0);
		$(this).listarCola("f="+filtroest1);
   		//alert(filtroest + ' - ' + filtroest1 );
		return false;
   
		MostrarLoad().done(function(result) {
		    console.log(result);
		
		
				
		var filial =  $("#filtro_cola_estado_1 option:selected").text();
		var nfiltro =  $("#filtro_cola_estado_1 option:selected").val();
		
		//alert(nfiltro);
		$("#tabla_listar_cola tr").show();
		
		
		if(nfiltro == 0){
			quitarLoad();
		 return false;
		
		}
		
		$("#tabla_listar_cola").hide();
		//alert("comenzando");
		//$("#resultadocola").html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");
		
		//console.log(nfiltro);

		if(nfiltro < 8){
			var total = 0;
			$("#tabla_listar_cola").each(function(index){ total = $("tbody tr", this).length; });
			$("#resultadocola h3").html("RESULTADOS ("+total+")");
			if(filial == 'TODAS') return false;
			var contador = 0;
			$("#tabla_listar_cola tr").each(function(index){
				$(this).find("td").eq(5).each(function(index2){
					//alert(filial+" / "+$(this).html());
					
					var buscarx = $(this).html();
					console.log(buscarx.indexOf(filial));
					if(buscarx.indexOf(filial) == -1){
//					if(filial != $(this).html()){
						$("#tabla_listar_cola tr:eq("+index+")").hide();
						//alert(index2+" -- ["+filial+"] = ["+$(this).html()+"]");
					}else contador++;
				});
			});
			$("#resultadocola h3").html("RESULTADOS ("+contador+")");
		}else{
			var filtrome = "";
			if(nfiltro == 8 ) filtrome = "NUEVO";
			if(nfiltro == 9 ) filtrome = "TUYO";
			if(nfiltro == 10 ) filtrome = "TOMADO";
			
			var total = 0;
			$("#tabla_listar_cola").each(function(index){ total = $("tbody tr", this).length; });
			$("#resultadocola h3").html("RESULTADOS ("+total+")");
			var contador = 0;
			$("#tabla_listar_cola tr").each(function(index){
				$(this).find("td").eq(3).each(function(index2){
				//console.log($(this).html().indexOf(filtrome));
					if($(this).html().indexOf(filtrome) < 0){
						
						$("#tabla_listar_cola tr:eq("+index+")").hide();
						//alert(index2+" -- ["+filial+"] = ["+$(this).html()+"]");
					}else contador++;
				});
			});
			$("#resultadocola h3").html("RESULTADOS ("+contador+")");
			
		}
		$("#tabla_listar_cola").show();
		quitarLoad();
		
	});
		
	});
	
	//bt_buscar_filtro
	
	
	$("#filtro_cola_estado").change(function (){
		var filtroest =  $("#filtro_cola_estado option:selected").val();
		$(this).listarCola("f="+filtroest);
		
	});
	
	$("#filtro_cola_beca").change(function (){
		MostrarLoad().done(function(result) {
		    console.log(result);
	
			var filial =  $("#filtro_cola_beca option:selected").text();
			$("#tabla_listar_cola tr").show();
			var total = 0;
			$("#tabla_listar_cola").each(function(index){ total = $("tbody tr", this).length; });
			$("#resultadocola h3").html("RESULTADOS ("+total+")");
			if(filial == 'TODAS'){ quitarLoad(); return false; }
			var contador = 0;
			$("#tabla_listar_cola tr").each(function(index){
				$(this).find("td").eq(4).each(function(index2){
					if(filial != $(this).html()){
						$("#tabla_listar_cola tr:eq("+index+")").hide();
						//alert(index2+" -- ["+filial+"] = ["+$(this).html()+"]");
					}else contador++;
				});
			});
			$("#resultadocola h3").html("RESULTADOS ("+contador+")");
			quitarLoad();
		});
	});
		
	$("#cl_tipos").change(function (){
		var filial =  $("#cl_tipos option:selected").text();
		//$("#esfilial").val(filial);
		if(filial == "GESTION CASOS FILIAL CAJA VECINA"){
		$("#esfilial").val("1");
		var valdata1 = $("#esfilial").val();
		}else{
		$("#esfilial").val("0");
		var valdata1 = $("#esfilial").val();		
		}
		//alert(valdata1);
	});

		
		
		
		var llavegestion = $("#llavegestion").val();
		var fono1completo = $("#cl_fono1_aux").val();
		var arreglo3 = fono1completo.split("-");
		
		
		if(llavegestion == 1){
			var celu1completo = $("#cl_celu_aux").val();
			var arreglo1 = celu1completo.split("-");	
					
			var celu2completo = $("#cl_celu2_aux").val();
			var arreglo2 = celu2completo.split("-");
			
			var fono2completo = $("#cl_fono2_aux").val();
			var arreglo4 = fono2completo.split("-");
			
			var fono3completo = $("#cl_fono3_aux").val();
			var arreglo5 = fono3completo.split("-");
			
			var fono4completo = $("#cl_fono4_aux").val();
			var arreglo6 = fono4completo.split("-");
	
		
		}
		
		
		
		
		
		
		
		if(llavegestion == 1)
		{
			if(arreglo1.length>1)
				{		
					//alert("El fono 1 viene con guion");
					$("#pcel").val(arreglo1[0]);
					$("#cl_celu_aux").val(arreglo1[1])			
					
				}
				else
				{	
				
					var p1 = celu1completo.substring(0,2);
					//alert(p3);
					$("#pcel").val(p1);
					if(celu1completo.length == 10 || celu1completo.length == 9 ){
					
					//alert("el largo del numero tiene un largo de 10 0 9 "+p3);
						$("#cl_celu_aux").val(celu1completo.substring(2, celu1completo.length));			
						
					}
					
				}//fin else llave 2
					
				if(arreglo2.length>1)
				{		
					//alert("El fono 1 viene con guion");
					$("#pcel2").val(arreglo2[0]);
					$("#cl_celu2_aux").val(arreglo2[1])			
					
				}
				else
				{	
				
					var p2 = celu2completo.substring(0,2);
					//alert(p3);
					$("#pcel2").val(p2);
					if(celu2completo.length == 10 || celu2completo.length == 9 ){
					
					alert("el largo del numero tiene un largo de 10 0 9 "+p3);
						$("#cl_celu2_aux").val(celu2completo.substring(2, celu2completo.length));			
						
					}
					
				}//fin else llave 2
			if(arreglo3.length>1)
			{		
				//alert("El fono 2 viene con guion");
				$("#pfono1").val(arreglo3[0]);
				$("#cl_fono1_aux").val(arreglo3[1])			
				
			}
			else
			{		
				//alert("El fono 2 viene SIN guion");
				var p3 = fono2completo.substring(0,2);
				$("#pfono1").val(p3);
					if(fono1completo.length == 10 || fono1completo.length == 9 ){
					$("#cl_fono1_aux").val(fono1completo.substring(2, fono1completo.length));			
					
				}
			}//fin fono 2		
			
			if(arreglo4.length>1)
			{		
				//alert("El fono 2 viene con guion");
				$("#pfono2").val(arreglo4[0]);
				$("#cl_fono2_aux").val(arreglo4[1])			
				
			}
			else
			{		
				//alert("El fono 2 viene SIN guion");
				var p4 = fono2completo.substring(0,2);
				$("#pfono2").val(p4);
					if(fono2completo.length == 10 || fono2completo.length == 9 ){
					$("#cl_fono2_aux").val(fono2completo.substring(2, fono2completo.length));			
					
				}
			}//fin fono 2	
			
			if(arreglo5.length>1)
			{		
				//alert("El fono 2 viene con guion");
				$("#pfono3").val(arreglo5[0]);
				$("#cl_fono3_aux").val(arreglo5[1])			
				
			}
			else
			{		
				//alert("El fono 2 viene SIN guion");
				var p5 = fono3completo.substring(0,2);
				$("#pfono3").val(p5);
					if(fono3completo.length == 10 || fono3completo.length == 9 ){
					$("#cl_fono3_aux").val(fono3completo.substring(2, fono3completo.length));			
					
				}
			}//fin fono 2		
			
			if(arreglo6.length>1)
			{		
				//alert("El fono 2 viene con guion");
				$("#pfono4").val(arreglo6[0]);
				$("#cl_fono4_aux").val(arreglo6[1])			
				
			}
			else
			{		
				//alert("El fono 2 viene SIN guion");
				var p6 = fono3completo.substring(0,2);
				$("#pfono4").val(p6);
					if(fono4completo.length == 10 || fono4completo.length == 9 ){
					$("#cl_fono4_aux").val(fono4completo.substring(2, fono4completo.length));			
					
				}
			}//fin fono 2				
		}//fin if llavegestion = 1
		else{		
		//alert(llavegestion);					
				if(arreglo3.length>1)
				{		
					//alert("El fono 1 viene con guion");
					$("#pfono1").val(arreglo3[0]);
					$("#cl_fono1_aux").val(arreglo3[1])			
					
				}
				else
				{	
				
					var p3 = fono1completo.substring(0,2);
					//alert(p3);
					$("#pfono1").val(p3);
					if(fono1completo.length == 10 || fono1completo.length == 9 ){
					
					alert("el largo del numero tiene un largo de 10 0 9 "+p3);
						$("#cl_fono1_aux").val(fono1completo.substring(2, fono1completo.length));			
						
					}
					
				}//fin else llave 2
		}//fin else  llavegestion
			
		
		$("#op_fono").blur(function() {
				var numeroLetras = $("#op_glosa").val().length;
				var mensaje = $("#op_glosa").val();
				var posicion = mensaje.indexOf('DETALLE DEL REQUERIMIENTO:');
				//alert('t.letras:'+numeroLetras+' posicion index:'+posicion);
				var porcion = mensaje.substring(posicion+27, numeroLetras);
				//alert('el mensjae que queremos es: '+porcion);
				
				
				var celular = $("#cl_fono2_aux").val()!=""?"\nFONO :"+$("#cl_fono2_aux").val():"";
				//alert(llavegestion);		
			
			if(llavegestion == 2){
						
				$("#op_glosa").val("ID: <?php echo $_GET["txtBuscar"]; ?>"+"\nNOMBRE: "+$("#cl_nombre").val()+ " "+$("#cl_apellidop").val()+ " "+$("#cl_apellidom").val()+ "\nFONO VISOR: "+$("#op_fono").val()+celular+"\nFECHA REPORTE: <?php echo date("d-m-Y"); ?>" + "\nHORA REPORTE: <?php echo date ("H:i:s", $now); ?>" + "\nDETALLE DEL REQUERIMIENTO: "+porcion );
		

			}//FIN 	IF
			else	
			{
				//alert("El n�mero es:"+llavegestion);
				
				//$("#op_glosa").val("NOMBRE: "+$("#cl_nombre").val()+ " "+$("#cl_apellidop").val()+ " "+$("#cl_apellidom").val()+ "\nRUT: xxxxxxx"+"\nFONO VISOR: "+$("#op_fono").val()+fono+ "\nFECHA REPORTE: <?php echo date("d-m-Y"); ?>" + "\nHORA REPORTE: <?php echo date ("H:i:s", $now); ?>" + "\nDETALLE DEL REQUERIMIENTO: "+porcion );
				
				
			}//fin else
		});//fin blur op_fono
		
	
//$("#op_glosa").attr("disabled", "disabled");	
/*
if(llavegestion == 1){			
	
$("#op_glosa").val("NOMBRE: <?php //echo $g[0]->NOMBRE_TRABAJADOR; ?>\rRUT: <?php //echo $row["NN_RUT"]."-".$row["CR_DV"]; ?>\rLOCALIDAD:<?php //echo $row["CR_COMUNA"]?>\rFONO VISOR: <?php //echo $row["CR_CELULAR"]!=''?'\rCELULAR1:'.$row["CR_CELULAR"]:''; ?> <?php //echo $row["CR_CELULAR2"]!=''?'\rCELULAR2:'.$row["CR_CELULAR2"]:''; ?><?php //echo $row["CR_FONO1"]!=''?'\rFONO1:'.$row["CR_FONO1"]:''; ?><?php //echo $row["CR_FONO2"]!=''?'\rFONO2:'.$row["CR_FONO2"]:''; ?><?php //echo $row["CR_FONO3"]!=''?'\rFONO3:'.$row["CR_FONO3"]:''; ?><?php //echo $row["CR_FONO4"]!=''?'\rFONO4:'.$row["CR_FONO4"]:''; ?>
<?php //echo $row["CR_EMAIL"]!=''?'\rCORREO ELECTRONICO:'.$row["CR_EMAIL"]:''; ?>
\rFECHA REPORTE: <?php echo date("d-m-Y"); ?>\rHORA REPORTE: <?php echo date ("H:i:s", $now); ?>\rDETALLE DEL REQUERIMIENTO:\n\r");
}//fin 	if llavegestion

	else{

$("#op_glosa").attr("disabled", "disabled");		
		$("#op_glosa").val("NOMBRE: <?php //echo $row["CR_NOMBRE"]; ?> <?php ////echo $row["CR_MATERNO"]; ?>\rRUT: <?php //echo $row["NN_RUT"]."-".$row["CR_DV"]; ?>\rLOCALIDAD:<?php //echo $row["CR_COMUNA"]?>\rFONO VISOR: <?php //echo $row["CR_FONO1"]!=''?'\rFONO1:'.$row["CR_FONO1"]:''; ?>
	\rFECHA REPORTE: <?php echo date("d-m-Y"); ?>\rHORA REPORTE: <?php echo date ("H:i:s", $now); ?>\rDETALLE DEL REQUERIMIENTO:\n\r");
	}//fin else llavegestion

*/	
		
	
		  $.ajaxSetup ({
			cache: false
		  });
		  
		  $("#atemp").click(function(){
		  
		  	//$(this).hide();
		  
		  	var data1 = $("#alerta_pos").val();
			var data2 = $("#alerta_rut").val();
			var data3 = $("#alerta_fono").val();
			var data4 = $("#alerta_glosa").val();
			var data5 = $("#alerta_id").val();
			
			if(data1==""){
				alert("Ingresa un POS");
				$("#alerta_pos").focus();
				return false;
			}
			
			if(data2=="" || data2.length < 8){
				alert("Ingresa un RUT");
				$("#alerta_rut").focus();
				return false;
			}
			
			var rut = data2.split("-");
			if(rut[0].length<6 || rut[0].length>8){
				alert("RUT Incorrecto (Recuerda Ingresar Gui�n)");
				$("#alerta_rut").focus();
				return false;
			} 
			
			if(rut[1].length<1 || rut[1].length>1){
				alert("DV Incorrecto");
				$("#alerta_rut").focus();
				return false;
			} 
			
			
			if(data3=="" || data3.length < 8){
				alert("Ingresa un FONO (Recuerda anticipar el prefijo)");
				$("#alerta_fono").focus();
				return false;
			}
			
			if(data4=="" || data4.length < 6){
				alert("Texto en Blanco o descripci�n muy corta.");
				$("#alerta_glosa").focus();
				return false;
			}
			
			$(this).hide();
			//var dataString = $("#form-alerta").serialize();
			
			dataString = "idpunto="+data5+"&pos="+data1+"&rut="+data2+"&fono="+data3+"&glosa="+data4;
			
			/*
				$id = $_GET["idpunto"];
				$usr = $_SESSION["idusuario"];
				$pos = $_GET["pos"];
				$rut = $_GET["rut"];
				$fono = $_GET["fono"];
				$glosa = $_GET["glosa"];
			*/
			
			//alert(dataString);
			

			$("#alerta_msj").html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");

			$.ajax({
				type: "GET",
				url: "Pages/guardar_alerta.php",
				data: dataString,
				success: function (data) {
					if(data=="1"){
						$("#alerta_msj").html("<center><strong style='color:green'>ALERTA ENVIADA</strong></center>");
					}
					if(data=="99"){
						$("#alerta_msj").html("<center><strong style='color:red'>FALLO EL ENVIO</strong></center>");
					}
					//$("#atemp").show();
				},
				error: function(){
					alert("Error al enviar, contacte al administrador");
					$("#atemp").show();
				}
			});
			
			$("#alerta_msj").html("");
			
		  });
		  
	  
		  
		    $("#txt_buscar_rut").bind('keydown', function(e) {
				var keyCode = e.keyCode;
				if (keyCode == 9) {
					e.preventDefault();
					$("#bt_buscar_rut").trigger('click');
				}
            })
				
			$("#txt_buscar_nombre").bind('keydown', function(e) {
				var keyCode = e.keyCode;
				if (keyCode == 9) {
					e.preventDefault();
					$("#bt_buscar_nombre").trigger('click');
				}
            })
				
				
			$("#txt_folio").bind('keydown', function(e) {
				var keyCode = e.keyCode;
				if (keyCode == 9) {
					e.preventDefault();
					$("#bt_buscar_folio").trigger('click');
				}
            })
		  
		  
		  
		 jQuery.fn.AbrirGestion = function (iddata) {
		  		location.replace($(this).attr("href"));
				document.location.href = "gestion.php?txtBuscar="+iddata;
		  		return false;
		  };

		  function base64_encode(data) {
  var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    enc = '',
    tmp_arr = [];

  if (!data) {
    return data;
  }

  data = unescape(encodeURIComponent(data));

  do {
    // pack three octets into four hexets
    o1 = data.charCodeAt(i++);
    o2 = data.charCodeAt(i++);
    o3 = data.charCodeAt(i++);

    bits = o1 << 16 | o2 << 8 | o3;

    h1 = bits >> 18 & 0x3f;
    h2 = bits >> 12 & 0x3f;
    h3 = bits >> 6 & 0x3f;
    h4 = bits & 0x3f;

    // use hexets to index into b64, and append result to encoded string
    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
  } while (i < data.length);

  enc = tmp_arr.join('');

  var r = data.length % 3;

  return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
}
		  
	  
		  jQuery.fn.AbrirPostulacion = function (iddata, idbeca, idlink) {
		  		//if(idbeca=="1") return false;
				var habilitado = 0;

				$("#linkCorregirEstudios").empty();
				var mydiv = document.getElementById("linkCorregirEstudios");
				var aTag = document.createElement('a');


				<?php if($_SESSION["perfil"]=="1"){ ?>
				
				var dataString = 'i='+iddata;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/tomar_registro.php",
				data: dataString,
				async: false,
				success: function (data) {
					  //alert(data);
					  if (window.console) console.log('--->DEBUG tomar_registro.php '+data);
					  if(data=="1"){
					  	 habilitado = 1;
						 $("#resultadocola").html("");
					  }else if (data=="-3"){
					  	 alert("Lo Sentimos, tu session ha finalizado vuelve a logearte.");
					  }else{
					  	alert("Lo Sentimos, el registro fue tomado por otro evaluador.");
					  }
					  
				}}));
				
				if(habilitado == 0){
				 return false;
				}
				
				<?php } ?>
				
				//alert(idlink);
				$(".cont_bt_gpond").remove();
		  		$("#validaciones_vivienda").hide();
				$("#validaciones_estudios").hide();
				$("#tab8").trigger('click');
				$("#idpostulacion").val(iddata);
				$("#idtipobeca").val(idbeca);
				$("#idnota").val("");
				$("#idlinkqa").val(idlink);
				if(idbeca=='1'){
				 $("#validaciones_vivienda").show();
				 $(".calculo_estudios").hide();
				 $(".calculo_vivienda").show();
				}
				if(idbeca=='2'){
				 $("#validaciones_estudios").show();
				 $(".calculo_estudios").show();
				 $(".calculo_vivienda").hide();
				}
				//$("#listarresumensimple").load('Pages/informacion_resumennew.php?i='+iddata+'&b='+idbeca);

				$("#listarresumensimple").load('Pages/informacion_resumennew.php?i='+iddata+'&b='+idbeca,null,mod_post29);

				function mod_post29(){
						var textpost29 = $('#estadopostulacion').text();
						if((textpost29 == "POSTULADA")||(textpost29 == "CORREGIDA")){
					    	var rutaenconde = base64_encode("a=admin&k=1&i="+iddata);
							vUrl = "http://www.oticdelaconstruccion.cl/fondos2017/vivienda.php?"+rutaenconde;
							aTag.setAttribute('href',vUrl);
							aTag.setAttribute('target','_blank');
							aTag.innerHTML = "Corregir postulaci�n";
							mydiv.appendChild(aTag);
						}
				}
/*
				$("#listarresumensimple").load('Pages/informacion_resumennew.php?i='+iddata+'&b='+idbeca),function(responseText, textStatus, XMLHttpRequest){
				    if(textStatus == "success"){
				    	alert("111");
				    	var rutaenconde = base64_encode("a=admin&k=1&i="+iddata);
						vUrl = "http://www.oticdelaconstruccion.cl/fondos2017/estudios.php?"+rutaenconde;
						aTag.setAttribute('href',vUrl);
						aTag.setAttribute('target','_blank');
						aTag.innerHTML = "Corregir postulaci�n";
						mydiv.appendChild(aTag);
				    }
				    if(textStatus == "error"){
				    	//alert("222");
				    }
				  }

*/

				//$("#listarresumensimple_trabajador").load('Pages/informacion_resumentrabajador.php?i='+iddata+'&b='+idbeca);
				//$("#listarresumensimple_postulante").load('Pages/informacion_resumenpostulante.php?i='+iddata+'&b='+idbeca);
				//$("#resumencontrolcalidad").load('Pages/informacion_validacion.php?i='+iddata+'&b='+idbeca);
				//$("#datapaso1").load('Pages/listar_pasosnew.php?p=1&i='+iddata+'&b='+idbeca);
				//$("#datapaso2").load('Pages/listar_pasosnew.php?p=2&i='+iddata+'&b='+idbeca);
				//$("#datapaso3").load('Pages/listar_pasosnew.php?p=3&i='+iddata+'&b='+idbeca);
				//$("#datapaso4").load('Pages/listar_pasosnew.php?p=4&i='+iddata+'&b='+idbeca);
				//$("#datapaso5").load('Pages/listar_pasosnew.php?p=5&i='+iddata+'&b='+idbeca);
				
				$("#pond_12").val("");
				$("#pond_22").val("");
				$("#pond_32").val("");
				$("#pond_42").val("");
				
				$("#pondx_12").val("");
				$("#pondx_22").val("");
				$("#pondx_32").val("");
				$("#pondx_42").val("");
				$("#pond_final").val("");
				
				$("#ops_paso1").val("");
				$("#ops_paso2").val("");
				$("#ops_paso3").val("");
				$("#ops_paso4").val("");
				$("#ops_paso5").val("");
				
				
				
				$(".guarda_comentarios").each(function(){
				
				var botnaux = $(this);
				botnaux.next().remove();
				
				});
				
				//$(".numresume").trigger('click');
				$(".numpaso7").trigger('click');
				
				
				
				
				
				$("#bt_ponderacion_clt").next().remove();
				
				
				
				/*
				var dataString = 'p=1&i='+iddata+'&b='+idbeca+'&l='+idlink;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/listar_comentarios.php",
				data: dataString,
				async: false,
				success: function (data) {
						//alert(data);
						$('#ops_paso1').val(data);
				}}));
				dataString = 'p=2&i='+iddata+'&b='+idbeca+'&l='+idlink;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/listar_comentarios.php",
				data: dataString,
				async: false,
				success: function (data) {
						$('#ops_paso2').val(data);
				}}));
				dataString = 'p=3&i='+iddata+'&b='+idbeca+'&l='+idlink;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/listar_comentarios.php",
				data: dataString,
				async: false,
				success: function (data) {
						$('#ops_paso3').val(data);
				}}));
				dataString = 'p=4&i='+iddata+'&b='+idbeca+'&l='+idlink;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/listar_comentarios.php",
				data: dataString,
				async: false,
				success: function (data) {
						$('#ops_paso4').val(data);
				}}));
				dataString = 'p=5&i='+iddata+'&b='+idbeca+'&l='+idlink;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/listar_comentarios.php",
				data: dataString,
				async: false,
				success: function (data) {
						$('#ops_paso5').val(data);
				}}));
				
				if(idbeca == "2"){
					dataString = 'i='+iddata+'&b='+idbeca+'&l='+idlink;
					$.when(
					$.ajax({
					type: "GET",
					url: "Pages/validaciones_estudios.php",
					data: dataString,
					async: false,
					success: function (data) {
						$('#validacioncontrolcalidad').html(data);
					}}));
				}*/
				
		  		return false;
				
		  };
		  
		  
		  


//bt_ver_mapa
//bt_ver_avanzado
		
		
		
		$("#bt_ver_contactos").toggle(
			function(){
			//$("#contactos_contect").hide("slow");
			$(this).attr("src","style/img/select_up.gif");
			},
			function(){
			//$("#contactos_contect").show("slow");
			$(this).attr("src","style/img/select_right.gif");
			}
		);

        $("#campo_nuevo_cliente").hide();
		
		jQuery.fn.reset = function () {
		  $(this).each (function() { this.reset(); });
		}
		
		
		

       jQuery.fn.borrarContacto = function(xid) {
                var idbuscar = xid;

                if (idbuscar == "") {
                  return false;
                }
                
                var data = $("#cl_usuario").val();

                dataString = "id="+idbuscar+"&usuario="+data;

                $.ajax({
                    type: "GET",
                    url: "Pages/borrar_contacto.php",
                    data: dataString,
                    error: function (objeto, quepaso, otroobj) {
                        alert("Error inesperado al intentar procesar la solicitud \n contacte a su administrador");
                        $("#debug_guardar").html(objeto.responseText);
                    },
                    success: function (data) {
                        if(data == 1){
                            alert("Borrado");
                            $("#bt_lista_contactos").trigger('click');
                        }
                    }
                });
        };

                      jQuery.fn.Dialogo = function (mensaje) {
                var $dialog = $('<div>' + mensaje + '</div>')
                .dialog({
                    autoOpen: true,
                    bgiframe: true,
                    modal: true,
                    draggable: false,
                    resizable: false,
                    closeOnEscape: false,
                    height: 350,
                    title: 'MENSAJE',
                    width: 500,
                    dialogClass: 'myDialog',
                    position: 'center'
                });
                $dialog.dialog('open');

            };
			
			jQuery.fn.ForceNumericOnly = function()
			{
			return this.each(function()
			{
				$(this).keydown(function(e)
				{
					var key = e.charCode || e.keyCode || 0;
					// allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY

					return (
						key == 8 || 
						key == 9 ||
						key == 45 ||
						(key >= 37 && key <= 40) ||
						(key >= 48 && key <= 57) ||
						(key >= 96 && key <= 105));
				});
			});
			};
		
			
			jQuery.fn.ForceNumericOnlyGuion = function()
			{
			return this.each(function()
			{
				$(this).keydown(function(e)
				{
					var key = e.charCode || e.keyCode || 0;
					// allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
					//alert(key);
					return (
						key == 8 || 
						key == 9 ||
						key == 45 ||
						key == 173 ||
						key == 189 ||
						(key >= 37 && key <= 40) ||
						(key >= 48 && key <= 57) ||
						(key >= 96 && key <= 105));
				});
			});
			};
            

        jQuery.fn.Mostrar = function() {
            $("#tab1").attr("disabled", "disabled");
            $("#tab2").attr("disabled", "");
            $("#tab3").attr("disabled","");
            $("#tab4").attr("disabled", "");
            $("#tab5").attr("disabled", "");
            TabOcultar();
            $("#Tab_Cliente").show();
			//$("#Tab_Administracion").show();
			
            limpiarTab();
            $("#tab2").removeClass().addClass("active");
        };



        jQuery.fn.Ocultar = function() {
            $("#tab1").attr("disabled", "");
            $("#tab2").attr("disabled", "disabled");
            $("#tab3").attr("disabled","disabled");
            $("#tab4").attr("disabled", "disabled");
            $("#tab5").attr("disabled", "disabled");
            TabOcultar();
            $("#Tab_Buscar").show();
            limpiarTab();
            $("#tab1").removeClass().addClass("active");
         };

            $('.text-long').bestupper();
            $('.text-normal').bestupper();
			$('.text-medium').bestupper();
			$('.text-long-obs').bestupper({clear:false}); 
			$('.text-longest').bestupper();
			$("#txt_buscar_rut").ForceNumericOnly();	
			$("#pond_2").ForceNumericOnly();
			//$("#txt_folio").ForceNumericOnly();	
			$("#cl_celu").ForceNumericOnly();
			$("#nu_fono").ForceNumericOnly();
			$("#cl_fono1").ForceNumericOnly();
			$("#cl_fono2").ForceNumericOnly();
			$("#cl_fono3").ForceNumericOnly();
			$("#cl_fono4").ForceNumericOnly();
			$("#con_fono").ForceNumericOnly();
			$("#con_trabajo").ForceNumericOnly();
			$("#con_anexo").ForceNumericOnly();
			$("#con_celu").ForceNumericOnly();
			$("#op_fono").ForceNumericOnly();
			$("#alerta_pos").ForceNumericOnly();
			$("#alerta_fono").ForceNumericOnly();
			$("#alerta_rut").ForceNumericOnlyGuion();
			
			$("#cl_celu_aux").ForceNumericOnly();
			$("#cl_celu2_aux").ForceNumericOnly();
			$("#cl_fono1_aux").ForceNumericOnly();
			$("#cl_fono2_aux").ForceNumericOnly();
			$("#cl_fono3_aux").ForceNumericOnly();
			$("#cl_fono4_aux").ForceNumericOnly();
			
			
			
			
			
			
			
            $("#filtro_especifico").hide();

            $(".tab").hide();
            $(".container").hide();
            $("#tab31").show();
			$("#tabresumen").show();

            $("#Tab_Buscar").show();
			
			
			$("#bt_ponderacion_clt").click(function () {
				var qlink = $("#idlinkqa").val();
				var beca = $("#idtipobeca").val();
				var nota = $("#idnota").val();
                var dataString = 'b='+beca+'&l='+qlink+'&n='+nota;
				var botnaux = $(this);
				botnaux.hide();
				$(this).next().remove();
				$(this).after("<span class='mensaje_nota'><center><img src='style/img/ajax-loader-finder.gif'/></center></span>");
				//.html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");
				//return false;
				//alert(dataString);
				//return false;
                $.ajax({
                    type: "GET",
                    url: "Pages/guardar_ponderacion.php",
                    data: dataString,
                    success: function (data) {
						// alert(data);
					     if(data == "1"){
							botnaux.show();
							botnaux.next().remove();
							botnaux.after("<span><a href='#' class='inline-link-g2'>Guardado Correctamente</a></span>");
							//$(".numresume").trigger('click');
							//alert(nota);
							$('#irn_ponderacion').text(nota);
						 }else{
							 $(".mensaje_nota").html(data);
							 botnaux.after("<span><a href='#' class='inline-link-g1'>Error al Guardar</a></span>");
						 }
                    }
                });
            });
			
			
			
			
			
			
			
			
			$(".numresume").click(function () {
                subTabOcultar();
				$("#tabresumen").show();
				 $(".numresume").addClass("active");
				  var x = $("#idpostulacion").val();
				  var b = $("#idtipobeca").val();
				 $("#listarresumensimple").load('Pages/informacion_resumennew.php?i='+x+'&b='+b);
            });

            $(".numpaso1").click(function () {
                subTabOcultar();
				$("#tabpaso1").show();
				 $(".numpaso1").addClass("active");
				 var x = $("#idpostulacion").val();
				 var b = $("#idtipobeca").val();
				 var l = $("#idlinkqa").val();
				 $("#datapaso1").load('Pages/listar_pasosnew.php?p=1&i='+x+'&b='+b);
				 
				var dataString = 'p=1&i='+x+'&b='+b+'&l='+l;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/listar_comentarios.php",
				data: dataString,
				async: false,
				success: function (data) {
						$('#ops_paso1').html(data);
				}}));
            });
			
			
            $(".numpaso2").click(function () {
                subTabOcultar();
				$("#tabpaso2").show();
				 $(".numpaso2").addClass("active");
				 var x = $("#idpostulacion").val();
				 var b = $("#idtipobeca").val();
				  var l = $("#idlinkqa").val();
				 $("#datapaso2").load('Pages/listar_pasosnew.php?p=2&i='+x+'&b='+b);
				 var dataString = 'p=2&i='+x+'&b='+b+'&l='+l;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/listar_comentarios.php",
				data: dataString,
				async: false,
				success: function (data) {
						$('#ops_paso2').html(data);
				}}));
            });
            $(".numpaso3").click(function () {
                subTabOcultar();
				$("#tabpaso3").show();
				$(".numpaso3").addClass("active");
				 var x = $("#idpostulacion").val();
				 var b = $("#idtipobeca").val();
				  var l = $("#idlinkqa").val();
				 $("#datapaso3").load('Pages/listar_pasosnew.php?p=3&i='+x+'&b='+b);
				 var dataString = 'p=3&i='+x+'&b='+b+'&l='+l;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/listar_comentarios.php",
				data: dataString,
				async: false,
				success: function (data) {
						$('#ops_paso3').html(data);
				}}));
            });

            $(".numpaso4").click(function () {
                subTabOcultar();
				$("#tabpaso4").show();
				$(".numpaso4").addClass("active");
				 var x = $("#idpostulacion").val();
				 var b = $("#idtipobeca").val();
				  var l = $("#idlinkqa").val();
				 $("#datapaso4").load('Pages/listar_pasosnew.php?p=4&i='+x+'&b='+b);
				var dataString = 'p=4&i='+x+'&b='+b+'&l='+l;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/listar_comentarios.php",
				data: dataString,
				async: false,
				success: function (data) {
						$('#ops_paso4').html(data);
				}}));  
            });



            $(".numpaso5").click(function () {
                subTabOcultar();
				$("#tabpaso5").show();
				$(".numpaso5").addClass("active");
				 var x = $("#idpostulacion").val();
				 var b = $("#idtipobeca").val();
				  var l = $("#idlinkqa").val();
				 $("#datapaso5").load('Pages/listar_pasosnew.php?p=5&i='+x+'&b='+b);
				 var dataString = 'p=5&i='+x+'&b='+b+'&l='+l;
				$.when(
				$.ajax({
				type: "GET",
				url: "Pages/listar_comentarios.php",
				data: dataString,
				async: false,
				success: function (data) {
						$('#ops_paso5').html(data);
				}}));
            });
            $(".numpaso6").click(function () {
                subTabOcultar();
				$("#tabpaso6").show();
				$(".numpaso6").addClass("active");
            });
            $(".numpaso7").click(function () {
                subTabOcultar();
				$("#tabpaso7").show();
				 $(".numpaso7").addClass("active");
				  var b = $("#idtipobeca").val();
				  var x = $("#idpostulacion").val();
				   var l = $("#idlinkqa").val();
				   
				   $("#bt_postulacion_estado").next().remove();

				    $("#listardocumentos").load('Pages/listar_pasosnew.php?p=5&i='+x+'&b='+b);

				    //$(".numresume").trigger('click');

    				//AbrirPostulacion(x,b,l);
	
				    //alert(5555);
				    //$("#listarresumensimple").html("");
				    //$("#listarresumensimple").load('Pages/informacion_resumennew.php?r=123123123123213&i='+x+'&b='+b);
				 //$("#resumencontrolcalidad").load('Pages/informacion_validacion.php?i='+x+'&b='+b);

				 //$("#resumeninfo").load('Pages/informacion_resumennew.php?i='+x+'&b='+b);

				 //$("#resumendatapaso5").load('Pages/listar_pasosnew.php?p=5&i='+x+'&b='+b);

				 if(b == "1"){
				 	var dataString = 'i='+x+'&b='+b+'&l='+l;
					//alert("b1: " + dataString);
					$.when(
					$.ajax({
					type: "GET",
					url: "Pages/validaciones_vivienda.php",
					data: dataString,
					async: false,
					success: function (data) {
						$('#validacioncontrolcalidad').html(data);
						calcular_prom();
					}}));
				 }else if(b == "2"){
				 	//alert("estudios");
				 	var dataString = 'i='+x+'&b='+b+'&l='+l;
				 	//alert("b2: " + dataString);
					$.when(
					$.ajax({
					type: "GET",
					url: "Pages/validaciones_estudios2.php",
					data: dataString,
					async: false,
					success: function (data) {
						$('#validacioncontrolcalidad').html(data);
					}}));
				 }
				 
            });


            $(".btab32").click(function () {
                subTabOcultar();
                $("#tab32").show();
            });

            $(".btab33").click(function () {
                subTabOcultar();
                $("#tab33").show();
            });

			
            $("#tab2").attr('disabled', true);
            $("#tab3").attr('disabled', true);
            $("#tab4").attr('disabled', true);
            $("#tab5").attr('disabled', true);

            
            $("#tab1").click(function (e) {
				datos = this.href.split("#");
				var href = datos[1];
				window.location.hash = href;
   				e.preventDefault();
                TabOcultar();
                $("#Tab_Buscar").show();
                limpiarTab();
                $(this).removeClass().addClass("active");

            });

            $("#tab2").click(function (e) {
				datos = this.href.split("#");
				var href = datos[1];
				window.location.hash = href;
   				e.preventDefault();		
                TabOcultar();
                $("#Tab_Cliente").show();
                limpiarTab();
                $(this).removeClass().addClass("active");
            });
			
            $("#tab7").click(function (e) {
				datos = this.href.split("#");
				var href = datos[1];
				window.location.hash = href;
   				e.preventDefault();
                TabOcultar();
                $("#Tab_Cola").show();
                limpiarTab();
                $(this).removeClass().addClass("active");
            	$("#filtro_cola_estado").val(20); 
				$("#filtro_cola_estado_1").val(0);
				
			});
			
			$("#tab8").click(function (e) {
				datos = this.href.split("#");
				var href = datos[1];
				window.location.hash = href;
   				e.preventDefault();
                TabOcultar();
				$("#Tab_AdministracionCola").show();
                limpiarTab();
                $(this).removeClass().addClass("active");
            });

            $("#tab3").click(function (e) {
				datos = this.href.split("#");
				var href = datos[1];
				window.location.hash = href;
   				e.preventDefault();
                TabOcultar();
                $("#Tab_Administracion").show();
				$("#cl_solicitante").focus();
                limpiarTab();
                $(this).removeClass().addClass("active");
            });

            $("#tab4").click(function (e) {
				datos = this.href.split("#");
				var href = datos[1];
				window.location.hash = href;
   				e.preventDefault();
                TabOcultar();
                $("#Tab_Historico").show();
                limpiarTab();
                $(this).removeClass().addClass("active");
            });
					

            $("#tab5").click(function (e) {
				datos = this.href.split("#");
				var href = datos[1];
				window.location.hash = href;
   				e.preventDefault();
				llavesalirf5 = false;
				
				fnCuelgaLlamada();
				return false;
			
				var data0 = $("#llave").val();
				var data3 = $("#correlativos").val();
				var ranm = Math.ceil(Math.random()*500);
				var clfilial = $("#esfilial").val();
				//alert(clfilial);
                var $dialog = $('<div></div>')
				
                .load('Pages/formato_colgar.php?q=<?php echo $busqueda; ?>&f='+clfilial+'&k='+data0+'&b='+data3+'&ca='+ranm)
				
                .dialog({
                    autoOpen: false,
                    //open: function (event, ui) { $(".ui-dialog-titlebar-close").hide(); },
                    bgiframe: true,
                    modal: true,
                    draggable: false,
                    resizable: false,
                    closeOnEscape: false,
                    height: 350,
                    title: 'COLGAR LLAMADO',
                    width: 700,
                    dialogClass: 'myDialog',
                    position: 'center',
					close: function (event, ui) {
               			 $dialog.dialog('destroy').remove();
						 
         			}
                });
                $dialog.dialog('open');
            });

            $("#salir").click(function () {
                window.location.replace('Pages/salir.php');
            });
			

            $("#bt_buscar_rut").click(function () {
                var rutbuscar = $("#txt_buscar_rut").val();
                if (rutbuscar == "") {
                alert("CAMPO VACIO");
                return false;
                }
          
                dataString = "q="+rutbuscar;

                $("#resultadoBuscar").html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");

                $.ajax({
                    type: "GET",
                    url: "Pages/buscar_rut.php",
                    data: dataString,
                    success: function (data) {
                    $("#resultadoBuscar").html(data);
                    }
                });
            });
			
			 			
			$(".guarda_comentarios").click(function () {
                var paso = $(this).attr("rel");
				var qlink = $("#idlinkqa").val();
				var textoq = $("#ops_paso"+paso).val();
				var beca = $("#idtipobeca").val();
                dataString = "p="+paso+'&b='+beca+'&l='+qlink+'&t='+textoq;
                //$("#ops_paso"+paso).append("<center><img src='style/img/ajax-loader-finder.gif'/></center>");
				var botnaux = $(this);
				botnaux.hide();
				$(this).next().remove();
				$(this).after("<span class='mensaje_paso"+paso+"'><center><img src='style/img/ajax-loader-finder.gif'/></center></span>");
				//.html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");
				//return false;

                $.ajax({
                    type: "GET",
                    url: "Pages/guardar_observaciones.php",
                    data: dataString,
                    success: function (data) {
					     if(data == "1"){
							botnaux.show();
							botnaux.next().remove();
							botnaux.after("<span><a href='#' class='inline-link-g2'>Guardado Correctamente</a></span>");
						 }else{
							 $(".mensaje_paso"+paso).html(data);
							 botnaux.after("<span><a href='#' class='inline-link-g1'>Error al Guardar</a></span>");
						 }
                    }
                });
            });
			
			$("#bt_controlcalidad_clt").click(function () {
 				var qlink = $("#idlinkqa").val();
				var beca = $("#idtipobeca").val();
                auxString = '&b='+beca+'&l='+qlink;
				
				//var dataString = $("#frm_validacioncontrolcalidad").serialize()+auxString;
				
				//alert(dataString);
				
				/*if($("#frm_validacioncontrolcalidad #tr4").val() == ""){
					alert("Debes completar el campo N� Contrato");
					return false;
				}*/
				
				if($("#frm_validacioncontrolcalidad #tr14").val() == ""){
					alert("Debes completar la remuneraci�n promedio.");
					return false;
				}
				
				var data1 =  $("#frm_validacioncontrolcalidad #destino option:selected").val();
				
				if(data1 == "0"){
					alert("Debes completar el tipo de postulante.");
					return false;
				}		
				
				var data1 =  $("#frm_validacioncontrolcalidad #ensenanzabene_select option:selected").val();
				
				if(data1 == "0"){
					alert("Debes completar la instituci�n.");
					return false;
				}			
				
				
				if($("#frm_validacioncontrolcalidad #tr26").val() == ""){
					alert("Debes completar el promedio de notas.");
					return false;
				}
				
				if($("#frm_validacioncontrolcalidad #obs").val() == ""){
					alert("Debes completar una observaci�n general.");
					return false;
				}

				
				
				//alert($("#frm_validacioncontrolcalidad").serialize());
				
				$("#frm_validacioncontrolcalidad #destino_val").prop('disabled', false);
				$("#frm_validacioncontrolcalidad #tr11").prop('disabled', false);
				$("#frm_validacioncontrolcalidad #tr14").prop('disabled', false);
				$("#frm_validacioncontrolcalidad #tr4").prop('disabled', false);
				
                //$("#ops_paso"+paso).append("<center><img src='style/img/ajax-loader-finder.gif'/></center>");
				var botnaux = $(this);
				botnaux.hide();
				$(this).next().remove();
				$(this).after("<span class='mensaje_qa'><center><img src='style/img/ajax-loader-finder.gif'/></center></span>");
				
				var dataString = $("#frm_validacioncontrolcalidad").serialize()+auxString;
				
				//console.log(dataString);
				//return false;
				
				$("#frm_validacioncontrolcalidad #destino_val").prop('disabled', true);
				$("#frm_validacioncontrolcalidad #tr11").prop('disabled', true);
				$("#frm_validacioncontrolcalidad #tr14").prop('disabled', true);
				$("#frm_validacioncontrolcalidad #tr4").prop('disabled', true);
				
				//return false
				//console.log(dataString);

                $.ajax({
                    type: "GET",
                    url: "Pages/guardar_validacionesqa.php",
                    data: dataString,
                    success: function (data) {
						
						//return false;
					     if(data == "1"){
					     	//$("#idnota").val();
					     	$("#bt_calcula_ponderacion").trigger('click');
							botnaux.show();
							botnaux.next().remove();
							botnaux.after("<span class='cont_bt_gpond'><a href='#' class='inline-link-g2'>Guardado Correctamente</a></span>");
							$(".numpaso7").trigger('click');
							$("#bt_ponderacion_clt").trigger('click');
							$(".calculo_estudios h2 a#pond_final222").show();
						 }else{
							 $(".mensaje_qa").html(data);
							 botnaux.after("<span class='cont_bt_gpond'><a href='#' class='inline-link-g1'>Error al Guardar</a></span>");
						 }
                    }
                });
            });


            $("#bt_buscar_folio").click(function () {
                var rutbuscar = $("#txt_folio").val();
                if (rutbuscar == "") {
                alert("CAMPO VACIO");
                return false;
                }
          
                dataString = "q="+rutbuscar;

                $("#resultadoBuscar").html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");

                $.ajax({
                    type: "GET",
                    url: "Pages/buscar_codigo.php",
                    data: dataString,
                    success: function (data) {
                    $("#resultadoBuscar").html(data);
                    }
                });
            });

            



           $("#bt_buscar_nombre").click(function (){

            var nombrebuscar = $("#txt_buscar_nombre").val();
			var largo = $("#txt_buscar_nombre").val().length;
			
            if (nombrebuscar == "" || largo < 4) {
                alert("CAMPO VACIO o DEMASIADO CORTO EL NOMBRE");
                return false;
            }
          
            dataString = "q="+nombrebuscar;

            $("#resultadoBuscar").html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");

            $.ajax({
                    type: "GET",
                    url: "Pages/buscar_razon.php",
                    data: dataString,
                    success: function (data) {
                    $("#resultadoBuscar").html(data);
                    }
            });

            });



             $("#bt_oportunidad_lst").click(function () {
                var buscar = $("#cl_id").val();
         
                dataString = "q="+buscar;
				
				

                $("#listar_oportunidad").html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");

                $.ajax({
                    type: "GET",
                    url: "Pages/listar_bitacoras.php",
                    data: dataString,
					extaParams: {timestamp:'cache'},
                    success: function (data) {
                    $("#listar_bitacora").html(data);
                    }
                });
            });
			
			jQuery.fn.crearSolicitantes = function () {
			    var buscar = $("#cl_id").val();
                dataString = "q="+buscar;
                $.ajax({
                    type: "GET",
                    url: "Pages/listar_contactos_gestion.php",
                    data: dataString,
                    success: function (data) {
                    $("#listado_solicitantes").html(data);
                    }
                });

             };


			jQuery.fn.crearTipos = function () {
                $.ajax({
                    complete: function () {
							 $("#cl_tipos").change(function (){
							 	var data1 =  $("#cl_tipos option:selected").val();	
								//alert(data1);
							  	$(this).crearSubtipo(data1);
								//$(this).crearResolucion();
							});
                    },
                    type: "GET",
                    url: "Pages/listar_tipos.php",
                    data: dataString,
                    success: function (data) {
                    $("#listado_tipos").html(data);
                    }
                });

             };
			 
			 jQuery.fn.crearDetalles = function (valor) {
				
				if(typeof valor != 'undefined'){ 
					dataString = "subtipo="+valor;
				}
			 	
                $.ajax({
                    complete: function () {
							 $("#cl_detalle").change(function (){
							 	var data1 =  $("#cl_detalle option:selected").val();	
							  	$(this).crearResolucion(data1);
								//$(this).crearResolucion();
							});
                    },
                    type: "GET",
                    url: "Pages/listar_detalle.php",
                    data: dataString,
                    success: function (data) {
                    $("#listado_detalles").html(data);
                    }
                });

             };
			 
	         jQuery.fn.listarCola = function (filtro) {
			     dataString = filtro;
                $("#resultadocola").html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");
				var data1 = MostrarLoad();
				//alert(data1);
                $.ajax({
                    type: "GET",
                    url: "Pages/buscar_cola.php",
                    data: dataString,
                    success: function (data) {
						
                    	$("#resultadocola").html(data);
						quitarLoad();
                    }
                });
			};
			 	
			jQuery.fn.crearCiudades = function () {
                $.ajax({
                    complete: function () {
                            $("#cl_ciudad").val("1");
							 $("#cl_ciudad").change(function (){
							 	
							 var data1 =  $("#cl_ciudad option:selected").val();	
							 //alert(data1);
							  $(this).crearComunas(data1);
							});
                    },
                    type: "GET",
                    url: "Pages/listar_ciudades.php",
                    data: dataString,
                    success: function (data) {
                    $("#listado_ciudades").html(data);
                    }
                });

             };


			jQuery.fn.crearSubtipo = function (valor) {
				if(typeof valor != 'undefined'){ 
					dataString = "tipo="+valor;
				}
				//alert(dataString);
                $.ajax({
                    type: "GET",
                    url: "Pages/listar_subtipo.php",
                    data: dataString,
					complete: function () {
							 $("#cl_subtipo").change(function (){
							 	var data1 =  $("#cl_subtipo option:selected").val();	
								$(this).crearDetalles(data1);
							});
                    },
                    success: function (data) {
                    $("#listado_subtipos").html(data);
                    }
                });
                
             };
			 
			 
			 	jQuery.fn.crearResolucion = function (valor) {
				if(typeof valor != 'undefined'){ 
					dataString = "detalle="+valor;
				}
                $.ajax({
                    type: "GET",
                    url: "Pages/listar_resolucion.php",
                    data: dataString,
                    success: function (data) {
                    $("#listado_resolucion").html(data);
                    }
                });
                
             };
			 
                       
             jQuery.fn.crearComunas = function (valor) {
				if(typeof valor != 'undefined'){ 
					dataString = "ciudad="+valor;
				}
				
                $.ajax({
                    complete: function () {
                            $("#cl_comuna").val("1"); 
                    },
                    type: "GET",
                    url: "Pages/listar_comunas.php",
                    data: dataString,
                    success: function (data) {
                    $("#listado_comunas").html(data);
                    }
                });
                
             };

            
            $("#bt_reclamos_lst").click(function () {
                var buscar = $("#cl_id").val();
                dataString = "q="+buscar;

                $("#listar_reclamos").html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");

                $.ajax({
                    type: "GET",
                    url: "Pages/listar_reclamos.php",
                    data: dataString,
                    success: function (data) {
                    $("#listar_reclamos").html(data);
                    }
                });
            });
            
             $("#bt_lista_contactos").click(function () {
                var buscar = $("#con_id").val();
         
                dataString = "q="+buscar;
                

                $("#listar_contactos").html("<center><img src='style/img/ajax-loader-finder.gif'/></center>");

                $.ajax({
                    type: "GET",
                    url: "Pages/listar_contactos.php",
                    data: dataString,
                    success: function (data) {
                    $("#listar_contactos").html(data);
                    }
                });
            });


             $("#bt_lista_contactos").trigger('click');

            $("#campo_detalles").hide();
            $("#campo_detalles_contactos").hide();


            $("#bt_agregar_contacto").click(function () {
                $("#campo_detalles_contactos").toggle("slow");
            });

            $("#open_crear_clt").click(function () {
               $("#campo_nuevo_cliente").toggle("slow");
            });

            
            $(".checklist input:checked").parent().addClass("selected");

            /* handle the user selections */
            $(".checklist .checkbox-select").click(
            function (event) {
                event.preventDefault();
                $(this).parent().addClass("selected");
                $(this).parent().find(":checkbox").attr("checked", "checked");
            }
            );

            $(".checklist .checkbox-deselect").click(
            function (event) {
                event.preventDefault();
                $(this).parent().removeClass("selected");
                $(this).parent().find(":checkbox").removeAttr("checked");
            }
            );

            $(".mascara_filtro").addClass("selected");

            $("#dialog").dialog();

			

			
			
			
			
            $("#bt_actualizar_clt").click(function () {
			
			
			
			var llavegestion = $("#llavegestion").val();
			//alert(llavegestion);
			if(llavegestion == "1" ){
					//alert("Actualizando datos cliente tipo gesti�n CRM");				
				if(valida_prefijos_celular() == true){
						return false;
					}
				
				if(valida_prefijos_fijos() == true){
						return false;
					}	
								
			}//fin  if llavegestion		
			else{
				//alert("Actualizando datos cliente tipo gesti�n CRM");	
				if(valida_prefijos_gcrm()){
				 	return false;
				 }else{
				 	$("#cl_fono1").val();
				 }			
			}
			
			var numerofono1crm = $("#cl_fono1").val();
			//alert("el numero fono 1 gestioncrm viene asi:"+numerofono1crm);
			//alert("hice click");
			//var celu1 = $("#cl_fono1_aux").val();
			//$("#cl_fono1").val(celu1);
			
			
			///agregar aqui las validacione de fonos
					
			
                var data0 = $("#cl_id").val();		
                if (data0 == "") {
                    alert("NO EXISTE CLIENTE");
                    return false;
                }
				

                var data1 = $("#cl_nombre").val();
                if (data1 == "") {
                    alert("FALTA UN NOMBRE");
                    $("#cl_nombre").focus();
                    return false;
                }


                
					var data3 = $("#cl_fono1_aux").val();
				if (data3 == "") {
                    alert("FALTA UN FONO");
                    $("#cl_dire").focus();
                    return false;
                }
				
				
                var data4 = $("#cl_fono1").val();
					//alert("la data4 es: "+data4);
				
                
				var data5 = $("#cl_usuario").val();
				if (data5 == "") {
                    alert("NO HAZ INICIADO SESION");
                    return false;
                }
				
                var data6 = $("#cl_mail").val();
                
				var data7 = $("#cl_apellidop").val();
				if (data7 == "") {
                    alert("Falta Apellido Paterno");
					 $("#cl_apellidop").focus();
                    return false;
                }
				
				var data17 = $("#cl_apellidom").val();
				if (data17 == "") {
                    alert("Falta Apellido Materno");
					 $("#cl_apellidop").focus();
                    return false;
                }
				
                var data8 = $("#cl_comuna").val();
                var data9 = $("#cl_ciudad").val();

                var dataString = $("#form_datoscliente").serialize();
				
				//alert(dataString);
				
				//return false;
				
                $("#bt_actualizar_clt").hide();
				$('#debug_guardar').html("");

                $.ajax({
                    complete: function () {
                               $("#bt_actualizar_clt").show();
							   $(this).crearSolicitantes();
                            },
                    error: function (objeto, quepaso, otroobj) {
                        alert("Error inesperado al intentar procesar la solicitud \n contacte a su administrador");
                        $("#debug_guardar").html(objeto.responseText);
                    },
                    type: "GET",
                    url: "Pages/guardar_cliente.php",
                    data: dataString,
                    success: function (data) {
							//alert(data);
                        if(data==1){
                            //alert("GUARDADO");
							//$("#op_glosa").attr("disabled", "");
							$("#llave").val(1);
							
							
							var liData = "<a href='#' class='inline-link-g2'>Guardado Correctamente</a>";
							$('#debug_guardar').html(liData);
							//$(liData).prependTo('#debug_guardar').fadeIn('slow');
							
							
							var llavegestion = $("#llavegestion").val();
							var numeroLetras = $("#op_glosa").val().length;
							var mensaje = $("#op_glosa").val();
							var posicion = mensaje.indexOf('DETALLE DEL REQUERIMIENTO:');
							var porcion = mensaje.substring(posicion+27, numeroLetras);
		
						var celular = $("#cl_celu_aux").val()!=""?"\nCELULAR1 :"+$("#pcel").val()+"-"+$("#cl_celu_aux").val():"";
						var celular2 = $("#cl_celu2_aux").val()!=""?"\nCELULAR2 :"+$("#pcel2").val()+"-"+$("#cl_celu2_aux").val():"";
						var fono1 = $("#cl_fono1_aux").val()!=""?"\nFONO1 :"+$("#pfono1").val()+"-"+$("#cl_fono1_aux").val():"";
						var fono2 = $("#cl_fono2_aux").val()!=""?"\nFONO2 :"+$("#pfono2").val()+"-"+$("#cl_fono2_aux").val():"";
						var fono3 = $("#cl_fono3_aux").val()!=""?"\nFONO3 :"+$("#pfono3").val()+"-"+$("#cl_fono3_aux").val():"";
						var fono4 = $("#cl_fono4_aux").val()!=""?"\nFONO4 :"+$("#pfono4").val()+"-"+$("#cl_fono4_aux").val():"";
						var email = $("#cl_mail").val()!=""?"\nCORREO CORREO ELECTRONICO :"+$("#cl_mail").val():"";
							/*
							//alert(celular);
							if(llavegestion == 1){
							//alert(llavegestion);
	$("#op_glosa").val("NOMBRE: "+$("#cl_nombre").val()+ " "+$("#cl_apellidop").val()+ " "+$("#cl_apellidom").val()+ "\nRUT: <?php //echo $row["NN_RUT"]."-".$row["CR_DV"]; ?>"+"\nLOCALIDAD: <?php //echo $row["CR_COMUNA"]; ?>"+"\nFONO VISOR: "+$("#op_fono").val()+celular+celular2+fono1+fono2+fono3+fono4+email+ "\nNUMERO: <?php //echo $row["NN_NUMEROPOS"]; ?>" + "\nFECHA REPORTE: <?php echo date("d-m-Y"); ?>" + "\nHORA REPORTE: <?php echo date ("H:i:s", $now); ?>" + "\nDETALLE DEL REQUERIMIENTO: "+porcion   );
							}//fin if llavegestion
							else{
$("#op_glosa").val("NOMBRE: "+$("#cl_nombre").val()+ " "+$("#cl_apellidop").val()+ " "+$("#cl_apellidom").val()+ "\nRUT: <?php //echo $row["NN_RUT"]."-".$row["CR_DV"]; ?>"+"\nFONO VISOR: "+$("#op_fono").val()+
fono1+ "\nPOS: <?php //echo $row["NN_NUMEROPOS"]; ?>" + "\nFECHA REPORTE: <?php //echo date("d-m-Y"); ?>" + "\nHORA REPORTE: <?php echo date ("H:i:s", $now); ?>" + "\nDETALLE DEL REQUERIMIENTO: "+porcion );
								
							}//fin else
							*/
								
                        }else{
						    alert("NO SE PUDO GUARDAR");
							var liData = "<a href='#' class='inline-link-g3'>No se pudo Guardar</a>";
							$('#debug_guardar').html(liData);
						}
                    }
                });

                return false;

            });

            // **** FIN REALIZAR ACTUALIZACION *********** //


            //************** nuevo cliente **************//

             $("#bt_crear_clt").click(function () {

                var data0 = $("#nu_nombre").val();
                if (data0 == "") {
                    $("#nu_nombre").css("border", "solid RED 1px");;
                    $("#nu_nombre").focus();
                    return false;
                }

                var data1 = $("#nu_apellidop").val();
                if (data1 == "") {
                    $("#nu_apellidop").css("border", "solid RED 1px");;
                    $("#nu_apellidop").focus();
                    return false;
                }
		
				var data1 = $("#nu_fono").val();
                if (data1 == "") {
                    $("#nu_fono").css("border", "solid RED 1px");;
                    $("#nu_fono").focus();
                    return false;
                }
				
				var data6 = $("#nu_rut").val();

                var dataString = $("#form_nuevoclt").serialize();
				//alert(dataString);
                $("#bt_crear_clt").hide();

                $.ajax({
                    error: function (objeto, quepaso, otroobj) {
                        alert("Error inesperado al intentar procesar la solicitud \n contacte a su administrador");
                        $("#debug_crear_cliente").html(objeto.responseText);
                    },
                    type: "GET",
                    url: "Pages/crear_cliente.php",
                    data: dataString,
                    success: function (data) {
						//alert(data);
                        if(data==1){
                           alert("REGISTRO CREADO");
                           $("#open_crear_clt").trigger('click');
                           $("#txt_buscar_rut").val(data6);
						   $("#bt_buscar_rut").trigger('click');
                        }
                        if(data==0){
                           alert("YA EXISTE EN LA BASE");
						   $("#bt_crear_clt").show();
                        }
                      }
                });

                return false;

            });

            //****************fin nuevo cliente *********//

            //********** validar cliente rut ***************/

            
            $("#bt_validar_clt").click(function () {

                var data0 = $("#nu_rut").val();
                if (data0 == "") {
                    $("#nu_rut").css("border", "solid RED 1px");;
                    $("#nu_rut").focus();
                    return false;
                }

                var data1 = $("#nu_dv").val();
                if (data1 == "") {
                    $("#nu_dv").css("border", "solid RED 1px");;
                    $("#nu_dv").focus();
                    return false;
                }

                var dataString = 'rut=' + data0 + '&dv=' + data1;

                $("#bt_validar_clt").hide();


                $.ajax({
                    complete: function () {
                               $("#bt_validar_clt").show();
                    },
                    error: function (objeto, quepaso, otroobj) {
                        alert("Error inesperado al intentar procesar la solicitud \n contacte a su administrador");
                    },
                    type: "GET",
                    url: "Pages/consultar_rut.php",
                    data: dataString,
                    success: function (data) {
						//alert(data);
                        if(data==0){
                            habilitarCrear();
							$("#nu_nombre").focus();
                            //alert("CORRECTO");
                        }
                        if(data==2){
                            alert("RUT INVALIDO");
                        }
                        if(data==1){
                            alert("CLIENTE YA EXISTE");
                        }
                    }
                });

                return false;

            });

            //******************* fin validaar rut ************//

            //*********** ENVIAR OPORTUNIDAD ************//


//francisco            url = remove_accent($(this).find("#Buscador").val().replace(' ','+'));

			$("#bt_calcula_ponderacion_infovalidacion").click(function () {
				var x = $("#idpostulacion").val();
				 var b = $("#idtipobeca").val();
				 var l = $("#idlinkqa").val();
				
				var dataString = "i="+x;
				//$("#dataponderaciones").load('Pages/ponderacion.php?i='+x);
				
				//alert("bt_calcula_ponderacion_infovalidacion"+dataString);
				if(b == "2"){
					var ruta = "Pages/ponderacion_estudios.php";
				}
				
				if(b == "1"){
					var ruta = "Pages/ponderacion_vivienda.php";
				}
				
				$.ajax({
					type: "GET",
					url: ruta,
					data: dataString,
					async: false,
					success: function (data) {
						//alert(data);
						if (window.console) console.log('--->DEBUG22 '+ruta+': '+data);
						var res = data.split("|");
	
						$("#p_pondx_1"+b).html(res[0]);
						$("#p_pondx_3"+b).html(res[1]);
						$("#p_pondx_4"+b).html(res[2]);
						$("#p_pondx_2"+b).html(res[3]);
						$("#p_pond_1"+b).val(res[6]);
						$("#p_pond_2"+b).val(res[7]);
						$("#p_pond_3"+b).val(res[8]);
						$("#p_pond_4"+b).val(res[9]);
						$("#p_pond_final").html(res[10]);
						$("#p_idnota").val(res[10]);
						if(res[7]==""){
						 $("#p_pond_2"+b).attr("disabled","");
						 }

						
						
					},
					error: function (objeto, quepaso, otroobj) {
					   if (window.console) console.log('ERROR AL INTENTAR ENVIAR  Pages/ponderacion.php --> '+objeto.responseText);
					}
				})
				
								
			});


			$("#bt_calcula_ponderacion").click(function () {
				var x = $("#idpostulacion").val();
				 var b = $("#idtipobeca").val();
				 var l = $("#idlinkqa").val();
				
				var dataString = "i="+x;
				//$("#dataponderaciones").load('Pages/ponderacion.php?i='+x);
				
				//alert(dataString);
				if(b == "2"){
					var ruta = "Pages/ponderacion_estudios.php";
				}
				
				if(b == "1"){
					var ruta = "Pages/ponderacion_vivienda.php";
					//alert(dataString);
				}
				
				$.ajax({
					type: "GET",
					url: ruta,
					data: dataString,
					async: false,
					success: function (data) {
						
						if (window.console) console.log('--->DEBUG11 '+ruta+': '+data);
						var res = data.split("|");
	
						//console.log("bt_calcula_ponderacion:" + res[0]);

						$("#pondx_1"+b).html(res[0]);
						$("#pondx_3"+b).html(res[1]);
						$("#pondx_4"+b).html(res[2]);
						$("#pondx_2"+b).html(res[3]);
						$("#pond_1"+b).val(res[6]);
						$("#pond_2"+b).val(res[7]);
						$("#pond_3"+b).val(res[8]);
						$("#pond_4"+b).val(res[9]);
						$("#pond_final").html(res[10]);
						$("#idnota").val(res[10]);
						if(res[7]==""){
						 $("#pond_2"+b).attr("disabled","");
						 }

						
						
					},
					error: function (objeto, quepaso, otroobj) {
					   if (window.console) console.log('ERROR AL INTENTAR ENVIAR  Pages/ponderacion.php --> '+objeto.responseText);
					}
				})
				
								
			});

            $("#bt_solicitud_clt").click(function () {
				
				var dataString = $("#frm_gestion").serialize();
                

				if($("#llave").val()==0){
					alert("Debes actualizar los datos del cliente/contacto antes de ejecutar una gesti�n");
					 return false;
				}
				
                var data0 = $("#op_id").val();
                if (data0 == "") {
                    alert("NO EXISTE CLIENTE");
                    return false;
                }

                var data2 = $("#cl_solicitante").val();
                if (data2 == "0") {
                    $("#cl_solicitante").css("border", "solid RED 1px");;
                    $("#cl_solicitante").focus();
                    return false;
                }
				
				var data3 = $("#op_fono").val();
                if (data3 == "") {
                    $("#op_fono").css("border", "solid RED 1px");;
                    $("#op_fono").focus();
                    return false;
                }
				
				var data5 = $("#cl_tipo").val();
                if (data5 == "0") {
                    $("#cl_tipo").css("border", "solid RED 1px");;
                    $("#cl_tipo").focus();
                    return false;
                }
				
				var data6 = $("#cl_subtipo").val();
                if (data6 == "0") {
                    $("#cl_subtipo").css("border", "solid RED 1px");;
                    $("#cl_subtipo").focus();
                    return false;
                }
				
				var data8 = $("#cl_detalle").val();
                if (data8 == "0") {
                    $("#cl_detalle").css("border", "solid RED 1px");;
                    $("#cl_detalle").focus();
                    return false;
                }

				var data7 = $("#cl_resolucion").val();
                if (data7 == "0") {
                    $("#cl_resolucion").css("border", "solid RED 1px");;
                    $("#cl_resolucion").focus();
                    return false;
                }
				
				var data4 = $("#op_glosa").val();
                if (data4 == "") {
                    $("#op_glosa").css("border", "solid RED 1px");;
                    $("#op_glosa").focus();
                    return false;
                }

				var dataString = $("#frm_gestion").serialize();
               // alert(dataString);

                $("#bt_solicitud_clt").hide();

                $.ajax({
                    complete: function () {
							   $("#frm_gestion").reset();
							   $("#op_fono").val(data3);
                            },
                    error: function (objeto, quepaso, otroobj) {
                        alert("Error inesperado al intentar procesar la solicitud \n contacte a su administrador");
                        $("#debug_oportunidad").html(objeto.responseText);
                    },
                    type: "GET",
                    url: "Pages/guardar_gestion.php",
                    data: dataString,
                    success: function (data) {
						//alert(data);
						if(data>0){
                            //alert("GESTION CREADA");
							$("#llave").val(2)
							var liData = "<a href='#' class='inline-link-g0'>Gestion #100"+data+"</a>";
							$(liData).prependTo('#gestiones_realizadas').fadeIn('slow');
							var infoactual = $("#correlativos").val();
							$("#correlativos").val(infoactual+","+data);
							$("#bt_solicitud_clt").show();
							$("#bt_oportunidad_lst").trigger('click');
                        }else{
							alert("FALLO LA CREACION, CONTACTE A SU ADMINISTRADOR.");
						}
                    }
                });

                return false;

            });


  



            //************ FIN OPORTUNIDAD ******************//

           $("#Buscar tr").click(function() {
                $("#Buscar tr").css("border", "solid RED 1px");
                var idusuario =  $(this).find("td").eq(0).text();
                var nomusuario =  $(this).find("td").eq(4).text();
                $("#elegido").val(nomusuario);
                $("#numero_usuario").val(idusuario);
             });

            //*********** crear contacto ***********//

             $("#con_enviar_crear").click(function () {

                var data0 = $("#con_id").val();
                if (data0 == "") {
                    alert("NO EXISTE CLIENTE");
                    return false;
                }

                var data1 = $("#con_nombre").val();
                if (data1 == "") {
                    $("#con_nombre").css("border", "solid RED 1px");;
                    $("#con_nombre").focus();
                    return false;
                }
				
				var data2 = $("#con_fono").val();
				var data3 = $("#con_celu").val();
				var data4 = $("#con_anexo").val();
				var data5 = $("#con_trabajo").val();
				
                if (data2 == "" && data3 == "" && data5 == "") {
                    alert("Debes ingresar al menos un tel�fono")
                    $("#con_fono").focus();
                    return false;
                }

                var dataString = $("#form_contacto").serialize();
				
				//alert(dataString);

                $("#con_enviar_crear").hide();


                $.ajax({
                    complete: function () {
                               $("#con_enviar_crear").show();
							   $("#form_contacto").reset();
							   $(this).crearSolicitantes();
							   $("#campo_detalles_contactos").toggle("slow");
                            },
                    error: function (objeto, quepaso, otroobj) {
                        alert("Error inesperado al intentar procesar la solicitud \n contacte a su administrador");
                        $("#debug_contacto").html(objeto.responseText);
                    },
                    type: "get",
                    url: "Pages/guardar_contacto.php",
                    data: dataString,
                    success: function (data) {
						//alert(data);
                        if(data==1){
                            alert("GUARDADO");
							$("#llave").val(1);
                            $("#bt_lista_contactos").trigger('click');
                        }
                    }
                });

                return false;

            });

            //********************* *****************/

             $(".delete-contacto").click(function () {
                alert($(this).attr("id"));
             });

			$("#tab8").hide();
                       
			//$(this).listarCola("q=1");
			$(this).crearCiudades();
            $(this).crearComunas();
			$(this).crearTipos();
			$(this).crearSubtipo();
			$(this).crearDetalles();
			$(this).crearSolicitantes();
			$(this).crearResolucion();
            $("#bt_oportunidad_lst").trigger("click");
			//$("#avanzado_contect").hide();
			//$("#contactos_contect").hide();
			
			<?php if(in_array($_SESSION["perfil"], array("3","4"))){ ?>
			<?php if($busqueda>0){ ?>
			$(this).Mostrar();
			<?php }} ?>
			
			 <?php if(in_array($_SESSION["perfil"], array("3","2","1"))){ ?>
			 $("#tab7").trigger("click");
			 <?php } ?>
			
			
			
			
			
			
	});//fin ready
	
	function valida_prefijos_gcrm() {
	
	var fono1crm = $("#cl_fono1_aux").val();
		 var lfonocrm = $("#cl_fono1_aux").val().length;
		 var pfonocrm = $("#pfono1").val();
		 var real_fono1crm = pfonocrm+"-"+fono1crm;
		 // alert(real_fono1);
		
		
		if(lfonocrm !=0 || pfonocrm >0){
			
				if (pfonocrm == 0) {
					$("#pfono1").css({ borderColor: "red" });
					$("#pfono1").focus();					
					alert("Debe seleccionar un prefijo para el fono GCRM");
					return true;
				}else{ $("#pfono1").css({ borderColor: "" });}		
				
				 if (pfonocrm ==2 && lfonocrm<8 ) {
					$("#cl_fono1_aux").css({ borderColor: "red" });
					$("#cl_fono1_aux").focus();					
					alert("Formato de fono incorrecto, deben ser 8 d�gitos");
					return true;
				}
				else{				
					$("#cl_fono1_aux").css({ borderColor: "" });
				}
				
				 if (pfonocrm !=2 && lfonocrm !=	7 ) {
					$("#cl_fono1_aux").css({ borderColor: "red" });
					$("#cl_fono1_aux").focus();					
					alert("Formato de fono incorrecto, deben ser 7 d�gitos");
					return true;
				}
				else{				
					$("#cl_fono1_aux").css({ borderColor: "" });
				}
				
				$("#cl_fono1").val(real_fono1crm);				
				//alert("paso la validacion prefijos GESTION CRM el fono es: "+real_fono1crm);
		}///fin fono1
			
	}//fin f_valida_prefijos_celular
	function valida_prefijos_celular() {

		 var celu1 = $("#cl_celu_aux").val();
		 var largo1 = $("#cl_celu_aux").val().length;
		 var pcelular = $("#pcel").val();
		 var real_celu = pcelular+"-"+celu1;
		
		
		
		if(largo1 > 0 || pcelular >0){
		//alert(pcelular);
			
				if (pcelular == 0) 	{
					$("#pcel").css({ borderColor: "red" });
					$("#pcel").focus();
					alert("Debe seleccionar un prefijo para el celular");
					return true;
				}else{$("#pcel").css({ borderColor: "" });}
				
				if (largo1 != 8) {
					$("#cl_celu_aux").css({ borderColor: "red" });
					$("#cl_celu_aux").focus();
					alert("Formato de celular incorrecto, deben ser 8 d�gitos");
					return true;
				}else{$("#cl_celu_aux").css({ borderColor: "" });}
				
				$("#cl_celu").val(real_celu);
		}
		
		
		var celu1 = $("#cl_celu2_aux").val();
		var largo2 = $("#cl_celu2_aux").val().length;
		var pcelular2 = $("#pcel2").val();
		var real_celu = pcelular2+"-"+celu1;
			
		if(largo2 !=0 || pcelular2 >0){
		 
			if (pcelular2 == 0) {
				$("#pcel2").css({ borderColor: "red" });
				$("#pcel2").focus();
				alert("Debe seleccionar un prefijo para el celular");
				return true;
			}else{$("#pcel2").css({ borderColor: "" });}
			
			if (largo2 != 8) {
				$("#cl_celu2_aux").css({ borderColor: "red" });
				$("#cl_celu2_aux").focus();
				alert("Formato de celular incorrecto, deben ser 8 d�gitos");
				return true;

			}else{$("#cl_celu2_aux").css({ borderColor: "" });}
			
			$("#cl_celu2").val(real_celu);
			
		}//fin if celu 1
		
		
		
	}//fin funcion checkeo celular
	
	
	function valida_prefijos_fijos() {
	
		 var celu1 = $("#cl_fono1_aux").val();
		 var largo1 = $("#cl_fono1_aux").val().length;
		 var pcelular = $("#pfono1").val();
		 var real_fono1 = pcelular+"-"+celu1;
		 // alert(real_fono1);
		
		
		if(largo1 !=0 || pcelular >0){
			
				if (pcelular == 0) {
					$("#pfono1").css({ borderColor: "red" });
					$("#pfono1").focus();					
					alert("Debe seleccionar un prefijo para el fono");
					return true;
				}else{ $("#pfono1").css({ borderColor: "" });}		
				
				 if (pcelular ==2 && largo1<8 ) {
					$("#cl_fono1_aux").css({ borderColor: "red" });
					$("#cl_fono1_aux").focus();					
					alert("Formato de fono incorrecto, deben ser 8 d�gitos");
					return true;
				}
				else{				
					$("#cl_fono1_aux").css({ borderColor: "" });
				}
				
				 if (pcelular !=2 && largo1 !=	7 ) {
					$("#cl_fono1_aux").css({ borderColor: "red" });
					$("#cl_fono1_aux").focus();					
					alert("Formato de fono incorrecto, deben ser 7 d�gitos");
					return true;
				}
				else{				
					$("#cl_fono1_aux").css({ borderColor: "" });
				}
				
				
				$("#cl_fono1").val(real_fono1);
		}///fin fono1
		
		
		
		 var nfono2 = $("#cl_fono2_aux").val();
		 var largof2 = $("#cl_fono2_aux").val().length;
		 var pfono2 = $("#pfono2").val();
		 var real_fono2 = pfono2+"-"+nfono2;

		if(largof2 >0 || pfono2 >0){
			
				if (pfono2 == 0) {
					$("#pfono2").css({ borderColor: "red" });
					$("#pfono2").focus();
					alert("Debe seleccionar un prefijo para el fono");					
					return true;
				}else{$("#pfono2").css({ borderColor: "" });}		
				
				if (pfono2 ==2 && largof2<8) {
					$("#cl_fono2_aux").css({ borderColor: "red" });
					$("#cl_fono2_aux").focus();
					alert("Formato de fono incorrecto, deben ser 8 d�gitos");
					return true;
				}else{$("#cl_fono2_aux").css({ borderColor: "" });}
				
				if (pfono2 !=2 && largof2 !=7) {
					$("#cl_fono2_aux").css({ borderColor: "red" });
					$("#cl_fono2_aux").focus();
					alert("Formato de fono incorrecto, deben ser 7 d�gitos");
					return true;
				}else{$("#cl_fono2_aux").css({ borderColor: "" });}
				
				
				
				$("#cl_fono2").val(real_fono2);
		}//fin if fono2
		
		var nfono3 = $("#cl_fono3_aux").val();
		 var largof3 = $("#cl_fono3_aux").val().length;
		 var pfono3 = $("#pfono3").val();
		 var real_fono3 = pfono3+"-"+nfono3;
		

		if(largof3 !=0 || pfono3 >0){
			
				if (pfono3 == 0) {
					$("#pfono3").css({ borderColor: "red" });
					$("#pfono3").focus();
					alert("Debe seleccionar un prefijo para el fono");	
					return true;
				}else{$("#pfono3").css({ borderColor: "" });}	
				
				if (pfono3 ==2 && largof3<8) {
					$("#cl_fono3_aux").css({ borderColor: "red" });
					$("#cl_fono3_aux").focus();					
					alert("Formato de fono incorrecto, deben ser 8 d�gitos");
					return true;
				}else{$("#cl_fono3_aux").css({ borderColor: "" });}
				
				if (pfono3 !=2 && largof3 !=7) {
					$("#cl_fono3_aux").css({ borderColor: "red" });
					$("#cl_fono3_aux").focus();					
					alert("Formato de fono incorrecto, deben ser 7 d�gitos");
					return true;
				}else{$("#cl_fono3_aux").css({ borderColor: "" });}
				
				$("#cl_fono3").val(real_fono3);
		}//fin if fono3
		
	var nfono4 = $("#cl_fono4_aux").val();
		 var largof4 = $("#cl_fono4_aux").val().length;
		 var pfono4 = $("#pfono4").val();
		 var real_fono4 = pfono4+"-"+nfono4;
		

		if(largof4 !=0 || pfono4 >0){
			
				if (pfono4 == 0) {
					$("#pfono4").css({ borderColor: "red" });
					$("#pfono4").focus();
					alert("Debe seleccionar un prefijo para el fono");	
					return true;
				}else{$("#pfono3").css({ borderColor: "" });}	
				
				if (pfono4 ==2 && largof4<8) {
					$("#cl_fono4_aux").css({ borderColor: "red" });
					$("#cl_fono4_aux").focus();					
					alert("Formato de fono incorrecto, deben ser 8 d�gitos");
					return true;
				}else{$("#cl_fono3_aux").css({ borderColor: "" });}
				
				if (pfono4 !=2 && largof4 !=7) {
					$("#cl_fono4_aux").css({ borderColor: "red" });
					$("#cl_fono4_aux").focus();					
					alert("Formato de fono incorrecto, deben ser 7 d�gitos");
					return true;
				}else{$("#cl_fono4_aux").css({ borderColor: "" });}
				
				$("#cl_fono4").val(real_fono4);
		}//fin if fono3
		
		
		
			
			
		
		
	}//fin funcion checkeo fono1
	
	
	
	

     </script>
</head>
<body style="display:none">
<form >
	<div id="wrapper">
    	<div id="time_rest"></div>
       <div style="width:60px; float:right; padding-right:40px;"><input type="button" name="salir" id="salir" value="SALIR" class="button-submit" /></div>
    	<h1><a href="gestion.php"><span>BECAS</span></a></h1>
        <div style="float:right"><strong style="color:Blue"><div id="nombre_usuario" ></div></strong></div>
        <div style="height:5px;" class="clear"></div>
        <ul class="mainNav">
	        <?php if($numRows == 0){ ?>
            <?php if(in_array($_SESSION["perfil"], array("3","4"))){ ?>
        	<li><a href="#tab1" id="tab1" class="active" >CALLCENTER</a></li>
            <?php }} ?>
            <?php if($numRows > 0){ ?>
            <?php if(in_array($_SESSION["perfil"], array("3","2","4"))){ ?>
        	<li><a href="#tab2" id="tab2" >ADMINISTRACION CLIENTE</a></li>
        	<li><a href="#tab3" id="tab3" >GESTIONES</a></li>
        	<li><a href="#tab4" id="tab4" >HISTORIAL</a></li>
            <?php }} ?>
            <?php if(in_array($_SESSION["perfil"], array("3","2","1"))){ ?>
            <li><a href="#tab7" id="tab7" >COLA DE POSTULACIONES</a></li>
            <li><a href="#tab8" id="tab8" >DETALLE POSTULACION</a></li>
            <?php } ?>
            <?php if($numRows > 0){ ?>
            <?php if(in_array($_SESSION["perfil"], array("3","4"))){ ?>
        	<li class="logout"><a href="#tab5" id="tab5" >COLGAR</a></li>
            <?php }} ?>
        </ul>

        <!-- //BUSCAR -->

        <div id="Tab_Buscar" class="tab">
			<div class="fullcontainer">
            
  
                <h2><a href="#">BUSCAR</a></h2>
                <div class="mainfull">
                <form>
        <fieldset>
                        	<div style="float:left; padding-left:10px;"><label>RUT DEL TRABAJADOR</label><input type="text" class="text-normal" id="txt_buscar_rut" /></div><div style="float:left; padding-top:20px;"><input type="button" name="enviar" id="bt_buscar_rut" value="IR" class="button-find" /></div>
                            <div style="float:left; padding-left:10px;"><label>NOMBRE DEL TRABJADOR</label><input type="text" class="text-normal" id="txt_buscar_nombre" /></div><div style="float:left; padding-top:20px;"><input type="button" name="enviar" id="bt_buscar_nombre" value="IR" class="button-find" /></div>
                            <div style="float:left; padding-left:10px;"><label>CODIGO</label><input type="text" class="text-normal" id="txt_folio" /></div><div style="float:left; padding-top:20px;"><input type="button" name="enviar" id="bt_buscar_folio" value="IR" class="button-find" /></div>
                            <div style="height:10px" class="clear"></div>
                            <div style="float:left; padding-left:10px; display:none;"><input type="button" name="open_crear_clt" id="open_crear_clt" value="CREAR CLIENTE" class="button-submit" /></div>
                            <div style="height:10px" class="clear"></div>
                            </form>
                            <div id="resultadoBuscar" ></div>
                            <div style="height:10px" class="clear"></div>
                            <div id="campo_nuevo_cliente">
                            <h2><a href="#">INGRESAR UN NUEVO POSTULANTE</a></h2>
                            <div style="height:10px" class="clear"></div>
                            <fieldset>
                            <form name="form_nuevoclt" id="form_nuevoclt" >
                            <div style="float:left"><label>RUT</label><input type="text" class="text-medium" name="nu_rut" id="nu_rut"  /><input type="text" class="text-tiny" id="nu_dv" name="nu_dv"  /><input type="button" name="enviar" id="bt_validar_clt" value="IR" class="button-find" /></div>
                            <div style="height:10px" class="clear"></div>
                            <div style="float:left"><label>NOMBRE</label><input type="text" maxlength="50" class="text-normal" name="nu_nombre" id="nu_nombre" disabled="disabled"  /></div>
                            <div style="float:left"><label>PATERNO</label><input type="text" maxlength="50" class="text-normal" name="nu_apellidop" id="nu_apellidop" disabled="disabled"  /></div>
                            <div style="float:left"><label>MATERNO</label><input type="text" maxlength="50" class="text-normal" name="nu_apellidom" id="nu_apellidom" disabled="disabled"  /></div>
                            <div style="float:left"><label>FONO</label><input type="text" maxlength="10" class="text-normal" name="nu_fono" id="nu_fono" disabled="disabled"  /></div>
                            <div style="height:20px" class="clear"></div>
                            </fieldset>
                            <div style="text-align:center;"><input type="button" name="enviar" id="bt_crear_clt" value="CREAR" class="button-submit" /></div>
                            <div id="debug_crear_cliente"></div>
                            </div>

                            <div style="height:10px" class="clear"></div>
<div style="height:15px"></div>
<div style="float:left; padding-top:10px;">
                
            </div>
            <div style="height:10px" class="clear"></div>
              </form>              
        </fieldset>
        


         <div style="height:5px;" class="clear"></div>

  
                </div>
                
                <div class="clear"></div>
            </div>

        </div>

        <!-- // #cliente -->
        <div id="Tab_Cola" class="tab">
        
                

			<div class="fullcontainer">
   
                <!--<h2>COLA DE REGISTROS</h2>-->
                <br>
                <div class="mainfull main">
                <form id="form_datoscliente">
                <input type="hidden" name="cl_id" id="cl_id" value="<?php echo $busqueda; ?>" />
                <input type="hidden" name="idpostulacion" id="idpostulacion" value="1" />
                <input type="hidden" name="idtipobeca" id="idtipobeca" value="0" />
                <input type="hidden" name="idnota" id="idnota" value="" />
                <input type="hidden" name="idlinkqa" id="idlinkqa" value="0" />
                <input type="hidden" name="cl_usuario" id="cl_usuario" value="<?php echo $_SESSION["idusuario"]; ?>" />
                
        <fieldset>



<form>
                        	<div style="float:left; padding-left:10px;"><label>RUT TRABAJADOR</label><input type="text" class="text-finder" id="filtro_cola_rut" /></div><div style="float:left; padding-top:20px;"><input type="button" name="enviar" id="btn_filtro_cola_rut" value="IR" class="button-find" /></div>
                            <div style="float:left; padding-left:10px;"><label>RUT POSTULANTE</label><input type="text" class="text-finder" id="filtro_cola_postulante" /></div><div style="float:left; padding-top:20px;"><input type="button" name="enviar" id="btn_filtro_cola_postulante" value="IR" class="button-find" /></div>
                            <div style="float:left; padding-left:10px;"><label>NOMBRE DEL CLIENTE</label><input type="text" class="text-finder" id="filtro_cola_nombre" /></div><div style="float:left; padding-top:20px;"><input type="button" name="enviar" id="btn_filtro_cola_nombre" value="IR" class="button-find" /></div>
                            <div style="float:left; padding-left:10px;"><label>EVALUADOR</label><select id="filtro_cola_estado" class="text-medium">
<option value="0">TODOS</option>
<option value="8">SOLO NUEVOS</option>
<option value="9">SOLO MIOS</option>
<option value="10">SOLO AJENOS</option>
</select></div><!--<div style="float:left; padding-top:20px;"><input type="button" name="enviar" id="bt_buscar_filtro" value="IR" class="button-find" /></div>-->


<div style="float:left; padding-left:10px;"><label>FILTRO ESTADOS</label><select id="filtro_cola_estado_1" class="text-medium">
<option value="0">SIN FILTRO</option>
<option value="1">EN CURSO</option>
<option value="2">POSTULADA</option>
<option value="3">OBSERVACIONES</option>
<option value="4">CORREGIDA</option>
<option value="5">RECHAZADA</option>
<option value="6">ADJUDICADA</option>
<option value="7">PENDIENTE AUDITOR</option>
<option value="10">POSTULADA CORRECTAMENTE</option>
<option value="11">DESACTIVADA</option>
</select></div>

<div style="float:left; padding-left:10px; display:none;"><label>TIPO DE BECA</label><select id="filtro_cola_beca" class="text-medium">
<option value="0">1TODAS</option>
<option value="1">VIVIENDA</option>
<option value="2">ESTUDIOS</option>
</select></div>




                            <div style="height:10px" class="clear"></div>
                            <div style="height:10px" class="clear"></div>
                            </form>
                            
                            <div id="resultadocola" ></div>
                            
                             <div style="height:5px" class="clear"></div>
                             
                          
             </fieldset>
        </form>
      
       <div style="height:5px" class="clear"></div>
              
       <div style="height:5px" class="clear"></div>
         
             
        
        
<!-- formend -->

  
 <div style="height:10px" class="clear"></div>
<div style="height:20px" class="clear"></div>

        
        



  
                </div>
             
                <div class="clear"></div>
            </div>

        </div>

        <div id="Tab_Cliente" class="tab">
        <input type="hidden" name="llave" id="llave" value="0" />
        <input type="hidden" name="correlativos" id="correlativos" value="" />
        <input type="hidden" name="pfono1" id="correlativos" value="" />
        

			<div class="fullcontainer">
   
                <h2><a href="#">TRABAJADOR <?php echo $g[0]->NOMBRECOMPLETO; ?></a> <font color="#990000">BECA <?php echo ($g[0]->IDTIPOBECA=="1")?"VIVIENDA":"ESTUDIOS"; ?></font></h2>
                <div class="mainfull main">
                <form id="form_datoscliente">
                <input type="hidden" name="cl_id" id="cl_id" value="<?php echo $busqueda; ?>" />
                <input type="hidden" name="cl_usuario" id="cl_usuario" value="<?php echo $_SESSION["idusuario"]; ?>" />
                
        <fieldset>

                            <div style="float:left"><label>NOMBRE</label><input type="text" id="cl_nombre" name="cl_nombre"  class="text-medium" value="<?php echo $g[0]->NOMBRE_TRABAJADOR; ?>" /></div>
                            <div style="float:left"><label>PATERNO</label><input type="text" id="cl_apellidop" name="cl_apellidop"  class="text-medium" value="<?php echo $g[0]->PATERNO_TRABAJADOR; ?>" /></div>
                            <div style="float:left"><label>MATERNO</label><input type="text" id="cl_apellidom" name="cl_apellidom"  class="text-medium" value="<?php echo $g[0]->MATERNO_TRABAJADOR; ?>" /></div>
                            <div style="float:left"><!--<label>FONO FIJO</label>--><input type="text" class="text-medium" id="cl_fono1_aux" style="display:none;" maxlength="10" name="cl_fono1_aux" value="7777777"  /></div>
                            <div style="float:left"><label>FONO CELULAR</label><input type="text" class="text-medium" id="cl_fono2_aux" maxlength="10" name="cl_fono2_aux" value="<?php echo $g[0]->CELU_TRABAJADOR; ?>"  /></div>
                           
                            
                            
                            <input type="hidden" name="cl_comuna" value="1" />
                            <input type="hidden" name="cl_ciudad" value="1" />
                            <input type="hidden" name="pcel" value="1" />
                            <input type="hidden" name="cl_fono1" id="cl_fono1" value="" />
                            <input type="hidden" name="llavegestion" id="llavegestion" value="2" />
                            
                            
                            
                            	
                            
                            

                           
                            <div style="height:20px" class="clear"></div>
                   
                            <div style="text-align:right;"><input type="button" name="enviar" id="bt_actualizar_clt" value="GUARDAR" class="button-submit" /></div>
                            <div id="debug_guardar">
                            
                            </div>
                            
                             <div style="height:5px" class="clear"></div>
                             
                          
             </fieldset>
        </form>
      
       <div style="height:5px" class="clear"></div>
       <?php if("a" != "a"){ ?>
        
        
        
                <div style="float:left; width:200px; border:1px solid #CCCCCC; height:25px; vertical-align:middle; margin-right:15px; "><h4  style="float:left; padding-top:5px; padding-left:5px;">CONTACTOS</h4><img id="bt_ver_contactos"  style="float:right; padding-left:10px;" src="style/img/select_right.gif" /></div> 
                
                  
        
         
       <div style="height:5px" class="clear"></div>
 
         <?php } ?>  
         <div style="height:5px" class="clear"></div>
       

        
       <div style="height:5px" class="clear"></div>
         
             
        <form id="form_contacto">  
        
                        <input type="hidden" name="con_id" id="con_id" value="<?php echo $busqueda; ?>" />
                <input type="hidden" name="con_usuario" id="con_usuario" value="<?php echo $_SESSION["idusuario"]; ?>" />
        
        <div style="float:left; width:100px; line-height:10px; padding-bottom:3px; display:none;" id="bt_agregar_contacto"><img src="style/img/ncontacto.jpg"  style="width:110px;height:20px;vertical-align:middle" /></div>
         <div style="height:10px" class="clear"></div>
         <div id="campo_detalles_contactos">
        <fieldset>
                            <div style="float:left"><label>NOMBRE DEL CONTACTO</label><input type="text" id="con_nombre" name="con_nombre"  class="text-longest" /></div>
                            <div style="float:left"><label>EMAIL</label><input type="text" class="text-normal" id="con_mail" name="con_mail"  /></div>
                            <div style="height:10px" class="clear"></div>
                            <div style="float:left"><label>FONO</label><input type="text" maxlength="10" class="text-medium" id="con_fono" name="con_fono"  /></div>
                            <div style="float:left"><label>CELULAR</label><input type="text" maxlength="10" class="text-medium" id="con_celu" name="con_celu"  /></div>
                            
                            <div style="float:left"><label>TRABAJO</label><input type="text" maxlength="10" class="text-medium" id="con_trabajo" name="con_trabajo"  /></div>
                            <div style="float:left"><label>ANEXO</label><input type="text" maxlength="6" class="text-medium" id="con_anexo" name="con_anexo"  /></div>
                            
                            <div style="height:10px" class="clear"></div>
                            
                            <div style="float:left"><label>OBSERVACIONES DEL CONTACTO</label><span id="left"></span><textarea  id="con_glosa" name="con_glosa" class="text-long-obs" ></textarea></div>
                            
                            <div style="height:20px" class="clear"></div>
                            <div style="text-align:right;"><input type="button" name="enviar" id="con_enviar_crear" value="GUARDAR" class="button-submit" /></div>
                            <div id="debug_contacto"></div>
             </fieldset>
             </div>
         <fieldset id="contactos_contect" style="display:none;">
         <div style="width:70px; float:right;"><img id="bt_lista_contactos" src="style/img/recargar.jpg" /></div>
            <div id="listar_contactos"></div>
         </fieldset>

</form>
        
<!-- formend -->

  
 <div style="height:10px" class="clear"></div>
<div style="height:20px" class="clear"></div>

        
        



  
                </div>
             
                <div class="clear"></div>
            </div>

        </div>
        
        <div id="Tab_AdministracionCola" class="tab">
			<div class="container" id="tabresumen">
        		<!--<div class="sidebar">
                	<ul class="sideNav">
                    	<li><a href="#" class="numresume">Resumen</a></li>
                    	<li><a href="#" class="numpaso1" >Antecedentes</a></li>
                        <li><a href="#" class="numpaso7" >Validaciones</a></li>
                        <li><a href="#" class="numpaso6" >Ponderacion Final</a></li>

                    </ul>
                </div>-->    
               <h2><a href="#">POSTULACION</a> &raquo; <a href="#" class="active">RESUMEN</a></h2>
              <div class="main" style="width: 880px !important; float:left; padding-left:20px;">

          <form name="frm_cola" id="frm_cola">
          			<div id="listarresumensimple2222"></div>
                    <div style="height:5px;" class="clear"></div>
                    <div style="text-align:center;"><input type="button" id="bt_postulacion_estado2222" value="GUARDAR ESTADO" class="button-save" /></div>
					<div style="height:15px;" class="clear"></div>
                


        </form>
        

        


                </div>
                
                <div class="clear"></div>
            </div>
            
            <div class="container" id="tabpaso1">
        		<div class="sidebar">
                	<ul class="sideNav">
                    	<li><a href="#" class="numresume">Resumen</a></li>
                    	<li><a href="#" class="numpaso1" >Antecedentes</a></li>
                        <li><a href="#" class="numpaso7" >Validaciones</a></li>
                        <li><a href="#" class="numpaso6" >Ponderacion Final</a></li>
                    </ul>
                </div>    
                <h2><a href="#">POSTULACION</a> &raquo; <a href="#" class="active">PASO 1</a></h2>
              <div class="main">

          <form name="frm_cola" id="frm_cola">

		<fieldset>
            <div style="height:10px" class="clear"></div>
            
            <div id="tabs" style="height:500px;">
  <ul>
    <li><a href="#tabs-1">Trabajador</a></li>
    <li><a href="#tabs-2">Empleador</a></li>
    <li><a href="#tabs-3">Beneficio</a></li>
    <li><a href="#tabs-4">Declaraci�n Jurada</a></li>
    <li><a href="#tabs-5">Documentaci�n</a></li>
  </ul>
  <div id="tabs-1"><div id="datapaso1"></div></div>
  <div id="tabs-2"><div id="datapaso2"></div></div>
  <div id="tabs-3"><div id="datapaso3"></div></div>
  <div id="tabs-4"><div id="datapaso4"></div></div>
  <div id="tabs-5"><div id="datapaso5"></div></div>
</div>
            
           <!-- <div style="float:left"><label>NOMBRE</label><input type="text" maxlength="50" class="text-normal" name="nu_nombre" id="nu_nombre" disabled="disabled"  /></div>-->
            
            <div style="height:20px" class="clear"></div>
        </fieldset>
        
        <fieldset>
         			
                    <div style="float:left; display:none;"><label>OBSERVACIONES PASO 1</label><textarea spellcheck="true" id="ops_paso1" name="ops_paso1" class="text-long-obs" style="height:100px; overflow-y: auto;" ></textarea></div>
         </fieldset>


        </form>
        

        
 <div style="height:5px;" class="clear"></div>
          <div style="text-align:center; display:none;"><input type="button" name="enviar_solicitud" rel="1" value="GUARDAR PASO" class="button-save guarda_comentarios" /></div>
   <div style="height:15px;" class="clear"></div>

                </div>
                
                <div class="clear"></div>
            </div>


            
            
            <div class="container" id="tabpaso5">
        		<div class="sidebar">
                	<ul class="sideNav">
						<li><a href="#" class="numresume">Resumen</a></li>
                    	<li><a href="#" class="numpaso1" >Antecedentes</a></li>
                        <li><a href="#" class="numpaso7" >Validaciones</a></li>
                        <li><a href="#" class="numpaso6" >Ponderacion Final</a></li>
                    </ul>
                </div>    
                 <h2><a href="#">POSTULACION</a> &raquo; <a href="#" class="active">PASO 5</a></h2>
              <div class="main">

          <form name="frm_cola" id="frm_cola">

		<fieldset>
            <div style="height:10px" class="clear"></div>
           <!-- <div style="float:left"><label>NOMBRE</label><input type="text" maxlength="50" class="text-normal" name="nu_nombre" id="nu_nombre" disabled="disabled"  /></div>-->
            <div id="datapaso5"></div>
            <div style="height:20px" class="clear"></div>
        </fieldset>
        
        <fieldset>
         			
                    <div style="float:left; display:none;"><label>OBSERVACIONES PASO 5</label><textarea spellcheck="true" id="ops_paso5" name="ops_paso5" class="text-long-obs" style="height:100px; overflow-y: auto;" ></textarea></div>
         </fieldset>


        </form>
        

        

         <div style="height:5px;" class="clear"></div>
          <div style="text-align:center; display:none;">
          	<input type="button" name="enviar_solicitud" rel="5" value="GUARDAR PASO" class="button-save guarda_comentarios" /></div>
   			<div style="height:15px;" class="clear"></div>

                </div>
                
                <div class="clear"></div>
            </div>
            <div class="container" id="tabpaso6">
        		<!--<div class="sidebar">
                	<ul class="sideNav">
						<li><a href="#" class="numresume">Resumen</a></li>
                    	<li><a href="#" class="numpaso1" >Antecedentes</a></li>
                        <li><a href="#" class="numpaso7" >Validaciones</a></li>
                        <li><a href="#" class="numpaso6" >Ponderacion Final</a></li>
                    </ul>
                </div> -->   
                 <h2><a href="#">POSTULACION</a> &raquo; <a href="#" class="active">PONDERACION</a></h2>
              <div class="main">

          <form name="frm_cola_ponderacion" id="frm_cola_ponderacion">

                <fieldset>
                <div class="calculo_vivienda" style="display:none;">
                			<span class="texto-titu2">VIVIENDA</span><br />
                    		<H2 style="width:650px;">PF = 50% * (100%*RM) + 50% * (50%*GF + 50%*TP)</H2>
                            <span class="texto-titu2" style="text-align:left;float:left;">

D�nde:<br />

PF : Puntaje Final<br />

RM : Puntaje  por Remuneraci�n Mensual<br />

GF : Puntaje por Grupo Familiar<br />

TP : Puntaje por Tipo de Postulaci�n<br />

</span><br />
	</div>
    <div class="calculo_estudios" style="display:none;">
                			<span class="texto-titu2">ESTUDIOS</span><br />
                			<!--<H2 style="width:650px;">PF = 60% * (85%*RA + 15%*IE) + 40% * (70%*RM + 30%*GF)</H2>-->
                    		<H2 style="width:650px;">PF = 60% * (85%*RA + 15%*IE) + 40% * (RM)</H2>
                            <span class="texto-titu2" style="text-align:left;float:left;">

D�nde:<br />

PF : Puntaje Final<br />

RA : Puntaje Rendimiento Acad�mico<br />

IE : Puntaje Instituci�n de Estudios A�o Anterior<br />

RM : Puntaje Remuneraci�n Bruta Mensual<br />

<!--GF : Puntaje por Grupo Familiar<br />-->


</span><br />
	</div>
    
    
               </fieldset>
                <fieldset>
                <div class="calculo_vivienda" style="display:none;">
                    <div style="float:left"><label>RM</label><input type="text" maxlength="3" class="text-medium" name="pond_1" id="pond_11" value="" disabled="disabled"   /><i>Remuneracion: <span id="pondx_11"></span></i></div>
                    <div style="float:left;display:none;"><label>CV</label><input type="text" maxlength="3" class="text-medium" name="pond_2" id="pond_21" value="" disabled="disabled"  /><i>Comuna Vivienda: <span id="pondx_21"></span></i></div>
                    <!--<div style="float:left"><label>GF</label><input type="text" maxlength="3" class="text-medium" name="pond_3" id="pond_31" value=""  disabled="disabled" /><i>Grupo Familiar:  <span id="pondx_31"></span></i></div>-->
                    <div style="float:left"><label>TP</label><input type="text" maxlength="3" class="text-medium" name="pond_4" id="pond_41"  value=""  disabled="disabled" /><i>Destino Fondos:  <span id="pondx_41"></span></i></div>
                    <div style="height:20px" class="clear"></div>
		            <div style="height:5px" class="clear"></div>
                </div>
                <div class="calculo_estudios" style="display:none;">
                 <ul>
                    <li><div style="float:left"><label>RM</label><input type="text" maxlength="3" class="text-medium" name="pond_1" id="pond_12" value="" disabled="disabled"   /><i>Remuneracion: <span id="pondx_12"></span></i></div></li>
                    <li><div style="float:left"><label>IE</label><input type="text" maxlength="3" class="text-medium" name="pond_2" id="pond_22" value="" disabled="disabled"  /><i>Estudios: <span id="pondx_22"></span></i></div></li>
                    <!--<li><div style="float:left"><label>GF</label><input type="text" maxlength="3" class="text-medium" name="pond_3" id="pond_32" value=""  disabled="disabled" /><i>Grupo Familiar:  <span id="pondx_32"></span></i></div></li>-->
                    <li><div style="float:left"><label>RA</label><input type="text" maxlength="3" class="text-medium" name="pond_4" id="pond_42"  value=""  disabled="disabled" /><i>Rendimiento Acad�mico:  <span id="pondx_42"></span></i></div></li>
                 </ul>
                    <div style="height:20px" class="clear"></div>
		            <div style="height:5px" class="clear"></div>
                </div>
                </fieldset>

   
    <div style="height:5px;" class="clear"></div>
          <div style="text-align:center;"><input type="button" name="bt_calcula_ponderacion" id="bt_calcula_ponderacion" value="CALCULAR" class="button-submit" /></div>
   <div style="height:15px;" class="clear"></div>

        </form>
        <fieldset>
        	<h2 style="width:650px;">LA PONDERACION TOTAL ES DE: <a href="#" class="active" id="pond_final"> 0</a> </h2>
        </fieldset>

        

         <div style="height:5px;" class="clear"></div>
          <div style="text-align:center;"><input type="button" name="enviar_solicitud" id="bt_ponderacion_clt" value="GUARDAR PONDERACION" class="button-save" /></div>
   <div style="height:15px;" class="clear"></div>

                </div>
                
                <div class="clear"></div>
            </div>
            
            
            <div class="container" id="tabpaso7" style="width:920px;">
        		<!--<div class="sidebar">
                	<ul class="sideNav">
<li><a href="#" class="numresume">Resumen</a></li>
                    	<li><a href="#" class="numpaso1" >Antecedentes</a></li>
                        <li><a href="#" class="numpaso7" >Validaciones</a></li>
                        <li><a href="#" class="numpaso6" >Ponderacion Final</a></li>
                    </ul>
                </div>  -->  
               <!--<h2><a href="#">POSTULACION</a> &raquo; <a href="#" class="active">CONTROL DE CALIDAD</a></h2>-->
               <br>
              <div class="main" style="width: 880px !important; float:left; padding-left:20px;">

          <form name="frm_validacioncontrolcalidad" id="frm_validacioncontrolcalidad">

				<fieldset>
		                <div id="listarresumensimple"></div>
		                <div style="text-align:center;"><input type="button" id="bt_postulacion_estado" value="GUARDAR ESTADO" class="button-save" /></div>

		                <div id="linkCorregirEstudios"></div>
                </fieldset>
				
				<fieldset>
                <div id="listardocumentos"></div>
                </fieldset>
             

	           <fieldset>
	                    <div style="height:2px" class="clear"></div>

	                    <div id="validacioncontrolcalidad"></div>
	                    <div style="height:20px" class="clear"></div>

	            		<div style="height:5px" class="clear"></div>      
	        	</fieldset>


        </form>
        

        

        <div style="height:5px;" class="clear"></div>
        <div id="bt_gpost" style="text-align:center;">
          		<input type="button" name="enviar_solicitud" id="bt_controlcalidad_clt" value="CALCULAR PONDERACI�N Y GUARDAR VALIDACI�N" class="button-save" />
        </div>
   		<div style="height:15px;" class="clear"></div>

                </div>
                
                <div class="clear"></div>
            </div>


        </div>
        <!-- // #containerHolder -->
        
     <div id="Tab_Administracion" class="tab">
			<div class="container" id="tab31">
        		<div class="sidebar">
                	<ul class="sideNav">
                    	<li><a href="#" class="active">Gestionar</a></li>
                        
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2><a href="#">SOLICITUDES</a> &raquo; <a href="#" class="active">GESTION DE ACCION</a></h2>
                
              <div class="main">

                <form name="frm_gestion" id="frm_gestion">
                <input type="hidden" name="op_id" id="op_id" value="<?php echo $busqueda; ?>" />
                <input type="hidden" name="op_usuario" id="op_usuario" value="<?php echo $_SESSION["idusuario"]; ?>" />
                <fieldset>
                <span class="texto-titu2"></span><br />
                    <H2 style="width:650px;">NOMBRE TITULAR: <?php echo $g[0]->NOMBRECOMPLETO; ?> </H2>
                            <span class="texto-titu2">RUT: <?php echo $g[0]->RUT_TRABAJADOR."-".$g[0]->DV_TRABAJADOR; ?></span><br />
                            
                             
                            </fieldset>
        <fieldset>
        					
                        	<div style="float:left; display:NONE;"><label>CONTACTO TELEFONICO</label>
                            <select name="cl_solicitante" id="cl_solicitante" class="text-normal">
							<option value="DEMO CONTACTO">-- DEMO--</option>
                            </select>
                            <div id="listado_solicitantes_1"></div></div>
                            <div style="float:left"><label>TELEFONO DEL VISOR.</label><input type="text" class="text-medium" maxlength="10" id="op_fono" name="op_fono"  /></div>
                            
                            <div style="float:left"><label>TIPO</label><div id="listado_tipos"></div></div>
                            <div style="height:10px" class="clear"></div>
                            <div style="float:left"><label>SUBTIPO</label><div id="listado_subtipos">&nbsp;</div></div>
                            <div style="float:left"><label>RESOLUCION</label><div id="listado_detalles">&nbsp;</div></div>
                            <div style="float:left; display:none;"><label>RESOLUCION</label><div id="listado_resolucion">&nbsp;</div></div>
                            <input type="hidden" id="esfilial" name="esfilial" value="" />
                            
                           <div style="height:10px" class="clear"></div>
                            <div style="float:left"><label>REQUERIMIENTO DEL CLIENTE</label><span id="left"></span><textarea spellcheck="true" id="op_glosa" name="op_glosa" class="text-long-obs" style="height:200px; overflow-y: auto;" ></textarea></div>
<div style="height:15px"></div>
            <div style="height:5px" class="clear"></div>
                            
        </fieldset>
        <h3 style="text-align:left;">Gestiones Creadas</h3>
        <fieldset>
        
        <div style="height:2px" class="clear"></div>
        <div id="gestiones_realizadas" style="text-align:left;">
        

       
        </div>
        </fieldset>
        </form>
        

        

         <div style="height:5px;" class="clear"></div>
          <div style="text-align:center;"><input type="button" name="enviar_solicitud" id="bt_solicitud_clt" value="CREAR GESTION" class="button-submit" /></div>
   <div style="height:15px;" class="clear"></div>
   <div id="debug_oportunidad"></div>
                </div>
                
                <div class="clear"></div>
            </div>

            

            <!--- tab3.3. -->

            


        </div>


        <!---- historico TAB --->

        <div id="Tab_Historico" class="tab">
			<div class="fullcontainer">
   
                <h2><a href="#">HISTORICO</a></h2>
                <div class="mainfull">
                <form >
        <fieldset>
                        <h3>GESTIONES <div style="float:right; width:450px; text-align:right; "><img id="bt_oportunidad_lst" src="style/img/recargar.jpg" /></div></h3>
                    	<div id="listar_bitacora"><hr style="color:#dddddd; background-color:#dddddd; width:97%" /></div>
                        
<div style="height:15px"></div>
<div style="float:left; padding-top:10px;">
                
            </div>
            <div style="height:10px" class="clear"></div>
                            
        </fieldset>
        </form>


         <div style="height:5px;" class="clear"></div>

  
                </div>
                
                <div class="clear"></div>
            </div>

        </div>


        <!---- --->





               <p id="footer"></p>
    </div>




     

    </form>
    <script>
	
        
	
	</script>
</body>
</html>
