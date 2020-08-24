<?php

$link =  mysqli_connect("localhost", "root", "", "appdb");
#("hostname", "username", "password", "database")

if($link === false){
    die("Err:Could not connect to databse app db." . mysqli_connect_error());

}

$sql = "CREATE TABLE Tickets (
    TicketsID int NOT NULL AUTO_INCREMENT,
    Show_name varchar(25) NOT NULL,
    Type  varchar(20),
    Price float,
    UserID int,
    PRIMARY KEY (TicketsID),
    FOREIGN KEY (UserID) REFERENCES Users(id)
)";

if(mysqli_query($link, $sql)){
    echo "Table Tickets created succesfully.";
}
else{
    die("Err: Could not able to execute $sql. " . mysqli_error($link));
}

mysqli_close($link);
?>