<?php
require('../config.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// manager
$sql = "Select * from member where title like '%主任'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
        echo $row["id"]." ".$row["name"]." ".$row["title"]."<br>";
    }
}
else echo "none";
// military
$sql = "Select * from member where title='教官'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
        echo $row["id"]." ".$row["name"]." ".$row["title"]."<br>";
    }
}
?>
