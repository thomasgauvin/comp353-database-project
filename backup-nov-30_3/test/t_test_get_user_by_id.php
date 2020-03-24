<?php
    require('./z_session.php');

    require('./control/h_get_user_by_id.php');

    //sample user id
    $userDetails = getUserDetailsByID(12);

    print(json_encode($userDetails));
?>