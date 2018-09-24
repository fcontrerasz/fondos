<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<?php 
include "includes/base.php";
ob_start();
session_start();
//echo "--------->".$_SESSION['userID'];
if(empty($_SESSION['userID'])) {
        //header('location:udd_login.php');
		include "codelco_login.php";
		die();
}
include "includes/base.php";

$fetch_config = mysql_query("SELECT * FROM config ORDER BY id ASC LIMIT 1 ");
$config = mysql_fetch_array($fetch_config);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title><?php echo $config['title'];?></title>
<link rel="stylesheet" type="text/css" media="all" href="css/estilo.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/client.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script type="text/javascript">

var normalize = (function() {
  var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
      to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
      mapping = {};
 
  for(var i = 0, j = from.length; i < j; i++ )
      mapping[ from.charAt( i ) ] = to.charAt( i );
 
  return function( str ) {
      var ret = [];
      for( var i = 0, j = str.length; i < j; i++ ) {
          var c = str.charAt( i );
          if( mapping.hasOwnProperty( str.charAt( i ) ) )
              ret.push( mapping[ c ] );
          else
              ret.push( c );
      }
      return ret.join( '' );
  }
 
})();

$(document).ready(function(){
                Cufon.replace('h4,h3,h2,h1,label,a');
		var intervalID = setInterval("getInput();", <?php echo $config['clientRefresh'];?>);
		getInput();
});
function str_replace (search, replace, subject)
{
var result = "";
var  oldi = 0;
for (i = subject.indexOf (search); i > -1; i = subject.indexOf (search, i))
{
result += subject.substring (oldi, i);
result += replace;
i += search.length;
oldi = i;
}
return result + subject.substring (oldi, subject.length);
}

function sendInput() {  // open send input
        var ajaxInsert;
        try{
                ajaxInsert = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxInsert = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxInsert = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("There appears to have been a problem, please reload the page.");
                                return false;
                        }
                }
        } // close ajax request
        ajaxInsert.onreadystatechange = function(){
                if(ajaxInsert.readyState == 4){
			getInput();
		}
        }
		var message = encodeURI(document.getElementById('message').value);
		var user = encodeURI(document.getElementById('userID').value);
		var name = encodeURI(document.getElementById('userName').value);
		var convoID = document.getElementById('convoID').value;
		var randomnumber= Math.floor(Math.random()*1001);
	        var queryString = "?message=" + normalize(message) + "&userID=" + user + "&name=" + name + "&convoID=" + convoID + "&rand=" + randomnumber;
		if(message != "") {
	        	ajaxInsert.open("GET", "includes/insert.php" + queryString, true);
		        ajaxInsert.send(null);
			if(document.getElementById('message').value = message) {
				document.getElementById('message').value = "";
			}
		}
} // close send input
function getInput() {  
        var ajaxGet;
        try{
                ajaxGet = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxGet = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxGet = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("There appears to have been a problem, please reload the page.");
                                return false;
                        }
                }
        } 
        ajaxGet.onreadystatechange = function(){
                if(ajaxGet.readyState == 4){
			document.getElementById('chatOutput').innerHTML = ajaxGet.responseText;
			var objDiv = document.getElementById('chatOutput');
                        objDiv.scrollTop = objDiv.scrollHeight;
                }
        }
                var convo = document.getElementById('convoID').value;
                var queryString = "?convo=" + convo;
                ajaxGet.open("GET", "includes/retrieve.php" + queryString, true);
                ajaxGet.send(null);
} // close get input
</script>
</head>
<body style="margin:0; padding:0;">
<div id="cuerpo_form_chat" style="margin:0; padding:0;">
		<div class="container" style="margin:0; padding:0;">
				<div style="clear:both; height:1px;"></div>
                <div style="float:right"><a href="codelco_stop.php?id=<?php echo $_SESSION['convoID'];?>" class="red small_text"><img width="96" height="25" src="images/chat/salir.jpg" /></a></div>
                <div style="clear:both; height:1px;"></div>
				</div>
				<!--- Chat output -->
				<div id="chatOutput" style="height:180px; width:280px; margin-left:14px;"></div>
			<div id="client_input_container">
					<!-- Client Input -->
					<form action="javascript:sendInput();" name="messageInput" id="MessageInput">
					<input type="hidden" name="userID" id="userID" value="<?php echo $_SESSION['userID'];?>" />
					<input type="hidden" name="userName" id="userName" value="<?php echo $_SESSION['name'];?>" />
					<input type="hidden" name="convoID" id="convoID" value="<?php echo $_SESSION['convoID'];?>" />
					<input type="text" name="message" id="message" size="25" class="input_field" />
					<input type="submit" class="input_field submit" value="Enviar" /><br />
					</form>	

			</div>
		</div>
</div>
</body>
</html>

<?php ob_flush(); ?>

