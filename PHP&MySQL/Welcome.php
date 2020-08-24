<?php
#echo "yey";

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    {header("location: login.php");
    exit;
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
    <title>Welcome</title>
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
            <a href="#" class="nav-item nav-link active">Home</a>
            <a href="Shows.php" class="nav-item nav-link">Shows</a>
            <a href = "Your_tickets.php" class="nav-item nav-link">Your tickets</a>
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
        <b><h1>Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?>.</b> Welcome to our Tickets app.</h1>
        <p class = "lead">In today's world internet is the most popular way of connecting with the people. But would you like to see videos on youtube instead of going to a live concert?
        <hr><span class="a">Here</span> you can <span class="a"> book</span> the best seats for a dreamy concert <span class= "a">online</span> but you can fully <span class ="a">enjoy</span> it <span class ="a">live</span>.
        </p>
</div>
</div>
<div class="row">
        <div class="col-md-4">
            <h2>Summer Well</h2>
            <img src="https://thumbor.unica.ro/unsafe/1160x650/smart/filters:contrast(1):quality(80)/https://static.unica.ro/wp-content/uploads/2018/08/summer-well-1.jpg" class="img-thumbnail" alt="Thumbnail Image">
            <p><a href="SummerWell.php" class="btn btn-success">See tickets &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Theatre night</h2>
            <img src="https://bucurestiulmeudrag.ro/img/photos/s1920/58376453-acbc-4068-a7ca-4c4b592b13d5.jpg"class="img-thumbnail" alt="Thumbnail Image">
            <p><a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank" class="btn btn-success">See tickets &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Electric Castle</h2>
            <img src="https://img.wall-street.ro/image_thumbs/thumbs/3e7/3e78c28e740542d85d92749e0c1ebc0a-1063x560-00-86.jpg?v=1549454485"class="img-thumbnail" alt="Thumbnail Image">
            <p><a href="ElectricCastle.php"  class="btn btn-success">See tickets &raquo;</a></p>
        </div>
</div>

<script src="https://use.fontawesome.com/62921944ed.js"></script>
</body>
</html>
