<?php

$link =  mysqli_connect("localhost", "root", "", "appdb");
#("hostname", "username", "password", "database")

if($link === false){
    die("Err:Could not connect to databse app db." . mysqli_connect_error());

}

$sql = "SELECT id, username, email, birth_date FROM USERS";

if($result = mysqli_query($link, $sql))
{
    if(mysqli_num_rows($result) >0)
    {   echo "<div class = 'container-fluid'>";
        echo "<table class =  'table table-hover text-center'>";
            echo "<tr class = 'top' >";
                echo "<th>ID</th>";
                echo "<th>username</th>";
                echo "<th>email</th>";
                echo "<th>birth_date</th>";
            echo "</tr>";
        echo "</div>";


        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                if($row['email'] == NULL)
                {
                    echo "<td>" . "---" . "</td>";
                }
                else {
                    echo "<td>" . $row['email'] . "</td>";
                }
                if($row['birth_date'] == NULL)
                {
                    echo "<td>" . "---" . "</td>";
                }
                else{
                    echo "<td>" . $row['birth_date'] . "</td>";
                }
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
    .top{
        background-color:#49c95e;
    }
    .table {
   margin: 10% auto auto auto;
   width: 50% !important; 
}
    </style>
    <title>See_USERS</title>
     
</head>
<body>
</body>
</html>
