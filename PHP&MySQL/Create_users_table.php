<?php

$link =  mysqli_connect("localhost", "root", "", "appdb");
#("hostname", "username", "password", "database")

if($link === false){
    die("Err:Could not connect to databse app db." . mysqli_connect_error());

}

$sql = "CREATE TABLE IF NOT EXISTS USERS(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP)";

if(mysqli_query($link, $sql)){
    echo "Table USERS created succesfully.";
}
else{
    die("Err: Could not able to execute $sql. " . mysqli_error($link));
}

mysqli_close($link);

?>