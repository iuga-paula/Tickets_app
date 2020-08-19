<?php

$link =  mysqli_connect("localhost", "root", "", "appdb");
#("hostname", "username", "password", "database")

if($link === false){
    die("Err:Could not connect to databse app db." . mysqli_connect_error());

}

$sql0 = "SELECT 1 FROM USERS LIMIT 1"; 

$sql1 = "ALTER TABLE USERS ADD email VARCHAR(25)";

$sql2 = "ALTER TABLE USERS ADD birth_date DATE";

$val = mysqli_query($link, $sql0);  #Returneaza fals daca nu exista tabelul

if($val !== FALSE)
{
    #tabelul USERS exista
    
    #echo "exista";
    if(mysqli_query($link, $sql1) && mysqli_query($link, $sql2)){
        echo "Table USERS altered succesfully.";
    }
    else{
         echo "Smth went wrong, please try again.";
    }

}
else{
    #tabelul USERS nu exista
    echo "Sorry the Users table does not exist" ;
}

mysqli_close($link);
?>