<?php
$link = mysqli_connect("localhost", "root", "");//conex la server

if($link === false)
{
    die("Err:Could not connect to server." . mysqli_connect_error());
}

$sql = "CREATE DATABASE appdb";///creare bd appbd
if(mysqli_query($link, $sql))
{
    echo "Database app db created successfully.";
}
else{
    die("Err:Could not execute $sql." . mysqli_error($link));
}

?>
