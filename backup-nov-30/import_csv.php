<?php

require('./db_connect.php');

printf($filename=$_FILES["file"]["name"]);
$ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));

//we check,file must be have csv extention
if($ext=='csv')
{
  $file = fopen($filename, "r");
         while (($emapData = fgetcsv($file, 10000, "|")) !== FALSE)
         {
            $sql = "INSERT into users(lastname,firstname,middle_name,userID,password) values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]')";
            mysqli_query($con, $sql);
         }
         fclose($file);
         echo "CSV File has been successfully Imported.\n";
}
if($ext!=="csv") {
    printf("Error: Please Upload only CSV File");
}

$queryResult = mysqli_query($con, 'SELECT * from users');

echo "<b> <center>Database Output</center> </b> <br> <br>";
 
if ($result = $con->query("SELECT * from users")) {
 
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["lastname"];
        $field2name = $row["firstname"];
        $field3name = $row["middlename"];
        $field4name = $row["userID"];
        $field5name = $row["password"];
 
        echo '<b>'.$field1name.' '.$field2name.' '.$field3name.'</b><br />';
        echo $field5name.'<br />';
        echo $field5name.'<br />';
    }

/*freeresultset*/
$result->free();
}


?>
