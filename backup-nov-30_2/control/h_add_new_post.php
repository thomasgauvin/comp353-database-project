<?php

    require('./z_session.php');

    $userID = $_SESSION['userID'];

    if(isset($_POST['newPostContent'])){
        if(isset($_POST['eventID'])){

            $newPostContent = $_POST['newPostContent'];
            $eventID = $_POST['eventID'];
            $newPostPermissions = $_POST['newPostPermissions'];

            require('./db_connect.php');

            //find default group id of the event
            $groupIDforEventIDQuery = "SELECT GroupID FROM EventGroup WHERE EventID = {$eventID} AND isMain = 1;"; 
            $result = $con->query($groupIDforEventIDQuery);
            $groupIDforEventID = $result->fetch_assoc()["GroupID"];
        
            //add new post to default group for event
            $addNewPost="INSERT INTO Post Values (NULL, '{$newPostContent}', '{$newPostPermissions}', CURRENT_TIME(), {$userID}, {$groupIDforEventID});";
            $result = $con->query($addNewPost);

            //redirect to avoid resubmission
            header("Location: " . $_SERVER['REQUEST_URI']);

        }
        elseif (isset($_POST['groupID'])){

            $newPostContent = $_POST['newPostContent'];
            $groupID = $_POST['groupID'];
            $newPostPermissions = $_POST['newPostPermissions'];

            //add new post to group id
            require('./db_connect.php');
            $addNewPost="INSERT INTO Post Values (NULL, '{$newPostContent}', '{$newPostPermissions}'', CURRENT_TIME(), {$userID}, {$groupID});";
            $result = $con->query($addNewPost);


            //redirect to avoid resubmission
            header("Location: " . $_SERVER['REQUEST_URI']);

        }
    }



?>