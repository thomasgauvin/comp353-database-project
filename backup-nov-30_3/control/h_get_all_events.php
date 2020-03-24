<?php

    //INPUT: NONE
    //OUTPUT: $h_get_all_events__events

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    //variable is accessible where imported
    $h_get_all_events__events = array();

    //get all posts that the user should see from home page and print in json
    $sqlGetAllEvents="SELECT * from Event WHERE EventID IN (
        SELECT EventID from EParticipant WHERE UserID = {$userID});";
    if ($result = $con->query($sqlGetAllEvents)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_all_events__events, $row);
        }

        /*freeresultset*/
        $result->free();
    }

    //you can get all the events that the user has access to with this script
?>