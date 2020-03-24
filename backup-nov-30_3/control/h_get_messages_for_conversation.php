<?php

    //INPUT: $h_get_messages_for_conversation__conversationUserID
    //OUTPUT: $h_get_messages_for_conversation__messages

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get current user id
    $userID = $_SESSION['userID'];

    //variable is accessible where imported
    $h_get_messages_for_conversation__messages = array();

    //get all groups in the event that the USER IS PART OF
    $sqlGetConversationMessages ="SELECT * from Messages WHERE FromUser={$userID} AND ToUser={$h_get_messages_for_conversation__conversationUserID}
        OR ToUser={$userID} AND FromUser={$h_get_messages_for_conversation__conversationUserID} ORDER BY Timestamp;";
    if ($result = $con->query($sqlGetConversationMessages)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_messages_for_conversation__messages, $row);
        }

        /*freeresultset*/
        $result->free();
    }

    //you can get all the groups that the user has access to in an event with this script
?>