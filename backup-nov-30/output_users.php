<?php
    require('./z_session.php');

    //Query to output all users from User Table
    $queryResult = mysqli_query($con, 'SELECT * from User');

    echo "<b> <center>User Table test</center> </b> <br> <br>";
    
    $selectUsers='SELECT * from User';
    if ($result = $con->query($selectUsers)) {
    
        while ($row = $result->fetch_assoc()) {
            $field1name = $row["UserID"];
            $field2name = $row["Email"];
            $field3name = $row["FName"];
            $field4name = $row["LName"];
            $field5name = $row["Admin"];
            $field6name = $row["Controller"];
    
            echo '<b>'.$field1name.'. '.$field3name.' '.$field4name.'</b><br />';
            echo $field2name.'<br />';
            echo '<br />';
        }

    /*freeresultset*/
    $result->free();
    }
?>
