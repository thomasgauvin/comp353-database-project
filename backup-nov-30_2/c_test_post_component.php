<?php


    require('./control/h_get_all_users.php');

    require('./control/h_get_all_posts_and_all_comments.php');

    $postComponents = array();


    for($x = 0; $x < count($h_get_all_posts_and_all_comments__posts); $x++){
        $post = $h_get_all_posts_and_all_comments__posts[$x];
        $comments = $h_get_all_posts_and_all_comments__comments;
        $users = $h_get_all_users__users;
        require('./components/post_component.php');

        print($postComponent);

        array_push($postComponents, $postComponent);
    }   

    require('./html_header.php');
?>