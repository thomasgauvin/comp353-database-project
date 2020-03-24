<?php

    require('./z_session.php');

    require('./control/h_add_comment.php');

    require('./control/f_new_post.php');

      //GETTING groupID from URL PARAMS
      if (!isset($_GET['groupID'])) { //redirect to home page if not a correct event id
        header("Location: https://crc353.encs.concordia.ca/home_page.php");
    }
    $h_get_all_users_in_group__groupID = $_GET['groupID'];
    $h_get_group_posts_and_comments__groupID = $_GET['groupID'];
    require('./control/h_get_group_details.php');
    //print(($groupDetails));
    $groupName=$groupDetails["GName"]; //need this for display

?>
<html>
    <?require('./html_header.php');?>
    <body>
        <div class="d-flex">
        <nav class="flex-column justify-content-start navbar navbar-dark bg-dark" style="width:350px;">
        <div class="p-2 navbar-brand">EventWorld</div>
        <?php
            print("<div class='p-2 navbar-brand'>".$groupName."</div>")
        ?>
            <div class="p-2 navbar-text">
                Email:
                <?php
                    print($_SESSION["email"]);
                ?>
            </div>

            <h6 class="p-2 text-center" style="color:white;">Participants in Group</h6>
            <ul class="navbar-nav p-2">
            <?php
                require('./control/h_get_all_users_in_group.php');
                    for($x = 0; $x < count($h_get_all_users_in_group__groupUsers); $x++){
                        $groupUser = $h_get_all_users_in_group__groupUsers[$x];
                        $groupUserFName = $groupUser["FName"];
                        $groupUserLName = $groupUser["LName"];
                        print("<li class='nav- navbar-text'>{$groupUserFName} {$groupUserLName}</li>");
                    }
                ?>
            </ul>

        </nav>

        <div class="posts-container">
            <?php
                $groupID = $_GET['groupID'];
                require('./components/new_post_component.php');

                $h_get_group_posts_and_comments__groupID = $_GET['groupID'];
                require('./control/h_get_group_posts_and_comments.php');
                $posts = $h_get_group_posts_and_comments__posts;
                $comments = $h_get_group_posts_and_comments__comments;
                $users = $h_get_all_users_in_group__groupUsers;
                for($x = 0; $x < count($posts); $x++){
                    $post = $posts[$x];
                    require('./components/post_component.php');

                    print($postComponent);
                    print("<br />");
                }
            ?>
        </div>
    </body>
</html>