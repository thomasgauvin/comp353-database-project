<?php
    require('./z_session.php');

    require('./control/h_get_all_events.php');

    print(json_encode($h_get_all_events__events));
?>