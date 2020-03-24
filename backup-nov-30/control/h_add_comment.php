<?php 

    //INPUT: NONE
    //OUTPUT: POST
    //SIDE EFFECT: Store comment to db

    //////////////////////////
    // POST
    //////////////////////////


    require('./z_session.php');

    $userID = $_SESSION["userID"];

    //TODO verify that the user can add comment to this post

    if(!empty($_POST)){

        if(isset($_POST['postID']) && isset($_POST['newComment'])){
            $postID = ((int)$_POST["postID"]);
            $commentContent = $_POST["newComment"];

            require('./db_connect.php');

            $addNewComment="INSERT INTO Comments Values (NULL, {$postID}, CURRENT_TIME(), '{$commentContent}', {$userID});";

            $result = $con->query($addNewComment);

            header("Location: " . $_SERVER['REQUEST_URI']);
        }
    }
?>