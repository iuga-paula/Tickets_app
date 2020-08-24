<?php


session_start();
$test_file = file_exists("Config.php");
if(!$test_file)
{
    die("Err: Config file does no exist please create one.");
}

require_once "Config.php";

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Your tickets</title>
    <style type="text/css">

        body{ font: 14px Helvetica;}
        input[type="text"]:focus, input[type="password"]:focus,  input[type="date"]:focus{
        border-color: green;
        box-shadow: none;
       /* -webkit-box-shadow: none;
        outline: -webkit-focus-ring-color auto 5px;*/
        }
        .btn-costum{
            background-color:#f5faf5;
        }
        .btn-costum:hover{
            background-color:#1f5423;
            color:white;
        }
        .container{
            padding-top:2%;
        }

        .a{
            font-weight:bold;
            color:green;
        }
        .col-md-4{
            padding-left:2%;
           
        }

        h2{
            font-weight:bold;

        }
        .fa{
            height:10px;
           color:white;
        }

        #par3{
            margin-right:80%;
            padding-left:10px;
            border:solid;
            border-color:#044518;
            color:white;
        }




}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-success">
<i class="fa fa-ticket" aria-hidden="true"></i>
   <a href="#" class="navbar-brand">Tickets app</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="Welcome.php" class="nav-item nav-link">Home</a>
            <a href="Shows.php" class="nav-item nav-link">Shows</a>
            <a href = "#" class="nav-item nav-link active">Your tickets</a>
            <a href = "Settings.php" class="nav-item nav-link">Settings</a>
            
        </div>
        <form class="form-inline ml-auto">
            <input type="text" class="form-control mr-sm-2" placeholder="Search">
            <button type="submit" class="btn btn-costum">Search</button>
        </form>
        <div class="navbar-nav  ml-auto">
        <a href = "#" class="nav-item nav-link active" id = "hi">Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</a>
        <a href = "Logout.php" class = "nav-item nav-link" id="log">Log out</a>
        </div>

        </div>

</nav>
<div class="container">
    <div class="jumbotron">     
        <b><h1>Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</b> These are your booked tickets:</h1>
        <p class = "lead">(Here you can take a look at your last bookings and the total amount you'll hapilly spend on dreamy concerts.)</p>
        <hr>
        <table class="table table-borderless">
        <tread>
        <tr>
            <th>Order Id</th>
            <th>Concert Name</th>
            <th>Tickets type</th>
            <th>Number</th>
            <th>Price</th>
        </tr>
        </thead>
        <t/body>
        <?php
        
        $link =  mysqli_connect("localhost", "root", "", "appdb");
        #("hostname", "username", "password", "database")

        if($link === false){
            die("Err:Could not connect to databse app db." . mysqli_connect_error());

            }

        $sql = "SELECT TicketsID, Show_name, Type, Number,  Price FROM TICKETS , USERS where UserId = id and id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $_SESSION["id"];

            if(mysqli_stmt_execute($stmt))
            { 
                mysqli_stmt_store_result($stmt);
                
                
                if(mysqli_stmt_num_rows($stmt) > 0)
                {
                    mysqli_stmt_bind_result($stmt, $order, $name, $type, $number, $price);
                    while(mysqli_stmt_fetch($stmt))
                    {
                        #mysqli_stmt_fetch($stmt);
                        $total += $number*$price;
                        echo "<tr>";
                        echo "<td>". $order . "</td>";
                        echo "<td>". $name . "</td>";
                        echo "<td>". $type . "</td>";
                        echo "<td>". $number . "</td>";
                        echo "<td>". $price . "</td>";
                        echo "</tr>";
                    }
                    
                }
            }
            else {echo mysqli_error($link);}
        }

        ?>
        </tbody>
        <p class = "lead bg-success" id = "par3" > Your total is :  &euro; <?php  echo $total ?> </p>  
</div>

</div>

<script src="https://use.fontawesome.com/62921944ed.js"></script>
</body>
</html>