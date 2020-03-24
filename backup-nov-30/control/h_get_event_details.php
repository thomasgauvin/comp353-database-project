<?php
    
    //INPUT: $h_get_event_details__eventID
    //OUTPUT: $h_get_event_details__eventDetails

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    $h_get_event_details__eventDetails = array();

    //get all comments that the user should see from home page and print in json
    $sqlGetEventDetails="SELECT * from Event WHERE EventID = {$h_get_event_details__eventID};";
    if ($result = $con->query($sqlGetEventDetails)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_event_details__eventDetails, $row);
        }

        //print json_encode($posts);

        /*freeresultset*/
        $result->free();
    }

    $h_get_event_details__eventDetails = $h_get_event_details__eventDetails[0];


?>