<?php
    //INPUT: $h_add_existing_user_to_event__eventID
    //INPUT: $h_add_existing_user_to_event__email

    // SIDE EFFECT: Add user to event in db

    require('./z_session.php');
    require('./db_connect.php');

    //GET USER ID FROM EMAIL
    $h_get_userID_from_email__email = $h_add_existing_user_to_event__email;
    require('./control/h_get_userID_from_email.php');
    $userID = $h_get_userID_from_email__userID;

    // CHECK IF USER IS NOT ALREADY IN EVENT
    $h_get_all_users_in_event__eventID = $h_add_existing_user_to_event__eventID;
    require('./control/h_get_all_users_in_event.php');

    //ADD USER CONDITIONALLY
    if(isset($h_get_all_users_in_event__eventUsers[$userID])){
        print('the person you are trying to invite is already in the event!');
    }
    else{
        //add user to event
        $sqlAddUserToEvent="INSERT into EParticipant Values ($userID, $h_add_existing_user_to_event__eventID);";
        
        $result = $con->query($sqlAddUserToEvent);
    }




?>