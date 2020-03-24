<?php

    //INPUT: $h_add_first_time_user__email
    //SIDE EFFECT: Stores secret code in db
    //SIDE EFFECT: Sends email with secret code

    require('./z_session.php');
    require('./db_connect.php');

    require('./control/h_generate_random_string.php');

    $secretCode = generateRandomString(5);

    $h_send_email__to = $h_add_first_time_user__email;
    $h_send_email__subject = "You've been invited to join SCC!";
    $h_send_email__messageContent = "<html><body>You've been invited to join SCC, a new event management platform. Someone has invited you to an event on the platform, click <a href='https://crc353.encs.concordia.ca/z_create_account.php?secretCode={$secretCode}'>here</a> to create and account!</body><body>";
    require('./control/h_send_email.php');

    if($mailResult!=FALSE){
        //add secret code in db
        $sqlAddSecretCodeEmailPair="INSERT into SecretCodes Values ('{$h_add_first_time_user__email}', '{$secretCode}');";
        $result = $con->query($sqlAddSecretCodeEmailPair);
    }


?>