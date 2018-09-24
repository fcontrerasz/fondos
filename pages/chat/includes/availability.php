<?php
if(!empty($_GET['user'])) {
include "base.php";
$current = mysql_query("SELECT available FROM users WHERE username = '".$_GET['user']."' ");
$result = mysql_fetch_array($current);
if($result['available'] == "no") {
$updated = "yes";
$string = '<h4><a href="#" onClick="available(false);"><img src="images/icons/available.png" title="Click to change availability" height="30" style="vertical-align:middle;"/>&nbsp;&nbsp;Disponible</a></h4>';
}
else {
$updated = "no";
$string = '<h4><a href="#" onClick="available(false);"><img src="images/icons/unavailable.png" title="Click to change availability" height="30" style="vertical-align:middle;"/>&nbsp;&nbsp;No Disponible</a></h4>';
}
$query = mysql_query("UPDATE users SET available = '".$updated."' WHERE username = '".$_GET['user']."' ");
if($query) {
echo $string;
}
}
?>
