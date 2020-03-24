<?php
    
    //INPUT: userID
    //OUTPUT: userDetails

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    function getUserDetailsByID($userID){
        $userDetails = array();

        //get all comments that the user should see from home page and print in json
        $sqlGetUserDetails="SELECT * from User WHERE UserID = {$userID};";
        if ($result = $con->query($sqlGetUserDetails)) {
    
            while ($row = $result->fetch_assoc()) {
                array_push($userDetails, $row);
            }
        
            /*freeresultset*/
            $result->free();
        }

        return $userDetails;
    }



?>