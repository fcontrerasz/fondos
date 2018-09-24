<?php
// sanitise all $_POST and $_GET variables, to protect against sql injection
foreach ($_POST as $key => $value) {
    $_POST[$key] = mysql_real_escape_string($value);
    $_POST[$key] = strip_tags($value, '<b><i><u><a>');
    $_POST[$key] = addslashes($value);
  }
foreach ($_GET as $key => $value) {
    $_GET[$key] = mysql_real_escape_string($value);
    $_GET[$key] = strip_tags($value, '<b><i><u><a>');
    $_GET[$key] = addslashes($value);
  }
?>
