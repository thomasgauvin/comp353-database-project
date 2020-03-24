<?php

    require('./z_session.php');

    require('./control/h_add_comment.php');

    require('./control/f_new_post.php');

    require('./html_header.php');

    //GETTING eventID from URL PARAMS
    if (!isset($_GET['eventID'])) { //redirect to home page if not a correct event id
        header("Location: https://crc353.encs.concordia.ca/home_page.php");
    }

    $h_get_event_details__eventID = $_GET['eventID'];
    $h_get_all_users_in_event__eventID = $_GET['eventID'];
    $h_get_all_my_groups__eventID = $_GET['eventID'];
    $h_get_all_other_groups__eventID = $_GET['eventID'];
    require('./control/h_get_event_details.php');

    //print("<br /><br />");
    $eventName=$eventDetails["EName"]; //need this for display
    $eventID=$h_get_event_details__eventID;
    $eventOwnerID = $eventDetails["EventManager"];
  
    $h_get_user_by_id__userID = $eventOwnerID;
    require('./control/h_get_user_by_id.php');

    require('./control/h_get_all_users.php');

    //print(json_encode($userDetails));    
    
    //print("<br /><br />");

    require('./control/h_get_event_posts.php');

    //print(json_encode($eventPosts));

    //print("<br /><br />");

    
?>
<html>
  <head>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
  </head>
  <body>
 <div class="d-flex">
      <nav class="flex-column justify-content-start navbar navbar-dark bg-dark" style="width:350px;">
      <div class="p-2 navbar-brand">EventWorld</div>
      <?php
         print("<div class='p-2 navbar-brand'>".$eventName."</div>")
      ?>
        <div class="p-2 navbar-text">
            Email:
            <?php
                print($_SESSION["email"]);
            ?>
        </div>
        <h5 class="p-2 text-center" style="color:white;">My Groups</h5>
        <ul class="navbar-nav p-2">
           <?php
              require('./control/h_get_all_my_groups.php');
                for($x = 0; $x < count($h_get_all_my_groups__myGroups); $x++){
                    $myGroup = $h_get_all_my_groups__myGroups[$x];
                    $myGroupName = $myGroup["GName"];
                    $myGroupID = $myGroup["GroupID"];
                    $myGroupLink = "./group_page.php?groupID={$myGroupID}";
                    print("<li class='nav-item text-center'><a class='nav-link' href={$myGroupLink}>{$myGroupName}</a></li>");
                }
            ?>
        </ul>

        <h5 class="p-2 text-center" style="color:white;">Other Groups</h5>
        <ul class="navbar-nav p-2">
           <?php
              require('./control/h_get_all_other_groups.php');
                for($x = 0; $x < count($h_get_all_other_groups__otherGroups); $x++){
                    $otherGroup = $h_get_all_other_groups__otherGroups[$x];
                    $otherGroupName = $otherGroup["GName"];
                    $otherGroupID = $otherGroup["EventID"];
                    $otherGroupLink = "./event_page.php?eventID={$otherGroupID}";
                    print("<li class='nav-item text-center navbar-text'>{$otherGroupName}   <button type='button' class='btn btn-outline-primary btn-sm'>Apply</button></li>");
                }
            ?>
        </ul>

        <h6 class="p-2 text-center" style="color:white;">Participants in Event</h6>
        <ul class="navbar-nav p-2">
           <?php
              require('./control/h_get_all_users_in_event.php');
                for($x = 0; $x < count($h_get_all_users_in_event__eventUsers); $x++){
                    $eventUser = $h_get_all_users_in_event__eventUsers[$x];
                    $eventUserFName = $eventUser["FName"];
                    $eventUserLName = $eventUser["LName"];
                    print("<li class='nav-item navbar-text'>{$eventUserFName} {$eventUserLName}</li>");
                }
            ?>
        </ul>

      </nav>
    <div class="posts-container">

    <?php

        $h_get_user_by_id__userID = $_SESSION['userID'];

        require('./control/h_get_user_by_id.php');

        $details = $h_get_user_by_id__userDetails[0];
        $admin = $details["Admin"];

        // If user is admin or user manager they can edit the page
        if($admin == true) {
            $eventUpdateLink = "./z_update_event.php?eventID={$eventID}";
            print("<a class='nav-link' href={$eventUpdateLink}>Update Event</a>");
        } 

        $createGroupLink = "./z_create_group.php?eventID={$eventID}";
            print("<a class='nav-link' href={$createGroupLink}>Create Group</a>");

        require('./components/new_post_component.php');
        
        require('./control/h_get_all_posts_and_all_comments.php');
        $posts = $h_get_all_posts_and_all_comments__posts;
        $comments = $h_get_all_posts_and_all_comments__comments;
        $users = $h_get_all_users_in_event__eventUsers;
        for($x = 0; $x < count($posts); $x++){
            $post = $posts[$x];

            require('./components/post_component.php');

            print($postComponent);
            print("<br />");
        }
    ?>
    </div>
<body>
</html>
