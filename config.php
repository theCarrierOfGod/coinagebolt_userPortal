<?php
// define('DB_SERVER','localhost');
// define('DB_USER','urban_user2');
// define('DB_PASS' ,'xXFZp4^b5ylL');
// define('DB_NAME', 'coinage');
$con = mysqli_connect('localhost','urban_user2','xXFZp4^b5ylL','coinage');
$conn = mysqli_connect('localhost','urban_user2','xXFZp4^b5ylL','coinage');
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
//echo "connected sucessfully ";	
}
?>