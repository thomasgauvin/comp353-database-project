<?php

    //INPUT: NONE
    //OUTPUT: $h_get_all_event_codes__codes

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    //variable is accessible where imported
    $h_get_all_event_codes__codes = array();

    //get all posts that the user should see from home page and print in json
    $sqlGetAllEventCodes="SELECT Code, EventName from EventCode WHERE EventManager = {$userID}";
    if ($result = $con->query($sqlGetAllEventCodes)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_all_event_codes__codes, $row);
        }

        /*freeresultset*/
        $result->free();
    }

    //you can get all the events that the user has access to with this script
?>