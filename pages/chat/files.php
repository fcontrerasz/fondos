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
// upload
	$output = "";
if(isset($_POST['upload'])) {
	$target_path = "files/";
	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
		$query = "INSERT INTO files (path,name,description) VALUES ('".$target_path."','".$_POST['name']."','".$_POST['description']."')";
		$runQuery = mysql_query($query);
		if($runQuery) {
 	   	$output = '<div class="success">'.  basename( $_FILES['uploadedfile']['name']).' has been uploaded!</div>';
		}
	} else{
		$output = '<div class="error">Problem uploading file!</div>';
}
}
// delete
if(isset($_POST['delete'])) {
	$get = mysql_query("SELECT * FROM files WHERE id = '".$_POST['id']."' ");
	$delete = mysql_fetch_array($get);
	$remove = unlink($delete['path']);
	if($remove) {
		$query = mysql_query("DELETE FROM files WHERE id = '".$_POST['id']."' ");
			$output = '<div class="success">'. $delete['name'] .' has been removed!</div>';	
	} else {
		$output = '<div class="error">Problem removing file!</div>';
	}
}
// update
if(isset($_POST['edit'])) {

		$query = mysql_query("UPDATE files SET name = '".$_POST['title']."', description = '".$_POST['message']."' WHERE id = '".$_POST['id']."' ");
			$output = '<div class="success">File updated!</div>';	

}
// get current files
$files = array();
$counter = 0;
$get = mysql_query("SELECT * FROM files");
while($row = mysql_fetch_array($get)) {
	$files[$counter]['id'] = $row['id'];
	$files[$counter]['name'] = $row['name'];
	$files[$counter]['description'] = $row['description'];
	$files[$counter]['img']= substr($row['path'], strrpos($row['path'], '.') + 1);
	$counter = $counter + 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Shared files</title>
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
<div id='popup'><div><h3>You have a new message!</h3><p>Head over to the dashboard to respond.</p></div></div>
<div id="main_container">
<div class="container_12">
	<div class="grid_8">
	<h1 class="ls"><img src="images/chat.png" alt="Live Support" title="Live Support" />&nbsp;&nbsp;Archivos Compartidos</h1>
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
	<div class="grid_8">
		<div class="heading_solid">
			<h3>Actuales Archivos Compartidos</h3>
		</div>
	<p>You can add more icons for file extensions, simply upload an image to "images/mimetypes" in the following format: filextension.png, so pdf.png for example.</p>
	<table style="width:100%;">
        <tr><th style="padding-right:10px;">Name</th><th style="padding-right:10px;">Description</th><th style="padding-right:10px;">Edit</th><th style="padding-right:10px;">Delete</th></tr>
        <?php
        $limit = count($files);
        for($i = 0; $i < $limit; $i ++ ){
                echo '<tr><td style="padding-right:10px;">';
		$imgPath = 'images/mimetypes/' . $files[$i]['img'] . '.png';
		if(file_exists($imgPath)) {
		echo '<img src="images/mimetypes/'.$files[$i]['img'].'.png" width="26" />&nbsp;&nbsp;';
		} else {
		echo '<img src="images/mimetypes/default.png" width="26" />&nbsp;&nbsp;'; 
		}
                echo $files[$i]['name'];
                echo '</td><td style="padding-right:10px;">';
		echo $files[$i]['description'];
		echo '</td><td style="padding-right:10px;">';
                echo '<a href="includes/alterFile.php?edit='.$files[$i]["id"].'" class="edit_user"><img src="images/icons/edit.png" width="20" /></a>';
                echo '</td><td style="padding-right:10px;">';
                echo '<a href="includes/alterFile.php?delete='.$files[$i]["id"].'" class="delete_user"><img src="images/icons/crossb.png" width="20" /></a>';
                echo '</td></tr>';
        }
        ?>
        </table>

	</div>
	<div class="grid_4">
                <div class="heading_solid">
			<h3>Subir un Archivo</h3>
                </div>
	<form enctype="multipart/form-data" action="files.php" method="POST">
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
	<label for="uploadedfile">Archivo a Subir:</label><br />
	<input name="uploadedfile" type="file" class="input_field submit"/><br />
	<label for="name">Nombre del Archivo</label><br />
	<input type="text" name="name" class="input_field" size="45"><br />
	<label for="description">Descripcion</label><br />
	<textarea name="description" class="input_field" cols="45" rows="7"></textarea><br />
	<input type="submit" name="upload" value="Subir" class="input_field submit"/>
	</form>
        </div>




</div>
<div class="clear">&nbsp;</div>
</div>
<div class="clear">&nbsp;</div>
<span id="audio_alert"></span>
</body>
</html>
