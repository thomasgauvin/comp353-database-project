<?php

    ////////////////////////
    //  INPUT: $h_send_email__to
    //  INPUT: $h_send_email__subject
    //  INPUT: $h_send_email__messageContent
    //
    //  SIDE EFFECT: Sends an email
    ////////////////////////

    $headers = "From: webmaster@SCC.com";

    mail($h_send_email__to,$h_send_email__subject,$h_send_email__messageContent,$headers);
?>