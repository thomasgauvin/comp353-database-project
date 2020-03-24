<?php
    //INPUT: $h_get_event_posts__eventID
    //OUTPUT: $h_get_event_posts__eventPosts

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    //variable is accessible where imported
    $h_get_event_posts__eventPosts = array();

    //get all event posts that the user should see from the event page
    $sqlGetAllEventPosts="SELECT * from Post WHERE GroupID IN (
        SELECT gp.GroupID from EventGroup as eg JOIN GParticipant as gp ON eg.GroupID = gp.GroupID
        WHERE UserID = {$userID} AND EventID = {$h_get_event_posts__eventID} AND isMain = True);";
        
    if ($result = $con->query($sqlGetAllEventPosts)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_event_posts__eventPosts, $row);
        }

        /*freeresultset*/
        $result->free();
    }
?>