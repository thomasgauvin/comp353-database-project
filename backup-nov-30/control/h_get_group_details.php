<?php
    
    //INPUT: $h_get_group_details__groupID
    //OUTPUT: $h_get_group_details__groupDetails

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    $h_get_group_details__groupDetails = array();

    //get all group details and print in json
    $sqlGetGroupDetails="SELECT * from EventGroup WHERE GroupID = {$h_get_group_details__groupID};";
    if ($result = $con->query($sqlGetGroupDetails)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_group_details__groupDetails, $row);
        }

        print json_encode($h_get_group_details__groupDetails);

        /*freeresultset*/
        $result->free();
    }

    $h_get_group_details__groupDetails = $h_get_group_details__groupDetails[0];

?>