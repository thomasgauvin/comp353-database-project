<?php

    //INPUT: NONE
    //OUTPUT: $h_get_all_conversations__conversations

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    //variable is accessible where imported
    $h_get_all_conversations__conversations = array();

    //get all posts that the user should see from home page and print in json
    $sqlGetAllConverstations="SELECT FromUser AS UserID FROM Messages WHERE ToUser = {$userID} 
            UNION
        SELECT ToUser AS conversation FROM Messages WHERE FromUser = {$userID};";

    if ($result = $con->query($sqlGetAllConverstations)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_all_conversations__conversations, $row);
        }

        /*freeresultset*/
        $result->free();
    }

    //you can get all the events that the user has access to with this script
?>