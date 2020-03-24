<?php

    require('./z_session.php');

    //sample user id
    require('./control/h_get_user_by_id.php');
    $admin = getUserDetailsByID($_SESSION['userID'])[0]["Admin"];

    // If not admin, user gets redirected to homepage, else allow to create event
    if($admin == false) {
        header("Location: https://crc353.encs.concordia.ca/home_page.php");
    } 

    if(!empty($_POST)){
        if(isset($_POST['eventName']) && isset($_POST['email'])) {
            $eventName = $_POST['eventName'];
            $email = $_POST['email'];
            $getEventManagerID = "SELECT UserID from User where Email = '{$email}'";
            if ($result = $con->query($getEventManagerID)) {
                $eventManagerIDObject = $result->fetch_object();
                $eventManagerID = $eventManagerIDObject->UserID;
                /*freeresultset*/
                $result->free();
            }

            if (!empty($eventManagerID)) {
                $createEventCode="INSERT Into EventCode VALUES(NULL, {$eventManagerID}, '{$eventName}')";
                $con->query($createEventCode);
            }
        }
    }
    
?>

<html>	
      <body>
      <?php
        require('./html_header.php');
      ?>
            <div class="d-flex justify-content-center" style="margin-top:100px">
            <div class="card" style="width:20rem; text-align:center">
            <div class="card-body">
                <h5 class="card-title">Create an Event Code</h5>
                <br>
                <form action="" method="POST">
                    <input type="text" class="form-control" placeholder="Enter Event Name" name="eventName" required>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter Event Manager's email" name="email" required>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </form>
            </div>
            </div>
            </div>

        </body>
</html>	

