<?php 

    //INPUT: NONE
    //OUTPUT: POST
    //SIDE EFFECT: Store message to db

    //////////////////////////
    // POST
    //////////////////////////

    require('./z_session.php');

    $userID = $_SESSION["userID"];

    //TODO verify that the user can send the message to this conversation

    if(!empty($_POST)){

        if(isset($_POST['conversationUserID']) && isset($_POST['newMessage'])){
            $conversationUserID = (int)$_POST["conversationUserID"];
            $messageContent = $_POST["newMessage"];

            require('./db_connect.php');

            $addNewMessage="INSERT INTO Messages Values (NULL, {$conversationUserID}, {$userID}, CURRENT_TIME(), '{$messageContent}');";

            $result = $con->query($addNewMessage);

            header("Location: " . $_SERVER['REQUEST_URI']);
        }
    }
?>