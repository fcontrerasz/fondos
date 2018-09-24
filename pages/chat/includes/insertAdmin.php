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

	$timeStamp = date('g:i a');	
	$query = mysql_query("SELECT * FROM sessions WHERE id = '".$_GET['convoID']."' ");
	$result = mysql_fetch_array($query);
	if(($result['status'] == "closed") && ($result['hide'] == "no")) {
		mysql_query("UPDATE sessions SET status = 'open', updated = '".$row['updated']."' WHERE id = '".$_GET['convoID']."' ");
	}
	if($message != "") {
	if($result['hide'] == "no") {
	mysql_query("INSERT INTO transcript 
	(name,message,user,convoID,time,class) 
	VALUES 
	('".$_GET['name']."','".$message."','".$_GET['userID']."','".$_GET['convoID']."','".$timeStamp."','admin') 
	");
	$answered = time();
	mysql_query("UPDATE sessions SET
	answered = '".$answered."'
	WHERE convoID = '".$_GET['convoID']."'
	");
	}
	} else if($result['hide'] == "yes") {
	$message = "This session has expired";
	mysql_query("INSERT INTO transcript
        (name,message,convoID,class)
        VALUES
        ('System','".$message."','".$_GET['convoID']."','notice')
        ");
	}
}


?>
