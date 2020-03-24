<?php
    require('./z_session.php');

    //sample user id
    $h_get_user_by_id__userID = $_SESSION['userID'];

    require('./control/h_get_user_by_id.php');

    $details = $h_get_user_by_id__userDetails[0];
    
    $admin = $details["Admin"];
    $controller = $details["Controller"];
    
    //If not admin or controller, user gets redirected to homepage, else allow to create event
    if(!($admin == true || $controller == true)) {
        header("Location: https://crc353.encs.concordia.ca/home_page.php");
    } 

    if(isset($_POST['base']) && isset($_POST['discount']) && isset($_POST['extraBandwidth']) && isset($_POST['extraTime'])) {
        
        $base = $_POST['base'];
        $discount = $_POST['discount'];
        $extraBandwidth = $_POST['extraBandwidth'];
        $extraTime = $_POST['extraTime'];

        $queryUpdateBaseRate = "UPDATE Rate SET Amount = '{$base}' WHERE Type = 'Base'";
        $queryUpdateDiscountRate = "UPDATE Rate SET Amount = '{$discount}' WHERE Type = 'Discount'";
        $queryUpdateExtraBandwidthRate = "UPDATE Rate SET Amount = '{$extraBandwidth}' WHERE Type = 'ExtraBandwidth'";
        $queryUpdateExtraTimeRate = "UPDATE Rate SET Amount = '{$extraTime}' WHERE Type = 'ExtraTime'";

        $con->query($queryUpdateBaseRate);
        $con->query($queryUpdateDiscountRate);
        $con->query($queryUpdateExtraBandwidthRate);
        $con->query($queryUpdateExtraTimeRate);
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
                <h5 class="card-title"s>Rate</h5>
                <br>
                <form action="" method="POST">
                    <input type="text" class="form-control" placeholder="Base" name="base" required>
                    <br>
                    <input type="text" class="form-control" placeholder="Discount" name="discount" required>
                    <br>
                    <input type="text" class="form-control" placeholder="Extra Bandwitdh" name="extraBandwidth" required>
                    <br>
                    <input type="text" class="form-control" placeholder="Extra Time" name="extraTime" required>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
            </div>
            </div>

        </body>
</html>	

