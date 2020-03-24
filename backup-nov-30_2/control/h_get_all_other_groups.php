<?php

    //INPUT: $h_get_all_other_groups__eventID
    //OUTPUT: $h_get_all_other_groups__otherGroups

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    //variable is accessible where imported
    $h_get_all_other_groups__otherGroups = array();

    //get all groups in the event that the USER IS PART OF
    $sqlGetAllOtherGroups="SELECT * from EventGroup WHERE EventID={$h_get_all_other_groups__eventID} AND GroupID NOT IN (
        SELECT GroupID from GParticipant WHERE UserID={$userID});";
    if ($result = $con->query($sqlGetAllOtherGroups)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_all_other_groups__otherGroups, $row);
        }

        /*freeresultset*/
        $result->free();
    }

    //you can get all the groups that the user has access to in an event with this script
?>