<?php

    //INPUT: $message_component__message
    //OUTPUT: NONE
    //SIDE EFFECT: Display comment

    //////////////////////////
    // POST
    //////////////////////////


    $userID = $_SESSION["userID"];

    if($message_component__message["FromUser"] == $userID){?>
    <div class="message-container">
        <div class="message-bubble message-bubble-sent bg-primary">
            <?=$message_component__message["Content"]?>
        </div>
    </div>
    <?}
    else{?>
    <div class="message-container">
        <div class="message-bubble message-bubble-received">
            <?=$message_component__message["Content"]?>
        </div>
    </div>
    <?}

?>