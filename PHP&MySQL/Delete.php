<?php

$link =  mysqli_connect("localhost", "root", "", "appdb");
#("hostname", "username", "password", "database")

if($link === false){
    die("Err:Could not connect to databse app db." . mysqli_connect_error());

}

$sql = "DELETE FROM TICKETS WHERE TicketsID = 1 or TicketsID = 4";

if(mysqli_query($link, $sql))
{
    echo "succesfully deleted.";
}
else {
    echo mysqli_error($link);
}

?>