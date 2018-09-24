<?php
include "base.php";
include "date.php";
if(!empty($_GET)) {
	// emoticons
        $message = $_GET['message'];
        $path = '&nbsp;<img src="images/smilies/';
        $endPath = '" width="16"/>';
        // normal smile
        $message = str_replace(":)", $path . "smile.png" . $endPath, $message);
        // big smile
        $message = str_replace(":D", $path . "bigsmile.png" . $endPath, $message);
        $message = str_replace(":d", $path . "bigsmile.png" . $endPath, $message);
        // tongue out
        $message = str_replace(":P", $path . "tongue.png" . $endPath, $message);
        $message = str_replace(":p", $path . "tongue.png" . $endPath, $message);
        // suprised
        $message = str_replace(":O", $path . "suprised.png" . $endPath, $message);
        $message = str_replace(":o", $path . "suprised.png" . $endPath, $message);
        // sad
        $message = str_replace(":(", $path . "sad.png" . $endPath, $message);
        // wink
        $message = str_replace(";)", $path . "wink.png" . $endPath, $message);
        // confused
        $message = str_replace(":S", $path . "confused.png" . $endPath, $message);
        $message = str_replace(":s", $path . "confused.png" . $endPath, $message);
	// idea
	$message = str_replace(":bulb", $path . "bulb.png" . $endPath, $message);
	// user
	$message = str_replace(":user", $path . "user.png" . $endPath, $message);
	//star
	$message = str_replace(":top", $path . "star.png" . $endPath, $message);
	// cool
	$message = str_replace(":8", $path . "cool.png" . $endPath, $message);

	// make sure convo is active
	$active = mysql_query("SELECT * FROM sessions WHERE userID = '".$_GET['userID']."' ");
	$check = mysql_fetch_array($active);
	$timeStamp = date('g:i a');
	$updated = time();
	if($message != "") {
	if($check['status'] == "open") {
	mysql_query("INSERT INTO transcript 
	(name,message,user,convoID,time,class) 
	VALUES 
	('".$_GET['name']."','".$message."','".$_GET['userID']."','".$_GET['convoID']."','".$timeStamp."','user') 
	");
	mysql_query("UPDATE sessions SET
	updated = '".$updated."'
	WHERE userID = '".$_GET['userID']."'
	");
	}
	} else {
	mysql_query("INSERT INTO transcript
        (name,message,user,convoID,time,class)
        VALUES
        ('".$_GET['name']."','This session has expired.','".$_GET['userID']."','".$_GET['convoID']."','".$timeStamp."','notice')
        ");
        mysql_query("UPDATE sessions SET
        updated = '".$updated."'
        WHERE userID = '".$_GET['userID']."'
        ");

	}
}


?>
