<?php

$test_file = file_exists("Config.php");
if(!$test_file)
{
    die("Err: Config file does no exist please create one.");
}
require_once "Config.php";

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){




    $sql = "SELECT id, TicketsID, Show_name, Type, Number,  Price FROM TICKETS , USERS where UserId = id and id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET["id"]);

        if(mysqli_stmt_execute($stmt))
        { 
            mysqli_stmt_store_result($stmt);
            
            
            if(mysqli_stmt_num_rows($stmt) > 0)
            {
                echo "<div class = 'container-fluid'>";
                echo "<table class =  'table table-hover text-center'>";
                    echo "<tr class = 'top' >";
                        echo "<th>USER_ID</th>";
                        echo "<th>TICKETS_iD</th>";
                        echo "<th>Show namw</th>";
                        echo "<th>Type</th>";
                        echo "<th>Number</th>";
                        echo "<th>Price</th>";
                    echo "</tr>";
                echo "</div>";
                mysqli_stmt_bind_result($stmt, $id, $order, $name, $type, $number, $price);
                while(mysqli_stmt_fetch($stmt))
                {
                    echo "<tr>";
                    echo "<td>". $id . "</td>";
                    echo "<td>". $order . "</td>";
                    echo "<td>". $name . "</td>";
                    echo "<td>". $type . "</td>";
                    echo "<td>". $number . "</td>";
                    echo "<td>". $price . "</td>";
                    echo "</tr>";
                }
                
            }
            else{
                echo "<div class='alert alert-success' role='alert'>";
                echo "This User does not have any booked tickets!";
                echo "</div>";
            }
        }
        else {echo mysqli_error($link);}
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Read</title>
    <style type="text/css">

        body{ font: 14px Helvetica;}

        .table {
   margin: 10% auto auto auto;
   width: 50% !important; 
}
        .top{
                background-color:#49c95e;
            }

        .alert{
            margin-top:10%;
            font-size:30px;
            text-align:center;
        }
    </style>
</head>
</body>
</body>
</html>
