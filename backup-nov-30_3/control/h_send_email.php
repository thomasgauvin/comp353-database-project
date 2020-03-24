<?php

    ////////////////////////
    //  INPUT: $h_send_email__to
    //  INPUT: $h_send_email__subject
    //  INPUT: $h_send_email__messageContent
    //
    //  SIDE EFFECT: Sends an email
    ////////////////////////

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: webmaster@SCC.com";

    $mailResult = mail($h_send_email__to,$h_send_email__subject,$h_send_email__messageContent,$headers);
?>