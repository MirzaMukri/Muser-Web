<?php

ob_start();
session_start();

if(!isset($_SESSION['logged_user'])) {
    header("location:index.php");
    exit;
}

include "settings.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Muser Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/panel.css">
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navcol">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navcol">
            <ul class="nav navbar-nav">
                <li><a href="panel.php"><strong><i class="fa fa-home"></i> Home</strong></a></li>
                <li><a href="/players"><strong><i class="fa fa-check"></i> Players</strong></a></li>
                <li><a href="/recent"><strong><i class="fa fa-book"></i> Updates</strong></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <a href="#" class="btn btn-danger btn-lg"><i class="fa fa-info"></i> Muser v1.0</a>
                <a href="logout.php" class="btn btn-danger btn-lg"><i class="fa fa-sign-out"></i> Logout</a>
            </ul>
        </div>
    </div>
</nav>

<div class="container bg-1">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-4">
                <img src="img/PP.jpg" class="img-responsive img-circle" align="middle">
            </div>
            <div class="col-md-6">
                <h2><?php echo "Welcome ".$_SESSION['logged_user'];?>!</h2>
                <p>Thank you for using Muser for your whitelisting system! This text is for you to change your announcements for your staff team!</p>
                <p>Still doesn't know how to use Muser? CLICK ME</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 style="text-align: center;">Add Players</h1></div>
                <div class="panel-body">
                    <?php
                        if(!empty($_GET['ignadd'])) {
                            $addIgn = $_GET['ignadd'];
                            $query24 = htmlspecialchars($addIgn);
                            $query25 = mysql_real_escape_string($query24);

                            $con = mysqli_connect($sqlIp, $sqlUser, $sqlPass, $sqlTable);
                            $db = mysqli_select_db($con, $sqlTable);

                            $query = mysqli_query($con, "SELECT * FROM Muser WHERE user='".$query25."'");
                            $numrows = mysqli_num_rows($query);

                            if($numrows == 0) {
                                $idQuery = mysqli_query($con, "SELECT MAX(id) FROM Muser");
                                $row = mysqli_fetch_row($idQuery);
                                $highestid = $row[0] + 1;

                                $addQuery = "INSERT INTO Muser (id, user) VALUES ('".$highestid."','".$query25."')";

                                if(mysqli_query($con, $addQuery)) {
                                    echo "You added ".$query25." to your database!";
                                } else {
                                    echo "Error: ".mysqli_error($con);
                                }

                            } else {
                                echo "Player already exist on the database!";
                            }
                            mysqli_close($con);

                        } else {
                            echo "<form method='get' action='panel.php'><div class='form-group'><label>Username</label><input type='text' class='form-control' name='ignadd' id='ignadd'></div><p><i>*Player name are case sensitive!</i></p><input type='submit' class='btn btn-danger' value='Add Player'></form>";
                        }

                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 style="text-align: center;">Recently Added</h1></div>
                <div class="panel-body">
                <?php
                    $con = mysqli_connect($sqlIp, $sqlUser, $sqlPass, $sqlTable);
                    $query = "SELECT * FROM Muser ORDER BY id DESC LIMIT 5";

                    if(!$con) {
                        $errorl = "<p style='color: red;'>Could not connect to the mySql!</p>";
                    }

                    $result = mysqli_query($con, $query);
                    $numbers = 0;

                    while($rows = mysqli_fetch_array($result)) {
                        $numbers++;
                        echo "<p><strong>".$numbers.". <img src='https://minotar.net/helm/".$rows['user']."/25'> ".$rows['user']."</strong></p>";
                    }
                    mysqli_close($con);
                ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 style="text-align: center;">Remove Players</h1></div>
                <div class="panel-body">
                    <?php
                        if(!empty($_GET['ignrem'])) {

                            $removedIgn = $_GET['ignrem'];
                            $query24 = htmlspecialchars($removedIgn);
                            $query25 = mysql_real_escape_string($query24);

                            $con = mysqli_connect($sqlIp, $sqlUser, $sqlPass, $sqlTable);
                            $db = mysqli_select_db($con, $sqlTable);

                            $query = mysqli_query($con, "SELECT * FROM Muser WHERE user='".$query25."'");
                            $numrows = mysqli_num_rows($query);

                            if($numrows == 0) {
                                echo "Player does not exists";
                            } else {
                                $removeQuery = "DELETE FROM Muser WHERE user='".$query25."'";

                                if(mysqli_query($con, $removeQuery)) {
                                    echo "You successfully removed ".$query25." from the database!";
                                } else {
                                    echo "Error: ".mysqli_error($con);
                                }
                            }
                            mysqli_close($con);

                        } else {
                            echo "<form method='get' action='panel.php'><div class='form-group'><label>Username</label><input type='text' class='form-control' name='ignrem' id='ignrem'></div><p><i>*Player name are case sensitive!</i></p><input type='submit' class='btn btn-danger' value='Remove Player'></form>";
                        }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https:///maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>