<?php 
session_start();
if (isset($_SESSION['Unique_Id'])) {
    include_once "connect.php";
    include_once "utils.php";
    if ($conn) {
        $logout_id = mysqli_real_escape_string($conn, check($_GET['logout_id']));
        if (isset($logout_id)) {
            session_unset();
            session_destroy();
            header('location: ../../index.php');
            die();
        } else {
            header('location: ../../members.php');
            die();
        }
    } else {
        echo "Connection Error!";
    }
} else {
    header('location: ../../index.php');
    die();
}
