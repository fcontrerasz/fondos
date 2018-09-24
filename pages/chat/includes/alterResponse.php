<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Manage Users</title>
<link rel="stylesheet" type="text/css" media="all" href="../chat/css/global.css" />
</head>
<body>
<div id="padded_box">
<?php
include "base.php";
if(isset($_GET['edit'])) {
$edit = mysql_query("SELECT * FROM responses WHERE id = '".$_GET['edit']."' ");
$result = mysql_fetch_array($edit);
	?> 	
	<form method="post" action="standard_response.php">
			<input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
			<label for="title">Titulo</label><br />
		        <input type="text" name="title" class="input_field" size="70" value="<?php echo $result['title'];?>"><br />
                        <label for="message">Respuesta</label><br />
                        <textarea name="message" class="input_field" cols="70" rows="15"><?php echo $result['message'];?></textarea><br />
                        <input type="submit" name="edit" value="Editar" class="input_field submit">

	</form>
	<?php
	
} else if(isset($_GET['delete'])) {
	echo '<form method="post" action="standard_response.php">';
        echo '<p>Are you sure you want to delete this response?</p>';
        echo '
        <input type="hidden" name="response" id="response" value="'.$_GET['delete'].'" />
        <button type="submit" name="cancel" value="cancel">Cancel</button>
        <button class="del" type="submit" name="delete" value="delete">Delete</button>
        </form>
        ';
}
?>
</div>
</body>
</html>

