<?php
header('Access-Control-Allow-Origin: *'); 
$servername = "db4free.net";
$username = "windsake";
$password = "123456789";
$dbname = "windsake";

$mysqli = new mysqli($servername,$username,$password,$dbname);
$result = $mysqli->query("SELECT * FROM DataTable");
$arr = array();


while ($row = $result->fetch_assoc()){
    array_push($arr,$row["id"],$row["data"]);
}

echo json_encode($arr);
?>