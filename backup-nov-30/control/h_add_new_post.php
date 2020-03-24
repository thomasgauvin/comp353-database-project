<?php

    if(isset($_POST['newPostContent'])){
        if(isset($_POST['eventID'])){
            print(json_encode($_POST['newPostContent']));
        }
        elseif (isset($_POST['groupID'])){
            print(json_encode($_POST['newPostContent']));

        }
    }



?>