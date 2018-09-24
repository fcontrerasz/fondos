<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<?php
include "includes/base.php";
$path = "../support/";
$agentTimeout = 180;
$check = mysql_query("SELECT * FROM users") or die("Error en MySQL dice: ".mysql_error());  

while ($row=mysql_fetch_array($check)) {
	if(time() > ($row['keepAlive'] + $agentTimeout ) ) {
		mysql_query("UPDATE users SET available = 'no' WHERE username = '".$row['username']."' "); 
	}
}

$available = "false";
$check = mysql_query("SELECT available FROM users ");
while ($row=mysql_fetch_array($check)) {
	if($row['available'] == "yes") {
		$available = "true";
	}
}
// get config
$fetch = mysql_query("SELECT * FROM config ");
$config = mysql_fetch_array($fetch);

//var_dump($available);


	if($available == "true") {
	
    	include "codelco_chat.php";
	
		 } else { 
	
    	include "codelco_offline.php";
	
		
	}



?>