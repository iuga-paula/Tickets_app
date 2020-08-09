<?php
define('DB_server', 'localhost');
define('DB_user', 'root');
define('DB_password', '');
define('DB_name', 'appdb');

$link = mysqli_connect(DB_server, DB_user, DB_password, DB_name);

if($link === false)
{
    die("Err:Could not connect" . mysqli_connect_error());
}
else{
    echo "Successfully connected";
}
?>