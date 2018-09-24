<?php

function online2() {
// globals
global $available,$config,$path;
// build box
echo '<div id="status_box" style="width:150px;">';
echo '<h3><img src="'.$path.'images/icons/ls.png" width="50" alt="'.$config['title'].'" title="'.$config['title'].'" style="vertical-align:middle;" /> '.$config['title'].'</h3>';
	if($available == "true") { ?>
		<div class="ls_available"><a href="#" onclick="javascript:launchSupport('<?php echo $path;?>chat.php', '200', '200', '510', '440')">Online, Click here to begin</a></div> 
	<?php } else { ?>
		<div class="ls_unavailable"><a href="#" onclick="javascript:launchSupport('<?php echo $path;?>leavemessage.php', '200', '200', '510', '440')">Currently Unavailable</a></div> 
		<?php
		echo '<p>'.$config['offlineMessage'].'</p>';
	}
echo '</div>';
}
// define page functions
function online() {
// globals
global $available,$config,$path;
// build box
echo '<div id="status_box" style="width:250px;">';
echo '<h3><img src="'.$path.'images/icons/ls.png" width="50" alt="'.$config['title'].'" title="'.$config['title'].'" style="vertical-align:middle;" /> '.$config['title'].'</h3>';
	if($available == "true") { ?>
		<div class="ls_available"><a href="#" onclick="javascript:launchSupport('<?php echo $path;?>chat.php', '200', '200', '510', '440')">Online, Click here to begin</a></div> 
	<?php } else { ?>
		<div class="ls_unavailable"><a href="#" onclick="javascript:launchSupport('<?php echo $path;?>leavemessage.php', '200', '200', '510', '440')">Currently Unavailable</a></div> 
		<?php
		echo '<p>'.$config['offlineMessage'].'</p>';
	}
echo '</div>';
}
// db connection
include "base.php";
// first check to make sure that there is no timed out logins
$agentTimeout = 180;
$check = mysql_query("SELECT * FROM users ");
while ($row=mysql_fetch_array($check)) {
	if(time() > ($row['keepAlive'] + $agentTimeout ) ) {
		mysql_query("UPDATE users SET available = 'no' WHERE username = '".$row['username']."' "); 
	}
}
// check availablility
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
?>
