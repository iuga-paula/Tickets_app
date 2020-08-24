<?php

session_start();
$test_file = file_exists("Config.php");
if(!$test_file)
{
    die("Err: Config file does no exist please create one.");
}

require_once "Config.php";

#echo $_SESSION["id"];
#se insereaza datele din formular in tabelul Tickets;
/*
$test = "One day 13 Aug - 50 euro";
$pieces = explode("-", $test);
$pieces2 = explode(" ", $pieces[1]);
echo $pieces2[1];*/

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $sql ="INSERT INTO TICKETS(Show_name, Type, Price, number, UserID) values (?,?,?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "sssii", $param_name, $param_type, $param_price, $param_number, $param_id);
            $param_name = "Electric_Castle";

            $pieces = explode(" ", $_POST["type"]);
            $param_type = $pieces[0]. "_". $pieces[1];

            $pieces1 = explode("-", $_POST["type"]);
            $pieces2 = explode(" ", $pieces1[1]);
            $param_price = floatval($pieces2[1]);

            $param_number = $_POST["number"];

            $param_id = intval($_SESSION["id"]);

            if(mysqli_stmt_execute($stmt))
            {

                #echo "yey";
                ?>
                <script type="text/javascript">
                window.onload = function(){
                document.getElementById("par2").style.visibility = "visible";}

                </script>
            
            
            <?php
            }
            else{
                echo "ups". mysqli_error($link);
            }
            mysqli_stmt_close($stmt);
        }
    
        mysqli_close($link);
    
}





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
<title>Electric Castle</title>
<style type="text/css">

    body{ font: 14px Helvetica;}
    .wrapper{ width: 350px; padding: 20px; border: 2px solid green;
  border-radius: 5px;}
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
    .navbar{
   margin-bottom: 30px;
    }

    .fa{
            height:10px;
           color:white;
        }

    .form-control{
        box-shadow:none;
    }
    .select option:hover{
        background-color:#35ab4d;
        box-shadow:#35ab4d;
 
}

#x{
    color:#044518;
    font-style:italic;
}

label{
    padding-top:10px;
}

#par2{
    background-color:#35ab4d;
    
    font-size:40px;
    color:white;
    padding-bottom:10%;
    padding-left:10%;
    padding-top:10%;

    visibility:hidden;
}

#sp2{
    font-weight:bold;
    font-size:1.2em;
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
        <a href = "Your_tickets.php" class="nav-item nav-link">Your tickets</a>
        <a href = "Settings.php" class="nav-item nav-link">Settings</a>
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

<div class="row mb-2" id="wr">
<div class="col-md-6">
<div class="wrapper">
<h2>Electric Castle Tickets</h2>
        <p>Please select number and tickets type.</p>

<form action =  "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
    <div class="form-goup">
    <label><b>Tickets type</b></label>
        <select class="form-control" id="exampleFormControlSelect1" name="type">
        <option>One day 1 Sept - 25 euro</option>
        <option>One day 2 Sept - 25 euro</option>
        <option>One day 3 Sept - 25 euro</option>
        <option>One day 4 Sept - 25 euro</option>
        <option>One day 5 Sept - 25 euro</option>
        <option>2 Days 1-3 Sept - 40 euro</option>
        <option>2 Days 2-4 Sept - 40 euro</option>
        <option>Full entrance - 215 euro</option>
        </select>
    </div>

<div class="form-goup">   
<label><b>Number</b></label>
<select class="form-control" id="exampleFormControlSelect2" name = "number">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
    </select>
</div>

<p id="x">If you want to book another type of tickets please fill in this formular again.</p>
<input type="submit" class="btn btn-success" value="Book tickets">

</form>
</div>
</div>

<div class="col-md-6 ">
<p id = "par2">Thank, you! Your tickets have been <span id = "sp2"> succesfully </span> booked.</p>
</div>
</div>
</body>
</html>