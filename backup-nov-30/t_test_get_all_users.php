<?php
    require('./z_session.php');

    require('./control/h_get_all_users.php');

    print(json_encode($h_get_all_users__users));
?>