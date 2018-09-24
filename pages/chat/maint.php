<?php 
// create session so we can keep track of users
session_start();
// check login
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
// update keepalive
mysql_query("UPDATE users SET keepAlive = '".time()."' WHERE username = '".$_SESSION['username']."' ");
// chekc if admin or not
if($_SESSION['admin'] == "No") {$output = '<div class="error">You need administrator rights to view this page.</div>'; }
$output = "";
// update config if form submitted
if(isset($_POST['change_config'])) {
	$output = "";
	if(is_numeric($_POST['clientRefresh'])) { $errors = $errors; } else { $errors = 1; $output = $output . "Client refresh value must be a number!<br />"; }
	if(is_numeric($_POST['adminRefresh'])) { $errors = $errors; } else { $errors = 1; $output = $output . "Admin refresh value must be a number!<br />"; }
	if(is_numeric($_POST['convoRefresh'])) { $errors = $errors; } else { $errors = 1; $output = $output . "Conversation list refresh value must be a number!<br />"; }
	if(is_numeric($_POST['warnConvo'])) { $errors = $errors; } else { $errors = 1; $output = $output . "Inactive timeout must be a number!<br />"; }
	if(is_numeric($_POST['endConvo'])) { $errors = $errors; } else { $errors = 1; $output = $output . "End conversation timeout must be a number!<br />"; }
	if($errors == 1) { $output = '<div class="error">' . $output . '</div>'; }
	if($errors == 0) {
	if(isset($_POST['flushTranscript'])) {
		$flush = mysql_query("TRUNCATE transcript ");
		if($flush) {
			$output = '<div class="success">All actions completed with no problems</div>';
	        } else {
                $output = '<div class="error">' . mysql_error() . '</div>';
		}
	 }	
	if(isset($_POST['flushSessions'])) {
                $flush = mysql_query("TRUNCATE sessions ");
                if($flush) {
                        $output = '<div class="success">All actions completed with no problems</div>';
                } else {
                $output = '<div class="error">' . mysql_error() . '</div>';
                }
         }
	if(isset($_POST['flushLeads'])) {
                $flush = mysql_query("TRUNCATE leads ");
                if($flush) {
                        $output = '<div class="success">All actions completed with no problems</div>';
                } else {
                $output = '<div class="error">' . mysql_error() . '</div>';
                }
         }
	if(isset($_POST['flushArchive'])) {
                $flush = mysql_query("TRUNCATE archive ");
                if($flush) {
                        $output = '<div class="success">All actions completed with no problems</div>';
                } else {
                $output = '<div class="error">' . mysql_error() . '</div>';
                }
         }

	

	$query = mysql_query("UPDATE config SET
			email = '".$_POST['email']."',
			clientRefresh = '".$_POST['clientRefresh']."',
			adminRefresh = '".$_POST['adminRefresh']."',
			convoRefresh = '".$_POST['convoRefresh']."',
			inactive = '".$_POST['warnConvo']."',
			end = '".$_POST['endConvo']."'
		
		WHERE id = '".$_POST['id']."' ");
	if($query) {
		$output = '<div class="success">All actions completed with no problems</div>';
	} else {
		$output = '<div class="error">' . mysql_error() . '</div>';
		}
	}

}
if(isset($_POST['change_message'])) {
$query = mysql_query("UPDATE config SET
	title = '".$_POST['title']."',
	offlineMessage = '".$_POST['offlineMessage']."',
	loginMessage = '".$_POST['loginMessage']."',
	welcome = '".$_POST['welcome']."',
	leaveAMessage = '".$_POST['leaveAMessage']."',
	thankYouMessage = '".$_POST['thankYouMessage']."'
	WHERE id = '".$_POST['id']."' ");
	if($query) {
                $output = '<div class="success">All actions completed with no problems</div>';
        } else {
                $output = '<div class="error">' . mysql_error() . '</div>';
                }
}
// grab current config
$query = mysql_query("SELECT * FROM config ORDER BY id ASC LIMIT 1");
$config = mysql_fetch_array($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Mantencion</title>
<link rel="stylesheet" type="text/css" media="all" href="css/global.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="js/subs.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                Cufon.replace('h4,h3,h2,h1,label,a');
                setTimer('<?php echo $_SESSION['username'];?>');
                setChecker();
                setInterval("setChecker();",10000);
                setInterval("setTimer('<?php echo $_SESSION['username'];?>');",120000);
});
</script>
</head>
<body>
<div id='popup'><div><h3>You have a new message!</h3><p>Head over to the dashboard to respond.</p></div></div>

<div id="main_container">
<div class="container_12">
   <div class="grid_8">
        <h1 class="ls"><img src="images/chat.png" alt="Live Support" title="Live Support" />&nbsp;&nbsp;Configuracion</h1>
        </div>
        <div class="grid_4">
                <ul class="navigation">
                        <li><a href="admin.php"><img src="images/navhome.png" alt="Dashboard" title="Dashboard" width="39" style="margin-right:6px;"/></a></li>
                        <li><a href="leads.php"><img src="images/navleads.png" alt="Leads" title="Leads" width="39" style="margin-right:6px;"/></a></li>
                        <li><a href="users.php"><img src="images/navusers.png" alt="User Admin" title="User Admin" width="39" style="margin-right:6px;"/></a></li>
			<li><a href="files.php"><img src="images/files.png" alt="Shared Files"title="Shared Files" width="39" style="margin-right:6px;"/></a></li>
			<li><a href="standard_response.php"><img src="images/canned.png" alt="Standard Responses"title="Standard Responses" width="39" style="margin-right:6px;"/></a></li>
                        <li><a href="maint.php"><img src="images/navmaint.png" alt="Maintenance" title="Maintenance" width="39" style="margin-right:6px;" /></a></li>
                </ul>

        </div>
        <div class="clear">&nbsp;</div>
        <div class="grid_12"><div class="heading_light">&nbsp;</div></div>
        <div class="clear">&nbsp;</div>
	<div class="grid_12"><?php echo $output;?></div>
	<?php if($_SESSION['admin'] == "Yes") { ?>
	<div class="grid_6">
                <div class="heading_solid">
                        <h3>Configuration</h3>
	        </div>
	<form method="post" action="maint.php">

	<p><strong>Contact Email Address :</strong> When no support reps are online, a contact form is available, please enter the address you would like responses sent to.</p>
	<input type="text" name="email" id="email" size="50" class="input_field" value="<?php echo $config['email'];?>">

	<p><strong>Chat refresh rates :</strong> The variables below, dictate how often the client chat window, admin chat window, and conversation list refresh.  Use lower values for faster servers, higher values for slower servers. 1000 = 1 second.</p>

	<input type="hidden" id="id" name="id" value="<?php echo $config['id'];?>">
	<label for="clientRefresh">Client refresh rate</label><br />
	<input type="text" name="clientRefresh" id="clientRefresh" size="30" class="input_field" value="<?php echo $config['clientRefresh'];?>"><br />
	<label for="adminRefresh">Admin refresh rate</label><br />
	<input type="text" name="adminRefresh" id="adminRefresh" size="30" class="input_field" value="<?php echo $config['adminRefresh'];?>"><br />
	<label for="convoRefresh">Conversation list refresh rate</label><br />
	<input type="text" name="convoRefresh" id="convoRefresh" size="30" class="input_field" value="<?php echo $config['convoRefresh'];?>"><br />

	<p><strong>Timeouts :</strong> These variables dicate how much time elapses between a conversation timing out, and being automatically ended due to no activity. This is measured in seconds.</p>

	<label for="warnConvo">Display inactive message after :</label><br />
        <input type="text" name="warnConvo" id="warnConvo" size="30" class="input_field" value="<?php echo $config['inactive'];?>"><br />
        <label for="endConvo">End conversation after : ( this is once timeout is active )</label><br />
        <input type="text" name="endConvo" id="endConvo" size="30" class="input_field" value="<?php echo $config['end'];?>"><br />

	<p><strong>Flush tables :</strong> These options will empty the relevant tables of any stored data</p>
	<input type="checkbox" name="flushTranscript" id="flushTranscript"><label for="flushTranscript"> - Empty Conversations table</label><br />
	<input type="checkbox" name="flushSessions" id="flushSessions"><label for="flushTranscript"> - Empty sessions table</label><br />
	<input type="checkbox" name="flushLeads" id="flushLeads"><label for="flushTranscript"> - Empty leads table</label><br />
	<input type="checkbox" name="flushArchive" id="flushArchive"><label for="flushTranscript"> - Empty archive table</label><br />
	<br />
	<input type="submit" class="input_field submit" name="change_config" id="change_config" value="Guardar Configuracion">
	</form>
	</div>

	<div class="grid_6">
                <div class="heading_solid">
                        <h3>Messaging</h3>
		</div>
	<form method="post" action="maint.php">
	<input type="hidden" id="id" name="id" value="<?php echo $config['id'];?>">
	<strong>Title of your support system, ie Live Support</strong><br />
        <input type="text" name="title" id="title" size="60" class="input_field" value="<?php echo $config['title'];?>"><br />
	<strong>Support offline message</strong><br />
        <textarea name="offlineMessage" id="offlineMessage" cols="60" rows="5" class="input_field"><?php echo $config['offlineMessage'];?></textarea><br />
	<strong>Login screen message</strong><br />
        <textarea name="loginMessage" id="loginMessage" cols="60" rows="5" class="input_field"><?php echo $config['loginMessage'];?></textarea><br />
	<strong>Opening chat message</strong><br />
        <textarea name="welcome" id="welcome" cols="60" rows="3" class="input_field"><?php echo $config['welcome'];?></textarea><br />
	<strong>Chat offline message</strong><br />
        <textarea name="leaveAMessage" id="leaveAMessage" cols="60" rows="3" class="input_field"><?php echo $config['leaveAMessage'];?></textarea><br />
	<strong>Email sent message</strong><br />
        <textarea name="thankYouMessage" id="thankYouMessage" cols="60" rows="3" class="input_field"><?php echo $config['thankYouMessage'];?></textarea><br />

	<input type="submit" class="input_field submit" name="change_message" id="change_message" value="Guardar Cambios">	
	</form>
	</div>

	<?php } ?>
</div>
<div class="clear">&nbsp;</div>
</div>
<div class="clear">&nbsp;</div>


<span id="audio_alert"></span>
</body>
</html>
