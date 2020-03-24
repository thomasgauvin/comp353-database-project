<?php
    require('./z_session.php');

    require('./control/h_get_all_event_codes_by_user.php');

    print(json_encode($h_get_all_event_codes__codes));
?>