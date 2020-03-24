<?php

    //INPUT: NONE
    //OUTPUT: $h_get_all_messages_for_current_user__sent_messages
    //OUTPUT: $h_get_all_messages_for_current_user__received_messages

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    //variable is accessible where imported
    $h_get_all_messages_for_current_user__sent_messages = array();

    //get all groups in the event that the USER IS PART OF
    $sqlGetAllMySentMessages ="SELECT * from Messages WHERE FromUser={$userID};";
    if ($result = $con->query($sqlGetAllMySentMessages)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_all_messages_for_current_user__sent_messages, $row);
        }

        /*freeresultset*/
        $result->free();
    }

    //variable is accessible where imported
    $h_get_all_messages_for_current_user__received_messages = array();

    //get all groups in the event that the USER IS PART OF
    $sqlGetAllMyReceivedMessages ="SELECT * from Messages WHERE ToUser={$userID};";
    if ($result = $con->query($sqlGetAllMyReceivedMessages)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_all_messages_for_current_user__received_messages, $row);
        }

        /*freeresultset*/
        $result->free();
    }

    //you can get all the groups that the user has access to in an event with this script
?>