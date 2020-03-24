<?php

    //INPUT: $h_get_all_users_in_event__eventID
    //OUTPUT: $h_get_all_users_in_event__eventUsers

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //variable is accessible where imported
    $h_get_all_users_in_event__eventUsers = array();

    //get all users for particular event
    $sqlGetAllUsers="SELECT * from User WHERE UserID IN (
        SELECT UserID from EParticipant WHERE EventID={$h_get_all_users_in_event__eventID});";
    if ($result = $con->query($sqlGetAllUsers)) {

        while ($row = $result->fetch_assoc()) {
            $h_get_all_users_in_event__eventUsers[$row["UserID"]] = $row;
        }

        /*freeresultset*/
        $result->free();
    }

    //you can get all the event Users 
?>