<?php
include "base.php";
include "date.php";
if(!empty($_GET['file'])) {
	$get = mysql_query("SELECT * FROM files WHERE name = '".$_GET['file']."' ");
	$result = mysql_fetch_array($get);
	$timeStamp = date('g:i a');
	$message = '<a href="'.$result['path'].'" target="blank">'.$result['name'].'</a>';
        mysql_query("INSERT INTO transcript
        (name,message,user,convoID,time,class)
        VALUES
        ('".$_GET['name']."','".$message."','admin','".$_GET['id']."','".$timeStamp."','download')
        ");

}
?>
