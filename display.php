<?php

$servername = "db4free.net";
$username = "windsake";
$password = "123456789";
$dbname = "windsake";

$con=mysqli_connect($servername,$username,$password); 
mysqli_select_db($dbname,$con);
$result=mysqli_query("select * from DataTable",$con);

echo "<table border='1' >
<tr>
<td align=center> <b>ID</b></td>
<td align=center><b>DATA</b></td>

while($data = mysqli_fetch_row($result))
{   
    echo "<tr>";
    echo "<td align=center>$data[0]</td>";
    echo "<td align=center>$data[1]</td>";
    echo "</tr>";
}
echo "</table>";
?>