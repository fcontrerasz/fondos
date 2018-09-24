<?php
ob_start();
session_start();
if(!empty($_GET['id'])) {
include "includes/base.php";
$query = mysql_query("UPDATE sessions SET status = 'closed', ended = '".time()."' WHERE convoID = '".$_GET['id']."' ");
if($query) {
$sign_off = mysql_query("INSERT INTO transcript 
	(name,message,user,convoID,time,class)
	VALUES
	('".$_SESSION['name']."','has left the conversation','".$_SESSION['userID']."','".$_GET['id']."','".$timeStamp."','notice')
	");

$info = mysql_query("SELECT * FROM sessions WHERE convoID = '".$_GET['id']."' ");
$result = mysql_fetch_array($info);
include "includes/date.php";
$timeStamp = date('g:i a');
if($result['contact'] == "yes") {
include "includes/functions.php";
archive($_GET['id'],$result['name'],$result['email']);
}
session_destroy();
}
}
ob_flush();
?>

<script type="text/javascript">
//javascript:window.close();
document.location.href='finudd.php';
</script>


