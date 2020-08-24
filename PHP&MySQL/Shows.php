<?php

session_start();
$test_file = file_exists("Config.php");
if(!$test_file)
{
    die("Err: Config file does no exist please create one.");
}

require_once "Config.php";

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
<title>Shows</title>
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
    .navbar{
   margin-bottom: 30px;
}

    .jumbotron{
        background-color:#044518;
    }

    .text{
        color:white;
        background-color:#044518;
        font-style:italic;
    }
    
    .fa{
            height:10px;
           color:white;
        }

    .tickets{
        font-size:1.5em;
        font-weight:bold;
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
        <a href="#" class="nav-item nav-link active">Shows</a>
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

<div class="jumbotron p-4 p-md-5 text-white rounded ">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">Here you cand find some good ways of enjoying yourself: </h1>
      <p class="lead my-3">The best concerts, live music events at theare or open-air festivals are wainting for you! Hurry up to get your ticket at the best price!</p>
      <p class="lead mb-0"><a href="#see" class="text-white font-weight-bold">Take a look  at some recommandations </a><i class="fa fa-arrow-down"></i></p>
    </div>
</div>

<div class="row mb-2" id="see">
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="text" >Festival</strong>
          <h3 class="mb-0">Summer Well Festival</h3>
          <div class="mb-1 text-muted">13-14 Aug 2021</div>
          <p class="card-text p-2 mb-auto">2021 will see Summer Well celebrate its 10th anniversary, and despite its rapidly growing reputation it continues to champion its unique, boutique festival vibe. Throughout the winding woodland, the tranquil locale is jam-packed with numerous stages, installations, and impeccable gastronomy.</p>
          <p class="card-text p-2 mb-auto">Each consecutive festival introduces an increasingly expansive lineup, with international staples such as The National, Interpol, Bastille, The 1975; it's indie, and it's awesome.</p>
          <a href="SummerWell.php" class = "text-success tickets">See available tickets</a>
        </div>
        <div class="col-auto d-none d-lg-block">
        <img src="https://thumbor.unica.ro/unsafe/1160x650/smart/filters:contrast(1):quality(80)/https://static.unica.ro/wp-content/uploads/2018/08/summer-well-1.jpg" class="img-thumbnail" alt="Thumbnail Image">
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
           <strong class="text">Festival</strong>
          <h3 class="mb-0">Electric Castle</h3>
          <div class="mb-1 text-muted">1-5 Sept 2021</div>
          <p class="card-text p-2 mb-auto">An eclectic line-up mixed with new media installations & performances, breathtaking scenery and historical surroundings create an alternate world where you can lose yourself to find your self.</p>
          <p class="card-text p-2 mb-auto">1000+ artists from around the world performed at Electric Castle over the course of 7 editions. Here are some of them: FLORENCE+THE MACHINE / THE PRODIGY / SKRILLEX / 30SECONDS TO MARS / ENTER SHIKARI / DIE ANTWOORD / SIGUR ROS / ALT-J / DAMIAN MARLEY / JESSIE J / DEADMAU5 / FATBOY SLIM / BRING ME THE HORIZON / THIEVERY</p>
          <a href="ElectricCastle.php" class = "text-success tickets">See available tickets</a>
        </div>
        <div class="col-auto d-none d-lg-block">
        <img src="https://img.wall-street.ro/image_thumbs/thumbs/3e7/3e78c28e740542d85d92749e0c1ebc0a-1063x560-00-86.jpg?v=1549454485"class="img-thumbnail" alt="Thumbnail Image">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mb-2" id="see">
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="text">Theatre Concert</strong>
          <h3 class="mb-0">Theatre Night</h3>
          <div class="mb-1 text-muted">11 Jul 2021</div>
          <p class="card-text p-2 mb-auto">The Prague Philharmonic Orchestra combines the atmosphere and power of the original songs with an unique interpretation, passion and the splendid sound of a big orchestra. What follows is an exalting audience experience, considered groundbreaking and very appreciated by Rock fans all over Europe.</p>
          <p class="card-text p-2 mb-auto">The absolute highlights of our shows include: Pink Floyd – Shine On You Crazy Diamond, Comfortably Numb, Echoes, Another Brick In The Wall, Deep Purple – Highway Star, Fireball, Smoke On The Water, When A Blind Man Cries, Queen – The Show Must Go On, We Are The Champions, A Kind Of Magic, Led Zeppelin – Stairway To Heaven and Kashmir, U2 – With Or Without You and Where The Streets Have No Name.</p>
          <a href="#" class = "text-success tickets">See available tickets</a>
        </div>
        <div class="col-auto d-none d-lg-block">
        <img src="https://bucurestiulmeudrag.ro/img/photos/s1920/58376453-acbc-4068-a7ca-4c4b592b13d5.jpg"class="img-thumbnail" alt="Thumbnail Image">
        </div>
      </div>
    </div>
    </div>

<script src="https://kit.fontawesome.com/yourcode.js"></script>
</body>
</html>