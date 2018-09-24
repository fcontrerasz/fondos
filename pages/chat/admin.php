<?php 
// create session so we can keep track of users
session_start();
// check login
error_reporting(0);

function isLoggedIn() {
	if($_SESSION['valid'])
		return true;
		return false;
	}
	if(!isLoggedIn()) {
		header('Location: login.php');
		die();
}
// mysql interaction
include "includes/base.php";
include "includes/functions.php";
// get whether available or not
$current = mysql_query("SELECT available FROM users WHERE username = '".$_SESSION['username']."' ");
$result = mysql_fetch_array($current);
	if($result['available'] == "yes") {
		$avail_string = '<h4><a href="#" onClick="available(false);"><img src="images/icons/available.png" title="Click para Cambiar Estado" height="30" style="vertical-align:middle;"/>&nbsp;&nbsp;Disponible</a></h4>';
	}
	else {
		$avail_string = '<h4><a href="#" onClick="available(false);"><img src="images/icons/unavailable.png" title="Click para Cambiar Estado" height="30" style="vertical-align:middle;"/>&nbsp;&nbsp;No Disponible</a></h4>';
	}
// update keepalive
mysql_query("UPDATE users SET keepAlive = '".time()."' WHERE username = '".$_SESSION['username']."' ");
//check for delete convo
if(isset($_POST['delete_convo'])) {
	// check to see if conversation is to be stored
	$check = mysql_query("SELECT * FROM sessions WHERE convoID = '".$_POST['id']."' ");
	$check_result = mysql_fetch_array($check);
	if($check_result['contact'] == "yes") {
		$idd = $_POST['id'];
		archive($idd,$check_result['name'],$check_result['email']);
	}
	include "includes/date.php";
	$timeStamp = date('g:i a');
	mysql_query("UPDATE sessions SET status = 'closed', ended = '".time()."', hide = 'yes'  WHERE convoID = '".$_POST['id']."' ");
	mysql_query("INSERT INTO transcript
        (name,message,user,convoID,time,class)
        VALUES
        ('".$_SESSION['name']."',ha dejado la conversacion','".$_SESSION['userID']."','".$_POST['id']."','".$timeStamp."','notice')
        ");
}
// grab standard responses
$responses = array();
$count = 0;
$standard = mysql_query("SELECT * FROM responses");
while($row = mysql_fetch_array($standard)) {
	$responses[$count]['title'] = $row['title'];
	$responses[$count]['message'] = $row['message'];
	$count = $count + 1;
}
// grab files
$files = array();
$count = 0;
$sharedfiles = mysql_query("SELECT * FROM files ");
while ($row = mysql_fetch_array($sharedfiles)) {
	$files[$count]['id'] = $row['id'];
	$files[$count]['name'] = $row['name'];
	$files[$count]['path'] = $row['path'];
	$count = $count + 1;
}
// grab config data
$fetch_config = mysql_query("SELECT * FROM config ORDER BY id ASC LIMIT 1 ");
$config = mysql_fetch_array($fetch_config);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Administrador</title>
<link rel="stylesheet" type="text/css" media="all" href="css/global.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/colorbox.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
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
	$("#chat-list li").click(function(){
	  window.location=$(this).find("a").attr("href"); return false;
	});
		setChecker();
                setInterval("setChecker();",10000);
		setTimer('<?php echo $_SESSION['username'];?>');
                setInterval("setTimer('<?php echo $_SESSION['username'];?>');",120000);
		$(".delete_convo").colorbox({opacity:0.9});
});
// str replace
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
// set refresh rate of conversations list
var convoRefresh = <?php echo $config['adminRefresh'];?>;
// set refresh rate of chat window 
var chatRefresh = <?php echo $config['convoRefresh'];?>;
// by default we want to retrieve dashboard
var activeConvo = "open";
// set up auto refresh to pull new entries into chat window
var intervalID = setInterval("getInput(activeConvo);", chatRefresh);
// populate convo list
function currentConvos() {
        var ajaxCurrent;
        try{
                ajaxCurrent = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxCurrent = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxCurrent = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("There appears to have been a problem, please reload the page.");
                                return false;
                        }
                }
        }
        ajaxCurrent.onreadystatechange = function(){
		if(ajaxCurrent.readyState == 1) {
		}
                if(ajaxCurrent.readyState == 4){
			document.getElementById('currentConvos').innerHTML = "";
			$('#currentConvos').append(ajaxCurrent.responseText);

               }
        }
                ajaxCurrent.open("GET", "includes/currentConvos.php?output=true",true);
                ajaxCurrent.send(null);
} // close currentConvos()

function sendInput(convoID) {
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
                                alert("Aparentemente hay problemas, actualice la página.");
                                return false;
                        }
                }
        }
		ajaxInsert.onreadystatechange = function(){
                if(ajaxInsert.readyState == 4){
		 getInput(convoID);
        	       }
		}

        
		var message = document.getElementById('messageID').value;
		var user = document.getElementById('userID').value;
		var name = document.getElementById('userName').value;
	 	var messageC = str_replace ('#', '%23', message);
		var randomnumber= Math.floor(Math.random()*1001);
		var message = encodeURI(normalize(messageC));
	        var queryString = "?message=" + message + "&userID=" + user + "&name=" + name + "&convoID=" + convoID + "&randomnumber=" + randomnumber;
        	ajaxInsert.open("GET", "includes/insertAdmin.php" + queryString, true);
	        ajaxInsert.send(null);
		if(document.getElementById('messageID').value = message) {
                document.getElementById('messageID').value = "";
                }
} // close sendInput()

function getInput(convoID) {
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
                                alert("Aparentemente hay problemas, actualice la página.");
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
                var queryString = "?id=" + convoID;
                ajaxGet.open("GET", "includes/retrieveAdmin.php" + queryString, true);
                ajaxGet.send(null);
		
} // close getInput()
function getInfo(user) {
        var ajaxInfo;
        try{
                ajaxInfo = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxInfo = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxInfo = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("Aparentemente hay problemas, actualice la página.");
                                return false;
                        }
                }
        }
        ajaxInfo.onreadystatechange = function(){
        if(ajaxInfo.readyState == 4){
                        document.getElementById('user_info').innerHTML = ajaxInfo.responseText;
			Cufon.replace('h3,th')
                }
        }
                var queryString = "?info=" + user;
                ajaxInfo.open("GET", "includes/user_info.php" + queryString, true);
                ajaxInfo.send(null);

}
function available() {
       var ajaxAvailable;
        try{
                ajaxAvailable = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxAvailable = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxAvailable = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("Aparentemente hay problemas, actualice la página.");
                                return false;
                        }
                }
        }
        ajaxAvailable.onreadystatechange = function(){
        if(ajaxAvailable.readyState == 4){
                        document.getElementById('available').innerHTML = "";
                        document.getElementById('available').innerHTML = ajaxAvailable.responseText;
                        Cufon.replace('h4')
                }
        }
		var randomnumber= Math.floor(Math.random()*1001);
		ajaxAvailable.open("GET", "includes/availability.php?user=<?php echo $_SESSION['username'];?>&noCache=" + randomnumber, true);
                ajaxAvailable.send(null);

}
function standardResponse() {
        var ajaxStandard;
        try{
                ajaxStandard = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxStandard = new ActiveXObject("Msxml2.XMLHTTP.4.0");
                } catch (e) {
                        try{
                                ajaxStandard = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("Aparentemente hay problemas, actualice la página.");
                                return false;
                        }
                }
        }
                ajaxStandard.onreadystatechange = function(){
                if(ajaxStandard.readyState == 4){
			var response = ajaxStandard.responseText;
				 document.getElementById('messageID').value = ajaxStandard.responseText;			
				document.getElementById('standard').selectedIndex = 0;
                       }
                }


		var randomnumber= Math.floor(Math.random()*1001);
                var title = document.getElementById('standard').value;
	        var queryString = "?title=" + title + "&randomnumber=" + randomnumber;
                ajaxStandard.open("GET", "includes/standard.php" + queryString, true);
                ajaxStandard.send(null);
} 
function sharedFiles() {
        var ajaxFiles;
        try{
                ajaxFiles = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxFiles = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxFiles = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("Aparentemente hay problemas, actualice la página.");
                                return false;
                        }
                }
        }
                ajaxFiles.onreadystatechange = function(){
                if(ajaxFiles.readyState == 4){
                                document.getElementById('messageID').value = ajaxFiles.responseText;
                                document.getElementById('files').selectedIndex = 0;
                       }
                }
		var randomnumber= Math.floor(Math.random()*11);
                var userName = document.getElementById('userName').value;
	        var files = document.getElementById('files').value;
                var queryString = "?file=" + files + "&id=" + activeConvo + "&name=" + userName + "&randomnumber=" + randomnumber;
                ajaxFiles.open("GET", "includes/addFile.php" + queryString, true);
                ajaxFiles.send(null);
}

</script>
</head>
<body>
<div id="main_container">
<div class="container_12">
	<div class="grid_8">
	<h1 class="ls">&nbsp;&nbsp;Soporte Chat </h1>

	</div>
	<div class="grid_4">
				<ul class="navigation">
			<li><a href="admin.php"><img src="images/navhome.png" alt="Dashboard" title="Dashboard" width="39" style="margin-right:6px;"/></a></li>
            	
            <?php if($_SESSION['admin']=="Yes"){ ?>
                          <li><a href="users.php"><img src="images/navusers.png" alt="Administracion de Usuarios" title="Usuarios" width="39" style="margin-right:6px;"/></a></li> 
            <?php } ?>
                                 
            <?php if(($_SESSION['username']=="fcontreras")){ ?>
                        <li><a href="leads.php"><img src="images/navleads.png" alt="Leads" title="Leads" width="39" style="margin-right:6px;"/></a></li>

			<li><a href="files.php"><img src="images/files.png" alt="Shared Files"title="Shared Files" width="39" style="margin-right:6px;"/></a></li>
			<li><a href="standard_response.php"><img src="images/canned.png" alt="Standard Responses"title="Standard Responses" width="39" style="margin-right:6px;"/></a></li>
                        <li><a href="maint.php"><img src="images/navmaint.png" alt="Maintenance" title="Maintenance" width="39" style="margin-right:6px;" /></a></li>
                        <?php } ?>
		</ul>

	</div>
	<div class="clear">&nbsp;</div>
	<div class="grid_3">
		<?php if($_SESSION['admin'] == "Yes") { ?>
		<h4><img src="images/icons/admin.png" alt="Admin User" title="Admin User" height="30" style="vertical-align:middle;" /> <?php echo $_SESSION['name'];?> | <a href="logout.php"><span class="red">Salir</span></a> </h4>
		<?php } else { ?>
		<h4><img src="images/icons/standard.png" alt="Standard User" title="Standard User" height="30" style="vertical-align:middle;" /> <?php echo $_SESSION['name'];?> | <a href="logout.php"><span class="red">Salir</span></a></h4>
		<?php } ?>
	</div>
	<div class="grid_2">	
		<div id="available"><?php echo $avail_string;?></div>
	</div>
	<div class="grid_2">
	<h4><a href="#" onClick="toggleMute();"><img id="muter" src="images/icons/sound.png" alt="Mute / Un Mute audio alerts" title="Mute / Un Mute audio alerts" height="30" style="vertical-align:middle;" /> Alertas Audio</a></h4>

	</div>
	<div class="clear">&nbsp;</div>


	<div class="grid_12"><div class="heading_light">&nbsp;</div></div>
	<div class="clear">&nbsp;</div>

	<div class="grid_3">
		<div class="heading_solid">
		<h3><img src="images/icons/identity.png" width="32" /> Actuales Chat</h3>
		</div>
		<div id="currentConvos"></div>
	</div>

	<script type="text/javascript">
		currentConvos();
		setInterval("currentConvos();",convoRefresh);
	</script>

	<div class="grid_9">
		<!--- Chat container -->
		<div class="chatContainer">
			<div class="heading_solid">
			<h3><img src="images/icons/userm.png" width="32" /> Actuales Conversaciones</h3>
			</div>
			<!--- user info output -->
			<div id="user_info">
			<script type="text/javascript">getInfo('open');</script>
			</div>
			<!--- chat output -->
			<div id="chatOutput"></div>
				<!--- Input form -->
				<form name="messageInput" id="MessageInput" action="javascript:sendInput(activeConvo);">
				<input type="hidden" name="userID" id="userID" value="<?php echo $_SESSION['userID'];?>" />
				<input type="hidden" name="userName" id="userName" value="<?php echo $_SESSION['name'];?>" />
				<input type="text" name="messageID" id="messageID" size="81" class="input_field" >
				<input type="submit" value="Enviar" class="input_field submit"/>&nbsp;&nbsp;
			
				<select name="standard" id="standard" class="input_field" onChange="javascript:standardResponse();"><option value="0">Seleccione Respuesta</option>
				<?php
					for($i = 0; $i < count($responses); $i ++) {
						echo '<option value="'.$responses[$i]['title'].'">';
						echo $responses[$i]['title'];
						echo '</option>';
					}	
				?>
				&nbsp;&nbsp;
				</select>
				<select name="files" id="files" class="input_field"><option value="0">Selecione Archivo</option>
				<?php
                                        for($i = 0; $i < count($files); $i ++) {
                                                echo '<option value="'.$files[$i]['name'].'">';
                                                echo $files[$i]['name'];
                                                echo '</option>';
                                        }
                                ?>
				</select>
				<button name="sendFile" value="send" onClick="javascript:sharedFiles();">Enviar Archivo</button>				
				</form>
		</div>
	</div>
</div>
<div class="clear">&nbsp;</div>
</div>
<div class="clear">&nbsp;</div>
<span id="audio_alert"></span>
</body>
</html>
