<?php
    require('./z_session.php');

    require('./control/f_post_new_comment.php');

    require('./control/h_get_all_users.php');
?>
<html>
  <head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <?php
    require('html_header.php');
  ?>
    <div class="d-flex">
      <nav class="flex-column justify-content-start navbar navbar-dark bg-dark" style="width:350px;">
      <div class="p-2 navbar-brand" href="#">EventWorld</div>
        <div class="p-2 navbar-text">
            Email:
	    <?php
		  print($_SESSION["email"]);
	    ?>
        </div>
        <h5 class="p-2 text-center" style="color:white;">Your Events</h5>
	        <ul class="navbar-nav p-2">
           <?php
              require('./control/h_get_all_events.php');
                for($x = 0; $x < count($h_get_all_events__events); $x++){
                    $event = $h_get_all_events__events[$x];
                    $eventName = $event["EName"];
                    $eventID = $event["EventID"];
                    $eventLink = "./event_page.php?eventID={$eventID}";
                    print("<li class='nav-item text-center'><a class='nav-link' href={$eventLink}>{$eventName}</a></li>");
                }
            ?>
          </ul>
          <h5 class="p-2 text-center" style="color:white;">Your Event To Create</h5>
	        <ul class="navbar-nav p-2">
           <?php
              require('./control/h_get_all_event_codes_by_user.php');
                for($x = 0; $x < count($h_get_all_event_codes__codes); $x++){
                    $code = $h_get_all_event_codes__codes[$x];
                    $codeNumber = $code["Code"];
                    $eventName = $code["EventName"];
                    $createEventLink = "./z_create_event.php?code={$codeNumber}";
                    print("<li class='nav-item text-center'><a class='nav-link' href={$createEventLink}>{$eventName}</a></li>");
                }
            ?>
          </ul>
          
        <h5><a href="/z_create_event_code.php">Create Event Code</a></h5>
        <h5><a href="/messages_page.php">Messages</a></h5>
        <h5><a href="/z_logout.php">Log out</a></h5>


      </nav>
        <div class="posts-container">
            <?php
                require('./control/h_get_all_posts_and_all_comments.php');
                
                for($x = 0; $x < count($h_get_all_posts_and_all_comments__posts); $x++){

                    $post = $h_get_all_posts_and_all_comments__posts[$x];
                    $comments = $h_get_all_posts_and_all_comments__comments;
                    $users = $h_get_all_users__users;

                    require('./components/post_component.php');
        
                    print($postComponent);

                    print("<br />");
                }
            ?>
        </div>

    </div>
  </body>
</html>
