<?php header('Content-Type: text/html; charset=UTF-8'); ?>
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

$output = "";
// update keepalive
mysql_query("UPDATE users SET keepAlive = '".time()."' WHERE username = '".$_SESSION['username']."' ");
// chekc if admin or not
if($_SESSION['admin'] == "No") {$output = '<div class="error">Necesitas permisos de admnistrador para continuar. <a href="includes/alterStandard.php?user='.$_SESSION['username'].'" class="edit_user" >ver</a></div>'; }
// check for form input
if(isset($_POST['delete'])) {

	// make sure there is at least 1 admin left
	$check = mysql_query("SELECT * FROM users WHERE username = '".$_POST['user']."' ");
	$result = mysql_fetch_array($check);
	if($result['admin'] == "No") {
		mysql_query("DELETE FROM users WHERE username = '".$_POST['user']."' ");
		$output = '<div class="success">Usuario Eliminado</div>';
	}
	if($result['admin'] == "Yes") {
	$check = mysql_query("SELECT * FROM users WHERE admin = 'Yes' ");
	if(mysql_num_rows($check) > 1) {
		mysql_query("DELETE FROM users WHERE username = '".$_POST['user']."' ");
		$output = '<div class="success">Usuario Eliminado</div>';
	} else {
	$output = '<div class="error">Se necesita al menos 1 administrador.</div>';
	}
	}
}
if(isset($_POST['update_user'])) {
	$errors = 0;
        if(empty($_POST['name'])) { $errors = 1; $output = $output . "Ingresa un nombre<br />"; }
        if(empty($_POST['email'])) { $errors = 1; $output = $output . "Ingresa un email<br />"; }
        if(empty($_POST['username'])) { $errors = 1; $output = $output . "Ingresa un login<br />"; }
	
	 if($errors == 0) {
		echo $_POST['user'];
           	if($_POST['password'] != "" ) {
		$hash = sha1($_POST['password']);
		$add = mysql_query("UPDATE users SET name = '".$_POST['name']."', password = '".$hash."', email = '".$_POST['email']."', admin = '".$_POST['admin']."' WHERE username = '".$_POST['username']."' ");
                } else {
		$add = mysql_query("UPDATE users SET name = '".$_POST['name']."', email = '".$_POST['email']."', admin = '".$_POST['admin']."' WHERE username = '".$_POST['username']."' ");
		}
		if($add) {
                        $output = '<div class="success">Usuario Actualizado</div>';
                        } else {
                        $output = '<div class="error">Error :' . mysql_error() . '</div>';
                }


        } else {
                $output = '<div class="error">' . $output . '</div>';
        }
}
if(!empty($_POST['add'])) {
$output = "";
	$errors = 0;
	if(empty($_POST['name'])) { $errors = 1; $output = $output . "Ingresa un nombre<br />"; }
	if($_POST['admin'] == "Seleccione") { $errors = 1; $output = $output . "Ingresa una alternativa de Administador<br />"; }	
	if(empty($_POST['password'])) { $errors = 1; $output = $output . "Ingresa una clave<br />"; }
	if(empty($_POST['email'])) { $errors = 1; $output = $output . "Ingresa un email<br />"; }
	if(empty($_POST['username'])) { $errors = 1; $output = $output . "Ingresa un login<br />"; }

	if($errors == 0) {
		$hash = sha1($_POST['password']);
		$check = mysql_query("SELECT * FROM users WHERE username = '".$_POST['username']."' ");
		$total = mysql_num_rows($check);
		if($total != 0) { $errors = 1; $output = $output . "Login ya existe<br />"; }
		$check = mysql_query("SELECT * FROM users WHERE email = '".$_POST['email']."' ");
                $total = mysql_num_rows($check);
                if($total != 0) { $errors = 1; $output = $output . "Email ya existe<br />"; }

		
		if($errors == 0 ) {
		$add = mysql_query("INSERT INTO users (name,password,username,email,admin) VALUES ('".$_POST['name']."','".$hash."','".$_POST['username']."','".$_POST['email']."','".$_POST['admin']."') ");
		if($add) {
			$output = '<div class="success">Usuario Creado</div>';
			} else {
			$output = '<div class="error">Error :' . mysql_error() . '</div>';
		}
		} else {$output = '<div class="error">' . $output . '</div>';}
	} else {
		$output = '<div class="error">' . $output . '</div>';
	}		
}
$current_users = array();
$fetch = mysql_query("SELECT * FROM users ");
$inc = 0;
while ($row = mysql_fetch_array($fetch)) {
	$current_users[$inc]["name"] = $row['name'];
	$current_users[$inc]["username"] = $row['username'];
	$current_users[$inc]["admin"] = $row['admin'];
	$inc = $inc + 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Administrar Usuarios</title>
<link rel="stylesheet" type="text/css" media="all" href="css/global.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/colorbox.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/subs.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                Cufon.replace('h4,h3,h2,h1,label,a');
		setTimer('<?php echo $_SESSION['username'];?>');
                setChecker();
                setInterval("setChecker();",10000);
                setInterval("setTimer('<?php echo $_SESSION['username'];?>');",120000);
		$(".delete_user").colorbox({opacity:0.9});
		$(".edit_user").colorbox({opacity:0.9});
});
</script>
</head>
<body>
<div id='popup'><div><h3>!Tienes un nuevo Menaje!</h3><p>Ingresa a la Portada.</p></div></div>
<div id="main_container">
<div class="container_12">
	<div class="grid_8">
	<h1 class="ls">Aministracion de Usuarios</h1>
	</div>
	<div class="grid_4">
		<ul class="navigation">
			<li><a href="admin.php"><img src="images/navhome.png" alt="Dashboard" title="Dashboard" width="39" style="margin-right:6px;"/></a></li>
                          <li><a href="users.php"><img src="images/navusers.png" alt="Administracion de Usuarios" title="Usuarios" width="39" style="margin-right:6px;"/></a></li>          
            <?php if($_SESSION['username']=="fcontreras"){ ?>
                        <li><a href="leads.php"><img src="images/navleads.png" alt="Leads" title="Leads" width="39" style="margin-right:6px;"/></a></li>

			<li><a href="files.php"><img src="images/files.png" alt="Shared Files"title="Shared Files" width="39" style="margin-right:6px;"/></a></li>
			<li><a href="standard_response.php"><img src="images/canned.png" alt="Standard Responses"title="Standard Responses" width="39" style="margin-right:6px;"/></a></li>
                        <li><a href="maint.php"><img src="images/navmaint.png" alt="Maintenance" title="Maintenance" width="39" style="margin-right:6px;" /></a></li>
                        <?php } ?>
		</ul>


	</div>
	<div class="clear">&nbsp;</div>
	<div class="grid_12"><div class="heading_light">&nbsp;</div></div>
	<div class="clear">&nbsp;</div>
	<div class="grid_12"><?php echo $output;?></div>
	<div class="clear">&nbsp;</div>
	<?php if($_SESSION['admin'] == "Yes") { ?>
	<div class="grid_6">
		<div class="heading_solid">
			<h3>Actuales Usuarios</h3>
		</div>
	<table style="width:100%;">
	<tr><th>Nombre</th><th>¿Administrador?</th><th>Editar</th><th>Borrar</th></tr>
	<?php
	$limit = count($current_users);
	for($i = 0; $i < $limit; $i ++ ){
		echo '<tr><td>';
		echo '<img src="images/icons/userm.png" width="24" alt="'.$current_users[$i]["name"].'" title="'.$current_users[$i]["name"].'" />&nbsp;&nbsp;';
		echo $current_users[$i]["name"];	
		echo '</td><td>';
		echo $current_users[$i]["admin"]=="Yes"?"Si":"No";
		echo '</td><td>';
		echo '<a href="includes/alterUser.php?edit='.$current_users[$i]["username"].'" class="edit_user"><img src="images/icons/edit.png" width="20" alt="Edit '.$current_users[$i]["name"].'" title="Edit '.$current_users[$i]["name"].'" /></a>';
		echo '</td><td>';
		echo '<a href="includes/alterUser.php?delete='.$current_users[$i]["username"].'" class="delete_user"><img src="images/icons/crossb.png" width="20" alt="Delete '.$current_users[$i]["name"].'" title="Delete '.$current_users[$i]["name"].'" /></a>';
		echo '</td></tr>';	
	}
	?>
	</table>
	</div>

	<div class="grid_6">
		<div class="heading_solid">
			<h3>Crear Usuario</h3>
		</div>
 	<form method="post" action="users.php">
		<label for="name">Nombre</label><br />
		<input type="text" name="name" id="name" class="input_field" size="40"><br />
		<label for="admin">¿Administrador?</label><br />
		<select name="admin" id="admin" class="input_field tall"><option>Seleccione</option><option>Yes</option><option>No</option></select><br />
		<label for="password">Clave</label><br />
		<input type="password" name="password" id="password" class="input_field" size="40"><br />
		<label for="email">Correo</label><br />
		<input type="text" name="email" id="email" class="input_field" size="40"><br />
		<label for="username">Login</label><br />
		<input type="text" name="username" id="username" class="input_field" size="40"><br />
		<input type="submit" name="add" id="add" value="Crear" class="input_field submit"/>

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
