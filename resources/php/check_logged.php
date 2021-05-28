<?php
session_start();
include_once "connect.php";
include_once "utils.php";

if ($conn) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $password = encrypt($password);
    if (!empty($email) && !empty($password)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = mysqli_query($conn, "SELECT `Email`, `Password`, `Unique Id` FROM `lads` WHERE Email = '$email' AND Password = '$password'");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['Unique_Id'] = $row['Unique Id'];
                $time = time();
                $sql1 = mysqli_query($conn, "UPDATE `lads` SET `Active` = '$time' WHERE `Email` = '$email'");
                if ($sql1) {
                    echo "Success";
                } else {
                    echo "Error Establishing Connection. Try Again Later.";
                }
            } else {
                echo "Email Or Password Is Incorrect.";
            }
        } else {
            echo $email . " - not a valid Email.";
        }
    } else {
        echo "All Fields Are Required!";
    }
} else {
    echo "Connection Error!";
}
