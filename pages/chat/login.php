<?php 
// create session so we can keep track of users
session_start();
ob_start();
$output="";
// check login
function isLoggedIn() {
        if($_SESSION['valid'])
                return true;
                return false;
        }
        if(isLoggedIn()) {
                header('Location: admin.php');
                die();
}

// mysql interaction
include "includes/base.php";

/* user logged in ok, start session */
function validateUser($username,$name,$admin){
        session_regenerate_id (); //this is a security measure
        $_SESSION['valid'] = 1;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['admin'] = $admin;
	
}

// check for form input
if(!empty($_POST['login'])) {
/* Login function to authenticate user */
$username = $_POST['username'];
$password = $_POST['password'];
$username = mysql_real_escape_string($username);
$query = "SELECT *
                FROM users
                WHERE username = '$username';";
$result = mysql_query($query);
if(mysql_num_rows($result) < 1) //no such user exists
{
        global $output;
        $output = '<div class="error"><p>Usuario desconocido.</p></div>';
}
$userData = mysql_fetch_array($result);
$hash = sha1($password);
if($hash != $userData['password']) //incorrect password
{
        global $output;
        $output = '<div class="error"><p>Clave incorrecta</p></div>';
}
if($hash == $userData['password']) {
validateUser($userData['username'],$userData['name'],$userData['admin']);
header('Location: admin.php');
}



}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Log In</title>
<link rel="stylesheet" type="text/css" media="all" href="css/global.css" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                Cufon.replace('h4,h3,h2,h1,label,a');
});
</script>
</head>
<body>
	<div id="login_box">
	<h3>Soporte Chat</h3>
	<?php echo $output;?>
	<form method="post" action="login.php">
                <label for="username">Usuario</label><br />
                <input type="text" name="username" id="username" class="input_field" size="40"><br />
		<label for="password">Clave</label><br />
                <input type="password" name="password" id="password" class="input_field" size="40"><br />
                <input type="submit" name="login" id="login" value="Ingresar" class="input_field submit"/>
	
	</form>
	<br />
	<!--<a href="forgotpassword.php"><span class="red">¿Olvidaste tu Clave?</span></a>-->
	</div>	

</body>
</html>
<?php ob_flush(); ?>
