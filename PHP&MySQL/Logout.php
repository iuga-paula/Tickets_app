<?php

session_start();

$_SESSION = array();//se reseteaza toate variabilele

session_destroy();

header("location: Login.php");
exit;
?>