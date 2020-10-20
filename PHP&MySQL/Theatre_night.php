<?php

session_start();
$test_file = file_exists("Config.php");
if(!$test_file)
{
    die("Err: Config file does no exist please create one.");
}

require_once "Config.php";
//require_once "Reserved_seats.php";


/*$booked_seats = $_POST['ys'];
echo $booked_seats;*/

$sub_err = "";
$n = 0;
$price = array(150,120,100,90,80,70,60);


if($_SERVER["REQUEST_METHOD"] == "POST")
{
   if(empty($_POST['seats']))
   {
     $sub_err = "You didn't select any seats.";

   }
   else{
     $seats = $_POST['seats'];

     $n = count($seats);

     for($i=0; $i < $n; $i++){
      
      $sql ="INSERT INTO TICKETS(Show_name, Type, Price, number, UserID) values (?,?,?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){

          mysqli_stmt_bind_param($stmt, "sssii", $param_name, $param_type, $param_price, $param_number, $param_id);
          $param_name = "Theatre Night";
          $param_type = $seats[$i];
          $param_number = 1;
          $param_id = intval($_SESSION["id"]);

          if(strpos($param_type, "R1") != False)
          {
          $param_price = $price[0];
          }
          elseif(strpos($param_type, "R2") != False)
          {
          $param_price = $price[1];
          }
          elseif(strpos($param_type, "R3") != False)
          {
          $param_price = $price[2];
          }
          elseif(strpos($param_type, "R4") != False)
          {
          $param_price = $price[3];
          }
          elseif(strpos($param_type, "R5") != False)
          {
          $param_price = $price[4];
          }
          elseif(strpos($param_type, "R6") != False)
          {
          $param_price = $price[5];
          }
          else
          {
          $param_price = $price[6];
          }


            if(mysqli_stmt_execute($stmt))
            {

                #echo "yey";

            }

            else
            {
              echo "ups". mysqli_error($link);
            }


        }
        mysqli_stmt_close($stmt);

  
    }
    mysqli_close($link);

     
   }
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
<title>Theare night</title>
<style type="text/css">

    body{ font: 14px Helvetica;}

    .container{
            padding-top:2%;
            
        }

        .fa{
            height:10px;
           color:white;
        }

    #sq1{

        color:#044518;
    }

    #sq2{

        color: #761818;
    }

    #sq3{
        color:#f7d5d6;
    }

    .x{

    margin-top:10%;
    margin-left: 20%;
    }

    .theatre {
  display: flex;
  position: absolute;
  transform: translate(-50%, -50%);
  margin-left:20%;
 
}



.left {


 transform: skew(-10deg);
}

.cinema-seats{
  flex-direction: column;
}
.cinema-seats .seat{
    cursor: pointer;
    }

.cinema-seats .seat:hover:before {
      content: '';
      position: absolute;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      border-radius: 7px;
    }
    
.cinema-seats .seat.active {}
    
.cinema-seats .seat.active:before {
      content: '';
      position: absolute;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.6);
      border-radius: 7px;
    }
}

.left .cinema-row {
    transform: skew(-20deg);
    margin: 0 6px;
}

.left .seat {
    width: 35px;
    height: 50px;
    border-radius: 7px;
    background: linear-gradient(to top, #761818, #761818, #761818, #761818, #761818, #B54041,  #F3686A);
    margin-bottom: 10px;
    transform: skew(50deg);
    margin-top: -38px;
    margin-left: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5)
  }

.left .row-1 {
    transform: skew(-14deg);
    }

.left .row-1 .seat {
      transform: skew(20deg);
    }

.left .row-2 {
    transform: skew(-13deg);
    }

.left .row-2 .seat {
      transform: skew(18deg);
    }
  

.left .row-3 {
    transform: skew(-12deg);}

.left .row-3 .seat {
      transform: skew(16deg);
    }

.left .row-4 {
    transform: skew(-11deg);}

.left .row-4 .seat {
      transform: skew(15deg);
    }

.left .row-5 {
    transform: skew(-10deg);
    }

 
.left .row-5 .seat {
      transform: skew(12deg);
    }


.left .row-6 {
    transform: skew(-9deg);
}

.left .row-6 .seat {
      transform: skew(10deg);
    }


.left .row-7 {
    transform: skew(-7deg);
}

.left .row-7 .seat {
      transform: skew(10deg);
    }



.right {
  margin-left: 250px;
  transform:skew(13deg);
  


}

  
.right .cinema-row {
    transform: skew(7deg);
    margin: 0 6px;
  }

.right .seat {
    width: 35px;
    height: 50px;
    border-radius: 7px;
    background: linear-gradient(to top, #761818, #761818, #761818, #761818, #761818, #B54041,  #F3686A);
    margin-bottom: 10px;
    transform: skew(-8deg);
    margin-top: -38px;
    margin-left: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5)
  }
  
.right .row-2 {
    transform: skew(9deg);
}

.right .row-2 .seat {
      transform: skew(-10deg);
    }

.right .row-3 {
    transform: skew(10deg);
}

.right .row-3 .seat {
      transform: skew(-12deg);
    }

.right .row-4 {
    transform: skew(11deg);
}

.right .row-4 .seat {
      transform: skew(-15deg);
    }

.right .row-5 {
    transform: skew(12deg);
}

.right .row-5 .seat {
      transform: skew(-16deg);
    }

.right .row-6 {
    transform: skew(13deg);
    }

.right .row-6 .seat {
      transform: skew(-18deg);
    }


.right .row-7 {
    transform: skew(15deg);
}

.right .row-7 .seat {
      transform: skew(-20deg);
    }

.form-group{
  margin-top:30px;
}

.btn-costum{
            background-color:#f5faf5;
           
        }

.btn-costum:hover{
  background-color:#1f5423;
  color:white;
}

#sub{
  margin-top:10%;
  margin-left:25%;
}

.help-block{
            color:#03541f;
            margin-left:20%;
            font-weight:bold;
        }

  #sp{
    color:#03541f;
    font-weight:bold;

  }

 input[type='checkbox'] {
    display:none;
    size:500px;
  }

#scene{
  font-size:50px;
  margin-left:34%;
  margin-top: 10%;
  font-style:italic;
  text-decoration: underline;
}

.reserved{
  background-color:#044518;
  pointer-events: none;

}
#pls{
  visibility: hidden;
}

@media only screen  and (max-width: 1023px){

  form{
    visibility:hidden;

  }

  #scene{
    visibility:hidden;
  }

  #pls{
    visibility:visible;
    font-size:60px;
    margin-left:50px;
    font-weight:bold;
  }
}
      
/*label::before {
  content: " ";
}*/

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

<div class = "container">
<div class="jumbotron">
    <h1>Theatre night</h1>
    <p class="lead"> Below you can see an interactive map of the theatre where "Rock the Opera" will take place. Please select your seats and click submit to book them.</p>
    <hr>
    <p class="lead">Legend</p>
    <p><i class="fa fa-square" id = "sq1"></i> - Already booked </p>
    <p><i class="fa fa-square" id = "sq2"></i> - Free </p>
    <p><i class="fa fa-square" id = "sq3"></i> - Selected </p>
</div>
</div>
<p id = "pls">Please view on desktop</p>
<div id = "scene">SCENE</div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class = "x">
<div class="theatre">
  <div class="cinema-seats left">
    <div class="cinema-row row-1">
    <input type="checkbox" name="seats[]" value="LR1-01"  id="myCheckbox1" />
    <label for="myCheckbox1">
      <div class="seat" id = "LR1-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR1-02"  id="myCheckbox2" />
    <label for="myCheckbox2">
      <div class="seat"  id = "LR1-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR1-03"  id="myCheckbox3" />
    <label for="myCheckbox3">
    <div class="seat"  id = "LR1-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR1-04"  id="myCheckbox4" />
    <label for="myCheckbox4">
    <div class="seat"  id = "LR1-04"></div>
    </label>
    
    <input type="checkbox" name="seats[]" value="LR1-05"  id="myCheckbox5" />
    <label for="myCheckbox5">
    <div class="seat"  id = "LR1-05"></div>
    </label>
    
    <input type="checkbox" name="seats[]" value="LR1-06"  id="myCheckbox6" />
    <label for="myCheckbox6">
    <div class="seat" id = "LR1-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR1-07"  id="myCheckbox7" />
    <label for="myCheckbox7">
    <div class="seat" id = "LR1-07"></div>
    </label>

    </div>

    <div class="cinema-row row-2">
    <input type="checkbox" name="seats[]" value="LR2-01"  id="myCheckbox8" />
    <label for="myCheckbox8">
    <div class="seat"  id = "LR2-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR2-02"  id="myCheckbox9" />
    <label for="myCheckbox9">
    <div class="seat" id = "LR2-02"></div>
    </label>
      
    <input type="checkbox" name="seats[]" value="LR2-03"  id="myCheckbox10" />
    <label for="myCheckbox10">
    <div class="seat" id = "LR2-03"></div>
    </label>
      
    <input type="checkbox" name="seats[]" value="LR2-04"  id="myCheckbox11" />
    <label for="myCheckbox11">
    <div class="seat" id = "LR2-04"></div>
    </label>
      
    <input type="checkbox" name="seats[]" value="LR2-05"  id="myCheckbox12" />
    <label for="myCheckbox12">
    <div class="seat" id = "LR2-05"></div>
    </label>
    
    <input type="checkbox" name="seats[]" value="LR2-06"  id="myCheckbox13" />
    <label for="myCheckbox13">
    <div class="seat" id = "LR2-06"></div>
    </label>
    
    <input type="checkbox" name="seats[]" value="LR2-07"  id="myCheckbox14" />
    <label for="myCheckbox14">
    <div class="seat" id = "LR2-07"></div>
    </label>
    </div>


    <div class="cinema-row row-3">
    <input type="checkbox" name="seats[]" value="LR3-01"  id="myCheckbox16" />
    <label for="myCheckbox16">
      <div class="seat" id = "LR3-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR3-02"  id="myCheckbox17" />
    <label for="myCheckbox17">
    <div class="seat" id = "LR3-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR3-03"  id="myCheckbox18" />
    <label for="myCheckbox18">
    <div class="seat" id = "LR3-03"></div>
    </label>


    <input type="checkbox" name="seats[]" value="LR3-04"  id="myCheckbox19" />
    <label for="myCheckbox19">
    <div class="seat" id = "LR3-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR3-05"  id="myCheckbox20" />
    <label for="myCheckbox20">
    <div class="seat" id = "LR3-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR3-06"  id="myCheckbox21" />
    <label for="myCheckbox21">
    <div class="seat" id = "LR3-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR3-07"  id="myCheckbox22" />
    <label for="myCheckbox22">
    <div class="seat" id = "LR3-07"></div>
    </label>
  </div>

    <div class="cinema-row row-4">
    <input type="checkbox" name="seats[]" value="LR4-01"  id="myCheckbox23" />
    <label for="myCheckbox23">
    <div class="seat" id = "LR4-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR4-02"  id="myCheckbox24" />
    <label for="myCheckbox24">
    <div class="seat" id = "LR4-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR4-03"  id="myCheckbox25" />
    <label for="myCheckbox25">
    <div class="seat" id = "LR4-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR4-04"  id="myCheckbox26" />
    <label for="myCheckbox26">
    <div class="seat" id = "LR4-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR4-05"  id="myCheckbox27" />
    <label for="myCheckbox27">
    <div class="seat" id = "LR4-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR4-06"  id="myCheckbox28" />
    <label for="myCheckbox28">
    <div class="seat" id = "LR4-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR4-07"  id="myCheckbox29" />
    <label for="myCheckbox29">
    <div class="seat" id = "LR4-07"></div>
    </label>
    </div>

    <div class="cinema-row row-5">
    <input type="checkbox" name="seats[]" value="LR5-01"  id="myCheckbox30" />
    <label for="myCheckbox30">
    <div class="seat" id = "LR5-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR5-02"  id="myCheckbox31" />
    <label for="myCheckbox31">
    <div class="seat" id = "LR5-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR5-03"  id="myCheckbox32" />
    <label for="myCheckbox32">
    <div class="seat" id = "LR5-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR5-04"  id="myCheckbox33" />
    <label for="myCheckbox33">
    <div class="seat" id = "LR5-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR5-05"  id="myCheckbox34" />
    <label for="myCheckbox34">
    <div class="seat" id = "LR5-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR5-06"  id="myCheckbox35" />
    <label for="myCheckbox35">
    <div class="seat" id = "LR5-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR5-07"  id="myCheckbox36" />
    <label for="myCheckbox36">
    <div class="seat" id = "LR5-07"></div>
    </label>
    </div>

    <div class="cinema-row row-6">
    <input type="checkbox" name="seats[]" value="LR6-01"  id="myCheckbox37" />
    <label for="myCheckbox37">
    <div class="seat" id = "LR6-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR6-02"  id="myCheckbox38" />
    <label for="myCheckbox38">
    <div class="seat" id = "LR6-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR6-03"  id="myCheckbox39" />
    <label for="myCheckbox39">
    <div class="seat" id = "LR6-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR6-04"  id="myCheckbox40" />
    <label for="myCheckbox40">
    <div class="seat" id = "LR6-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR6-05"  id="myCheckbox41" />
    <label for="myCheckbox41">
    <div class="seat" id = "LR6-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR6-06"  id="myCheckbox42" />
    <label for="myCheckbox42">
    <div class="seat" id = "LR6-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR6-07"  id="myCheckbox43" />
    <label for="myCheckbox43">
    <div class="seat" id = "LR6-07"></div>
    </label>
    </div>

    <div class="cinema-row row-7">
    <input type="checkbox" name="seats[]" value="LR7-01"  id="myCheckbox44" />
    <label for="myCheckbox44">
    <div class="seat" id = "LR7-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR7-02"  id="myCheckbox45" />
    <label for="myCheckbox45">
    <div class="seat" id = "LR7-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR7-03"  id="myCheckbox46" />
    <label for="myCheckbox46">
    <div class="seat" id = "LR7-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR7-04"  id="myCheckbox47" />
    <label for="myCheckbox47">
    <div class="seat" id = "LR7-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR7-05"  id="myCheckbox48" />
    <label for="myCheckbox48">
    <div class="seat" id = "LR7-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR7-06"  id="myCheckbox49" />
    <label for="myCheckbox49">
    <div class="seat" id = "LR7-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="LR7-07"  id="myCheckbox50" />
    <label for="myCheckbox50">
    <div class="seat" id = "LR7-07"></div>
    </label>
    </div>
  </div>


  <div class="cinema-seats right">
    <div class="cinema-row row-1">
    <input type="checkbox" name="seats[]" value="RR1-01"  id="myCheckbox51" />
    <label for="myCheckbox51">
    <div class="seat" id = "RR1-01"></div>
    </label>
      
    <input type="checkbox" name="seats[]" value="RR1-02"  id="myCheckbox52" />
    <label for="myCheckbox52">
    <div class="seat" id = "RR1-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR1-03"  id="myCheckbox99" />
    <label for="myCheckbox99">
    <div class="seat" id = "RR1-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR1-04"  id="myCheckbox53" />
    <label for="myCheckbox53">
    <div class="seat" id = "RR1-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR1-05"  id="myCheckbox54" />
    <label for="myCheckbox54">
    <div class="seat" id = "RR1-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR1-06"  id="myCheckbox55" />
    <label for="myCheckbox55">
    <div class="seat" id = "RR1-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR1-07"  id="myCheckbox56" />
    <label for="myCheckbox56">
    <div class="seat" id = "RR1-07"></div>
    </label>

    </div>

    <div class="cinema-row row-2">
    <input type="checkbox" name="seats[]" value="RR2-01"  id="myCheckbox57" />
    <label for="myCheckbox57">
    <div class="seat" id = "RR2-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR2-02"  id="myCheckbox58" />
    <label for="myCheckbox58">
    <div class="seat" id = "RR2-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR2-03"  id="myCheckbox59" />
    <label for="myCheckbox59"> 
    <div class="seat" id = "RR2-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR2-04"  id="myCheckbox60" />
    <label for="myCheckbox60">
    <div class="seat" id = "RR2-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR2-05"  id="myCheckbox61" />
    <label for="myCheckbox61">
    <div class="seat" id = "RR2-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR2-06"  id="myCheckbox62" />
    <label for="myCheckbox62">
    <div class="seat" id = "RR2-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR2-07"  id="myCheckbox63" />
    <label for="myCheckbox63">
    <div class="seat" id = "RR2-07"></div>
    </label>
    </div>

    <div class="cinema-row row-3">
    <input type="checkbox" name="seats[]" value="RR3-01"  id="myCheckbox64" />
    <label for="myCheckbox64">
    <div class="seat" id = "RR3-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR3-02"  id="myCheckbox65" />
    <label for="myCheckbox65">
    <div class="seat" id = "RR3-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR3-03"  id="myCheckbox66" />
    <label for="myCheckbox66">
    <div class="seat" id = "RR3-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR3-04"  id="myCheckbox67" />
    <label for="myCheckbox67">
    <div class="seat" id = "RR3-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR3-05"  id="myCheckbox68" />
    <label for="myCheckbox68">
    <div class="seat" id = "RR3-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR3-06"  id="myCheckbox69" />
    <label for="myCheckbox69">
    <div class="seat" id = "RR3-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR3-07"  id="myCheckbox70" />
    <label for="myCheckbox70">
    <div class="seat" id = "RR3-07"></div>
    </label>


    </div>

    <div class="cinema-row row-4">
    <input type="checkbox" name="seats[]" value="RR4-01"  id="myCheckbox71" />
    <label for="myCheckbox71">
    <div class="seat" id = "RR4-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR4-02"  id="myCheckbox72" />
    <label for="myCheckbox72">
    <div class="seat" id = "RR2-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR4-03"  id="myCheckbox73" />
    <label for="myCheckbox73">
    <div class="seat" id = "RR4-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR4-04"  id="myCheckbox74" />
    <label for="myCheckbox74">
    <div class="seat" id = "RR4-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR4-05"  id="myCheckbox75" />
    <label for="myCheckbox75">
    <div class="seat" id = "RR4-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR4-06"  id="myCheckbox76" />
    <label for="myCheckbox76">
    <div class="seat" id = "RR4-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR4-07"  id="myCheckbox77" />
    <label for="myCheckbox77">
    <div class="seat" id = "RR4-07"></div>
    </div>

    <div class="cinema-row row-5">
    <input type="checkbox" name="seats[]" value="RR5-01"  id="myCheckbox78" />
    <label for="myCheckbox78">
    <div class="seat" id = "RR5-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR5-02"  id="myCheckbox79" />
    <label for="myCheckbox79">
    <div class="seat" id = "RR5-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR5-03"  id="myCheckbox80" />
    <label for="myCheckbox80">
    <div class="seat" id = "RR5-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR5-04"  id="myCheckbox81" />
    <label for="myCheckbox81">
    <div class="seat" id = "RR5-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR5-05"  id="myCheckbox82" />
    <label for="myCheckbox82">
    <div class="seat" id = "RR5-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR5-06"  id="myCheckbox83" />
    <label for="myCheckbox83">
    <div class="seat" id = "RR5-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR5-07"  id="myCheckbox84" />
    <label for="myCheckbox84">
    <div class="seat" id = "RR5-07"></div>

    </div>

    <div class="cinema-row row-6">
    <input type="checkbox" name="seats[]" value="RR6-01"  id="myCheckbox85" />
    <label for="myCheckbox85">
    <div class="seat" id = "RR6-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR6-02"  id="myCheckbox86" />
    <label for="myCheckbox86">
    <div class="seat" id = "RR6-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR6-03"  id="myCheckbox87" />
    <label for="myCheckbox87">
    <div class="seat" id = "RR6-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR6-04"  id="myCheckbox88" />
    <label for="myCheckbox88">
    <div class="seat" id = "RR6-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR6-05"  id="myCheckbox89" />
    <label for="myCheckbox89">
    <div class="seat" id = "RR6-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR6-06"  id="myCheckbox90" />
    <label for="myCheckbox90">
    <div class="seat" id = "RR6-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR6-07"  id="myCheckbox91" />
    <label for="myCheckbox84">
    <div class="seat" id = "RR6-07"></div>

    </div>

    <div class="cinema-row row-7">
    <input type="checkbox" name="seats[]" value="RR7-01"  id="myCheckbox92" />
    <label for="myCheckbox92">
    <div class="seat" id = "RR7-01"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR7-02"  id="myCheckbox98" />
    <label for="myCheckbox98">
    <div class="seat" id = "RR7-02"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR7-03"  id="myCheckbox93" />
    <label for="myCheckbox93">
    <div class="seat" id = "RR7-03"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR7-04"  id="myCheckbox94" />
    <label for="myCheckbox94">
    <div class="seat" id = "RR7-04"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR7-05"  id="myCheckbox95" />
    <label for="myCheckbox95">
    <div class="seat" id = "RR7-05"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR7-06"  id="myCheckbox96" />
    <label for="myCheckbox96">
    <div class="seat" id = "RR7-06"></div>
    </label>

    <input type="checkbox" name="seats[]" value="RR7-07"  id="myCheckbox97" />
    <label for="myCheckbox97">
    <div class="seat" id = "RR7-07"></div>

    </div>
  </div>

</div>

</div>


<div class="form-group">
<button class="btn btn-success" id = "sub" type="submit">Submit</button>
</div>
<span class="help-block"><?php echo $sub_err; ?></span>
<span  id="sp"> 
<?php
if(empty($sub_err) && $n != 0)
echo("You booked $n seat/s: ");
for($i=0; $i < $n; $i++)
{
  echo($seats[$i] . "  ");
}
?>
</span>
</form>

<script src="https://use.fontawesome.com/62921944ed.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
//alert("hei");
$(".cinema-seats .seat").on("click", function() {
  $(this).toggleClass("active");
});
</script>

<script type="text/javascript">

function reqListener(){

  console.log(this.responseText);

}

var request = new XMLHttpRequest();
request.onload = function(){

  var tomodify = JSON.parse(this.responseText);
  var res = tomodify.trim().split(' ');
  
  res.forEach(myFunction);
  
  function myFunction(item, index) {
    
  alert(item.toString());
  document.getElementById(item.toString()).style.background = "linear-gradient(to top, #18301a,#18301a,#18301a,#18301a,#142916, #18301a, #326336, #3c7342, #4d8f55, #69b572)";
  document.getElementById(item.toString()).classList.add("reserved");

}

}

request.open("get", "Reserved_seats.php", true);
request.send();
</script>

</body>
</html>


