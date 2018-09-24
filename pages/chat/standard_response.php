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
	$output = "";
include "includes/base.php";
if(isset($_POST['add'])) {
	$errors = 0;

	if($_POST['title'] == "") { $errors = 1; $output .= "You must enter a title!<br />"; }
	if($_POST['message'] == "") { $errors = 1; $output .= "You must enter a response!<br />"; }
	if($errors == 0) {
		$query = mysql_query("INSERT INTO responses (title,message) VALUES ('".$_POST['title']."','".$_POST['message']."') ");
		if($query) {
			$output = '<div class="success">Response Added</div>';
		} else {
			$output .= '<div class="error">'.mysql_error().'</div>';
		}
	} else {
		$output .= '<div class="error">'.$output.'</div>';
	}

}
if(isset($_POST['delete'])) {

	mysql_query("DELETE FROM responses WHERE id = '".$_POST['response']."' ");


}
if(isset($_POST['edit'])) {

	mysql_query("UPDATE responses SET title	= '".$_POST['title']."', message = '".$_POST['message']."' WHERE id = '".$_POST['id']."' ");


}
// get current responses
$standard = array();
$counter = 0;
$get = mysql_query("SELECT * FROM responses");
while($row = mysql_fetch_array($get)) {
	$standard[$counter]['id'] = $row['id'];
	$standard[$counter]['title'] = $row['title'];
	$standard[$counter]['message'] = $row['message'];
	$counter = $counter + 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Standard Responses</title>
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
<div id='popup'><div><h3>Tines un nuevo Mensaje!</h3><p>Ingresa a la portada.</p></div></div>
<div id="main_container">
<div class="container_12">
	<div class="grid_8">
	<h1 class="ls"><img src="images/chat.png" alt="Live Support" title="Respuestas" />&nbsp;&nbsp;Respuestas Estadares</h1>
	</div>
	<div class="grid_4">
		<ul class="navigation">
			<li><a href="admin.php"><img src="images/navhome.png" alt="Dashboard" title="Dashboard" width="39" style="margin-right:6px;"/></a></li>
                        <li><a href="leads.php"><img src="images/navleads.png" alt="Leads" title="Leads" width="39" style="margin-right:6px;"/></a></li>
                        <li><a href="users.php"><img src="images/navusers.png" alt="User Admin" title="User Admin" width="39" style="margin-right:6px;"/></a></li>
                        <li><a href="files.php"><img src="images/files.png" alt="Files" title="Files" width="39" style="margin-right:6px;"/></a></li>
			<li><a href="standard_response.php"><img src="images/canned.png" alt="Standard Responses"title="Standard Responses" width="39" style="margin-right:6px;"/></a></li>
                        <li><a href="maint.php"><img src="images/navmaint.png" alt="Maintenance" title="Maintenance" width="39" style="margin-right:10px;" /></a></li>
		</ul>


	</div>
	<div class="clear">&nbsp;</div>
	<div class="grid_12"><div class="heading_light">&nbsp;</div></div>
	<div class="clear">&nbsp;</div>
	<div class="grid_12"><?php echo $output;?></div>
	<div class="clear">&nbsp;</div>
	<div class="grid_6">
		<div class="heading_solid">
			<h3>Actuales Respuestas Estandares</h3>
		</div>
	<table style="width:100%;">
        <tr><th>Title</th><th>Edit</th><th>Delete</th></tr>
        <?php
        $limit = count($standard);
        for($i = 0; $i < $limit; $i ++ ){
                echo '<tr><td>';
                echo $standard[$i]['title'];
                echo '</td><td>';
                echo '<a href="includes/alterResponse.php?edit='.$standard[$i]["id"].'" class="edit_user"><img src="images/icons/edit.png" width="20" /></a>';
                echo '</td><td>';
                echo '<a href="includes/alterResponse.php?delete='.$standard[$i]["id"].'" class="delete_user"><img src="images/icons/crossb.png" width="20" /></a>';
                echo '</td></tr>';
        }
        ?>
        </table>

	</div>
	<div class="grid_6">
                <div class="heading_solid">
			<h3>Crear una Respuesta</h3>
                </div>
		<form method="post" action="standard_response.php">
			<label for="title">Titulo</label><br />
			<input type="text" name="title" class="input_field" size="60"><br />
			<label for="message">Respuesta</label><br />
			<textarea name="message" class="input_field" cols="60" rows="15"></textarea><br />
			<input type="submit" name="add" value="Add standard response" class="input_field submit">
			<br /><br />
		</form>
        </div>




</div>
<div class="clear">&nbsp;</div>
</div>
<div class="clear">&nbsp;</div>
<span id="audio_alert"></span>
</body>
</html>
