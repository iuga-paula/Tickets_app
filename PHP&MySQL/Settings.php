<?php
    session_start();
    require "Config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Settings</title>
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

        .fa{
            height:10px;
           color:white;
        }

        #admin{
            visibility:hidden;
        }

        #admin p:first-child {
            font-weight:bold;
        }

        ul a:link{ color:green; font-weight:bold; font-size:1.5em;}
        ul a:visited{ color: #006600;}
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
            <a href="Welcome.php" class="nav-item nav-link ">Home</a>
            <a href="Shows.php" class="nav-item nav-link">Shows</a>
            <a href = "Your_tickets.php" class="nav-item nav-link">Your tickets</a>
            <a href = "Settings.php" class="nav-item nav-link active">Settings</a>
        </div>
        <form class="form-inline ml-auto">
            <input type="text" class="form-control mr-sm-2" placeholder="Search">
            <button type="submit" class="btn btn-costum">Search</button>
        </form>
        <div class="navbar-nav  ml-auto">
        <a href = "#" class="nav-item nav-link active " id = "hi">Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</a>
        <a href = "Logout.php" class = "nav-item nav-link" id="log">Log out</a>
        </div>

        </div>

</nav>
<div class = "container">
<div class="jumbotron">
    <h1>Your info</h1>
    <p class="lead">
    Username: <?php echo $_SESSION["username"] ?>
    <br>
    Email: 
    <?php $sql = "SELECT email from Users where username = ?";

if($stmt = mysqli_prepare($link, $sql))
    {
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $_SESSION["username"];


        if(mysqli_stmt_execute($stmt))
        { 
            mysqli_stmt_store_result($stmt);
    
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $email);
                mysqli_stmt_fetch($stmt);
                echo $email;
            }
        }
    }
?>
    </p>
    <p class="lead">
    Do you want to change your password?
    <a href="Reset_password"  class="btn btn-primary btn-success">Change password</a>
    </p>
    <div id = "admin">
    <p class = "lead">Since you are an admin you can see users, their orders and modify them.</p>

    <ul>
  <li><a href = "See_users.php" class = "nav-item nav-link" id="log">See users</a></li>
  <li><a href = "See_orders.php" class = "nav-item nav-link" id="log">See orders</a></li>

 </ul>
</div>
</div>
<script type ="text/javascript">
var request = new XMLHttpRequest();
request.onload = function(){

//alert(this.responseText);
  var rez = JSON.parse(this.responseText);
  if(rez == 1){
    document.getElementById("admin").style.visibility = "visible";
  }

}


request.open("get", "Verify_admin.php", true);
request.send();
</script>
</body>
</html>

