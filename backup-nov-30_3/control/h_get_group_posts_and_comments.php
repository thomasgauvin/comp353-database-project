<?php
    //INPUT: $h_get_group_posts_and_comments__groupID
    //OUTPUT: $h_get_group_posts_and_comments__groupPosts

    //////////////////////////
    // GET
    //////////////////////////

    require('./z_session.php');
    require('./db_connect.php');
    
    //variable is accessible where imported
    $h_get_group_posts_and_comments__posts = array();

    //get all event posts that the user should see from the group page
    $sqlGetAllGroupPosts="SELECT * from Post WHERE GroupID = {$h_get_group_posts_and_comments__groupID};";

    if ($result = $con->query($sqlGetAllGroupPosts)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_group_posts_and_comments__posts, $row);
        }

        /*freeresultset*/
        $result->free();
    }

    $h_get_group_posts_and_comments__comments = array();

    //get all event posts that the user should see from the group page
    $sqlGetAllGroupComments="SELECT p.PostID as postID, c.Author as cAuthor, c.Content as cContent from Post as p JOIN Comments c on c.PostID = p.PostID AND GroupID = {$h_get_group_posts_and_comments__groupID};";
    if ($result = $con->query($sqlGetAllGroupComments)) {

        while ($row = $result->fetch_assoc()) {
            array_push($h_get_group_posts_and_comments__comments, $row);
        }

        /*freeresultset*/
        $result->free();
    }
?>