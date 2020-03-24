<?php
    //This file ensures that the user is logged in. 
    //If the user is not logged in, he will be redirected to the login page.
    //
    //This file is to be used for every page that is restricted to the user.
    //

    require('./db_connect.php');
    session_start();

    if(!isset($_SESSION["userID"])){
        header("Location: https://crc353.encs.concordia.ca/z_login.php");
    }
?>