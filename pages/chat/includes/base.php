<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "00emdbd2015";
$dbname = "chat_codelco";
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to database");
mysql_set_charset("utf8",$conn);
mysql_select_db($dbname);
include "sanity.php";
?>