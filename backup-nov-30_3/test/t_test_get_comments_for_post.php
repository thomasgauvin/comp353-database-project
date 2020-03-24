<?php
    require('./z_session.php');

    //sample post
    $h_get_comments_for_post__postID = 3;

    require('./control/h_get_comments_for_post.php');

    print(json_encode($h_get_comments_for_post__postComments));
?>