<?php
    require('./z_session.php');

    $h_get_group_posts__groupID = 2;

    require('./control/h_get_group_posts.php');

    print(json_encode($h_get_group_posts__groupPosts));
?>