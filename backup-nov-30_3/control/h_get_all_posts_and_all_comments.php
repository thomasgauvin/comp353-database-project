<?php

    //INPUT: NONE
    //OUTPUT: $h_get_all_posts_and_all_comments__posts
    //OUTPUT: $h_get_all_posts_and_all_comments__comments

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');

    //get user id
    $userID = $_SESSION['userID'];

    //variable is accessible where imported
    $h_get_all_posts_and_all_comments__posts = array();

    //get all posts that the user should see from home page and print in json
    $sqlGetAllPosts="SELECT * from Post WHERE GroupID IN (
        SELECT GroupID from GParticipant WHERE UserID = {$userID});";
    if ($result = $con->query($sqlGetAllPosts)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_all_posts_and_all_comments__posts, $row);
        }

        /*freeresultset*/
        $result->free();
    }

    $h_get_all_posts_and_all_comments__comments = array();

    //get all comments that the user should see from home page and print in json
    $sqlGetAllPosts="SELECT p.PostID as postID, c.Author as cAuthor, c.Content as cContent from Post as p JOIN Comments c on c.PostID = p.PostID WHERE GroupID IN (
        SELECT GroupID from GParticipant WHERE UserID = {$userID});";
    if ($result = $con->query($sqlGetAllPosts)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_all_posts_and_all_comments__comments, $row);
        }

        /*freeresultset*/
        $result->free();
    }    
?>