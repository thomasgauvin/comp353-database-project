<?php
    
    //INPUT: h_get_user_by_id__userID
    //OUTPUT: $h_get_user_by_id__userDetails

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    $h_get_user_by_id__userDetails = array();

    //get all comments that the user should see from home page and print in json
    $sqlGetUserDetails="SELECT * from User WHERE UserID = {$h_get_user_by_id__userID};";
    if ($result = $con->query($sqlGetUserDetails)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_user_by_id__userDetails, $row);
        }

        //print json_encode($posts);

        /*freeresultset*/
        $result->free();
    }


?>