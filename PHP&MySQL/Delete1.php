<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){

    $test_file = file_exists("Config.php");
    if(!$test_file)
    {
        die("Err: Config file does no exist please create one.");
    }
    
    require_once "Config.php";
    

    $sql = "DELETE FROM USERS WHERE id = ?";
    $sql1 = "SELECT 1 FROM TICKETS WHERE UserId = ?";

    $sql2 = "DELETE FROM TICKETS WHERE UserId = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        
        $param_id = trim($_POST["id"]);
        

        if(mysqli_stmt_execute($stmt)){


            if($stmt1 = mysqli_prepare($link, $sql1)){

                mysqli_stmt_bind_param($stmt1, "i", $param_id);
                $param_id = trim($_POST["id"]);
        
                if(mysqli_stmt_execute($stmt1)){
                    mysqli_stmt_store_result($stmt1);
                if(mysqli_stmt_num_rows($stmt)>0){
        
                    if($stmt2 = mysqli_prepare($link, $sql2)){
        
                        mysqli_stmt_bind_param($stmt2, "i", $param_id1);
                        $param_id1 = trim($_POST["id"]);
                        if(mysqli_stmt_execute($stmt2)){
                            header("location: See_users.php");
                            exit();

                        }
                        mysqli_stmt_close($stmt2);


                    }
        
        
        
                }

                header("location: See_users.php");
                exit();
            }
            mysqli_stmt_close($stmt1);
        }




            header("location: See_users.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    
     
    mysqli_stmt_close($stmt);

    }

    mysqli_close($link);
} else{
 
    if(empty(trim($_GET["id"]))){
        echo "ups smth went wrong";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="See_users.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>