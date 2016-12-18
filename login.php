<?php

/*
    Please do change this "LogUser" & "PassUser" to your own wants. That will be the password and the user to login to the panel
*/

$loguser = "admin";
$passuser = "password";

session_start();

if(isset($_POST['submit'])) {
    if(empty($_POST['username']) || empty($_POST['pass'])) {
        $error = "Something went wrong!";
    }
    else {

        $user = $_POST['username'];
        $pass = $_POST['pass'];

        if($user == $loguser && $pass == $passuser) {
            $_SESSION['logged_user'] = $loguser;
            header("location:panel.php");
        }
    }

}