<?php

$test_file = file_exists("Config.php");
if(!$test_file)
{
    die("Err: Config file does no exist please create one.");
}

require_once "Config.php";

$sql = "SELECT id, username, TicketsID, Show_name, Type, Price, number
        FROM USERS, TICKETS  
        WHERE id=UserID
        GROUP BY id, username, TicketsID, Show_name, Type, Price, number";

if($result = mysqli_query($link, $sql))
{
    if(mysqli_num_rows($result)>0)
    {  echo "<div class = 'container-fluid'>";
        echo "<table class =  'table table-hover text-center'>";
            echo "<tr class = 'top' >";
                echo "<th>USER_ID</th>";
                echo "<th>username</th>";
                echo "<th>TICKETS_ID</th>";
                echo "<th>Show Name</th>";
                echo "<th>Type</th>";
                echo "<th>Price</th>";
                echo "<th>Number</th>";
            echo "</tr>";
        echo "</div>";


        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['TicketsID'] . "</td>";
                echo "<td>" . $row['Show_name'] . "</td>";
                echo "<td>" . $row['Type'] . "</td>";
                echo "<td>" . $row['Price'] . "</td>";
                echo "<td>" . $row['number'] . "</td>";


            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);

        }
    
    
    else{
    echo "No records matching your query were found.";
         }
}
else{
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
    body{ font: 14px Helvetica;}
    .top{
        background-color:#49c95e;
    }
    .table {
   margin: 10% auto auto auto;
   width: 50% !important; 
}
a:link{ color:green; font-weight:bold; font-size:1.5em;}
 a:visited{ color: #006600;}

    </style>
    <title>See_ORDERS</title>
     
</head>
<body>
<p>Go back to
<a href = "Settings.php">Settings</a>
</p>
</body>
</html>