<title>Chat codelco</title>
<?php
error_reporting(0);
ob_start();
session_start();

if(!isset($_SESSION['name'])){
	echo "<script type='text/javascript'>document.location.href='codelco_fin.php';</script>";
}


if(!empty($_GET['id'])) {
include "includes/base.php";

$timeStamp = date('g:i a');

$query = mysql_query("UPDATE sessions SET status = 'closed', ended = '".time()."' WHERE convoID = '".$_GET['id']."' ");
if($query) {
$sign_off = mysql_query("INSERT INTO transcript 
	(name,message,user,convoID,time,class)
	VALUES
	('".$_SESSION['name']."','a dejado la conversacion','".$_SESSION['userID']."','".$_GET['id']."','".$timeStamp."','notice')
	");

$info = mysql_query("SELECT * FROM sessions WHERE convoID = '".$_GET['id']."' ");
$result = mysql_fetch_array($info);
include "includes/date.php";

	if($result['contact'] == "yes") {
	include "includes/functions.php";
	archive($_GET['id'],$result['name'],$result['email']);
	}
$_SESSION['name'] = null;
$_SESSION['userID'] = null;
session_destroy();
session_unset();
}
}

ob_flush();
?>

<script type="text/javascript">
//javascript:window.close();
document.location.href='codelco_fin.php';
</script>


