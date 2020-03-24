<?php

    //INPUT: $h_invite_user_to_event__email

    // IF user is already registered: user is added to event
    // IF user is not registered: user is sent an email to create an account

    //////////////////////////
    // POST
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    if(isset($_POST['invite-button']) && isset($_POST["invitee-email-input"]) && isset($_POST['eventID'])){

        $h_invite_user_to_event__eventID = $_POST['eventID'];
        $h_invite_user_to_event__email = $_POST['invitee-email-input'];

        //variable is accessible where imported
        $users_with_email = array();

        //get all posts that the user should see from home page and print in json
        $sqlGetUsersWithEmail="SELECT * from User WHERE Email = '{$h_invite_user_to_event__email}';";
        if ($result = $con->query($sqlGetUsersWithEmail)) {

            $row = $result->fetch_assoc();

            //user exists
            if(isset($row)){
                $h_add_existing_user_to_event__eventID = $h_invite_user_to_event__eventID;
                $h_add_existing_user_to_event__email = $h_invite_user_to_event__email;
                require('./control/h_add_existing_user_to_event.php');
            }
            //user does not exit, send email
            else{
                $h_add_first_time_user__email = $h_invite_user_to_event__email;
                require('./control/h_add_first_time_user.php');
            }
        }
    }


?>