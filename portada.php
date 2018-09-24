<?php

//header('Location: mantencion.php');
//die();

$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
header('Location: ../index.php');
}
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<?php
//valida si la url es distinta a adminme
$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

//contabiliza los dias que faltan para comenzar con las postulaciones de cada beca (vivienda).
$datestr="2016-07-16 00:00:00";//Your date
$date=strtotime($datestr);//Converted to a PHP date (a second count)
$diff=$date-time();//time returns current time in seconds
$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=round(($diff-$days*60*60*24)/(60*60));
$days=0;
$daysv=floor($diff/(60*60*24));

//contabiliza los dias que faltan para comenzar con las postulaciones de cada beca (estudios).
$datestr="2017-03-13 00:00:00";//Your date
$date=strtotime($datestr);//Converted to a PHP date (a second count)
$diff=$date-time();//time returns current time in seconds
$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=round(($diff-$days*60*60*24)/(60*60));
$days=0;
$dayse=floor($diff/(60*60*24));
//echo($dayse);

//contabiliza los dias que faltan para terminar con las postulaciones de cada beca (estudios).
$datestr="2017-06-15 00:00:00";//Your date
$date=strtotime($datestr);//Converted to a PHP date (a second count)
$diff=$date-time();//time returns current time in seconds
$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=round(($diff-$days*60*60*24)/(60*60));
$days=0;
$dayset=floor($diff/(60*60*24));

//contabiliza los dias que faltan para comenzar con las postulaciones de cada beca (estudios).
$datestrx="2017-04-14 00:00:00";//Your date
$datex=strtotime($datestrx);//Converted to a PHP date (a second count)
$diffx=$datex-time();//time returns current time in seconds
$daysx=floor($diffx/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hoursx=round(($diffx-$daysx*60*60*24)/(60*60));
$daysx=0;
$daysex=floor($diffx/(60*60*24));
//echo($dayse);

//contabiliza los dias que faltan para comenzar con las apelaciones de cada beca (vivienda).
$datestr="2017-07-20 23:59:00";//Your date
$date=strtotime($datestr);//Converted to a PHP date (a second count)
$diff=$date-time();//time returns current time in seconds
$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=round(($diff-$days*60*60*24)/(60*60));
$days=0;
$daysv_apelacion=floor($diff/(60*60*24));
$hoursv_apelacion=floor($diff/(60*24));
$minutosv_apelacion=floor($diff/(24));
//echo "--->".$minutosv_apelacion;

//cierre apelaciones
$seconds = strtotime("2017-07-20 23:59:01") - time();
$days = floor($seconds / 86400);
$seconds %= 86400;
$hours = floor($seconds / 3600);
$seconds %= 3600;
$minutes = floor($seconds / 60);
$seconds %= 60;
//echo "$days days and $hours hours and $minutes minutes and $seconds seconds";

//cierre postulaciones vivienda
$viviendatime = time();
$tiempo_actual = date('Y-m-d  H:i:s', $viviendatime);
$iniciovivienda = $tiempo_actual;
$finvivienda   = '2017-09-05 00:00';    
$dte_iniciov = new DateTime($iniciovivienda);
$dte_finv   = new DateTime($finvivienda);
$dte_difv  = $dte_iniciov->diff($dte_finv);  

//contabiliza los dias que faltan para comenzar con las apelaciones de cada beca (estudios).
$datestr="2016-05-30 00:00:00";//Your date
$date=strtotime($datestr);//Converted to a PHP date (a second count)
$diff=$date-time();//time returns current time in seconds
$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
$hours=round(($diff-$days*60*60*24)/(60*60));
$days=0;
$days_apelacion=floor($diff/(60*60*24));
//echo "--->".$daysv;
?>
<!DOCTYPE HTML>
<html lang="en" class=" -webkit-">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=windows-1252' /> 
<title>Fondos 2017</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link href="css/estilo.css" rel="stylesheet" media="screen, projection">
<link href="css/animations.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="js/jquery.numeric.js" type="text/javascript"></script>
<script src="js/jquery.bestupper.min.js" type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script src="js/jquery.pause.js" ></script>
<style>
/*.ingresobanner{display: none !important;}*/
#estadomenviomsj{
	display: none;
}
#estadomenviomsj img{
	width: 30px;
	height: 30px;
}
</style>
<script>
var notyStatus = null;
var nombrepostulante = "";

function urldecode(str) {
  return decodeURIComponent((str + '')
    .replace(/%(?![\da-f]{2})/gi, function() {
      // PHP tolerates poorly formed escape sequences
      return '%25';
    })
    .replace(/\+/g, '%20'));
}

function urlencode(str) {
  str = (str + '')
    .toString();
  return encodeURIComponent(str)
    .replace(/!/g, '%21')
    .replace(/'/g, '%27')
    .replace(/\(/g, '%28')
    .replace(/\)/g, '%29')
    .replace(/\*/g, '%2A')
    .replace(/%20/g, '+');
}

function base64_decode(data) {
  var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    dec = '',
    tmp_arr = [];

  if (!data) {
    return data;
  }

  data += '';

  do { // unpack four hexets into three octets using index points in b64
    h1 = b64.indexOf(data.charAt(i++));
    h2 = b64.indexOf(data.charAt(i++));
    h3 = b64.indexOf(data.charAt(i++));
    h4 = b64.indexOf(data.charAt(i++));

    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

    o1 = bits >> 16 & 0xff;
    o2 = bits >> 8 & 0xff;
    o3 = bits & 0xff;

    if (h3 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1);
    } else if (h4 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1, o2);
    } else {
      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
    }
  } while (i < data.length);

  dec = tmp_arr.join('');

  return dec.replace(/\0+$/, '');
}

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


	var beca=0;

function fnCambiaDialogo(alto)
{
	$("#estadobecas").dialog({height: alto});
}
function fnCambiaDialogoEscala(alto,ancho)
{
	$("#estadobecas").dialog({height: alto, width: ancho,minWidth:ancho});
}
function fnCierraNormal()
{
//alert("Cerrando");
$("#dialog").dialog("close");
}
	
function fnCierraFormulario(data,origen)
{
	$('<div></div>').appendTo('body')
    .html('<div><center><h6>¿Desea enviar su información a la postulación?</h6><span style="font-size: 14px;width: 410px;display: block;margin-top: 10px;margin-bottom: 5px;">Luego de confirmar recibirá un correo con la información que subió a la postulación.</span><div id="estadomenviomsj"><span><img src="img/loadmsg.gif" /></span><span style="font-size: 14px;width: 410px;display: block;">Enviando postulación. Por favor espere hasta que se actualice la página.</span></div></center></div>')
    .dialog({
        modal: true,
        title: 'Postular',
        zIndex: 10000,
        autoOpen: true,
        width: '450px',
		height: '300',
        resizable: false,
        buttons: {
            "Si": function () {
            					$("#estadomenviomsj").fadeIn();
            					
            					setTimeout(function(){ 
										var dataString = "id="+data+"&desde="+origen;
										 $.when(
											$.ajax({
											type: "GET",
											url: "pages/guarda_estado.php",
											data: dataString,
											async: false,
											success: function (data) {
												if (window.console) console.log('--->DEBUG guarda_estado: '+data);
													var resp = data.split("|");
													if (resp[0] == "1") {
														if (resp[1] == "Mensaje Enviado") {
															//alert("Correo Enviado, el codigo de respaldo es: "+resp[2]);
															alert("Su postulación ha sido enviada con éxito. Se ha enviado un mensaje a su correo con los detalles del proceso. Muchas gracias");
														}
														window.location.reload();
													}			
												},
											error: function (objeto, quepaso, otroobj) {
											if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/guarda_estado.php --> '+objeto.responseText);
											}
											})
										
										);
								}, 2000);

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

function fnCierraFormularioModificado(data,origen)
{
	$('<div></div>').appendTo('body')
    .html('<div><center><h6>¿Desea enviar su información modificada?</h6><br><span>Luego de confirmar, su información será enviada sin vuelta atrás.</span></center></div>')
    .dialog({
        modal: true,
        title: 'Postular',
        zIndex: 10000,
        autoOpen: true,
        width: '450px',
		height: '250',
        resizable: false,
        buttons: {
            "Si": function () {
								var dataString = "id="+data+"&desde="+origen;
								 $.when(
									$.ajax({
									type: "GET",
									url: "pages/guarda_estado_mod.php",
									data: dataString,
									async: false,
									success: function (data) {
										if (window.console) console.log('--->DEBUG guarda_estado_mod1: '+data);
											var resp = data.split("|");
											if (resp[0] == "1") {
												if (resp[1] == "Mensaje Enviado") {
												alert("Las correcciones a su postulacion fueron ingresadas con exito");
												}
												window.location.reload();
											}			
										},
									error: function (objeto, quepaso, otroobj) {
									if (window.console) console.log('ERROR AL INTENTAR ENVIAR  pages/guarda_estado_mod.php --> '+objeto.responseText);
									}
									})
								
								);
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

var llave_rap = false;

	
function fnParentExits(rel, data)
{
	//alert(rel);
	
	$('#idiframe').on('load', function(){
        $(this).fadeIn();
    });
	
	$.when().then(function( x ) {
		 $("#idiframe").attr("src", "limpia.php" );
		$("#dialog").hide();
		$("#idiframe").hide();
 		// console.log( "hola" );
	});

	notyStatus2 = null;
	notyStatus = null;
	
	if(rel==""){ 
	  return false;
	}
	
	
	
    var paginadest = "";
	
	if(rel==0){
	  paginadest = "panel.php";
	  $("#dialog").dialog({height: 600,width: 900});
	}
	if(rel==1){
	  paginadest = "vivienda.php";
	  $("#dialog").dialog({height: 650,width: 1170});
	}
	if(rel==2){
	  paginadest = "estudios.php";
	  $("#dialog").dialog({height: 650,width: 1170});
	}
	if(rel==3){
	  paginadest = "estudios_mod.php";
	  $("#dialog").dialog({height: 650,width: 1170});
	}
	if(rel==4){
	  paginadest = "vivienda_mod.php";
	  $("#dialog").dialog({height: 650,width: 1170});
	}
	if(rel==5){
	//  alert("portada-" + data);
	  paginadest = "panel.php";
	  $("#dialog").dialog({height: 650,width: 1170});
	}

	
	
	ruta = paginadest+"?"+base64_encode(data+"&t=" + new Date().getTime());
	
	$("#idiframe").attr("src", ruta );
	
	console.log(ruta);
	
	//var height = $(window).height() - 200;
	
	

	//$("#dialog").closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
   
   
	$.ui.dialog.prototype._focusTabbable = function(){};
	$(".ui-dialog-title").hide();
	//.css("max-height", height);
	if($("#estadobecas").closest('.ui-dialog').is(':visible')){
		$("#estadobecas").dialog( "close" );
	}
	//$("#idiframe").fadeIn();
	
}
//var data = "r="+rut+"&d="+dv+"&n="+nombres+"&e="+correo+"&f="+fono;
function fnAbreChat(param){
	
	$('#iframe_chat' ).attr( 'src','http://www.oticdelaconstruccion.cl/fondos2017/pages/chat/?'+param);
	console.log("Chat param:" + param);
	if($('#chatme').is(':hidden')){
		$('#iframe_chat' ).attr( 'src', function ( i, val ) { return val; });
		$("#chatme").fadeIn();
	}else{
		$("#chatme").hide();
		$('#iframe_chat' ).attr( 'src', function ( i, val ) { return val; });
	}
}

//fnAbreChat();

function fnAbreFormulario(beca){
		data = "b="+beca;
		$("#estadobecas").dialog("close");
		$("#idiframe").attr("src", "login.php?"+data+"&t=" + new Date().getTime());
		$("#dialog").dialog({height: '300',minWidth:500});
		$("#dialog").closest('.ui-dialog').find('.ui-dialog-titlebar-close').show();
		$("#dialog").dialog("open");
		$("#dialog").dialog("option", "position", {my: "center", at: "center", of: window});
}

function fnAbreFormularioObs(beca){
		if(beca == 1){
			data = "b="+beca;
			$("#estadobecas").dialog("close");
			$("#idiframe").attr("src", "loginv_m.php?"+data+"&t=" + new Date().getTime());
			$("#dialog").dialog({height: '310', width: 500,minWidth:500});
			$("#dialog").closest('.ui-dialog').find('.ui-dialog-titlebar-close').show();
			$("#dialog").dialog("open");
			$("#dialog").dialog("option", "position", {my: "center", at: "center", of: window});
		
		}else{
			data = "b="+beca;
			$("#estadobecas").dialog("close");
			$("#idiframe").attr("src", "login_m.php?"+data+"&t=" + new Date().getTime());
			$("#dialog").dialog({height: '310', width: 500,minWidth:500});
			$("#dialog").closest('.ui-dialog').find('.ui-dialog-titlebar-close').show();
			$("#dialog").dialog("open");
			$("#dialog").dialog("option", "position", {my: "center", at: "center", of: window});
		}
}


var urlget = window.location.href;
if(urlget.indexOf("#iniciar") > -1){
	fnAbreFormulario(1);
}

function enviarTextoChat(){
				var texto = $(".userinput").val();
				$(".chat-messages ul").append('<li class="chat-msg-user"><span class="chat-msg-time"><strong>TU</strong></span>'+texto+'</li>');
				$('.fixedContent').animate({scrollTop: $(".chat-messages ul").prop("scrollHeight") },500);
				$(".userinput").val("");
				setTimeout(function(){$(".chat-messages ul").append('<li><span class="chat-msg-time"><a href="#">Callcenter</a></span>Un momento por favor, mientras revisamos su requerimiento.</li>'); $('.fixedContent').animate({scrollTop: $(".chat-messages ul").prop("scrollHeight") },500);},2000)
}

function dv(T) {
            var M = 0, S = 1; for (; T; T = Math.floor(T / 10))
                S = (S + T % 10 * (9 - M++ % 6)) % 11; return S ? S - 1 : 'K';
}

var browser = {
        isIe: function () {
            return navigator.appVersion.indexOf("MSIE") != -1;
        },
        navigator: navigator.appVersion,
        getVersion: function() {
            var version = 999; // we assume a sane browser
            if (navigator.appVersion.indexOf("MSIE") != -1)
                // bah, IE again, lets downgrade version number
                version = parseFloat(navigator.appVersion.split("MSIE")[1]);
            return version;
        }
    };

if (browser.isIe() && browser.getVersion() <= 9) {

    document.location.href = "actualizate.php";
}

$( document ).ready(function() {

	<?php if(isset($_GET["adminme"])){ ?>
	console.log = function() {}
	<?php } ?>

	if (document.addEventListener) {
		console.log("IE9 or greater");
	}else{
		document.location.href = "actualizate.php";
	}
	
	
		   <?php if(isset($_GET["adminme"])){ ?>
		   //var data11 = "r=15416115&d=5&n=Juan Perez Castro&e=test@test.cl&f=097845588";
		   //fnAbreChat(data11);
	  <?php } ?>
	
	/*if (window.requestAnimationFrame) {
		//console.log("IE10 or greater");
	}
	*/
	<?php //if((strpos($_SERVER['HTTP_REFERER'], 'eval') === true)){ ?>
	//var eval = true;
	<?php //} ?>
	//http://www.youtube.com/embed/POoP9zbUrJM
	$(".videositio").click(function(){
		var iframe = $('<iframe frameborder="0" src="https://www.youtube.com/embed/0Ep2ArlFlQo" marginwidth="0" marginheight="0" height="480px" width="680px" allowfullscreen></iframe>');
		var dialog = $("<div></div>").append(iframe).appendTo("body").dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			width: "auto",
			height: "auto",
			close: function () {
				iframe.attr("src", "");
			}
		});
		//dialog.closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
		$(".ui-dialog-title").hide();
		var title = "VIDEO PASO A PASO";
		dialog.dialog("option", "title", title).dialog("open");
	})

	$(".postulaaqui").hide();
	

	$.ajaxSetup({ cache: false });
	$('.upper').bestupper();
	//$("#rutconsultar").numeric("K");
	
	$("#rutconsultar").on("keypress",function (event) {
			//console.log(event.which);
			if (event.which == 13){
				event.preventDefault();
				//enviarTextoChat();
				$("#link_buscar").trigger( "click" );
				return false;
				
			}

    });
	
	$("#rutconsultar2").on("keypress keyup blur",function (event) {
			console.log(event.which);
			$(this).val($(this).val().replace(/[^0-9\-]/g,''));
            if ((event.which != 45 || $(this).val().indexOf('-') != -1) && (event.which < 48 || event.which > 57) ) {
                event.preventDefault();
            }
    });
	
	$(".userinput").on("keypress",function (event) {
			console.log(event.which);
			if (event.which == 13){
				event.preventDefault();
				enviarTextoChat();
				
				return false;
				
			}

    });
	
	$(window).resize(function() {
		$("#dialog").dialog("option", "position", {my: "center", at: "center", of: window});
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			 window.location.href = "index.php";
		}
	});
	
	$('input,textarea').focus(function(){
       $(this).data('placeholder',$(this).attr('placeholder'))
       $(this).attr('placeholder','');
    });
    $('input,textarea').blur(function(){
       $(this).attr('placeholder',$(this).data('placeholder'));
    });
	
	$("html, body").animate({ scrollTop: 0 }, "slow");
	
	
	
	var page = "limpia.php";
    $("#dialog").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="100%"></iframe>').dialog({ 
		autoOpen: false, 
		closeOnEscape: false, 
		modal:true, 
		height: 'auto',
		width:'500px', 
		draggable: false,
		resizable: false,
		beforeClose: function (event, ui) {
			var str = $("#idiframe").attr("src");
			
			//alert(notyStatus2+' // '+str);
			if ((str.indexOf("panel.php") >= 0)){
				var pag = str.split(".php?");
				//alert(base64_decode(pag[1]));
				if(pag[0]=="panel"){
				//alert(notyStatus);
					if (notyStatus2 === null) {
   			    event.preventDefault();
                $('<p style="font-size: 16px; padding: 20px;" title="¿Desea Salir del Panel?">Sus postulaciones quedarán hasta el último punto que completó los formularios. </p>').dialog({
					width:'400', 
                    modal: true,
                    buttons: {
                        "Salir": function () {
							notyStatus2 = true;
							$("#dialog").dialog("close");
                            $(this).dialog("close");
							//window.location.reload();
                            
                        },
                        "Continuar en el Panel": function () {
							 notyStatus2 = null;
                            $(this).dialog("close");
                        }
                    }
                });
				}
				}
			}
			
			
			if ((str.indexOf("vivienda") >= 0) ||(str.indexOf("estudios") >= 0) ){
				if (notyStatus === null) {
   			    event.preventDefault();
                $('<p style="font-size: 16px; padding: 20px;" title="¿Desea Salir del Formulario?">Su Información quedará almacenada solo hasta los campos completados </p>').dialog({
					width:'400', 
                    modal: true,
                    buttons: {
                        "Salir": function () {
							notyStatus = true;
							//$("#dialog").dialog("close");
							$("#idiframe").attr("src", "limpia.php" );
                            $(this).dialog("close");
							var pag = str.split(".php?");
							datam = "b=0&"+base64_decode(pag[1]);
							fnParentExits("0",datam);
							//window.location.reload();
                            
                        },
                        "Continuar con el Formulario": function () {
							 notyStatus = null;
                            $(this).dialog("close");
                        }
                    }
                });
				}
			}
				//return false;
  		},
        open: function(event, ui) {
            $(this).css({'max-height': $(document).height()-200, 'overflow-y': 'hidden'}); 
			$(this).css('overflow', 'hidden');
			$(".ui-dialog-title").show();
        } });
	$(".ui-dialog-titlebar-close").addClass("boton-cerrar");
	
	/*$(document).scroll(function() {
	  var y = $(this).scrollTop();
	  console.log(y);
	  if (y > 90) {
		$('.row4').fadeIn();
		$('.row3').animate({ "height": '0px' }, "slow");
	  } else {
		$('.row4').fadeOut();
		$('.row3').animate({ "height": '350px' }, "fast");
	  }
	}); */

	
	
	var slider = 1;
	var current_slider = 0;
	var num_slide = $(".grupo figure").length;
	//console.log("SLides : "+num_slide);
	var llave = true;

	function slideme1(){
		$("div#slider figure.grupo").animate({ "left": '-500%' }, "fast", "easeOutExpo");
	}

	function slideme(){

	//alert("ACA TOY -->"+current_slider);
	//console.log("ACA TOY -->"+current_slider);
	$(".progress-bar").css("width", "0px");
	//console.log("2 -->"+current_slider);
	if(slider == 1){
		//alert("Soy slide 1");
		if(current_slider < (num_slide)){
			//	console.log("2 -->"+current_slider);
			//console.log("SOY -->"+current_slider);
			

			var avanza = current_slider*100;
			$("div#slider figure.grupo").animate({ "left": '-'+(avanza)+'%' }, "fast", "easeOutExpo");
			current_slider++;
		}else{
		  //  console.log("4 -->"+current_slider);
			current_slider = 0;
			$("div#slider figure.grupo").fadeOut( "fast", function() {
			$("div#slider figure.grupo").animate({ "left": '0%' }, "fast", "easeOutExpo");
			$("div#slider figure.grupo").fadeIn( "fast");
		});
	}
	
	$('.progress-bar').animate({ width: '1280px' }, 6000, "linear", slideme);
}
	
    }
	
	var flag=true;

	
	
	$('body').on({'mousewheel': function(e) {
		if(!flag){
			if (e.target.id == 'body') return;
			e.preventDefault();
			e.stopPropagation();
		}

    }
})
	
	function abrircaja(num){
		if (flag) {
			$(".overlay").show();
			$(".postulaaqui").show("slow");
			$("div#slider figure.grupo figure:eq("+num+")").find(".textos span").hide();
			$("div#slider figure.grupo figure:eq("+num+")").find(".textos").animate({ "width": '300px' }, "slow");
			$("div#slider figure.grupo figure:eq("+num+")").find(".eventos").fadeIn("slow");
			//$("div#slider figure.grupo figure:eq("+num+")").find(".eventos").show("slow");
			$("div#slider figure.grupo figure:eq("+num+")").find(".textos p").show("slow");
			$("div#slider figure.grupo figure:eq("+num+")").find(".ingresobanner").show("slow");
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".textos").css("background","rgba(0,0,0,1)");
			$('.progress-bar').hide();
			$('.progress-bar').pause();
			slider = 0;
			$(".row0").animate({ height: '550px' }, "slow");
			$(".row0").clearQueue();
			
			$("body").css("overflow","hidden");
			flag = false;
		}
	}
	
	function cerrarcaja(){
		//alert(flag);
		if (!flag) {
			//alert(flag);
			current_slider = 0;
			console.log("ACTUAL: "+current_slider);
			$(".ingresobanner").hide();
			$(".postulaaqui").hide();
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".textos span").show("slow");
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".textos").animate({ "width": '550px' }, "slow");
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".eventos").hide();
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".textos p").hide();
			$("div#slider figure.grupo figure:eq("+current_slider+")").find(".textos").css("background","rgba(0,0,0,0.8)");
			$(".row0").animate({ "height": '390px' }, "slow");
			$('.progress-bar').show();
			$('.progress-bar').resume();
			slider = 1;
			$(".overlay").hide();
			$("body").css("overflow","visible");
			flag = true;
			current_slider = 1;
		}
	}

	slideme();
	
	$("#link_casa").click(function(){
		//alert("Próximamente");
		//alert("Próximamente");
	   //<?php if(!isset($_GET["adminme"])){ ?>
					//alert("Próximamente");
					//return false;
	  //<?php } ?>

	  	$("a.ingresobanner").show();
		current_slider = 3;
		slideme();
		abrircaja(3);
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	})
	
	$("#link_estudios").click(function(){
		$("a.ingresobanner").show();
		current_slider = 0;
		slideme();
		abrircaja(0);
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	})
	
	function minimizar(){
	
	alert("click");
	}
	
	$("#minimizar").click(function(){
	
	
	if($('.fixedContent').is(':visible')){
		$(".fixedContent").hide();
		$(".chatbox").hide();
		$(this).html("&#9632;");
	}else{
		$(".fixedContent").show();
		$(".chatbox").show();
		$(this).html("&#9644;");
	}
		
	})
	
	
	$("#link_buscar").click(function(){
		var codigo = $("#rutconsultar").val();
		var fondo = $("#tipobeneficio option:selected").val();
		
		if(codigo.length < 7 || codigo.length > 8  ){
			alert("Largo de Rut Incorrecto. Ejemplo: XXYYYZZZ");
			return false;
		}
/*		
		if(codigo.substring(0, 1) == "0"){
			alert("Rut Incorrecto, no puede iniciar con '0'. Ejemplo: XXYYYZZZ");
			return false;	
		}
	*/	
	//alert(fondo);
		var page = "estado.php?r="+fondo+""+codigo;
		//alert(page);
						
						console.log(page);
						$("#estadobecas").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="yes" src="' + page + '" width="100%" height="100%"></iframe>').dialog({ 
						autoOpen: true, 
						closeOnEscape: false, 
						modal:true, 
						height: '350',
						width:'480', 
						draggable: false,
						resizable: false,
						open: function(event, ui) {
							$(this).css({'max-height': $(document).height()-200, 'overflow-y': 'hidden'}); 
							$(this).css('overflow', 'hidden');
							$(".ui-dialog-title").show();
						} });
						
						//$("#estadobecas").dialog({height: '550', width: 750,minWidth:750});
						
						return false;
		
		
		
		
		$(".mensajeestados").hide();
		
		if(codigo=="" || codigo.length < 12){ 
			$("#rutconsultar").css("border", "solid RED 1px");
			$(".mensajeestados").show().html("Debes ingresa un codigo valido.");
			$("#rutconsultar").focus();
			return false;
		} /*
		var rutA = rut.split("-");
		if(rutA[0].length<6){
			$("#rutconsultar").css("border", "solid RED 1px");
			$(".mensajeestados").show().html("Codigo Incorrecto");
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
                return;
        }*/
		
		var dataString = "c="+codigo;
		
		$.ajax({
			type: "GET",
			url: "pages/existe_codigoticket_qa.php",
			data: dataString,
			async: false,
			success: function (data) {
				if (window.console) console.log('--->DEBUG existe_codigoticket: '+data);
				if (data == "1") {
					
						var page = "estado.php?r="+codigo;
						console.log(page);
						$("#estadobecas").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="yes" src="' + page + '" width="100%" height="100%"></iframe>').dialog({ 
						autoOpen: true, 
						closeOnEscape: false, 
						modal:true, 
						height: '400',
						width:'580', 
						draggable: false,
						resizable: false,
						open: function(event, ui) {
							$(this).css({'max-height': $(document).height()-200, 'overflow-y': 'hidden'}); 
							$(this).css('overflow', 'hidden');
							$(".ui-dialog-title").show();
						} });					
				}else{
					$(".mensajeestados").show().html("Codigo No encontrado.");
				}	
			}
		});
		
		
	})
	
	$(".ingresobanner").click(function(){
	
		$("#idiframe").attr("src", "loginpanel.php?t=" + new Date().getTime());
		$("#dialog").dialog({height: '310', width: 500,minWidth:500});
		$("#dialog").closest('.ui-dialog').find('.ui-dialog-titlebar-close').show();
		notyStatus = null
		var title = "ACCESO A POSTULACIONES";
		$("#dialog").dialog("option", "title", title);
		$("#dialog").dialog("open");
		$("#dialog").dialog("option", "position", {my: "center", at: "center", of: window});
		$("#idiframe").fadeIn();
		
		return false;

		var page = "estado.php?r="+fondo+""+codigo;
		//alert(page);
						
						console.log(page);
						$("#estadobecas").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="yes" src="' + page + '" width="100%" height="100%"></iframe>').dialog({ 
						autoOpen: true, 
						closeOnEscape: false, 
						modal:true, 
						height: '350',
						width:'480', 
						draggable: false,
						resizable: false,
						open: function(event, ui) {
							$(this).css({'max-height': $(document).height()-200, 'overflow-y': 'hidden'}); 
							$(this).css('overflow', 'hidden');
							$(".ui-dialog-title").show();
						} });
						
						//$("#estadobecas").dialog({height: '550', width: 750,minWidth:750});
						
						return false;
		
		
		
		
		$(".mensajeestados").hide();
		
		if(codigo=="" || codigo.length < 12){ 
			$("#rutconsultar").css("border", "solid RED 1px");
			$(".mensajeestados").show().html("Debes ingresa un codigo valido.");
			$("#rutconsultar").focus();
			return false;
		}
		
		var dataString = "c="+codigo;
		
		$.ajax({
			type: "GET",
			url: "pages/existe_codigoticket_qa.php",
			data: dataString,
			async: false,
			success: function (data) {
				if (window.console) console.log('--->DEBUG existe_codigoticket: '+data);
				if (data == "1") {
					
						var page = "estado.php?r="+codigo;
						console.log(page);
						$("#estadobecas").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="yes" src="' + page + '" width="100%" height="100%"></iframe>').dialog({ 
						autoOpen: true, 
						closeOnEscape: false, 
						modal:true, 
						height: '400',
						width:'580', 
						draggable: false,
						resizable: false,
						open: function(event, ui) {
							$(this).css({'max-height': $(document).height()-200, 'overflow-y': 'hidden'}); 
							$(this).css('overflow', 'hidden');
							$(".ui-dialog-title").show();
						} });					
				}else{
					$(".mensajeestados").show().html("Codigo No encontrado.");
				}	
			}
		});
		
		
	})

	$("#link_panel").click(function(){
	
		$("#idiframe").attr("src", "loginpanel.php?t=" + new Date().getTime());
		$("#dialog").dialog({height: '310', width: 500,minWidth:500,close: function () {
				$("#idiframe").attr("src", "limpia.php");
			}});
		$("#dialog").closest('.ui-dialog').find('.ui-dialog-titlebar-close').show();
		notyStatus = null
		var title = "ACCESO A POSTULACIONES";
		$("#dialog").dialog("option", "title", title);
		$("#dialog").dialog("open");
		$("#dialog").dialog("option", "position", {my: "center", at: "center", of: window});
		$("#idiframe").fadeIn();
		
		//return false;

		
		
	})
	
	
	
	
	
	$(".overlay").click(function(){
		cerrarcaja();
	})
	
	$(".postulasalir").click(function(){
		cerrarcaja();
	})
	
	
	$("#link_chat").click(function(){
		$("#chatme").fadeIn();
	})
		
	$(".postulaaqui").click(function(){
		beca = $(this).attr("rel");
		//cerrarcaja();
		$("#idiframe").hide();
		data = "b="+beca;
		if(beca == 1){
			$("#idiframe").attr("src", "loginv.php?"+data+"&t=" + new Date().getTime());
			$("#dialog").dialog({height: '310', width: 500,minWidth:500});
		}
		if(beca == 2){
			$("#idiframe").attr("src", "login.php?"+data+"&t=" + new Date().getTime());
			$("#dialog").dialog({height: '310', width: 500,minWidth:500});
		}
		
		
		$("#dialog").closest('.ui-dialog').find('.ui-dialog-titlebar-close').show();
		notyStatus = null
		$("#dialog").dialog("open");
		$("#dialog").dialog("option", "position", {my: "center", at: "center", of: window});
		$("#idiframe").fadeIn();
	})
	
	
	
	$(".link_pasoapaso_todas").click(function(){
		var beca = $(this).attr("rel");
		$("html").css("overflow-y","hidden");
		if(beca=="1"){
			var page = "files/INSTRUCCIONES PASO A PASO FV.pdf";
		}
		if(beca=="2"){
			//var page = "files/INSTRUCCIONES PASO A PASO BES 2017.pdf";
			var page = "files/INSTRUCCIONES PASO A PASO BES 2017 v2.pdf";
		}
		$("#basespdf").attr("title","Documento");
		var windowWidth = $(window).width() - 200;
		var windowHeight = $(window).height() - 200;
		//<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><div style="width:200px; margin: 0 auto;"><div class="becastipo">Bajar Bases</div></div>
		$("#basespdf").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="98%"></iframe>').dialog({ 
		autoOpen: true, 
		closeOnEscape: false, 
		modal:true, 	
		height: windowHeight,
		minWidth:950,
		minHeight:550,
		draggable: false,
		resizable: false,
		close: function(event, ui) {
			$("html").css("overflow-y","scroll");
        },
        open: function(event, ui) {

        } });
		
	
	})

	
	$("#link_frecuentes_educacion").click(function(){
		//alert("111111111111111111111111111111111111111");
		$("html").css("overflow-y","hidden");
		var page = "files/PREGUNTAS FRECUENTES 2017 BECAS ESTUDIOS.pdf";
		$("#basespdf").attr("title","Documento");
		var windowWidth = $(window).width() - 200;
		var windowHeight = $(window).height() - 200;
		//<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><div style="width:200px; margin: 0 auto;"><div class="becastipo">Bajar Bases</div></div>
		$("#basespdf").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="98%"></iframe>').dialog({ 
		autoOpen: true, 
		closeOnEscape: false, 
		modal:true, 	
		height: windowHeight,
		minWidth:950,
		minHeight:550,
		draggable: false,
		resizable: false,
		close: function(event, ui) {
			$("html").css("overflow-y","scroll");
        },
        open: function(event, ui) {

        } });
		
	
	})
	
	$("#link_frecuentes_vivienda").click(function(){
		$("html").css("overflow-y","hidden");
		var page = "files/PREGUNTAS FRECUENTES 2017 FONDO DE VIVIENDA.pdf";
		$("#basespdf").attr("title","Documento");
		var windowWidth = $(window).width() - 200;
		var windowHeight = $(window).height() - 200;
		//<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><div style="width:200px; margin: 0 auto;"><div class="becastipo">Bajar Bases</div></div>
		$("#basespdf").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="98%"></iframe>').dialog({ 
		autoOpen: true, 
		closeOnEscape: false, 
		modal:true, 	
		height: windowHeight,
		minWidth:950,
		minHeight:550,
		draggable: false,
		resizable: false,
		close: function(event, ui) {
			$("html").css("overflow-y","scroll");
        },
        open: function(event, ui) {

        } });
		
	
	})
	
	$(".basesaqui").click(function(){
		var tipob = $(this).attr("rel");
		$("html").css("overflow-y","hidden");
		
		var page = "files/REGLAMENTO 2017 FONDO DE VIVIENDA.pdf";
		if(tipob == "2"){
			page = "files/REGLAMENTO 2017 BECAS ESTUDIOS.pdf";
		}
		
		var windowWidth = $(window).width() - 200;
		var windowHeight = $(window).height() - 200;
		$("#basespdf").attr("title","Documento");
		//<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><div style="width:200px; margin: 0 auto;"><div class="becastipo">Bajar Bases</div></div>
		$("#basespdf").html('<iframe id="idiframe" style="border: 0px; overflow:hidden; overflow-y: hidden; " scrolling="no" src="' + page + '" width="100%" height="98%"></iframe>').dialog({ 
		autoOpen: true, 
		closeOnEscape: false, 
		modal:true, 	
		height: windowHeight,
		minWidth:950,
		minHeight:550,
		draggable: false,
		resizable: false,
		close: function(event, ui) {
			$("html").css("overflow-y","scroll");
        },
        open: function(event, ui) {

        } });
		
	
	})
	
	
});
</script>

<style>
.video {
    margin-left: 66px;
}
.col1 {
    float: left;
    width: 28%;
    background-color: #f69121;
    padding-right: 5%;
    height: 280px;
}
.col2 {
    float: left;
    width: 28%;
    padding-right: 5%;
    background-color: #f69121;
    height: 280px;
}
.col3 {
    float: left;
    width: 29%;
    padding-right: 5%;
    background-color: #f69121;
    height: 280px;
}
.becastipo {
    font-family: 'Lato', verdana !important;
    font-size: 16px !important;
    background-color: #fff;
    padding: 5px 15px;
    cursor: pointer;
    color: #946133;
}
section h2 {
    border-bottom: 1px solid white;
    display: table;
    text-transform: uppercase;
    min-height: 1px;
    overflow: hidden;
    width: 90%;
    color: white;
    margin-left: 35px;
    margin-top: 30px;
    font-weight: bold;
}
section h3 {
    font-family: inherit;
    margin-left: 35px;
    margin-bottom: 10px;
    font-weight: normal;
    color: white;
    line-height: 22px;
}
.becaselije {
    font-family: 'Lato', verdana !important;
    font-size: 18px !important;
    background-color: #f7951b;
    padding: 10px 30px;
    cursor: pointer;
    box-shadow: 0 0 10px #8E3401;
}
.centerbecas {
    margin: 0 auto;
    width: 790px;
    text-align: center;
    padding-top: 20px;
    padding-bottom: 70px;
}
.opcionbecas div {
    font-family: 'Lato', verdana !important;
    color: #fff;
    top: 0;
    margin: 0 auto;
    font-size: 32px;
    text-align: center;
    font-style: normal;
    font-weight: bold;
}

.row2 {
    display: none;
}
.cajabotones{
	width: 665px;
}
html {
    border-top: 10px solid #f26118;
    padding-top: 0px;
	background-color: rgba(399,79,11,.2);
	background-blend-mode: multiply;
}
body {
	-webkit-box-shadow: 0 5px 15px #371B0C;
	-moz-box-shadow: 0 5px 15px #371B0C;
	box-shadow: 0 5px 15px #371B0C;
}
header {
    margin-bottom: 0;
}
figcaption {
    position: absolute;
    top: 0;
    margin-left: 30px;
    margin-top: 40px;
    color: #fff;
    font-size: 1rem;
    float: left;
}
figcaption h1{
	font-family: 'Lato', verdana !important;
}
figcaption .textos {
    float: left;
    width: 550px;
    padding: 1.5rem 1rem 1.5rem 2rem;
    background: rgba(0,0,0,0.8);
}
</style>

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

<div id="dialog" class="hidden" title="Acceso"><p></p></div>
<div id="basespdf" class="hidden" title="Bases"><p></p></div>
<div id="estadobecas" class="hidden" title="Estado Solicitud"><p></p></div>






<section id="content" role="main">

<div class="row0">


<div id="slider">

<figure class="grupo">

	<figure>
	    <img src="img/banner4.jpg">
		<figcaption>
		<div class="textos">
		<h1>becas de educación superior</h1>
		<span>Para hijos, cónyuges y trabajadores de empresas contratistas y subcontratistas que prestan servicios a Codelco.</span>
		<p>La Corporación Nacional del Cobre de Chile entrega becas de excelencia académica de educación superior a estudiantes que sean hijos, cónyuges o convivientes de trabajadores contratistas y/o los propios trabajadores. Te invitamos a que puedas conocer las bases de este beneficio y postular a través de este formulario electrónico.</p><div class="limpiar"></div>
		<?php if(($dte_iniciov < $dte_finv) || isset($_GET["adminme"]) ){ ?>
			<a class="ingresobanner" href="#">Ingresar</a>
		<?php } ?>
		</div>
		<div class="eventos">
		<blockquote><span>13<br>MARZO</span><span>&nbsp;al&nbsp;</span><span>13<br>ABRIL</span><p>Postulaciones y entrega de antecedentes, <strong style="text-decoration:underline;"><?php /*echo $daysv<0?"0":$daysv;*/ ?> terminado</strong>.</p></blockquote>
		<blockquote><span>17<br>MAYO</span><p>Publicación de resultados preliminares de las postulaciones.</p></blockquote>
		<blockquote><span>17<br>MAYO</span><span>&nbsp;al&nbsp;</span><span>2<br>JUNIO</span><p>Apelaciones.</p></blockquote>
		<blockquote><span>19<br>JUNIO</span><p>Publicación de resultados finales.</p></blockquote>
		<blockquote><span>23<br>JUNIO</span><p>Pago fondos adjudicados.</p></blockquote>
		<div class="limpiar"></div>
<div class="cajabotones">
		<div class="basesaqui" rel="2">VER LAS BASES</div>
        <div class="prerequisitos" id="link_documentos" style="position: relative;">DOCUMENTACIÓN
        <div class="div-to-display doc_ESuperior" style="height: 325px !important;">
          <span>Para postular Necesitas: </span>
      <ul id="listado_requisitos">

	  <li>1.- <a style="color:black;" href="files/DJ_empresa_contratista_2017_(Educacion).doc" target="_blank">Declaración Jurada Simple Contratista</a></li>
	  <li>2.- <a style="color:black;" href="files/DJ_empresa_subcontratista_2017_(Educacion).doc" target="_blank">Declaración Jurada Simple Subcontratista</a></li>
      <li>3.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/adquirirCertificado.do" target="_blank">Certificado de Nacimiento.</a></li>
      <li>4.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/adquirirCertificado.do" target="_blank">Certificado de Matrimonio.</a></li>
      <li>5.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/servlet/VentaCertificadoAUC" target="_blank">Certificado de Unión Civil.</a></li>
    </ul></div></div>
        <!-- <div class="prerequisitos" id="link_frecuentes_educacion33333">PREGUNTAS FRECUENTES</div>
         <div class="prerequisitos link_pasoapaso_todas" rel="2">PASO A PASO</div>-->
         <div class="prerequisitos" id="link_frecuentes_educacion">PREGUNTAS FRECUENTES</div>
         <div class="prerequisitos link_pasoapaso_todas" rel="2">PASO A PASO</div>
     </div>
		<div class="limpiar"></div>
		<div class="postulasalir">SALIR</div>
		</div>
		</figcaption>
		
	</figure>
    <!--<figure>
	    <img src="img/banner4.jpg">
		<figcaption>
		<div class="textos">
		<h1>becas de educación superior</h1>
		<span>Para hijos, cónyuges y trabajadores de empresas contratistas y subcontratistas que prestan servicios a Codelco.</span>
		<p>La Corporación Nacional del Cobre de Chile entrega becas de excelencia académica de educación superior a estudiantes que sean hijos, cónyuges o convivientes de trabajadores contratistas y/o los propios trabajadores. Te invitamos a que puedas conocer las bases de este beneficio y postular a través de este formulario electrónico.</p><div class="limpiar"></div>
		<?php if(isset($_GET["adminme"])){ ?><a class="ingresobanner" href="#">Ingresar</a><?php } ?>

		</div>
		<div class="eventos">
		<blockquote><span>13<br>MARZO</span><span>&nbsp;al&nbsp;</span><span>13<br>ABRIL</span><p>Postulaciones y entrega de antecedentes, <strong style="text-decoration:underline;"><?php echo $dayse<0?"0":$dayse; ?></strong> días.</p></blockquote>
		<blockquote><span>17<br>MAYO</span><p>Publicación de resultados preliminares de las postulaciones.</p></blockquote>
		<blockquote><span>17<br>MAYO</span><span>&nbsp;al&nbsp;</span><span>2<br>JUNIO</span><p>Apelaciones.</p></blockquote>
		<blockquote><span>19<br>JUNIO</span><p>Publicación de resultados finales.</p></blockquote>
		<blockquote><span>23<br>JUNIO</span><p>Pago fondos adjudicados.</p></blockquote>
		<div class="limpiar"></div>

		<div class="cajabotones">
				<div class="basesaqui" rel="2">VER LAS BASES</div>
		        <div class="prerequisitos" id="link_documentos" style="position: relative;">DOCUMENTACIÓN
		        <div class="div-to-display">
		        <span>Para postular Necesitas: </span>
		      <ul id="listado_requisitos">
		      <li>1.- <a style="color:black;" href="#" target="_blank">Declaración Jurada Simple <br><br><br></a>
		      		<div style="background-color: #f37421; padding: 2px;position: absolute;    margin-left: 147px;    margin-top: -82px;">
		      		<ul id="listado_jurada" style="width: 200px;">
				       <li><a style="color:black;" href="files/DJ_empresa_contratista_2017_(Educacion).doc" target="_blank">Empresa Contratista.</a></li>
				       <li><a style="color:black;" href="files/DJ_empresa_subcontratista_2017_(Educacion).doc" target="_blank">Empresa Subcontratista.</a></li>
				    </ul>
					</div>
		      </li>
		      <li>2.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/adquirirCertificado.do" target="_blank">Certificado de Nacimiento.</a></li>
		      <li>3.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/adquirirCertificado.do" target="_blank">Certificado de Matrimonio.</a></li>
		      <li>4.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/servlet/VentaCertificadoAUC" target="_blank">Certificado de Unión Civil.</a></li>
		    </ul>
		</div></div>
		</div>
        <div class="prerequisitos" id="link_frecuentes_educacion">PREGUNTAS FRECUENTES</div>
         <div class="prerequisitos link_pasoapaso_todas" rel="2">PASO A PASO</div>
		<div class="limpiar"></div>
		<div class="postulasalir">SALIR</div>
		</div>
		</figcaption>
		
	</figure>-->
	<figure>
	    <img src="img/banner6.jpg">
		<figcaption>
		<div class="textos">
		<h1>becas de educación superior</h1>
		<span>Para hijos, cónyuges y trabajadores de empresas contratistas y subcontratistas que prestan servicios a Codelco.</span>
		<p>La Corporación Nacional del Cobre de Chile entrega becas de excelencia académica de educación superior a estudiantes que sean hijos, cónyuges o convivientes de trabajadores contratistas y/o los propios trabajadores. Te invitamos a que puedas conocer las bases de este beneficio y postular a través de este formulario electrónico.</p><div class="limpiar"></div>
		</div>
		<div class="eventos">
		<blockquote><span>13<br>MARZO</span><span>&nbsp;al&nbsp;</span><span>13<br>ABRIL</span><p>Postulaciones y entrega de antecedentes, <strong style="text-decoration:underline;"><?php /*echo $daysv<0?"0":$daysv;*/ ?> terminado</strong>.</p></blockquote>
		<blockquote><span>17<br>MAYO</span><p>Publicación de resultados preliminares de las postulaciones.</p></blockquote>
		<blockquote><span>17<br>MAYO</span><span>&nbsp;al&nbsp;</span><span>2<br>JUNIO</span><p>Apelaciones.</p></blockquote>
		<blockquote><span>19<br>JUNIO</span><p>Publicación de resultados finales.</p></blockquote>
		<blockquote><span>23<br>JUNIO</span><p>Pago fondos adjudicados.</p></blockquote>
		<div class="limpiar"></div>

		<div class="cajabotones">
				<div class="basesaqui" rel="2">VER LAS BASES</div>
		        <div class="prerequisitos" id="link_documentos" style="position: relative;">DOCUMENTACIÓN
		        <div class="div-to-display">
		        <span>Para postular Necesitas: </span>
		      <ul id="listado_requisitos">
		      <li>1.- <a style="color:black;" href="files/formato_certificado_empresa.doc" target="_blank">Declaración Jurada Simple.</a></li>
		      <li>2.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/adquirirCertificado.do" target="_blank">Certificado de Nacimiento.</a></li>
		      <li>3.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/adquirirCertificado.do" target="_blank">Certificado de Matrimonio.</a></li>
		      <li>4.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/servlet/VentaCertificadoAUC" target="_blank">Certificado de Unión Civil.</a></li>
		    </ul></div></div>
		</div>
<!--        <div class="prerequisitos" id="link_frecuentes_educacion">PREGUNTAS FRECUENTES</div>
         <div class="prerequisitos link_pasoapaso_todas" rel="2">PASO A PASO</div>-->
		<div class="limpiar"></div>
		<div class="postulasalir">SALIR</div>
		</div>
		</figcaption>
		
	</figure>
    <figure>
	    <img src="img/banner5.jpg">
		<figcaption>
		<div class="textos">
		<h1>becas de educación superior</h1>
		<span>Para hijos, cónyuges y trabajadores de empresas contratistas y subcontratistas que prestan servicios a Codelco.</span>
		<p>La Corporación Nacional del Cobre de Chile entrega becas de excelencia académica de educación superior a estudiantes que sean hijos, cónyuges o convivientes de trabajadores contratistas y/o los propios trabajadores. Te invitamos a que puedas conocer las bases de este beneficio y postular a través de este formulario electrónico.</p><div class="limpiar"></div>

		</div>
		<div class="eventos">
		<blockquote><span>13<br>MARZO</span><span>&nbsp;al&nbsp;</span><span>13<br>ABRIL</span><p>Postulaciones y entrega de antecedentes, <strong style="text-decoration:underline;"><?php /*echo $daysv<0?"0":$daysv;*/ ?> terminado</strong>.</p></blockquote>
		<blockquote><span>17<br>MAYO</span><p>Publicación de resultados preliminares de las postulaciones.</p></blockquote>
		<blockquote><span>17<br>MAYO</span><span>&nbsp;al&nbsp;</span><span>2<br>JUNIO</span><p>Apelaciones.</p></blockquote>
		<blockquote><span>19<br>JUNIO</span><p>Publicación de resultados finales.</p></blockquote>
		<blockquote><span>23<br>JUNIO</span><p>Pago fondos adjudicados.</p></blockquote>
		<div class="limpiar"></div>
<div class="cajabotones">
		<div class="basesaqui" rel="2">VER LAS BASES</div>
        <div class="prerequisitos" id="link_documentos" style="position: relative;">DOCUMENTACIÓN
        <div class="div-to-display doc_ESuperior" style="height: 357px !important;">
          <span>Para postular Necesitas: </span>
      <ul id="listado_requisitos">

	  <li>1.- <a style="color:black;" href="files/DJ_empresa_contratista_2017_(Educacion).doc" target="_blank">Declaración Jurada Simple Contratista</a></li>
	  <li>2.- <a style="color:black;" href="files/DJ_empresa_subcontratista_2017_(Educacion).doc" target="_blank">Declaración Jurada Simple Subcontratista</a></li>
      <li>3.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/adquirirCertificado.do" target="_blank">Certificado de Nacimiento.</a></li>
      <li>4.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/adquirirCertificado.do" target="_blank">Certificado de Matrimonio.</a></li>
      <li>5.- <a style="color:black;" href="https://www.registrocivil.cl/OficinaInternet/servlet/VentaCertificadoAUC" target="_blank">Certificado de Unión Civil.</a></li>
    </ul></div></div>
        <!-- <div class="prerequisitos" id="link_frecuentes_educacion33333">PREGUNTAS FRECUENTES</div>
         <div class="prerequisitos link_pasoapaso_todas" rel="2">PASO A PASO</div>-->
         <div class="prerequisitos" id="link_frecuentes_educacion">PREGUNTAS FRECUENTES</div>
         <div class="prerequisitos link_pasoapaso_todas" rel="2">PASO A PASO</div>
     </div>
		<div class="limpiar"></div>
		<div class="postulasalir">SALIR</div>
		</div>
		</figcaption>
		
	</figure>

	<figure>

	    <img src="img/banner1.jpg">

		<figcaption>
		<div class="textos">
			<h1>fondo único de vivienda concursable</h1>
			<span>Para la primera vivienda de trabajadores contratistas y subcontratistas de Codelco.</span>
			<p>En la Corporación Nacional del Cobre estamos interesados en que puedas postular al fondo único para la primera vivienda para trabajadores de empresas contratistas o subcontratistas que prestan servicios para Codelco. Infórmate en este sitio de los requerimientos necesarios y anímate a postular. </p><div class="limpiar"></div>
			<?php if(($dte_iniciov < $dte_finv) || isset($_GET["adminme"]) ){ ?>
			<a class="ingresobanner" href="#">Ingresar</a>
			<?php } ?>
		</div>
		<div class="eventos">
		<blockquote><span>19<br>JUN</span><span>&nbsp;al&nbsp;</span><span>20<br>JUL</span><p>Postulaciones y entrega de antecedentes.<strong style="text-decoration:underline;"><?php /*echo $daysv<0?"0":$daysv;*/ ?></strong>.</p></blockquote>
		<blockquote><span>21<br>AGO</span><p>Publicación de resultados preliminares.</p></blockquote>
		<blockquote><span>21<br>AGO</span><span>&nbsp;al&nbsp;</span><span>4<br>SEP</span><p>Apelaciones.<strong style="text-decoration:underline;"><?php //echo $daysv_apelacion<0?"0":$daysv_apelacion; ?></strong></p></blockquote>
		<blockquote><span>26<br>SEP</span><p>Publicación de resultados finales.</p></blockquote>
		<blockquote><span>29<br>SEP</span><p>Pago fondos adjudicados.</p></blockquote>
			<div class="limpiar"></div>

			<div class="cajabotones">
					<div class="basesaqui" rel="1">VER LAS BASES</div>
					<div class="prerequisitos" id="link_documentos" style="position: relative;">DOCUMENTACIÓN
		        		<div class="div-to-display doc_BVivienda">
		          			<span>Para postular Necesitas: </span>
							    <ul id="listado_requisitos">
							    <li>1.- <a style="color:black;" href="files/certificado_empresa_contratista_2017.doc" target="_blank">Declaracion Jurada Simple Contratistas</a></li>
							    <li>2.- <a style="color:black;" href="files/certificado_empresa_subcontratista_2017.doc" target="_blank">Declaracion Jurada Simple Subcontratistas</a></li>
							    <li>3.- <a style="color:black;" href="https://www.conservador.cl/portal/copia_dominio_vigente" target="_blank">Certificado de Propiedad Vigente</a></li>
							   
							    </ul>
						</div>
					</div>
		        	<div class="prerequisitos" id="link_frecuentes_vivienda">PREGUNTAS FRECUENTES</div>
		        	<div class="prerequisitos link_pasoapaso_todas" rel="1">PASO A PASO</div>
		    </div>

			<div class="limpiar"></div>
			<div class="postulasalir">SALIR</div>
		</div>
		</figcaption>
	</figure>
    
    <figure>
	    <img src="img/banner2.jpg">
		<figcaption>
		<div class="textos">
		<h1>fondo único de vivienda concursable</h1>
		<span>Para la primera vivienda de trabajadores contratistas y subcontratistas de Codelco.</span>
		<p>En la Corporación Nacional del Cobre estamos interesados en que puedas postular al fondo único para la primera vivienda para trabajadores de empresas contratistas o subcontratistas que prestan servicios para Codelco. Infórmate en este sitio de los requerimientos necesarios y anímate a postular. </p><div class="limpiar"></div>
		</div>
		<div class="eventos">
		<blockquote><span>13<br>JUN</span><span>&nbsp;al&nbsp;</span><span>15<br>JUL</span><p>Postulaciones y entrega de antecedentes, termina en <strong style="text-decoration:underline;"><?php /*echo $daysv<0?"0":$daysv;*/ ?> terminado</strong>.</p></blockquote>
		<blockquote><span>16<br>AGO</span><p>Publicación de resultados de las postulaciones.</p></blockquote>
		<blockquote><span>16<br>AGO</span><span>&nbsp;al&nbsp;</span><span>2<br>SEP</span><p>Apelaciones, termina en <strong style="text-decoration:underline;"><?php echo $daysv_apelacion<0?"0":$daysv_apelacion; ?></strong> días.</p></blockquote>
		<blockquote><span>20<br>SEP</span><p>Publicación de resultados finales.</p></blockquote>
		<blockquote><span>23<br>SEP</span><p>Pago fondos adjudicados.</p></blockquote>

		<div class="limpiar"></div>
		<div class="cajabotones">
					<div class="basesaqui" rel="1">VER LAS BASES</div>
					<div class="prerequisitos" id="link_documentos" style="position: relative;">DOCUMENTACIÓN
			        <div class="div-to-display doc_BVivienda">
			          <span>Para postular Necesitas: </span>
			      <ul id="listado_requisitos">
			      <li>1.- <a style="color:black;" href="files/formato_certificado_empresa_vivienda.doc" target="_blank">Declaracion Jurada</a></li>
			      <li>2.- <a style="color:black;" href="https://www.conservador.cl/portal/copia_dominio_vigente" target="_blank">Certificado de Propiedad Vigente</a></li>
			      <li>3.- <a style="color:black;" href="http://www.tesoreria.cl/portal/ofVirtual/aLink.do?go=crt2" target="_blank">Certificado de Deuda Vigente</a></li>
			    </ul></div></div>
		</div>
<!--        <div class="prerequisitos" id="link_frecuentes_vivienda">PREGUNTAS FRECUENTES</div>
        <div class="prerequisitos link_pasoapaso_todas" rel="1">PASO A PASO</div>-->
		<div class="limpiar"></div>
		<div class="postulasalir">SALIR</div></div>
		</figcaption>
	</figure>

	<figure>

	    <img src="img/banner3.jpg">

		<figcaption>
		<div class="textos">
			<h1>fondo único de vivienda concursable</h1>
			<span>Para la primera vivienda de trabajadores contratistas y subcontratistas de Codelco.</span>
			<p>En la Corporación Nacional del Cobre estamos interesados en que puedas postular al fondo único para la primera vivienda para trabajadores de empresas contratistas o subcontratistas que prestan servicios para Codelco. Infórmate en este sitio de los requerimientos necesarios y anímate a postular. </p><div class="limpiar"></div>
		</div>
		<div class="eventos">
		<blockquote><span>13<br>JUN</span><span>&nbsp;al&nbsp;</span><span>15<br>JUL</span><p>Postulaciones y entrega de antecedentes, termina en <strong style="text-decoration:underline;"><?php /*echo $daysv<0?"0":$daysv;*/ ?> terminado</strong>.</p></blockquote>
		<blockquote><span>16<br>AGO</span><p>Publicación de resultados de las postulaciones.</p></blockquote>
		<blockquote><span>16<br>AGO</span><span>&nbsp;al&nbsp;</span><span>2<br>SEP</span><p>Apelaciones, termina en <strong style="text-decoration:underline;"><?php echo $daysv_apelacion<0?"0":$daysv_apelacion; ?></strong> días.</p></blockquote>
		<blockquote><span>20<br>SEP</span><p>Publicación de resultados finales.</p></blockquote>
		<blockquote><span>23<br>SEP</span><p>Pago fondos adjudicados.</p></blockquote>
			<div class="limpiar"></div>

			<div class="cajabotones">
					<div class="basesaqui" rel="1">VER LAS BASES</div>
					<div class="prerequisitos" id="link_documentos" style="position: relative;">DOCUMENTACIÓN
		        		<div class="div-to-display doc_BVivienda">
		          			<span>Para postular Necesitas: </span>
							    <ul id="listado_requisitos">
							    <li>1.- <a style="color:black;" href="files/certificado_empresa_contratista_2016.doc" target="_blank">Declaracion Jurada Simple Contratistas</a></li>
							    <li>2.- <a style="color:black;" href="files/certificado_empresa_subcontratista_2016.doc" target="_blank">Declaracion Jurada Simple Subcontratistas</a></li>
							    <li>3.- <a style="color:black;" href="https://www.conservador.cl/portal/copia_dominio_vigente" target="_blank">Certificado de Propiedad Vigente</a></li>
							    <li>4.- <a style="color:black;" href="http://www.tesoreria.cl/portal/ofVirtual/aLink.do?go=crt2" target="_blank">Certificado de Deuda Vigente</a></li>
							    </ul>
						</div>
					</div>
		        	<div class="prerequisitos" id="link_frecuentes_vivienda">PREGUNTAS FRECUENTES</div>
		        	<div class="prerequisitos link_pasoapaso_todas" rel="1">PASO A PASO</div>
		    </div>

			<div class="limpiar"></div>
			<div class="postulasalir">SALIR</div>
		</div>
		</figcaption>
	</figure>


	

	
</figure>

<div class="progress-bar"></div>
</div>


</div>

<section class="row1">
<div class="opcionbecas"><div class="centerbecas"><div id="link_estudios"  style="float:left" class="becaselije">Becas de Educación Superior</div><div class="becaselije" id="link_casa" style="float:right">Fondos para la Primera Vivienda</div></div></div>
<!--<div class="opcionbecas"><div class="centerbecas"><div id="link_estudios"  style="" class="becaselije">Becas Educación Superior</div></div></div>-->
<div class="limpiar"></div>
</section>
<section class="row2">
<div id="triangulos"></div>
</section>


<section class="col1">

<h2>Administración </h2>
<div class="estadopostulacion">
 <?php //if(isset($_GET["adminme"])){ ?>
<form class="stdform">

<div class="control-group info">
<!--<div style="color:white;  font-family:inherit;">Rut</div>-->
                          <div class="controls">
                          <!--<p class="recomendacion"><img src="img/sign-warning-icon.png"> Para realizar una postulación sin inconvenientes recomendamos hacerlo a través del navegador de Internet Google Chrome. <a href="https://www.google.com/chrome/" target="_blank" class="descargar-gc">descargar aquí</a></p>-->
                           
<!--                           <input type="text" class="upper" id="rutconsultar" maxlength="13" placeholder="Ejemplo 13456789-k">-->
<?php 
//if($dte_iniciov < $dte_finv){
		echo "<script>console.log('no se ha cumplido la fecha vivienda');</script>";
  
?>
                            <span class="help-inline"><div class="becastipo" id="link_panel" style="float:left">Consultar postulación</div></span>
<?php //} ?>
                          </div>
                          
						  <div class="mensajeestados">
                          
						  </div>
                        </div>
</form>
 <?php //} ?>
</div>

<!-- <div class="postula"><img src="postula.png"></div> -->


</section>

<section class="col2">

<h2>Conoce nuestro video </h2>
<div class="video"><a href="#" class="videositio"><img src="img/note.png" alt="Video Becas"></a></div>
</section>

<section class="col3">

<h2>¿Necesitas Ayuda?</h2>
<div class="ayuda">


</div>
<div class="limpiar"></div>
<h3><span>CORREO DE CONTACTO:</span> contacto@oticdelaconstruccion.cl</h3>
<!--<h3><span>FONO:</span> 600 797 8000 o (2) 2 487 1431 </h3>
<h3><span>HORARIO DE ATENCIÓN:</span> <br>Lunes a Viernes de 09:00 a 19:00 hrs.</h3>-->
<h3><span>DESCARGA</span> <A href="http://get.adobe.com/es/reader/" target="_blank">ADOBE PDF</A></h3>


</section>

<!-- <section class="row3">

</section>
<section class="row4">

</section> -->



</section>

<div id="chatme">
    <div class="fixedHeader">Chat <!--<div style="float:right;"> <a href="#" onClick="minimizar();" style="cursor:help;">&#9644;</a></div>--></div>
    <div class="fixedContent">
	<iframe id="iframe_chat" src="" scrolling="no"></iframe>
	<!--<div class="chat-messages">
                                <ul>
                                    <li>
                                        <span class="chat-msg-time"><a href="#">Callcenter</a></span>
                                        Hola Francisco !
                                    </li>
                                    <li class="chat-msg-user">
                                        <span class="chat-msg-time"><strong>TU</strong></span>
                                        Hola, Quisiera Saber sobre la Beca de la vivienda.
                                    </li>
                                    <li>
                                        <span class="chat-msg-time"><a href="#">Callcenter</a></span>
                                        Claro, Cuéntame que necesitas ?
                                    </li>
                                </ul>
                            </div>-->
	
	</div>
    <div class="chatbox" style="display:none;">
        <textarea class="userinput" style="height: 16px; " placeholder="Escriba Aqui"></textarea>            
    </div>
</div>
</header>
</body>
</html>

