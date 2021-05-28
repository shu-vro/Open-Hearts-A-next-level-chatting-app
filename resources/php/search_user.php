<?php 
session_start();
include_once "connect.php";

$Unique_Id = $_SESSION['Unique_Id'];
if (empty($Unique_Id)) {
    header('location: ../../register.php');
    die();
}
$search = mysqli_real_escape_string($conn, $_POST['search-data']);

$output = '';
$sql = mysqli_query($conn, "SELECT * FROM `lads` WHERE `Full Name` LIKE '%$search%' AND NOT `Unique Id` = '$Unique_Id'");
if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
        $active = "";

        if ($row['Active'] > time()) {
            $active = "online";
        }
        $output .= "
        <a href='members.php?receiver-id=" . $row['User Id'] . "' class='shadow'>
            <img src='resources/img/" . $row['Image'] . "' alt='Others Profile' class='" . $row['Gender'] . "' />
            <div class='name'>
                <span>" . $row['Full Name'] . "</span>
                <span>Click me to chat! </span>
            </div>
            <div class='active " . $active . "'></div>
        </a>
        ";
    }
} else {
    $output = 'No people Named - ' . $search;
}

echo $output;
?>