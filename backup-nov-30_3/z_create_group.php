<?php
    require('./z_session.php');
    require('html_header.php');
    if (!isset($_GET['eventID'])) { //redirect to home page if not a correct event id
        header("Location: https://crc353.encs.concordia.ca/home_page.php");
    }

    $h_get_event_details__eventID = $_GET['eventID'];
    
    //sample user id
    $h_get_user_by_id__userID = $_SESSION['userID'];

    require('./control/h_get_user_by_id.php');

    if(!empty($_POST)){
        if(isset($_POST['gName']) && isset($_POST['gDescription'])){
            $gName = $_POST['gName'];
            $gDescription = $_POST['gDescription'];
            $createGroupQuery = "INSERT INTO EventGroup VALUES(NULL, '{$gName}', '{$gDescription}', {$h_get_event_details__eventID}, {$h_get_user_by_id__userID}, 0)";

            $con->query($createGroupQuery);

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
                <h5 class="card-title">Create Group</h5>
                <br>
                <form action="" method="POST">
                    <input type="text" class="form-control" placeholder="Group Name" name="gName" required>
                    <br>
                    <input type="text" class="form-control" placeholder="Group Description" name="gDescription" required>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </form>
            </div>
            </div>
            </div>

        </body>
</html>	

