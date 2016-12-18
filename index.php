<?php
    include('login.php');

    if(isset($_SESSION['logged_user'])) {
        header("location:panel.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Muser Whitelist Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="bg-1">
    <div class="panel panel-default">
        <div class="panel-heading"><img src="img/PP.jpg" class="img-responsive img-circle" align="middle"><h4 style="text-align:center;">Muser</h4></div>
        <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" class="form-control" name="pass" id="pass">
                </div>
                <input name="submit" type="submit" class="btn btn-danger" value="Login">
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https:///maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>