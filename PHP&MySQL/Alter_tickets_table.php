<?php

$link =  mysqli_connect("localhost", "root", "", "appdb");
#("hostname", "username", "password", "database")

if($link === false){
    die("Err:Could not connect to databse app db." . mysqli_connect_error());

}

$sql = "ALTER TABLE Tickets ADD number int";

if(mysqli_query($link, $sql)){
    echo "Table Tickets altered succesfully.";
}
else{
    die("Err: Could not able to execute $sql. " . mysqli_error($link));
}

mysqli_close($link);

?>