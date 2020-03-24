<?php
    //INPUT: $h_get_userID_from_email__email
    //OUTPUT: $h_get_userID_from_email__userID

    require('./z_session.php');
    require('./db_connect.php');

    $h_get_userID_from_email__userID = null;

    //get userid by email
    $sqlGetUserIDByEmail="SELECT UserID from User WHERE Email = '{$h_get_userID_from_email__email}';";
    if ($result = $con->query($sqlGetUserIDByEmail)) {

        $h_get_userID_from_email__userID = $result->fetch_assoc()["UserID"];
        
        /*freeresultset*/
        $result->free();
    }
?>