<?php
include "includes/base.php";
// start session
session_start();
// buffer flush
ob_start();
include "includes/date.php";
// divert to chat window if session is active
if(isset($_SESSION['userID'])) {
	header('location:chat.php');
}
// check to make sure someone is actually available
$check = mysql_query("SELECT available FROM users ");
$available = "no";
while ($row = mysql_fetch_array($check)) {
	if($row['available'] == "yes") { $available = "yes"; }
}
if($available == "no" ) {
	header('Location: leavemessage.php');
	die();
}
// start chat sessions
if(isset($_POST['start'])) {
if(!empty($_POST['name'])) {
// grab config
$fetch = mysql_query("SELECT * FROM config ");
$config = mysql_fetch_array($fetch);
// assign variables
// generate unique user id
$ip = $_SERVER['REMOTE_ADDR'];
$salt = rand(100,999);
$userID = $_POST['name'] . $ip . $salt;
$_SESSION['name'] = $_POST['name'];
$_SESSION['userID'] = $userID;
if(!empty($_POST['email'])) {
	$_SESSION['email'] = $_POST['email'];
} else {
	$_SESSION['email'] = "Not Set";
}
	if(isset($_POST['contactme'])) {
		$contactme = "yes";
	} else {
		$contactme = "no";
	}
// sessions started on ...
$start = time();
// add entry to sql
$query = mysql_query("INSERT INTO sessions (userID,name,email,initiated,status,contact) 
			VALUES 
			('".$_SESSION['userID']."','".$_SESSION['name']."','".$_SESSION['email']."','".$start."','open','".$contactme."') 
			");
if($query) {
	$timeStamp = date('g:i a');
	$update = mysql_query("SELECT id FROM sessions WHERE userID = '".$_SESSION['userID']."' ");
	$result = mysql_fetch_array($update);
	$_SESSION['convoID'] = $result['id'];
	mysql_query("UPDATE sessions SET convoID = '".$_SESSION['convoID']."' WHERE userID = '".$_SESSION['userID']."' ");
	mysql_query("INSERT INTO transcript
        (name,message,convoID,time,class)
        VALUES
        ('Admin','".$config['welcome']."','".$_SESSION['convoID']."','".$timeStamp."','admin')
        ");

	header('location:chat.php');
}
} else {
$output = '<div class="error"><p>Please enter your name</p></div>';
}
}
include "includes/base.php";
// fetch config
$fetch = mysql_query("SELECT * FROM config ");
$config = mysql_fetch_array($fetch);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Live Assist!</title>
<link rel="stylesheet" type="text/css" media="all" href="css/client.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                Cufon.replace('h4,h3,h2,h1,label,a');
});	
</script>
</head>
<body>
<div class="container">
	<h3><img src="images/icons/ls.png" alt="<?php echo $config['title'];?>" title="<?php echo $config['title'];?>" width="54" style="vertical-align:middle;"/>&nbsp;<?php echo $config['title'];?></h3>
				<p><?php echo $output;?></p>
				<p><?php echo $config['loginMessage'];?></p>

	<div class="centered_container pale_blue" style="width:300px; margin-top:20px;">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
		<label for="name">Your Name <span class="red">*</span></label><br>
			<input type="text" name="name" id="name" class="input_field thin" /><br>
		<label for="email">Your Email Address</label><br>
			<input type="text" name="email" id="email" class="input_field thin"><br>
		<label for="contactme">I would like to be contacted in the future</label>
			<input type="checkbox" name="contactme" id="contactme"><br>
				<input type="submit" name="start" id="start" class="input_field submit" value="Start Support Session!" />
	</form>
	<p><i><span class="red">*</span> = required field</i></p>
	</div>
</div><!--- END CONTAINER -->
</body>
</html>
<?php ob_flush(); ?>

