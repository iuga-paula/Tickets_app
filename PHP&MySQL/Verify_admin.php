<?php

session_start();
$test_file = file_exists("Config.php");
if(!$test_file)
{
    die("Err: Config file does no exist please create one.");
}

require_once "Config.php";


if($_SESSION["username"] == "admin"){

    echo json_encode(1);

}
else{
    echo json_encode(0);
}

?>