<?php
    
    //INPUT: $h_get_comments_for_post__postID
    //OUTPUT: $h_get_comments_for_post__postComments

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    $h_get_comments_for_post__postComments = array();

    //get all comments that the user should see from home page and print in json
    $sqlGetAllPostComments="SELECT p.PostID as postID, c.Author as cAuthor, c.Content as cContent from Post as p JOIN Comments c on c.PostID = p.PostID WHERE c.PostID = {$h_get_comments_for_post__postID} AND GroupID IN (
        SELECT GroupID from GParticipant WHERE UserID = {$userID});";
    if ($result = $con->query($sqlGetAllPostComments)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_comments_for_post__postComments, $row);
        }

        //print json_encode($posts);

        /*freeresultset*/
        $result->free();
    }


?>