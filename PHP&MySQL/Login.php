<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) #daca userul e logat redirect la welcome page
{
    header("location: Welcome.php");
    exit;

}

require_once "config.php";

$username = $password = "";
$username_err1 = $username_err = $email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter your username or email!";
    }
    else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter your password!";
    }
    else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT id, username, password from users where username = ?";


        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;


            if(mysqli_stmt_execute($stmt))
            { 
                mysqli_stmt_store_result($stmt);
                #se verif daca exis usernameul si daca se potriveste parola
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password))
                        {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: Welcome.php");
                        }
                        else{
                            $password_err = "Wrong password!";

                        }
                    }
                }
                else{
                    $username_err1 = $username_err = "No account found with that username.";
                }
            }
            else{
                echo "Something went wrong. Please try again later.";
            }
        }

            mysqli_stmt_close($stmt);



        }

        $sql2 = "SELECT id, email, password from users where email = ?";
        if($username_err1 != "" && $stmt2 = mysqli_prepare($link, $sql2))//daca nu e logat cu username -ul poate e cu parola
        {
            mysqli_stmt_bind_param($stmt2, "s", $param_email);
            $param_email = $username;
            
            if(mysqli_stmt_execute($stmt2))
            { 
                mysqli_stmt_store_result($stmt2);
            if (mysqli_stmt_num_rows($stmt2) > 0){
                $email_err = $username_err =  "Multiple accounts found with that email. Please log in with your username";

            }
            else if(mysqli_stmt_num_rows($stmt2) == 1)
                {
                    mysqli_stmt_bind_result($stmt2, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt2)){
                        if(password_verify($password, $hashed_password))
                        {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: Welcome.php");
                        }
                        else{
                            $password_err = "Wrong password!";

                        }
                    }
                }
            else { $email_err = $username_err =  "No account found with that email.";

            }
        }
            else{
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt2);
    
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
    <title>Login</title>

    <style type="text/css">

        body{ font: 14px Helvetica; }
        .wrapper{ width: 350px; padding: 20px; }
        label,h2{ font-weight: bold;}
        a:link{ color:green;}
        a:visited{ color: #006600;}
        #res{color: green;text-decoration: underline;}
        #res:hover{background-color: #A9A9A9;}
        #reg{font-size: 0.8em; font-style:italic;}

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
        <h2>Log in</h2>
        <p>Please fill in your credentials to login.</p>
        <p id = "reg">If you don't have an account please <a href="Register.php" id = "res">register here</a></p>

    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post"> <!-- informatiile introduse sunt transmise tot la pagina curenta pt a fi porcesate si bagate in baze de date -->
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input autocomplete = "off" type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input autocomplete="new-password" type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-success" value="Login">
            </div>
            <p>Don't have an account? <a href="Register.php">Sign up now</a>.</p>    
</form>
</div>
</body>
</html>

