<?php

$servername = "db4free.net";
$username = "windsake";
$password = "123456789";
$dbname = "windsake";

$con=mysqli_connect($servername,$username,$password); 
mysqli_select_db($dbname,$con);
$result=mysqli_query("select * from DataTable",$con);

echo $result;
?>