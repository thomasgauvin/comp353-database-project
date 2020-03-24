<?php
    require('./z_session.php');

    //sample user id
    $h_get_user_by_id__userID = 12;

    require('./control/h_get_user_by_id.php');

    print(json_encode($h_get_user_by_id__userDetails));
?>