<?php
if(!empty($_GET['user'])) {
// mysql
include "base.php";
mysql_query("UPDATE users SET keepAlive = '".time()."' WHERE username = '".$_GET['user']."' ");
}
?>
