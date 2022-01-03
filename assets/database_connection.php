<?php
    $servername = "db4free.net";
    $username = "windsake";
    $password = "123456789";
    $dbname = "windsake";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo $dbname;

    $sql = "SELECT * FROM DataTable";  //This is where I specify what data to query
    $result = $conn->query($sql);
    echo json_encode($result);
?>
