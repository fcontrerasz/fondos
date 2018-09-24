<?php
/*

THIS FILE OVER RIDES LOGIN DO NOT LEAVE IT ON YOUR SERVER!!!!!!!

*/
ob_start();
session_start();
	session_regenerate_id (); //this is a security measure
        $_SESSION['valid'] = 1;
        $_SESSION['username'] = "Admin";
        $_SESSION['name'] = "Admin";
        $_SESSION['admin'] = "Yes";


echo 'You are now logged in, please head straight to <a href="../users.php">User Managment</a> and create a proper user.  THEN DELETE THIS FILE FROM YOUR SERVER!!!!!';




ob_flush();
?>
