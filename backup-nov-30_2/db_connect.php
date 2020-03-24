<?php
  $host='crc353.encs.concordia.ca'; // Host name.
  $db_user='crc353_2'; //mysql user
  $db_password='pEQAF4'; //mysql pass
  $db='crc353_2'; // Database name.
  $con=  mysqli_connect($host,$db_user,$db_password,$db);

  // Check connection
  if (!$con)
  {
    echo "Failed to connect to MySQL: ". mysql_error();
  }
?>