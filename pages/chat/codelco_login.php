<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<?php
error_reporting(0);
include "includes/base.php";
session_start();
ob_start();
include "includes/date.php";

$check = mysql_query("SELECT available FROM users ");
$available = "no";
while ($row = mysql_fetch_array($check)) {
	if($row['available'] == "yes") { $available = "yes"; }
}
if($available == "no" ) {
	include "codelco_offline.php";
	die();
}



if(isset($_POST['idgestion'])) {
//var_dump($_POST);
//var_dump($_SESSION);

$fetch = mysql_query("SELECT * FROM config ");
$config = mysql_fetch_array($fetch);
$ip = $_SERVER['REMOTE_ADDR'];
$salt = rand(100,999);
$userID = $_POST['usuarionombre'] . $ip . $salt;
$_SESSION['name'] = $_POST['nombre'];

$_SESSION['userID'] = $userID;

if(!empty($_POST['usuariomail'])) {
	$_SESSION['email'] = $_POST['usuariomail'];
} else {
	$_SESSION['email'] = "N/A";
}

$_SESSION['rut'] = $_POST['rut']."-".$_POST['digito'];

$contactme = "yes";

$start = time();
// add entry to sql
$sqlx = "INSERT INTO sessions (userID,name,email,initiated,status,contact) VALUES ('".$_SESSION['userID']."','".$_SESSION['name']."','".$_SESSION['email']."','".$start."','open','".$contactme."')";

//echo $sqlx;


$query = mysql_query($sqlx);
if($query) {
	$timeStamp = date('g:i a');
	$update = mysql_query("SELECT id FROM sessions WHERE userID = '".$_SESSION['userID']."'");
	$result = mysql_fetch_array($update);
	$_SESSION['convoID'] = $result['id'];
	mysql_query("UPDATE sessions SET convoID = '".$_SESSION['convoID']."' WHERE userID = '".$_SESSION['userID']."' ");
	mysql_query("INSERT INTO transcript
        (name,message,convoID,time,class)
        VALUES
        ('Admin','".$config['welcome']."','".$_SESSION['convoID']."','".$timeStamp."','admin')
        ");

	//header('location:udd_chat.php');
		include "codelco_chat.php";
		die();
}else{
 die("ERROR: ".mysql_error());
 }

}
include "includes/base.php";

$fetch = mysql_query("SELECT * FROM config ");
$config = mysql_fetch_array($fetch);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Chat codelco</title>
<link rel="stylesheet" type="text/css" media="all" href="css/estilo.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script src="js/jquery.numeric.js" type="text/javascript"></script>
<script src="js/jquery.bestupper.min.js" type="text/javascript"></script>
<script src="js/jquery.Rut.js" type="text/javascript"></script>
<script src="js/jquery.Rut.min.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
			
            function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }

		function traeWS(){
			
			var data1 = $("#rut").val();
			
			if(data1 == "") return false;
			
			dataString = "xrut="+data1;
			
					
			 $.ajax({
                type: "GET",
                url: "includes/rutBuscar.php",
                data: dataString,
                success: function (data) {
					codigo = data.split("~");
                    if (codigo[0] == 2) {
						datosclt = codigo[1].split("|");
						$("#nombre").val(datosclt[0]);
						$("#email").val(datosclt[1]);
					}else{
						$("#nombre").attr("disabled",false);
						$("#email").attr("disabled",false);
					}
                },
                error: function (objeto, quepaso, otroobj) {
                    //$("#error").html(objeto.responseText);
                }
            });
				
			
		}
		
        $(document).ready(function () {
			
			$("input:text").hide();
			
			//$("#nombre").attr("disabled",true);
			//$("#email").attr("disabled",true);
			
		
		
			Cufon.replace('h4,h3,h2,h1,label,a');
			
            $("#nick").hide();
            $("#rut").numeric();
            $("#digito").numeric("K");
            $("#telefono").numeric();
            $('.upper').bestupper();
			
        });

        function limpiar() {
            $("#nombre").css({ borderColor: "" });
            $("#rut").css({ borderColor: "" });
            $("#email").css({ borderColor: "" });
            $("#telefono").css({ borderColor: "" });
			$("#resmes").html("");
        }

        function dv(T) {
            var M = 0, S = 1; for (; T; T = Math.floor(T / 10))
                S = (S + T % 10 * (9 - M++ % 6)) % 11; return S ? S - 1 : 'K';
        }

        function checkeo() {

            var var1 = $("#nombre").val();
            var var2 = $("#rut").val();
            var var3 = $("#email").val();
            var var4 = $("#telefono").val();
            var var0 = $("#digito").val();
			var var8 = $("#prefijo").val();
			
			 var stringbrowser = "";

            jQuery.each(jQuery.browser, function (i, val) {
                stringbrowser += i + ":" + val + ";";
            });
         
            var dataString = "xnombre=" + var1 + "&xrut=" + var2+''+var0+ "&xemail=" + var3 + "&xfono=" + var4 + "&xnavegador=" + stringbrowser;
			
		
			//alert(dataString);

			//$("#formulario1").submit();
		
			//return false;
			
            $.ajax({
                type: "POST",
                url: "includes/codelco_guardar.php",
                data: dataString,
                success: function (data) {
                    if (data == 1) {
                        $("#formulario1").submit();
                    } else {
                        alert('FALLO EN EL INGRESO');
                    }
                },
                error: function (objeto, quepaso, otroobj) {
                    $("#error").html(objeto.responseText);
                }
            });

        }	
</script>
</head>
<body>
<div id="cuerpo_form">
<div id="campos">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="formulario1" >
    <table style="width:100%;" align="center">
        <tr>
            <td align="right">&nbsp;
                </td>
      <td>
                &nbsp;
                <input id="rut" type="text" size="10" maxlength="8" name="rut" value="<?php echo $_SESSION['rut']; ?>" /><input class="upper" id="digito" type="text" size="1"  maxlength="1" name="digito" value="<?php echo $_SESSION['dv']; ?>" />
                </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
      <td>
                &nbsp;
                <input id="nombre" class="upper" type="text" maxlength="20" size="10" name="nombre" value="<?php echo $_SESSION['nombre']; ?>" /></td>
        </tr>
        
        <tr>
            <td align="right">&nbsp;
                </td>
      <td>
                &nbsp;
                <input id="email" class="upper" type="text" size="10" maxlength="50" name="email" value="<?php echo $_SESSION['email']; ?>" /></td>
        </tr>
        
        <tr>
            <td align="right">&nbsp;</td>
          <td>
            &nbsp;
                <input type="text" id="prefijo" name="prefijo" value="0">
                <span class="exmpl"></span>
                <input id="telefono" name="telefono" type="text" maxlength="10" size="15" value="<?php echo $_SESSION['fono']; ?>" /><span class="exmpl"></span></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><span id="resmes" style="color:#990000" class="exmpl"></span></td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                <input type="hidden" name="tipo" id="tipo" value="" />
                <input type="hidden" name="navegador" id="navegador" value="" />
                <input type="hidden" name="idgestion" id="idgestion" value="1" />
                <input type="hidden" name="usuarionombre" id="usuarionombre" value="" />
                <input type="hidden" name="usuariomail" id="usuariomail" value="" />
                <input id="enviar" onclick="checkeo();" type="button" value="" class="bot_buscar" /></td>
        </tr>
    </table>
</form>
</div>

</div>
<div id="error"></div>
</body>
</html>
<?php ob_flush(); ?>