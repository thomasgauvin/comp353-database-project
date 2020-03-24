<?php
    require('./z_session.php');
    require('html_header.php');
    if (!isset($_GET['eventID'])) { //redirect to home page if not a correct event id
        header("Location: https://crc353.encs.concordia.ca/home_page.php");
    }

    $h_get_event_details__eventID = $_GET['eventID'];
    
    //sample user id
    $h_get_user_by_id__userID = $_SESSION['userID'];

    $getEventManagerIdQuery = "SELECT EventManager FROM Event WHERE EventID = {$h_get_event_details__eventID}";

    if ($result = $con->query($getEventManagerIdQuery)) {
        $eventManagerId = $result->fetch_object()->EventManager;

        /*freeresultset*/
        $result->free();
    }

    require('./control/h_get_user_by_id.php');

    $details = $h_get_user_by_id__userDetails[0];

    $admin = $details["Admin"];

    if(!empty($_POST)){
        if(isset($_POST['eName']) && isset($_POST['eDescription']) && isset($_POST['address']) 
            && isset($_POST['type']) && isset($_POST['isRecurring'])
            && isset($_POST['startDateTime']) && isset($_POST['endDateTime'])){
            $eName = $_POST['eName'];
            $eDescription = $_POST['eDescription'];
            $address = $_POST['address'];
            $startDateTime = $_POST['startDateTime'];
            $endDateTime = $_POST['endDateTime'];

            $updateEventQuery = "UPDATE Event SET EName = '{$eName}', eDescription = '{$eName}', Type = '{$type}',
            isRecurring = {$isRecurring}, StartDateTime = {$startDateTime}, EndDateTime = {$endDateTime}
            WHERE EventID = {$h_get_event_details__eventID}";
            print($updateEventQuery);
            
            if($result = $con->query($updateEventQuery)){
                print ("Updated");
                print($updateEventQuery);  
            };

        }
    }

?>

<html>	
      <body>
            <div class="d-flex justify-content-center" style="margin-top:100px">
            <div class="card" style="width:20rem; text-align:center">
            <div class="card-body">
                <h5>Update Event</h5>
                <br/>
                <form action="" method="POST">
                    <input type="text" class="form-control" placeholder="Event Name" name="eName" required>
                    <br>
                    <input type="text" class="form-control" placeholder="Event Description" name="eDescription" required>
                    <br>
                    <input type="text" class="form-control" placeholder="Event Address" name="address" required>
                    <br>
                    <label>Start Date</label>
                    <input type="date" class="form-control" placeholder="Event Start Time" name="startDateTime" required>
                    <br>
                    <label>End Date</label>
                    <input type="date" class="form-control" placeholder="Event End Time" name="endDateTime" required>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
            </div>
            </div>

        </body>
</html>	

