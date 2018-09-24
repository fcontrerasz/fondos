<?php

include "includes/base.php";

$hash = sha1('123456');
$add = mysql_query("INSERT INTO users (name,password,username,email,admin) VALUES ('lagarx','".$hash."','lagarx','test@demo.cl','Yes') ");
echo $add;

?>