<?php

    require('./z_session.php');
    //sample user id
    $h_get_user_by_id__userID = $_SESSION['userID'];

    require('./control/h_get_user_by_id.php');
    $userID = getUserDetailsByID($_SESSION['userID']);

    $eventCode = $_GET['code'];
    //check that user is the event manager
    $getEventManagerIdQuery = "SELECT EventManager FROM EventCode WHERE Code = {$eventCode}";
    if($result = $con->query($getEventManagerIdQuery)){
        $eventManagerId = $result->fetch_object()->EventManager;
        $result->free();
    }
    //redirect to home page if not a correct event code or not the event manager
    if (!isset($eventCode) || $h_get_user_by_id__userID != $eventManagerId) { 
        header("Location: https://crc353.encs.concordia.ca/");
    }

    if(!empty($_POST)){
        if(isset($_POST['eName']) && isset($_POST['eDescription']) && isset($_POST['address']) && isset($_POST['type'])
        && isset($_POST['startDateTime']) && isset($_POST['endDateTime'])) {
            $eName = $_POST['eName'];
            $eDescription = $_POST['eDescription'];
            $eventManagerID = $h_get_user_by_id__userID;
            $address = $_POST['address'];
            $type = $_POST['type'];
            $startDateTime = date("Y-m-d H:i:s",strtotime($_POST['startDateTime']));
            $endDateTime = date("Y-m-d H:i:s",strtotime($_POST['endDateTime']));

            if (isset($_POST['isRecurring'])) {
                $isRecurring = 1;
            } else {
                $isRecurring = 0;
            }

            $createEvent="INSERT Into Event VALUES(NULL, '{$eName}', '{$eDescription}', '{$type}', {$isRecurring}, {$eventManagerID} , '{$address}', '{$startDateTime}', '{$endDateTime}')";
            $deleteEventCode="DELETE FROM EventCode WHERE Code={$eventCode}";

            if($result = $con->query($createEvent)) {
                print json_encode($result);
            }
           // $con->query($deleteEventCode);
            header("Location: https://crc353.encs.concordia.ca/");
        }
    }
?>

<html>	
    <?php
        require('html_header.php');
    ?>
      <body>
            <div class="d-flex justify-content-center" style="margin-top:100px">
            <div class="card" style="width:20rem; text-align:center">
            <div class="card-body">
                <h5>Create Event</h5>
                <br/>
                <form action="" method="POST">
                    <input type="text" class="form-control" placeholder="Event Name" name="eName" required>
                    <br>
                    <input type="text" class="form-control" placeholder="Event Description" name="eDescription" required>
                    <br>
                    <input type="text" class="form-control" placeholder="Event Address" name="address" required>
                    <br>
                    <label>Start Date</label>
                    <input type="datetime-local" class="form-control" placeholder="Event Start Time" name="startDateTime" required>
                    <br>
                    <label>End Date</label>
                    <input type="datetime-local" class="form-control" placeholder="Event End Time" name="endDateTime" required>
                    <br>
                    <label>Type</label>
                    <select class="form-control"  name="type" required>
                        <option value="Non-Profit Organization">Non-Profit Organization</option>
                        <option value="Profit Organization">Profit Organization</option>
                    </select>
                    <br>
                    <label>Recurring</label>
                    <input type="checkbox" name="isRecurring" value="isRecurring">
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
            </div>
            </div>

        </body>
</html>	

