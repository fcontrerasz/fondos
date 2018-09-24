<?php 
// catch things to be processed
/* MY SQL */
if(isset($_POST['mysql_install'])) {
	// remove base.php if one already exists
	if(file_exists("includes/base.php")) {
		unlink("includes/base.php");
	}
	// create base.php
	$baseFile = 'includes/base.php';
	$fh = fopen($baseFile, 'w') or die("can't open file");
	$stringData = "<?php\n";
	$stringData = $stringData . '$dbhost = "' . $_POST['host'] . '";' . "\n";
	$stringData = $stringData . '$dbuser = "' . $_POST['username'] . '";' . "\n";
	$stringData = $stringData . '$dbpass = "' . $_POST['password'] . '";' . "\n";
	$stringData = $stringData . '$dbname = "' . $_POST['name'] . '";' . "\n";
	$stringData = $stringData . '$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to database");' . "\n";
	$stringData = $stringData . 'mysql_set_charset("utf8",$conn);' . "\n";
	$stringData = $stringData . 'mysql_select_db($dbname);' . "\n";
	$stringData = $stringData . 'include "sanity.php";' ."\n?>";
	fwrite($fh, $stringData);
	fclose($fh);
	$dbhost = $_POST['host']; $dbuser = $_POST['username']; $dbpass = $_POST['password']; $dbname = $_POST['name']; 
	// connect to mysql
	mysql_connect($dbhost, $dbuser, $dbpass); /* or die("MySQL Error: " . mysql_error());*/
	// Create database
	if (mysql_query("CREATE DATABASE $dbname")) { echo ""; } else { echo mysql_error(); }
	// select DB
	mysql_select_db($dbname);	
	// create sessions table
	mysql_query("
	CREATE TABLE IF NOT EXISTS `sessions` (
	  `id` int(11) NOT NULL auto_increment,
	  `userID` varchar(200) NOT NULL,
	  `convoID` int(11) NOT NULL,
	  `name` varchar(100) NOT NULL,
	  `email` varchar(100) NOT NULL,
	  `initiated` int(11) NOT NULL,
	  `status` varchar(20) NOT NULL,
	  `ended` int(11) NOT NULL,
	  `updated` int(11) NOT NULL,
	  `answered` int(11) NOT NULL,
	  `contact` varchar(3) NOT NULL default 'no',
	  `hide` varchar(3) NOT NULL default 'no',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
	");
	// standard responses
	mysql_query("
	CREATE TABLE IF NOT EXISTS `responses` (
	  `id` int(11) NOT NULL auto_increment,
	  `title` varchar(200) NOT NULL,
	  `message` varchar(3000) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 
	");
	// files
	mysql_query("
	CREATE TABLE IF NOT EXISTS `files` (
	  `id` int(11) NOT NULL auto_increment,
	  `path` varchar(300) NOT NULL,
	  `name` varchar(200) NOT NULL,
	  `description` varchar(1000) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
	");	
	// create transcript table
	mysql_query("
	CREATE TABLE IF NOT EXISTS `transcript` (
	  `id` int(11) NOT NULL auto_increment,
	  `name` varchar(100) NOT NULL,
	  `message` varchar(2000) NOT NULL,
	  `user` varchar(100) NOT NULL,
	  `convoID` int(11) NOT NULL,
	  `time` varchar(100) NOT NULL,
	  `class` varchar(20) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
	");
	// create archive table
	mysql_query("
		CREATE TABLE IF NOT EXISTS `archive` (
	  `id` int(11) NOT NULL auto_increment,
	  `name` varchar(100) NOT NULL,
	  `message` varchar(2000) NOT NULL,
	  `user` varchar(100) NOT NULL,
	  `convoID` int(11) NOT NULL,
	  `time` varchar(100) NOT NULL,
	  `class` varchar(20) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
	");
	// create leads table
	mysql_query("
	CREATE TABLE IF NOT EXISTS `leads` (
	  `id` int(11) NOT NULL auto_increment,
	  `name` varchar(100) NOT NULL,
	  `email` varchar(100) NOT NULL,
	  `transcript` varchar(10000) NOT NULL,
	  `date` varchar(50) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
	");
	// create users table
	mysql_query("
	CREATE TABLE IF NOT EXISTS `users` (
	  `id` int(11) NOT NULL auto_increment,
	  `name` varchar(100) NOT NULL,
	  `password` varchar(200) NOT NULL,
	  `username` varchar(100) NOT NULL,
	  `email` varchar(100) NOT NULL,
	  `admin` varchar(3) NOT NULL,
	  `available` varchar(3) NOT NULL default 'no',
	  `keepAlive` int(11) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
        ");
	// create config table
	 mysql_query("
	CREATE TABLE IF NOT EXISTS `config` (
	  `id` int(11) NOT NULL,
	  `email` varchar(200) NOT NULL,
	  `clientRefresh` int(5) NOT NULL default '2000',
	  `adminRefresh` int(5) NOT NULL default '2000',
	  `convoRefresh` int(5) NOT NULL default '3500',
	  `inactive` int(5) NOT NULL default '3000',
	  `end` int(5) NOT NULL default '3000',
	  `remove` int(5) NOT NULL default '3000',
	  `title` varchar(200) NOT NULL,
	  `offlineMessage` varchar(1000) NOT NULL,
	  `loginMessage` varchar(1000) NOT NULL,
	  `welcome` varchar(500) NOT NULL,
	  `leaveAMessage` varchar(1000) NOT NULL,
	  `thankYouMessage` varchar(1000) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1
        ");
	// insert default config data
	 mysql_query("
	INSERT INTO `config` (`id`, `email`, `clientRefresh`, `adminRefresh`, `convoRefresh`, `inactive`, `end`, `remove`, `title`, `offlineMessage`, `loginMessage`, `welcome`, `leaveAMessage`, `thankYouMessage`) VALUES
	(0, 'unset', 5000, 3000, 5000, 600, 300, 3000, 'Live Support Chat!', 'None of our representatives are available right now, although you are welcome to leave a message!', 'Please type your name to begin. Entering your email address is optional, although if you would like to be contacted in the future, please add your email address and tick the checkbox before starting your session.', 'Welcome, A representative will be with you shortly', 'None of our representatives are currently available.  Please use the form below to send us an email.', 'Thank you for your message.  We will be in touch as soon as possible!')
        ");
} /* END MYSQL */
// add admin
if(isset($_POST['add_user'])) {
		include "includes/base.php";
		$hash = sha1($_POST['password']);
                $add = mysql_query("INSERT INTO users (name,password,username,email,admin) VALUES 
		('".$_POST['name']."','".$hash."','".$_POST['username']."','".$_POST['email']."','Yes') ");	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Live Support Installation</title>
<link rel="stylesheet" type="text/css" media="all" href="css/global.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/colorbox.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/font_400.font.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                Cufon.replace('h4,h3,h2,h1,label,a,th');
		$(".read_convo").colorbox({opacity:0.9});
		$('#loading').hide();
		<? if(isset($_POST['mysql_install'])) { ?>
		loadStep('4');
		<? } else if(isset($_POST['add_user'])) { ?>
		loadStep('6');
		<? } else { ?>
		loadStep('1');
		<? } ?>

});
function sqlHide() {
	if(
	(document.getElementById('host').value != "") &&
	(document.getElementById('name').value != "") &&
	(document.getElementById('username').value != "") &&
	(document.getElementById('password').value != "")
	)
	{ 
	$('#sql_submit').show();
	} else {
	$('#sql_submit').hide();
	}
//host name username password
}
function loadStep(step) {
        var ajaxLoad;
        try{
                ajaxLoad = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxLoad = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxLoad = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("There appears to have been a problem, please reload the page.");
                                return false;
                        }
                }
        }
        ajaxLoad.onreadystatechange = function(){
                if(ajaxLoad.readyState == 1) {
			document.getElementById('output').innerHTML = ""; 
			$('#loading').show();
                }
                if(ajaxLoad.readyState == 4){
			$('#loading').hide();			
			$('#output').append(ajaxLoad.responseText);
			document.getElementById('title').innerHTML = "Live Support Installation - Step " + step;
			Cufon.replace('h4,h3,h2,h1,label');
               }
        }
                ajaxLoad.open("GET", "includes/installActions.php?step=" + step ,true);
                ajaxLoad.send(null);
}
</script>
</head>
<body>
<div id="main_container">
	<div class="container_12">
		<div class="grid_12"><!-- ###### OPEN -->
			<h1 id="title">Live Support Installation</h1>
			<div class="grid_5">&nbsp;</div><div class="grid_2"><div id="loading"><br /><br /><img src="images/install.gif" /></div></div><div class="grid_5">&nbsp;</div>
			<div class="clear">&nbsp;</div>
			<!--- Ajax Output -->
			<div class="grid_12">
				<div id="output"></div>
			</div>
			<!-- / Ajax Output -->
		</div>
	</div><!-- ##### CLOSE -->
	<div class="clear">&nbsp;</div>

</div>
</body>
</html>
