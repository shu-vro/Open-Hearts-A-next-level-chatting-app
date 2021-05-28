<?php 
session_start();
include_once "connect.php";
$Unique_Id = $_SESSION['Unique_Id'];
$time = time() + 10;
if ($conn) {
    $sql1 = mysqli_query($conn, "UPDATE `lads` SET `Active`= '$time' WHERE `Unique Id` = '$Unique_Id'");
} else {
    echo "Error Connecting To Database.";
}
?>