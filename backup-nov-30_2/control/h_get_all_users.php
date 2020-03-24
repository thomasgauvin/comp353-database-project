<?php

    //INPUT: NONE
    //OUTPUT: $h_get_all_users__users

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //variable is accessible where imported
    $h_get_all_users__users = array();

    //get all users in db
    $sqlGetAllUsers="SELECT * from User;";
    if ($result = $con->query($sqlGetAllUsers)) {

        while ($row = $result->fetch_assoc()) {
            $h_get_all_users__users[$row["UserID"]] = $row;
        }

        /*freeresultset*/
        $result->free();
    }

    //you can get all the users 
?>