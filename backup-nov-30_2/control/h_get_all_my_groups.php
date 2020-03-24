<?php

    //INPUT: $h_get_all_my_groups__eventID
    //OUTPUT: $h_get_all_my_groups__myGroups

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    //variable is accessible where imported
    $h_get_all_my_groups__myGroups = array();

    //get all groups in the event that the USER IS PART OF
    $sqlGetAllMyGroups="SELECT * from EventGroup WHERE EventID={$h_get_all_my_groups__eventID} AND GroupID IN (
        SELECT GroupID from GParticipant WHERE UserID={$userID});";
    if ($result = $con->query($sqlGetAllMyGroups)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_all_my_groups__myGroups, $row);
        }

        /*freeresultset*/
        $result->free();
    }

    //you can get all the groups that the user has access to in an event with this script
?>