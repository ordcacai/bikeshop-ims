<?php

session_start();

if(isset($_GET['logout']) && $_GET['logout'] == 1){

    if(isset($_SESSION['logged_in'])){

        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_type']);

        header('location: ../login.php');
        exit;

    }

}

?>