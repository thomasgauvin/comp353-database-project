<?php
    require('./z_session.php');

    require('./control/h_get_all_posts_and_all_comments.php');

    print(json_encode($h_get_all_posts_and_all_comments__posts));
    print('<br /> <br />');
    print(json_encode($h_get_all_posts_and_all_comments__comments));
?>