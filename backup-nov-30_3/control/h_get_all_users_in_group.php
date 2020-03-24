<?php

    //INPUT: $h_get_all_users_in_group__groupID
    //OUTPUT: $h_get_all_users_in_group__groupUsers

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //variable is accessible where imported
    $h_get_all_users_in_group__groupUsers = array();

    //get all users for particular group
    $sqlGetAllUsers="SELECT * from User WHERE UserID IN (
        SELECT UserID from GParticipant WHERE GroupID={$h_get_all_users_in_group__groupID});";
    if ($result = $con->query($sqlGetAllUsers)) {

        while ($row = $result->fetch_assoc()) {
            $h_get_all_users_in_group__groupUsers[$row["UserID"]] = $row;
        }

        /*freeresultset*/
        $result->free();
    }

    //you can get all the group Users 
?>