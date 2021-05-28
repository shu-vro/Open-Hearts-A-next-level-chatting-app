<?php
session_start();
include_once "../php/connect.php";
include_once "../php/utils.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$unique_id = mysqli_real_escape_string($conn, $_POST['unique_id']);
$password1 = mysqli_real_escape_string($conn, $_POST['password1']);
$password2 = mysqli_real_escape_string($conn, $_POST['password2']);

if ($conn) {
	if (!empty($email) && !empty($unique_id) && !empty($password1) && !empty($password2)) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$sql1 = mysqli_query($conn, "SELECT * FROM `lads` WHERE Email = '$email' AND `Unique Id` = '$unique_id'");
			if (mysqli_num_rows($sql1)) {
				if (isset($password1) && isset($password2)) {
				if ($password1 == $password2) {
					$newPassword = encrypt($password1);
					$sql2 = mysqli_query($conn, "UPDATE `lads` SET `Password` = '$newPassword' WHERE `Unique Id` = '$unique_id'");
					if ($sql2) {
						echo "Password Changed Successfully. <a href=\"index.php\">Log In</a> now.";
					} else {
						echo "Something Went Wrong. Try Again Later.";
					}
				} else {
					echo "Passwords Doesn't Match!";
				}
				} else {
					echo "Type a password.";
				}
			} else {
				echo "Email And Unique Id Not Matching.";
			}
		} else {
			echo $email . " - Is Not A Valid Email.";
		}
	} else {
		echo "All Fields Are Required";
	}
} else {
	echo "Error Connecting With Server!";
}
