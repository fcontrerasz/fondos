<?php
include "base.php";

if(!empty($_GET['title'])) {
	$get = mysql_query("SELECT * FROM responses WHERE title = '".$_GET['title']."' ");
	$result = mysql_fetch_array($get);
	echo utf8_decode($result['message']);
}
?>
