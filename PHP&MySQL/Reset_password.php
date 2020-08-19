<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location.php");
    exit;
}

require_once "Config.php";

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty(trim($_POST["new_password"])))
    {
        $new_password_err = "Please enter the new password!";

    }
    elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Passowrd must be at least 6 characters!";
    }
    else{
        $new_password = trim($_POST["new_password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){

        $confirm_password_err = "Please confrim your password!";
    }
    else{
        $confirm_password = trim($_POST["confirm_password"]);

        if(empty($new_password_err) && $new_password != $confirm_password)
        {
            $confirm_password_err = "Passwords did not match!";

        }
    }

    if(empty($new_password_err) && empty($confirm_password_err))
    {
        $sql = "UPDATE USERS SET password = ? WHERE id= ?";

        if($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "si", $param_pass, $param_id);

            $param_pass = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if(mysqli_stmt_execute($stmt)){

                session_destroy();
                header("location: Login.php");
                exit;
            }
            else{
                echo "Sorry, smth went wrong, please try again later." .mysqli_error($link);

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">

        body{ font: 14px Helvetica;}
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
    </style>
    <title>Reset Password</title>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Submit">
                <a class="btn btn-link" href="Welcome.php" id="res">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>