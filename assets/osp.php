<?php
header('Access-Control-Allow-Origin: *'); 
$servername = "db4free.net";
$username = "windsake";
$password = "123456789";
$dbname = "windsake";
$table_name = "DataTable";

$mysqli = new mysqli($servername,$username,$password,$dbname);
$money = $_POST['money'];
//$mysqli->real_escape_string() function helps us prevent attacks such as SQL injection
$query  = "INSERT INTO $table_name (data) VALUES ($money)";

/*"insert into DataTable 
            set
                data = '$money'";*/

//execute the query
if( $mysqli ->query($query) ) {
    //if saving success
    echo "User was created.";
}else{
    //if unable to create new record
    echo "Database Error: Unable to create record.";
}
//close database connection
$mysqli->close();
}

echo json_encode($arr);
?>