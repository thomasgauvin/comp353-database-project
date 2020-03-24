<?php

    require('./z_session.php');

    //sample user id
    $h_get_user_by_id__userID = $_SESSION['userID'];

    require('./control/h_get_user_by_id.php');

    

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
                $createEvent="INSERT Into Event VALUES(NULL, '{$eventName}', NULL, NULL, NULL, '{$eventManagerID}' , NULL, NULL, NULL)";

                // if($result = $con->query($createEvent)){
                    
                // };
                $con->query($createEvent);
            }
        }
    }
    
?>

<html>	
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
                    <input type="date" class="form-control" placeholder="Event Start Time" name="startDateTime" required>
                    <br>
                    <label>End Date</label>
                    <input type="date" class="form-control" placeholder="Event End Time" name="endDateTime" required>
                    <br>
                    <label>Type</label>
                    <select class="form-control"  name="type" required>
                        <option value="Non-Profit Organization">Non-Profit Organization</option>
                        <option value="Profit Organization">Profit Organization</option>
                    </select>
                    <br>
                    <label>Recurring</label>
                    <select class="form-control" name="isRecurring">
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
            </div>
            </div>

        </body>
</html>	

