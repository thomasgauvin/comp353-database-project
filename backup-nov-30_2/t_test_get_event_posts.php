<?php
    require('./z_session.php');

    $h_get_event_posts__eventID = 2;

    require('./control/h_get_event_posts.php');

    print(json_encode($h_get_event_posts__eventPosts));
?>