<?php

$test_file = file_exists("Config.php");
if(!$test_file)
{
    die("Err: Config file does no exist please create one.");
}

require_once "Config.php";


$username = $password = $confirm_password = $email = $birthdate = "";
$username_err = $password_err = $confirm_password_err = $email_err = $birthdate_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty(trim($_POST["username"]))){ #username
        $username_err = "Please enter a username!";
    }
    else{#username nevid
        $sql = "SELECT id FROM USERS WHERE username = ?"; #placeholder
        if($stmt = mysqli_prepare($link, $sql))
        {#variabilele care vor fi puse in loc de placeholder
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                   $username_err = "This username is already taken!";
            }
            else{
                $username = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING);

                }
            }
            else{
                echo "Sorry! Smth went wrong please try again.";
            }
            mysqli_stmt_close($stmt);

        }
        


    }


    if(empty(trim($_POST["email"]))){ #email
        $email_err = "Please enter an email!";
    }
    elseif(stristr($_POST["email"], '@') === FALSE || $_POST["email"][strlen($_POST["email"])-1] == '@'){
        $email_err = "Please enter a valid email: local-part@domain.";

    }
    else{
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

    }


    if(empty(trim($_POST["date"]))){#date
        $birthdate_err = "Please select your birthday!";
    }
    else{

        $bdate = date_create($_POST["date"]);
        $now = date_create("now");

        $arr = explode("/", trim($_POST["date"]));
        /*echo $arr[0].$arr[1].$arr[2];
        if(count($arr) < '3' || ($arr[0] < '01' && $arr[0] > '12') || ($arr[1] < '1' && $arr[1] > '31') || ($arr[2] < '1') || ($arr[2]) >= date('y'))
        {
            $birthdate_err = "Please enter a correct date";
        }
        else{*/
   
        if(date_diff($bdate, $now)->format('%R%a') >=  '6048')
        {
           
           $birthdate  = filter_var( trim($_POST["date"]), FILTER_SANITIZE_STRING);
        }
        else {
            $birthdate_err = "You must be at least 18y old to register.";

        }
    #}



    }


    if(empty(trim($_POST["password"]))){#password
    $password_err = "Please enter a password!"; 
    }
    elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have a minimum lenght of 6!";
    }
    else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){#confirm_password
        $confirm_password_err = "Please confirm password!";
    }
    else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && $password != $confirm_password){
            $confirm_password_err = "Passwords did not match!";
        }
    }

    if($username_err === "" &&  $password_err === "" && $confirm_password_err === "" && $email_err === "" && $birthdate_err === ""){


        $sql ="INSERT INTO USERS (username, password, email, birth_date) values (?,?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_email, $param_date);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email;
            $parts = explode('/', $birthdate);
            $param_date  = "$parts[2]-$parts[0]-$parts[1]";
            /*$param_date =  date("yyy-mm-dd", strtotime($birthdate));
            $birthdate = strval($birthdate);
            $newbirthdate = $newstr = filter_var($birthdate, FILTER_SANITIZE_STRING);
            $param_date = date('yyyy-mm-dd', $newbirthdate);*/

 
            
            if(mysqli_stmt_execute($stmt))
            {
                //redirectionare la pagina de login
               // echo "Your cont has been successfully made!";
                $to = $email;
                $subject = 'NO REPLY: THICKETS APP - THANK YOU FOR REGISTRATION';
                $message = "HEY, $username, your account on Tickets app has been succesfully made. You can now book all the tickets you want"; 
                $from = 'iuga.paula@gmail.com';

                if(mail($to, $subject, $message)){
                    #echo 'Your mail has been sent successfully.';
                    $ok = TRUE;
                } 
                header("location: Redirect.php");
            }else{
                
                echo "Smth went wrong. Please try again.";
            }
            mysqli_stmt_close($stmt);


        }
    }

    mysqli_close($link);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <title>Register</title>

    <style type="text/css">

        body{ font: 14px Helvetica; }
        .wrapper{ width: 350px; padding: 20px; }
        label,h2{ font-weight: bold;}
        a:link{ color:green;}
        a:visited{ color: #006600;}
        #res{color: green;}
        #res:hover{background-color: #A9A9A9;}

        input[type="text"]:focus, input[type="password"]:focus,  input[type="date"]:focus{
        border-color: green;
        box-shadow: none;
       /* -webkit-box-shadow: none;
        outline: -webkit-focus-ring-color auto 5px;*/
        }

        .datepicker table tr td.active:active, 
        .datepicker table tr td.active.highlighted:active, 
        .datepicker table tr td.active.active, 
        .datepicker table tr td.active.highlighted.active {background-color: green;}


        .datepicker table tr td.active:active:hover, 
        .datepicker table tr td.active.highlighted:active:hover, 
        .datepicker table tr td.active.active:hover, 
        .datepicker table tr td.active.highlighted.active:hover{
            background-color: #0c381b;

        }

        .help-block{
            color:#03541f;
        }



    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>

    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post"> <!-- informatiile introduse sunt transmise tot la pagina curenta pt a fi porcesate si bagate in baze de date -->
    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" value = "">
        <label>Username</label>
        <input  type = "text" name = "username" class = "form-control" value = "">
        <span class = "help-block"><?php echo $username_err; ?></span>
    </div>
   
    <div class = "form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>" value = "">
        <label>Email</label>
        <input type = "text"  name = "email" class = "form-control" >
        <span class = "help-block"><?php echo $email_err; ?></span>
   </div>

    <div class = "form-group <?php echo (!empty($birthdate_err)) ? 'has-error' : ''; ?>">
    <label class="control-label" for="date">Date of birth</label>
        <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text" todayHighlight = "false">
        <span class = "help-block"><?php echo $birthdate_err; ?></span>
    </div>



    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>" value = "">
        <label>Password</label>
        <input autocomplete="new-password" type="password" name="password" class="form-control" >
        <span class="help-block"><?php echo $password_err; ?></span>
    </div>

    <div class = "form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>" value = "">
        <label>Confirm Password</label>
        <input autocomplete="new-password" type = "password"  name = "confirm_password" class = "form-control" >
        <span class = "help-block"><?php echo $confirm_password_err; ?></span>
   </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Submit">
        <input type="reset" class="btn btn-default" value="Reset" id = "res">
    </div>

    <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
    </script>

</body>
</html>